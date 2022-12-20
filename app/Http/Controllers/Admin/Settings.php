<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\GeneralSetting AS ModelGeneralSetting;

class Settings extends Controller
{
    //
    public function index(Request $request) {
        $is_edit = (bool)request()->routeIs('admin-settingeditform');
        $setting_info = general_setting_info();

        return response()->json([
            'response' => view('admin.layout.forms.settings',[
                'is_edit' => $is_edit,
                // 'id' => $is_edit ? $request->session()->get('account')->id : 0,
                'id' => $is_edit ? $setting_info->id : 0,
                'setting_info' => $setting_info,
                'display_terms' => json_decode($setting_info->display_terms),
                'other_settings' => json_decode($setting_info->other_settings),
                'payment_option' => json_decode($setting_info->payment_option),
                'sales_pack' => json_decode($setting_info->sales_pack),
                'shipping_option' => json_decode($setting_info->shipping_option),
                'captcha_settings' => json_decode($setting_info->captcha_settings),
            ])->render()
        ]);
    }

    protected function validate_fields($request) {
        $request->validate([
            'id' => 'required',
            //general
            'adminpanelname' => 'required',
            'sitename' => 'required',
            'website' => 'required|url',
            'phone' => 'required',
            'email' => 'required|email',
            'copyright' => 'required',
            'mapkey' => 'required',
            'newsbloglink' => 'required',
            'newsbloglinktarget' => 'required',
            'timezone' => 'required',
            'timeformat' => 'required',
            'dateformat' => 'required',
            'imeiapikey' => 'required',
            'statustermsconditions' => 'required',
            'showmodelstorage' => 'required',
            'showmissingproductsection' => 'required',
            'topsellerlimit' => 'required|numeric',
            'topsellermode' => 'required',
            'orderprefix' => 'required',
            'orderexpiringdays' => 'required|numeric',
            'orderexpireddays' => 'required|numeric',
            'pagelistlimit' => 'required|numeric',
            'promocodesection' => 'required',
            'displaycurrency' => 'required',
            'thousandseparator' => 'required',
            'decimalseparator' => 'required',
            'decimalnumber' => 'required',
            'newslettersection' => 'required',
            'defaultpaymentoption' => 'required',
            'recommendedpaymentoption' => 'required',
            'verification' => 'required',
            'servicehourstext' => 'required',
            'jscode' => 'required',
            'ordertrackingtag' => 'required',
            //company
            'companycompany' => 'required',
            'companyaddress' => 'required',
            'companycity' => 'required',
            'companystate' => 'required',
            'companycountry' => 'required',
            'companyzipcode' => 'required|numeric',
            'companyphone' => 'required|numeric',
            //email
            'emailname' => 'required',
            'emailemail' => 'required|email',
            'emailmailer' => 'required',
            //social
            'socialfacebook' => 'required|url',
            'socialtwitter' => 'required|url',
            'sociallinkedin' => 'required|url',
            'socialyoutube' => 'required|url',
            'socialmsg' => 'required|url',
            'socialinstagram' => 'required|url',
            // 'socialloginoption' => 'required',
            'socialgoogleclientid' => 'required',
            'socialgoogleclientsecret' => 'required',
            'socialfacebookappid' => 'required',
            'socialfacebookappsecret' => 'required',
            'sociallogin' => 'required',
            'socialloginoption' => 'required',
            //sms
            'smsstatus' => 'required',
            'smstwilioaccountsid' => 'required',
            'smstwilioaccountauthtoken' => 'required',
            'smstwiliolongcode' => 'required|numeric',
            //blog
            'blogwordslimit' => 'required|numeric',
            'blogrecentpost' => 'required',
            'blogcategories' => 'required',
            //homepage
            'offerpoptitle' => 'required',
            //shippingapi
            'shippingapi' => 'required',
            'shippingapikey' => 'required',
            'shippingdefaultcarrieraccount' => 'required',
            'shippingcarrieraccountid' => 'required',
            'shippingparcellength' => 'required|numeric',
            'shippingparcelwidth' => 'required|numeric',
            'shippingparcelheight' => 'required|numeric',
            'shippingparcelweight' => 'required|numeric',
            //captcha
            'captchakey' => 'required',
            'captchasecret' => 'required',
            //menutype
            'toprightmenu' => 'required',
            'headermenu' => 'required',
            'footermenucolumn1' => 'required',
            'footermenucolumn2' => 'required',
            'footermenucolumn3' => 'required',
            'copyrightmenu' => 'required',
        ], [
            'required' => 'this field is required.',
            'numeric' => 'this field must be a number.',
            'url' => 'this field must be a valid URL.',
            'email' => 'this field must be a valid email.',
        ]);
    }

