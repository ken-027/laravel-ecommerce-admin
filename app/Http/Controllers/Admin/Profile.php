<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\Models\Admin\Admin;
use App\Models\Admin\Order;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\GeneralSetting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class Profile extends Controller
{
    public function index(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-profileeditform');
        $id = decrypt($request->session()->get('account')->id);

        return response()->json([
                // 'response' => view('admin.layout.forms.profile', [
                'response' => view('admin.layout.forms.profile', [
                    'is_edit' => $is_edit,
                    'id' => $is_edit ? $id : 0,
                    'profile' => Admin::get_account_by_id($id),
            ])->render(),
        ]);
    }

    //
    public function login(LoginRequest $request) {
       
        $account = Admin::get_account_by_username($request->input('email'))->first();
        $setting_info = general_setting_info();

        if (!empty($account) && Hash::check($request->input('password'), $account->password)) {
            $account->id = encrypt($account->id);
            $setting_info->id = encrypt($setting_info->id);
            $request->session()->put('account', $account);
            $request->session()->put('settings', $setting_info);

            if (!empty($request->input('rememberme')) && $request->input('rememberme') == 1) {
                Cookie::queue('email', encrypt($request->input('email')), 4320);
                Cookie::queue('password', encrypt($request->input('password')), 4320);
            } else {
                Cookie::queue(Cookie::forget('email'));
                Cookie::queue(Cookie::forget('password'));
            }
          
            return response()->json([
                'response' => [
                    'status' => 1,
                    'message' => 'login successfully',
                    'redirect_url' => url('/admin/dashboard')
                ]
            ]);
        }
        
        return response()->json([
            'response' => [
                'status' => 0,
                'message' => 'invalid account'
            ]
        ]);
    }

    public function logout(Request $request) {
        $request->session()->forget('account');
        return redirect(url('/admin/login'));
    }

    public function dashboard(Request $request) {        
        return view('admin.home', [
            'total_awaiting' => count(Order::get_report_awaiting($request)),
            'total_unpaid' => count(Order::get_report_unpaid($request)),
            'total_paid' => count(Order::get_report_paid($request)),
            'total_archive' => count(Order::get_report_archive($request)),            
        ]);
    }

    public function update(Request $request) {
        $message_logout = '';
        $request->validate([
            'id' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'newpassword' => 'nullable|max:15|min:8',
        ]);

        $request->id = decrypt($request->id);
        
        if (empty($request->newpassword)) 
            $result = Admin::update_user($request);
        else
            $result = Admin::update_user_password($request);

        $message = $result ? 'Update profile successfully!' : 'No changes was made';

        if (!empty($request->newpassword)) 
            $message_logout = 'and You will be logout for changing password';

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message . $message_logout,
                'redirect_url' => '/admin/profile/logout',
                'is_password_change' => (bool)!empty($request->newpassword),
            ]
        ]);
    }

    public function forgot_password(Request $request) {
        return view('admin.forgot-password');
    }

    public function new_password(Request $request) {
        $id = decrypt($request->id);
        $date = strtotime(decrypt($request->date));
        $user_info = Admin::get_info_by_id($id);

        if (date('Y-m-d G:i:s', $date) < date('Y-m-d G:i:s') || empty($user_info)) return redirect(route('forgot-password'));

        return view('admin.reset-password', [
            'user_info' => $user_info, 
        ]);
    }

    public function reset_password(Request $request) {
        $general_setting_info = GeneralSetting::get_list();
        $user_info = Admin::get_account_by_username($request->email)->first();
        $from_name = $general_setting_info->from_name;
        $from_email = $general_setting_info->from_email;

        try {
            if (empty($user_info)) throw new \Exception("Email does not exist", 1);

            Mail::send('mail.reset-password', ['user_info' => $user_info], function ($message) use($from_email, $from_name, $user_info) {
                $message->subject('Reset Password | ' . config('app.name'));
                $message->to($user_info->email, $user_info->name);
                $message->from('macmetro7296.test@gmail.com', 'mac metro');
            });            //code...
            $result = true;
            $message = 'Email sent, please check your inbox';

        } catch (\Throwable $th) {
            // exit(var_dump($th));
            $result = false;
            $message = $th->getMessage();
        }

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
                'data' => [],
                'redirect_url' => route('admin-login'),
            ]
        ], 200);
    }

    public function update_password(Request $request) {
        $request->validate([
            'user' => 'required',
            'password' => 'required|max:15|min:8',
        ]);

        $request->id = decrypt($request->user);

        $result = Admin::update_password($request);
        
        $message = $result ? 'Update password successfully' : 'Failed to update password';

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
                'data' => [],
                'redirect_url' => route('admin-login'),
            ]
        ], 200);
    }
}
