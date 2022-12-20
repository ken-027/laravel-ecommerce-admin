<?php

use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifyCsrfToken;
use App\Http\Controllers as AppController;
use App\Http\Controllers\User\MobileController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\AccountController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//clearing cache

    // $target = storage_path('app/public');
    // $link = public_path('/storage');
    // symlink($target, $link);
    // echo "symbolic link created successfully";

Route::get('/update-app', function() {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    // Artisan::call('migrate:refresh');
    echo 'success';
    // return view('clear-cache');
});

Route::get('/storage-link', function() {
    Artisan::call('storage:link');
    echo 'success';
    // return view('clear-cache');
});

Route::get('/maintainance-enable', function() {
    Artisan::call('down');
    echo 'system is in maintainance';
});

Route::get('/token-error', function() {
    return view('csrf-error');
});




//users
Route::get('/', [AppController\AppMain::class, 'index'])->name('home');
// Route::get('/', function () {
//     // return view('welcome');
//     return view('home');
// });
Route::get('/order/review', [AppController\AppMain::class, 'review_order']);
Route::get('/device-type-or-brand', [AppController\AppMain::class, 'device_brand']);
Route::get('/device/{title}', [AppController\AppMain::class, 'model_list'])->name('client-device-list');
Route::get('/brand/{title}', [AppController\AppMain::class, 'model_list'])->name('client-brand-list');

Route::get('/blog', [AppController\Blog::class, 'index']);
Route::get('/blog/{id}', [AppController\Blog::class, 'get_post']);
Route::get('/blog/category/{category}', [AppController\Blog::class, 'category']);

foreach(Menu::get_client_menu() as $menu) {
    if (!$menu->parent && !empty($menu->url)) 
        Route::get($menu->url, [AppController\AppMain::class, substr(preg_replace("/[\W\s\/]+/", "_", $menu->url), 1) ])->name('user-'. strtolower($menu->menu_name));
}



Route::middleware(['authClient'])->group(function () {
    // client logout
    Route::post('/auth/logout', [LoginController::class, 'logout'])->name('user.logout');
    // account route
    Route::get('/account', [AccountController::class, 'index' ])->name('account');
    Route::put('/account/update', [AccountController::class, 'update'])->name('account.update');
    Route::put('/acccount/update-address', [AccountController::class, 'update_address'])->name('account.update.address');
    Route::put('/acccount/update-password', [AccountController::class, 'update_profile_password'])->name('account.update.password');
});


Route::middleware(['guest'])->group(function () {
    // Register user   
    Route::get('/account/login', [AccountController::class, 'login' ])->name('account.login');
    Route::get('/account/signup', [AccountController::class, 'signup' ])->name('account.signup');
    Route::get('/account/forgot-password', [AccountController::class, 'forgotPassword'])->name('account.forgot-password');     

    Route::post('/auth/login', [LoginController::class, 'check'])->name('user.login');
    Route::post('/user/signup', [RegisterController::class, 'store'])->name('user.signup');

    Route::post('/user/forgot-password', [ForgotPasswordController::class, 'sent'])->name('user.send_link');
    Route::get('/user/reset-password/{token}', [AccountController::class, 'reset_password'])->name('user.forgot-password');
    Route::put('/user/reset-password', [AccountController::class, 'update_password'])->name('user.update-password');
    /// categories
    Route::get('/categories', [CategoriesController::class, 'all'])->name('categories');
   
    //mobile
    Route::get('/mobiles/{model}/{id}', [MobileController::class, 'getMobileByModel']); 
    Route::get('/mobiles/search', [MobileController::class, 'searchItem']);   
    //search -page
  
});
Route::get('/search', [MobileController::class, 'search'])->name('app.search');
Route::get('/sell-your-devices', [MobileController::class, 'index'])->name('sell.your-devices');
Route::get('/sell-your-devices/{id}', [MobileController::class, 'index'])->name('sell.your-device.id');




/// account route


//admin

Route::get('/admin/login', function(Request $request) {
    if (empty($request->session()->get('account')->id)) 
        return view('admin.login');
    else
        return redirect()->route('admin-dashboard');
})->name('admin-login');