    protected function validate_checboxes(&$request) {
        //===================================
        $request->onaccountcreation = empty($request->onaccountcreation) ? 0 : 1;
        $request->onconfirmsale = empty($request->onconfirmsale) ? 0 : 1;
        //===================================
        $request->keepspacebetweencurrency = empty($request->keepspacebetweencurrency) ? 0 : 1;
        //===================================
        // $request->newslettersection = empty($request->newslettersection) ? 0 : 1;
        // $request->showmodelstorage = empty($request->showmodelstorage) ? 0 : 1;
        //===================================
        $request->salespackfreesalespack = empty($request->salespackfreesalespack) ? 0 : 1;
        $request->salespackprintownnopostage = empty($request->salespackprintownnopostage) ? 0 : 1;
        //===================================
        $request->shippingoptionschedule = empty($request->shippingoptionschedule) ? 0 : 1;
        $request->shippingoptionpostown = empty($request->shippingoptionpostown) ? 0 : 1;
        //===================================
        $request->paymentbank = empty($request->paymentbank) ? 0 : 1;
        $request->paymentpaypal = empty($request->paymentpaypal) ? 0 : 1;
        $request->paymentcheck = empty($request->paymentcheck) ? 0 : 1;
        $request->paymentzelle = empty($request->paymentzelle) ? 0 : 1;
        $request->paymentcash = empty($request->paymentcash) ? 0 : 1;
        //===================================
        $request->emaildisplaydepartment = empty($request->emaildisplaydepartment) ? 0 : 1;
        //===================================
        $request->allow_offer_popup = empty($request->allow_offer_popup) ? 0 : 1;
        //===================================
        $request->allowshipmentbycustomer = empty($request->allowshipmentbycustomer) ? 0 : 1;
        //===================================
        $request->captchacontactform = empty($request->captchacontactform) ? 0 : 1;
        $request->captchawriteareviewform = empty($request->captchawriteareviewform) ? 0 : 1;
        $request->captchabulkorderform = empty($request->captchabulkorderform) ? 0 : 1;
        $request->captchaaffiliateform = empty($request->captchaaffiliateform) ? 0 : 1;
        $request->captchaloginform = empty($request->captchaloginform) ? 0 : 1;
        $request->captchasignupform = empty($request->captchasignupform) ? 0 : 1;
        $request->captchaordertrackform = empty($request->captchaordertrackform) ? 0 : 1;
        $request->captchanewsletterform = empty($request->captchanewsletterform) ? 0 : 1;
        $request->captchamissingproductform = empty($request->captchamissingproductform) ? 0 : 1;
        $request->captchaimeinumberbasesearchform = empty($request->captchaimeinumberbasesearchform) ? 0 : 1;
    }

    public function save(Request $request) {
        $is_edit = request()->routeIs('admin-settingupdate');

        $this->validate_fields($request);

        if($request->file('logosetting')) $request->validate(['logosetting' => 'image'], ['image' => 'this field must be an image']);
        if($request->file('sitemapfile')) $request->validate(['sitemapfile' => 'mimes:application/xml,xml|max:10000'], ['mimes' => 'this field must be an xml file']);
        // if($request->file('icon')) $request->validate(['icon' => 'image']);

        $request->id = decrypt($request->id);

        $this->validate_checboxes($request);

        if ($request->file('logosetting')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('logosetting')->getClientOriginalExtension();
            $request->logo = $fileName;
        }

        if ($request->file('sitemapfile')) {
            $fileName = base64_encode(date('YmdGis'));
            $fileName .= '.' . $request->file('sitemapfile')->getClientOriginalExtension();
            $request->sitemap = $fileName;
        }

        $pre_msg = 'Save';
        if($is_edit) {
            $result = ModelGeneralSetting::edit($request);
            $setting_info = general_setting_info();
            $setting_info->id = encrypt($setting_info->id);
            $request->session()->put('settings', $setting_info);

            $pre_msg = 'Update';
        }    

        if($result) {
            if (!empty($request->file('logosetting'))) {
                $id = !$is_edit ? $result : $request->id;
                $path = 'setting/' . base64_encode($id) . '/logo/';
                $request->file('logosetting')->storeAs( $path, $fileName, 'public');
            }
            if (!empty($request->file('sitemapfile'))) {
                $id = !$is_edit ? $result : $request->id;
                $path = 'setting/' . base64_encode($id) . '/sitemap/';
                $request->file('sitemapfile')->storeAs( $path, $fileName, 'public');
            }
        }

        $message = $result ? $pre_msg . ' successfully' : "No changes was made!";

        return response()->json([
            'response' => [
                'status' => (bool)$result,
                'message' => $message,
            ]
        ]);        
    }