Route::get('/admin/account/forgot-password', [AppController\Admin\Profile::class, 'forgot_password'])->name('forgot-password');
Route::get('/admin/account/new-password', [AppController\Admin\Profile::class, 'new_password'])->name('new-password');

Route::middleware(['csrf_validation'])->group(function (){
    Route::controller(AppController\Admin\Profile::class)->group(function () {
        Route::post('admin/profile/login/', 'login');
        Route::get('/admin/profile/logout', 'logout')->withoutMiddleware(['csrf_validation']);
    });
});

Route::get('/test/php-script', function() {
    return view('test');
});

Route::middleware(['csrf_validation'])->group(function (){
    //listing
    Route::get('/admin/categories/get-list', [AppController\Admin\Categories::class, 'get_list'])->name('get-category-list');
    Route::get('/admin/brand/get-list', [AppController\Admin\Brand::class, 'get_list'])->name('get-brand-list');
    Route::get('/admin/email/get-list', [AppController\Admin\Email::class, 'get_list'])->name('get-email-list');
    Route::get('/admin/email-templates/get-list', [AppController\Admin\EmailTemplates::class, 'get_list'])->name('admin-emailtemplate-list');
    Route::get('/admin/promo/get-list', [AppController\Admin\Promo::class, 'get_list'])->name('admin-promo-list');
    Route::get('/admin/pages/get-list', [AppController\Admin\Pages::class, 'get_list'])->name('admin-page-list');
    Route::get('/admin/menus/get-list', [AppController\Admin\Menus::class, 'get_list'])->name('admin-menus-list');
    Route::get('/admin/customers/get-list', [AppController\Admin\Customers::class, 'get_list'])->name('admin-customer-list');
    Route::get('/admin/models/get-list', [AppController\Admin\Models::class, 'get_list'])->name('admin-model-list');
    Route::get('/admin/devices/get-list', [AppController\Admin\Devices::class, 'get_list'])->name('admin-device-list');
    Route::get('/admin/orders/get-list', [AppController\Admin\Orders::class, 'get_list'])->name('get-orders');
    Route::get('/admin/forms/contacts/get-list', [AppController\Admin\Forms::class, 'get_contact_list'])->name('contacts-forms-list');
    Route::get('/admin/forms/reviews/get-list', [AppController\Admin\Forms::class, 'get_review_list'])->name('reviews-forms-list');
    Route::get('/admin/forms/bulk-orders/get-list', [AppController\Admin\Forms::class, 'get_bulkorder_list'])->name('bulkord-forms-list');
    Route::get('/admin/forms/newsletter/get-list', [AppController\Admin\Forms::class, 'get_newsletter_list'])->name('newsletter-forms-list');
    Route::get('/admin/staffs/get-list', [AppController\Admin\Staffs::class, 'get_list'])->name('admin-staffslist');
    Route::get('/admin/staffs/group/get-list', [AppController\Admin\Staffs::class, 'get_group_list'])->name('admin-staffsgrouplist');
    Route::get('/admin/faqs/get-list', [AppController\Admin\Faqs::class, 'get_list'])->name('admin-faqslist');
    Route::get('/admin/faqs/group/get-list', [AppController\Admin\Faqs::class, 'get_group_list'])->name('admin-faqsgrouplist');
    Route::get('/admin/starbuck-locations/get-list', [AppController\Admin\StarbuckLocations::class, 'get_list'])->name('admin-starbucklocations-list');
    Route::get('/admin/blogs/get-list', [AppController\Admin\Blogs::class, 'get_list'])->name('admin-blogslist');
    Route::get('/admin/blogs/categories/get-list', [AppController\Admin\Blogs::class, 'get_category_list'])->name('admin-blogscategorylist');
    
    //updating status
    Route::post('/admin/email-templates/update-status', [AppController\Admin\EmailTemplates::class, 'update_status'])->name('admin-emailtemplate-status');
    Route::post('/admin/menus/update-status', [AppController\Admin\Menus::class, 'update_status'])->name('admin-menu-status');
    Route::post('/admin/customers/update-status', [AppController\Admin\Customers::class, 'update_status'])->name('admin-customer-status');
    Route::post('/admin/forms/newsletter/update-status', [AppController\Admin\Forms::class, 'update_newsletter_status'])->name('admin-newsletter-status');
    Route::post('/admin/forms/reviews/update-status', [AppController\Admin\Forms::class, 'update_review_status'])->name('admin-newsletter-status');
    Route::post('/admin/staffs/update-status', [AppController\Admin\Staffs::class, 'update_status'])->name('admin-staff-status');
    Route::post('/admin/promo/update-status', [AppController\Admin\Promo::class, 'update_status'])->name('admin-staff-status');

    //updating publish
    Route::controller(AppController\Admin\Publish::class)->group(function () {
        Route::post('/admin/publish/categories', 'categories')->name('publish-categories');
        Route::post('/admin/publish/brand', 'brand')->name('publish-brand');
        Route::post('/admin/publish/devices', 'devices')->name('publish-devices');
        Route::post('/admin/publish/models', 'models')->name('publish-models');
        Route::post('/admin/publish/pages', 'pages')->name('publish-pages');
        Route::post('/admin/publish/faqs', 'faqs')->name('publish-faqs');
        Route::post('/admin/publish/faqs/group', 'faqs_group')->name('publish-faqsgroup');
        Route::post('/admin/publish/form-contact', 'form_contacts')->name('publish-formcontact');
        Route::post('/admin/publish/starbuck-locations', 'starbuck_locations')->name('publish-starbuck-locations');
        Route::post('/admin/publish/staffs/group', 'staffs_group')->name('publish-staffsgroup');
    });

    //ordering
    Route::controller(AppController\Admin\Ordering::class)->group(function () {
        Route::post('/admin/categories/order/save', 'order_save')->name('category-ordering');
        Route::post('/admin/brand/order/save', 'order_save')->name('brand-ordering');
        Route::post('/admin/devices/order/save', 'order_save')->name('device-ordering');
        Route::post('/admin/models/order/save', 'order_save')->name('model-ordering');
        Route::post('/admin/menus/order/save', 'order_save')->name('menu-ordering');
        Route::post('/admin/starbuck-locations/order/save', 'order_save')->name('starbuck-ordering');
        Route::post('/admin/faqs/order/save', 'order_save')->name('faq-ordering');
        Route::post('/admin/faqs/group/order/save', 'order_save')->name('faqgroup-ordering');
    });

    //deleting
    Route::controller(AppController\Admin\DeleteRecords::class)->group(function () {
        Route::post('/admin/records/delete', 'index');
        Route::post('/admin/records/bulk-delete', 'bulk_delete');
        Route::post('/admin/records/bulk-restore', 'bulk_restore');
        Route::post('/admin/records/restore', 'restore');
    });

    //emailing
    Route::post('/account/reset-password', [AppController\Admin\Profile::class, 'reset_password']);

    //reporting
    Route::get('/admin/report/top-brand', [AppController\Admin\Brand::class, 'get_top_band_by_orders'])->name('admin-topbrand');
    Route::get('/admin/report/top-models', [AppController\Admin\Models::class, 'get_top_model_by_orders'])->name('admin-topmodel');

    Route::get('/admin/settings/page-links/get', [AppController\Admin\Settings::class, 'get_admin_links'])->name('admin-pagelinks');


    //update setting
    // Route::post('/admin/settings/company-details/update', [AppController\Admin\Settings::class, 'update_company_details'])->name('update-company');
    // Route::post('/admin/settings/email/update', [AppController\Admin\Settings::class, 'update_email'])->name('update-email');
    // Route::post('/admin/settings/social/update', [AppController\Admin\Settings::class, 'update_social'])->name('update-social');
    // Route::post('/admin/settings/sms/update', [AppController\Admin\Settings::class, 'update_sms'])->name('update-sms');
    // Route::post('/admin/settings/blog/update', [AppController\Admin\Settings::class, 'update_blog'])->name('update-blog');
    // Route::post('/admin/settings/homepage/update', [AppController\Admin\Settings::class, 'update_homepage'])->name('update-homepage');
    // Route::post('/admin/settings/shipping-api/update', [AppController\Admin\Settings::class, 'update_shipping_api'])->name('update-shippingapi');
    // Route::post('/admin/settings/captcha/update', [AppController\Admin\Settings::class, 'update_captcha'])->name('update-captcha');
    // Route::post('/admin/settings/menu-type/update', [AppController\Admin\Settings::class, 'update_menu_type'])->name('update-menutype');
    // Route::post('/admin/settings/sitemap/update', [AppController\Admin\Settings::class, 'update_sitemap'])->name('update-sitemap');
    // Route::post('/admin/settings/general/update', [AppController\Admin\Settings::class, 'update_general'])->name('update-general');

    //update profile
    Route::post('/admin/profile/update', [AppController\Admin\Profile::class, 'update'])->name('update-profile');
    Route::post('/account/update-password', [AppController\Admin\Profile::class, 'update_password'])->name('update-password');

    //adding/editting data
    Route::post('/admin/brand/add', [AppController\Admin\Brand::class, 'save'])->name('admin-brandadd');
    Route::post('/admin/brand/update', [AppController\Admin\Brand::class, 'save'])->name('admin-brandupdate');
    Route::post('/admin/devices/add', [AppController\Admin\Devices::class, 'save'])->name('admin-deviceadd');
    Route::post('/admin/devices/update', [AppController\Admin\Devices::class, 'save'])->name('admin-deviceupdate');
    Route::post('/admin/reviews/add', [AppController\Admin\Forms::class, 'save_review'])->name('admin-reviewadd');
    Route::post('/admin/reviews/update', [AppController\Admin\Forms::class, 'save_review'])->name('admin-reviewupdate');
    Route::post('/admin/pages/add', [AppController\Admin\Pages::class, 'save'])->name('admin-pageadd');
    Route::post('/admin/pages/update', [AppController\Admin\Pages::class, 'save'])->name('admin-pageupdate');
    Route::post('/admin/menus/add', [AppController\Admin\Menus::class, 'save'])->name('admin-menuadd');
    Route::post('/admin/menus/update', [AppController\Admin\Menus::class, 'save'])->name('admin-menuupdate');
    Route::post('/admin/faqs/add', [AppController\Admin\Faqs::class, 'save'])->name('admin-faqadd');
    Route::post('/admin/faqs/update', [AppController\Admin\Faqs::class, 'save'])->name('admin-faqupdate');
    Route::post('/admin/faqs/group/add', [AppController\Admin\Faqs::class, 'save_group'])->name('admin-faqgroupadd');
    Route::post('/admin/faqs/group/update', [AppController\Admin\Faqs::class, 'save_group'])->name('admin-faqgroupupdate');
    Route::post('/admin/promo/add', [AppController\Admin\Promo::class, 'save'])->name('admin-promoadd');
    Route::post('/admin/promo/update', [AppController\Admin\Promo::class, 'save'])->name('admin-promoupdate');
    Route::post('/admin/email-templates/add', [AppController\Admin\EmailTemplates::class, 'save'])->name('admin-emailtemplateadd');
    Route::post('/admin/email-templates/update', [AppController\Admin\EmailTemplates::class, 'save'])->name('admin-emailtemplateupdate');
    Route::post('/admin/staffs/add', [AppController\Admin\Staffs::class, 'save'])->name('admin-staffadd');
    Route::post('/admin/staffs/update', [AppController\Admin\Staffs::class, 'save'])->name('admin-staffupdate');
    Route::post('/admin/staffs/group/add', [AppController\Admin\Staffs::class, 'save_group'])->name('admin-staffgroupadd');
    Route::post('/admin/staffs/group/update', [AppController\Admin\Staffs::class, 'save_group'])->name('admin-staffgroupupdate');
    Route::post('/admin/starbuck-locations/add', [AppController\Admin\StarbuckLocations::class, 'save'])->name('admin-starbuckadd');
    Route::post('/admin/starbuck-locations/update', [AppController\Admin\StarbuckLocations::class, 'save'])->name('admin-starbuckupdate');
    Route::post('/admin/blogs/add', [AppController\Admin\Blogs::class, 'save'])->name('admin-blogadd');
    Route::post('/admin/blogs/update', [AppController\Admin\Blogs::class, 'save'])->name('admin-blogupdate');
    Route::post('/admin/blogs/categories/add', [AppController\Admin\Blogs::class, 'save_category'])->name('admin-blogcategoryadd');
    Route::post('/admin/blogs/categories/update', [AppController\Admin\Blogs::class, 'save_category'])->name('admin-blogcategoryupdate');
    Route::post('/admin/customers/update', [AppController\Admin\Customers::class, 'save'])->name('admin-customerupdate');
    Route::post('/admin/categories/add', [AppController\Admin\Categories::class, 'save'])->name('admin-categoryadd');
    Route::post('/admin/categories/update', [AppController\Admin\Categories::class, 'save'])->name('admin-categoryupdate');
    Route::post('/admin/models/add', [AppController\Admin\Models::class, 'save'])->name('admin-modeladd');
    Route::post('/admin/models/update', [AppController\Admin\Models::class, 'save'])->name('admin-modelupdate');
    Route::post('/admin/models/pricing/update', [AppController\Admin\Models::class, 'update_price'])->name('admin-modelpriceupdate');
    Route::post('/admin/orders/comment/add', [AppController\Admin\Orders::class, 'save_comment'])->name('admin-ordercommentadd');
    Route::post('/admin/settings/update', [AppController\Admin\Settings::class, 'save'])->name('admin-settingupdate');
});