    public function get_admin_links(Request $request) {
        
        $filtered = [];
        foreach(admin_page_links($request->search) as $title => $link) {
            $filtered[] = [
                'title' => $title,
                'link' => $link
            ];
        }
        return response()->json([
            'response' => [
                'status' => true,
                'message' => '',
                'filtered' => $filtered
            ]
        ]);        
    }

    // public function update_company_details(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'company' => 'required',
    //         'address' => 'required',
    //         'city' => 'required',
    //         'state' => 'required',
    //         'country' => 'required',
    //         'zipcode' => 'required|numeric',
    //         'phone' => 'required|numeric',
    //     ]);

    //     $request->id = decrypt($request->id);
    //     $result = ModelGeneralSetting::update_company_details($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message
    //         ]
    //     ]);
    // }

    // public function update_email(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'mailer' => 'required',
    //     ]);

    //     $request->id = decrypt($request->id);
    //     $request->displaydepartment = empty($request->displaydepartment) ? 0 : 1;
    //     $result = ModelGeneralSetting::update_email($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }

    // public function update_social(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'facebook' => 'required|url',
    //         'twitter' => 'required|url',
    //         'linkedin' => 'required|url',
    //         'youtube' => 'required|url',
    //         'msg' => 'required|url',
    //         'instagram' => 'required|url',
    //         // 'socialloginoption' => 'required',
    //         'googleclientid' => 'required',
    //         'googleclientsecret' => 'required',
    //         'facebookappid' => 'required',
    //         'facebookappsecret' => 'required',
    //     ]);

    //     $request->id = decrypt($request->id);
    //     $result = ModelGeneralSetting::update_social($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }

    // public function update_sms(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'twilioaccountsid' => 'required',
    //         'twilioaccountauthtoken' => 'required',
    //         'twiliolongcode' => 'required|numeric',
    //     ]);

    //     $request->id = decrypt($request->id);
    //     $result = ModelGeneralSetting::update_sms($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }

    // public function update_blog(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'blogwordslimit' => 'required|numeric',
    //         // 'blogrecentpost' => 'required',
    //         // 'twiliolongcode' => 'required|numeric',
    //     ]);

    //     $request->id = decrypt($request->id);
    //     $result = ModelGeneralSetting::update_blog($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }

    // public function update_homepage(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'offerpoptitle' => 'required',   
    //         // 'twiliolongcode' => 'required|numeric',
    //     ]);

    //     $request->id = decrypt($request->id);
    //     $request->allow_offer_popup = empty($request->allow_offer_popup) ? 0 : 1;
    //     $result = ModelGeneralSetting::update_homepage($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //             // 'html' => $request->processworksandslider
    //         ]
    //     ]);
    // }

    // public function update_shipping_api(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'shippingapi' => 'required',
    //         'shippingapikey' => 'required',
    //         'defaultcarrieraccount' => 'required',
    //         'carrieraccountid' => 'required',
    //         'shippingparcellength' => 'required|numeric',
    //         'shippingparcelwidth' => 'required|numeric',
    //         'shippingparcelheight' => 'required|numeric',
    //         'shippingparcelweight' => 'required|numeric',
    //         // 'webhookurl' => 'required|url',
    //     ]);

    //     $request->id = decrypt($request->id);
    //     $request->allowshipmentbycustomer = empty($request->allowshipmentbycustomer) ? 0 : 1;
    //     $result = ModelGeneralSetting::update_shipping_api($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }

    // public function update_captcha(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'captchakey' => 'required',
    //         'captchasecret' => 'required',
    //     ]);
        
    //     $request->id = decrypt($request->id);
    //     $result = ModelGeneralSetting::update_captcha($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }

    // public function update_menu_type(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //     ]);
        
    //     $request->id = decrypt($request->id);
    //     $result = ModelGeneralSetting::update_other_setting($request);

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }

    // public function update_sitemap(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         // 'sitemapfile' => 'required',
    //     ]);

    //     // $request->validate([
    //     //     'sitemapfile' => ['required', 'file', 'mimes:xml'],
    //     //     // 'alt' => ['required', 'string'],
    //     // ]);
    //     // $this->validate($request, [
    //     //     'sitemapfile' => 'required|mimes:xml',
    //     // ]);
        
    //     $request->id = decrypt($request->id);

    //     $fileName = $request->file('sitemapfile')->getClientOriginalName();
    //     $path = 'setting/' . base64_encode($request->id);
    //     $request->path = $path . $fileName;
    //     // $request->id = decrypt($request->id);
    //     // $result = ModelGeneralSetting::update_other_setting($request);
    //     $result = ModelGeneralSetting::update_sitemap($request);
        
    //     if ($result && $request->file()) $request->file('sitemapfile')->storeAs( $path, $fileName, 'public');

    //     $message = $result ? 'Upload successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }

    // public function update_general(Request $request) {
    //     $this->validate($request, [
    //         'id' => 'required',
    //         'adminpanelname' => 'required',
    //         'sitename' => 'required',
    //         'website' => 'required|url',
    //         'phone' => 'required',
    //         'email' => 'required|email',
    //         'copyright' => 'required',
    //         'mapkey' => 'required',
    //         'newsbloglink' => 'required',
    //         'newsbloglinktarget' => 'required',
    //         'timezone' => 'required',
    //         'timeformat' => 'required',
    //         'dateformat' => 'required',
    //         'imeiapikey' => 'required',
    //         'statustermsconditions' => 'required',
    //         'showmodelstorage' => 'required',
    //         'showmissingproductsection' => 'required',
    //         'topsellerlimit' => 'required|numeric',
    //         'topsellermode' => 'required',
    //         'orderprefix' => 'required',
    //         'orderexpiringdays' => 'required|numeric',
    //         'orderexpireddays' => 'required|numeric',
    //         'pagelistlimit' => 'required|numeric',
    //         'promocodesection' => 'required',
    //         'displaycurrency' => 'required',
    //         'thousandseparator' => 'required',
    //         'decimalseparator' => 'required',
    //         'decimalnumber' => 'required',
    //         'newslettersection' => 'required',
    //         'defaultpaymentoption' => 'required',
    //         'recommendedpaymentoption' => 'required',
    //         'verification' => 'required',
    //         'servicehourstext' => 'required',
    //         'jscode' => 'required',
    //         'ordertrackingtag' => 'required',
    //         'logosetting' => 'nullable|mimes:png, jpg',
    //         // 'webhookurl' => 'required|url',
    //     ]);


    //     // $request->validate([
    //     //     'logosetting' => ['sometimes|image'],
    //     //     // 'alt' => ['required', 'string'],
    //     // ]);

    //     $request->id = decrypt($request->id);
    //     //===================================
    //     $request->onaccountcreation = empty($request->onaccountcreation) ? 0 : 1;
    //     $request->onconfirmsale = empty($request->onconfirmsale) ? 0 : 1;
    //     //===================================
    //     $request->keepspacebetweencurrency = empty($request->keepspacebetweencurrency) ? 0 : 1;
    //     //===================================
    //     // $request->newslettersection = empty($request->newslettersection) ? 0 : 1;
    //     // $request->showmodelstorage = empty($request->showmodelstorage) ? 0 : 1;
    //     //===================================
    //     $request->salespackfreesalespack = empty($request->salespackfreesalespack) ? 0 : 1;
    //     $request->salespackprintownnopostage = empty($request->salespackprintownnopostage) ? 0 : 1;
    //     //===================================
    //     $request->shippingoptionschedule = empty($request->shippingoptionschedule) ? 0 : 1;
    //     $request->shippingoptionpostown = empty($request->shippingoptionpostown) ? 0 : 1;
    //     //===================================
    //     $request->paymentbank = empty($request->paymentbank) ? 0 : 1;
    //     $request->paymentpaypal = empty($request->paymentpaypal) ? 0 : 1;
    //     $request->paymentcheck = empty($request->paymentcheck) ? 0 : 1;
    //     $request->paymentzelle = empty($request->paymentzelle) ? 0 : 1;
    //     $request->paymentcash = empty($request->paymentcash) ? 0 : 1;
    //     //===================================
    //     if ($request->file('logosetting')) {
    //         $fileName = $request->file('logosetting')->getClientOriginalName();
    //         $path = 'setting/' . base64_encode($request->id) . '/';
    //         $request->logo = $path . $fileName;
    //     }
    //     $result = ModelGeneralSetting::update_general($request);
    
    //     if($result && $request->file()) $request->file('logosetting')->storeAs( $path, $fileName, 'public');

    //     $message = $result ? 'Update successfully!' : 'No changes was made!';

    //     return response()->json([
    //         'response' => [
    //             'status' => (bool)$result,
    //             'message' => $message,
    //         ]
    //     ]);
    // }
}