Route::middleware(['auth_login'])->group(function (){

    Route::get('/admin', function() {
        // return view('admin.home');
        return redirect()->route('admin-dashboard');
    })->name('admin');

    Route::get('/admin/dashboard', [AppController\Admin\Profile::class, 'dashboard'])->name('admin-dashboard');

    Route::get('/admin/categories', [AppController\Admin\Categories::class, 'index'])->name('admin-category');
    Route::get('/admin/brand', [AppController\Admin\Brand::class, 'index'])->name('admin-brand');
    Route::get('/admin/email', [AppController\Admin\Email::class, 'index'])->name('admin-email');
    Route::get('/admin/email-templates', [AppController\Admin\EmailTemplates::class, 'index'])->name('admin-emailtemplate');
    Route::get('/admin/promo', [AppController\Admin\Promo::class, 'index'])->name('admin-promo');
    Route::get('/admin/pages', [AppController\Admin\Pages::class, 'index'])->name('admin-page');
    Route::get('/admin/menus', [AppController\Admin\Menus::class, 'index'])->name('admin-menu');
    Route::get('/admin/customers', [AppController\Admin\Customers::class, 'index'])->name('admin-customer');
    Route::get('/admin/models', [AppController\Admin\Models::class, 'index'])->name('admin-model');
    Route::get('/admin/devices', [AppController\Admin\Devices::class, 'index'])->name('admin-device');
    Route::get('/admin/orders/awaiting', [AppController\Admin\Orders::class, 'awaiting'])->name('awaiting-orders');
    Route::get('/admin/orders/unpaid', [AppController\Admin\Orders::class, 'unpaid'])->name('unpaid-orders');
    Route::get('/admin/orders/paid', [AppController\Admin\Orders::class, 'paid'])->name('paid-orders');
    Route::get('/admin/orders/archive', [AppController\Admin\Orders::class, 'archive'])->name('archive-orders');
    Route::get('/admin/forms/contacts', [AppController\Admin\Forms::class, 'contacts'])->name('contacts-forms');
    Route::get('/admin/forms/reviews', [AppController\Admin\Forms::class, 'reviews'])->name('reviews-forms');
    Route::get('/admin/forms/bulk-orders', [AppController\Admin\Forms::class, 'bulk_orders'])->name('bulkord-forms');
    Route::get('/admin/forms/newsletter', [AppController\Admin\Forms::class, 'newsletter'])->name('newsletter-forms');
    Route::get('/admin/blogs', [AppController\Admin\Blogs::class, 'index'])->name('admin-blogs');
    Route::get('/admin/blogs/categories', [AppController\Admin\Blogs::class, 'categories'])->name('admin-blogs-categories');
    Route::get('/admin/staffs', [AppController\Admin\Staffs::class, 'index'])->name('admin-staffs');
    Route::get('/admin/staffs/group', [AppController\Admin\Staffs::class, 'group'])->name('admin-staffsgroup');
    Route::get('/admin/faqs', [AppController\Admin\Faqs::class, 'index'])->name('admin-faqs');
    Route::get('/admin/faqs/group', [AppController\Admin\Faqs::class, 'group'])->name('admin-faqsgroup');
    Route::get('/admin/starbuck-locations', [AppController\Admin\StarbuckLocations::class, 'index'])->name('admin-starbucklocation');


    //add-edit form
    Route::get('/admin/brand/form/add', [AppController\Admin\Brand::class, 'form'])->name('admin-brandaddform');
    Route::get('/admin/brand/form/edit', [AppController\Admin\Brand::class, 'form'])->name('admin-brandeditform');
    Route::get('/admin/devices/form/add', [AppController\Admin\Devices::class, 'form'])->name('admin-devicesaddform');
    Route::get('/admin/devices/form/edit', [AppController\Admin\Devices::class, 'form'])->name('admin-deviceseditform');
    Route::get('/admin/models/form/add', [AppController\Admin\Models::class, 'form'])->name('admin-modelsaddform');
    Route::get('/admin/models/form/edit', [AppController\Admin\Models::class, 'form'])->name('admin-modelseditform');
    Route::get('/admin/models/changes/category/form', [AppController\Admin\Models::class, 'get_attributes_form_by_category'])->name('admin-changescategoryform');
    Route::get('/admin/reviews/form/add', [AppController\Admin\Forms::class, 'review_form'])->name('admin-reviewsaddform');
    Route::get('/admin/reviews/form/edit', [AppController\Admin\Forms::class, 'review_form'])->name('admin-reviewseditform');
    Route::get('/admin/pages/form/add', [AppController\Admin\Pages::class, 'form'])->name('admin-pagesaddform');
    Route::get('/admin/pages/form/edit', [AppController\Admin\Pages::class, 'form'])->name('admin-pageseditform');
    Route::get('/admin/menus/form/add', [AppController\Admin\Menus::class, 'form'])->name('admin-menusaddform');
    Route::get('/admin/menus/form/edit', [AppController\Admin\Menus::class, 'form'])->name('admin-menuseditform');
    Route::get('/admin/faqs/form/add', [AppController\Admin\Faqs::class, 'form'])->name('admin-faqaddform');
    Route::get('/admin/faqs/form/edit', [AppController\Admin\Faqs::class, 'form'])->name('admin-faqeditform');
    Route::get('/admin/faqs-group/form/add', [AppController\Admin\Faqs::class, 'form_group'])->name('admin-faqgroupaddform');
    Route::get('/admin/faqs-group/form/edit', [AppController\Admin\Faqs::class, 'form_group'])->name('admin-faqgroupeditform');
    Route::get('/admin/promos/form/add', [AppController\Admin\Promo::class, 'form'])->name('admin-promoaddform');
    Route::get('/admin/promos/form/edit', [AppController\Admin\Promo::class, 'form'])->name('admin-promoeditform');
    Route::get('/admin/email-templates/form/add', [AppController\Admin\EmailTemplates::class, 'form'])->name('admin-emailtemplateaddform');
    Route::get('/admin/email-templates/form/edit', [AppController\Admin\EmailTemplates::class, 'form'])->name('admin-emailtemplateeditform');
    Route::get('/admin/staffs/form/add', [AppController\Admin\Staffs::class, 'form'])->name('admin-staffaddform');
    Route::get('/admin/staffs/form/edit', [AppController\Admin\Staffs::class, 'form'])->name('admin-staffeditform');
    Route::get('/admin/staffs/group/form/add', [AppController\Admin\Staffs::class, 'form_group'])->name('admin-staffgroupaddform');
    Route::get('/admin/staffs/group/form/edit', [AppController\Admin\Staffs::class, 'form_group'])->name('admin-staffgroupeditform');
    Route::get('/admin/staffs/group/view-permission', [AppController\Admin\Staffs::class, 'view_permission'])->name('admin-viewpermissionform');
    Route::get('/admin/starbuck-locations/form/add', [AppController\Admin\StarbuckLocations::class, 'form'])->name('admin-starbuckaddform');
    Route::get('/admin/starbuck-locations/form/edit', [AppController\Admin\StarbuckLocations::class, 'form'])->name('admin-starbuckeditform');
    Route::get('/admin/blogs/form/add', [AppController\Admin\Blogs::class, 'form'])->name('admin-blogaddform');
    Route::get('/admin/blogs/form/edit', [AppController\Admin\Blogs::class, 'form'])->name('admin-blogeditform');
    Route::get('/admin/blogs/categories/form/add', [AppController\Admin\Blogs::class, 'form_category'])->name('admin-blogcategoryaddform');
    Route::get('/admin/blogs/categories/form/edit', [AppController\Admin\Blogs::class, 'form_category'])->name('admin-blogcategoryeditform');
    Route::get('/admin/customers/form/edit', [AppController\Admin\Customers::class, 'form'])->name('admin-customereditform');
    Route::get('/admin/categories/form/add', [AppController\Admin\Categories::class, 'form'])->name('admin-categoryaddform');
    Route::get('/admin/categories/form/edit', [AppController\Admin\Categories::class, 'form'])->name('admin-categoryeditform');
    Route::get('/admin/models/pricing/edit', [AppController\Admin\Models::class, 'pricing_form'])->name('admin-modelpricingeditform');
    Route::get('/admin/orders/invoice/view', [AppController\Admin\Orders::class, 'invoice_form'])->name('admin-invoiceform');
    Route::get('/admin/orders/form/edit', [AppController\Admin\Orders::class, 'form'])->name('admin-ordereditform');
    Route::get('/admin/profile/form/edit', [AppController\Admin\Profile::class, 'index'])->name('admin-profileeditform');
    Route::get('/admin/settings/form/edit', [AppController\Admin\Settings::class, 'index'])->name('admin-settingeditform');
    Route::get('/admin/email/message/view', [AppController\Admin\Email::class, 'view_email'])->name('admin-emailmessageform');
    Route::get('/admin/sms/message/view', [AppController\Admin\Email::class, 'view_sms'])->name('admin-smsmessageform');
    Route::get('/admin/email/details/view', [AppController\Admin\Email::class, 'view_detail'])->name('admin-emaildetails');
    
    Route::get('/admin/orders/awaiting/export', [AppController\Admin\ExportData::class, 'orders'])->name('awaiting-orders-export');
    Route::post('/admin/orders/awaiting/import', [AppController\Admin\ImportData::class, 'orders'])->name('awaiting-orders-import');
    Route::get('/admin/orders/unpaid/export', [AppController\Admin\ExportData::class, 'orders'])->name('unpaid-orders-export');
    Route::post('/admin/orders/unpaid/import', [AppController\Admin\ImportData::class, 'orders'])->name('unpaid-orders-import');
    Route::get('/admin/orders/paid/export', [AppController\Admin\ExportData::class, 'orders'])->name('paid-orders-export');
    Route::post('/admin/orders/paid/import', [AppController\Admin\ImportData::class, 'orders'])->name('paid-orders-import');
    Route::get('/admin/orders/archive/export', [AppController\Admin\ExportData::class, 'orders'])->name('archive-orders-export');
    Route::post('/admin/orders/archive/import', [AppController\Admin\ImportData::class, 'orders'])->name('archive-orders-import');
    Route::get('/admin/models/export', [AppController\Admin\ExportData::class, 'models'])->name('models-export');
    Route::post('/admin/models/import', [AppController\Admin\ImportData::class, 'models'])->name('models-import');
    Route::get('/admin/models/pricing/export', [AppController\Admin\ExportData::class, 'model_pricelist'])->name('models-pricelist-export');
    Route::post('/admin/models/pricing/import', [AppController\Admin\ImportData::class, 'model_pricelist'])->name('models-pricelist-import');
});
