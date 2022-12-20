<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class GeneralSetting extends Model
{
    public static $table_name = 'general_setting';

    public static function get_list() {
        return DB::table(self::$table_name)
        // ->join('loans', 'borrowers.id', '=', 'loans.borrower_id')
        ->select('*')   
        ->where(DB::raw('(SELECT COUNT(*) FROM deleted AS d WHERE d.table_name = "'. self::$table_name . '" AND d.table_id = '.self::$table_name.'.id)'), '=', 0) //check if this is deleted
        ->first();
    }

    public static function update_company_details($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'company_name' => $request->company,
            'company_address' => $request->address,
            'company_city' => $request->city,
            'company_state' => $request->state,
            'company_country' => $request->country,
            'company_zipcode' => $request->zipcode,
            'company_phone' => $request->phone,
        ]);
    }

    public static function update_email($request) {
        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update([
            'from_name' => $request->name,
            'from_email' => $request->email,
            'display_department_specific_from_email_only_in_order' => $request->displaydepartment ,
            'mailer_type' => $request->mailer,
        ]);
    }

    // public static function update_social($request) {
    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'fb_link' => $request->facebook,
    //         'twitter_link' => $request->twitter,
    //         'linkedin_link' => $request->linkedin ,
    //         'youtube_link' => $request->youtube,
    //         'msg_link' => $request->msg,
    //         'instagram_link' => $request->instagram,
    //         'social_login' => $request->sociallogin,
    //         'google_client_id' => $request->googleclientid,
    //         'google_client_secret' => $request->googleclientsecret,
    //         'fb_app_id' => $request->facebookappid,
    //         'fb_app_secret' => $request->facebookappsecret,
    //     ]);
    // }

    // public static function update_sms($request) {
    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'sms_sending_status' => $request->smsstatus,
    //         'twilio_ac_sid' => $request->twilioaccountsid,
    //         'twilio_ac_token' => $request->twilioaccountauthtoken ,
    //         'twilio_long_code' => $request->twiliolongcode,
    //     ]);
    // }

    // public static function update_blog($request) {
    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'blog_rm_words_limit' => $request->blogwordslimit,
    //         'blog_recent_posts' => $request->blogrecentpost,
    //         'blog_categories' => $request->blogcategories ,
    //     ]);
    // }

    // public static function update_homepage($request) {
    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'home_slider' => base64_encode($request->processworksandslider),
    //         'allow_offer_popup' => $request->allowofferpopup,
    //         'offer_popup_title' => $request->offerpoptitle ,
    //         'offer_popup_content' => base64_encode($request->offerpopupcontent) ,
    //     ]);
    // }

    // public static function update_shipping_api($request) {
    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'shipping_api' => $request->shippingapi,
    //         'shipment_generated_by_cust' => $request->allowshipmentbycustomer,
    //         'shipping_api_key' => $request->shippingapikey ,
    //         'default_carrier_account' => $request->defaultcarrieraccount ,
    //         'carrier_account_id' => $request->carrieraccountid ,
    //         'shipping_parcel_length' => $request->shippingparcellength ,
    //         'shipping_parcel_width' => $request->shippingparcelwidth ,
    //         'shipping_parcel_height' => $request->shippingparcelheight ,
    //         'shipping_parcel_weight' => $request->shippingparcelweight ,
    //         // 'shipping_parcel_width' => $request->webhookurl ,
    //     ]);
    // }

    // public static function update_captcha($request) {
    //     $captcha_settings = [
    //         'captcha_key' => $request->captchakey,
    //         'captcha_secret' => $request->captchasecret,
    //         'contact_form' => empty($request->contactform) ? 0 : 1,            
    //         'write_review_form' => empty($request->writeareviewform) ? 0 : 1,            
    //         'bulk_order_form' => empty($request->bulkorderform) ? 0 : 1,            
    //         'affiliate_form' => empty($request->affiliateform) ? 0 : 1,            
    //         'login_form' => empty($request->loginform) ? 0 : 1,            
    //         'signup_form' => empty($request->signupform) ? 0 : 1,            
    //         'order_track_form' => empty($request->ordertrackform) ? 0 : 1,            
    //         'newsletter_form' => empty($request->newsletterform) ? 0 : 1,            
    //         'missing_product_form' => empty($request->missingproductform) ? 0 : 1,            
    //         'imei_number_based_search_form' => empty($request->imeinumberbasesearchform) ? 0 : 1,            
    //     ];


    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'captcha_settings' => json_encode($captcha_settings),
    //     ]);
    // }

    // public static function update_other_setting($request) {

    //     $get_setting = DB::table(self::$table_name)
    //     ->select('other_settings')
    //     ->where('id', '=', $request->id)
    //     ->first();

    //     $other_settings = json_decode($get_setting->other_settings);

    //     $other_settings->top_right_menu = $request->toprightmenu;
    //     $other_settings->header_menu = $request->headermenu;
    //     $other_settings->footer_menu_column1 = $request->footermenucolumn1;
    //     $other_settings->footer_menu_column2 = $request->footermenucolumn2;
    //     $other_settings->copyright_menu = $request->copyrighhtmenu;

    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'other_settings' => json_encode($other_settings),
    //     ]);
    // }

    // public static function update_sitemap($request) {
    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'sitemap_location' => $request->path,
    //     ]);   
    // }

    // public static function update_general($request) {
    //     $get_setting = DB::table(self::$table_name)
    //     ->select('*')
    //     ->where('id', '=', $request->id)
    //     ->first();

    //     $other_settings = json_decode($get_setting->other_settings);
    //     $payment_option = json_decode($get_setting->payment_option);
    //     $display_terms = json_decode($get_setting->display_terms);
    //     $sales_pack = json_decode($get_setting->sales_pack);
    //     $shipping_option = json_decode($get_setting->shipping_option);
    //     //===================================
    //     $other_settings->newslettter_section = $request->newslettersection;
    //     $other_settings->show_model_storage = $request->showmodelstorage;
    //     //===================================
    //     $payment_option->bank = $request->paymentbank;
    //     $payment_option->paypal = $request->paymentpaypal;
    //     $payment_option->check = $request->paymentcheck;
    //     $payment_option->zelle = $request->paymentzelle;
    //     $payment_option->cash = $request->paymentcash;
    //     //===================================
    //     $display_terms->ac_creation = $request->onaccountcreation;
    //     $display_terms->confirm_sale = $request->onconfirmsale;
    //     //===================================
    //     $sales_pack->free = $request->salespackfreesalespack;
    //     $sales_pack->own = $request->salespackprintownnopostage;
    //     //===================================
    //     $shipping_option->free_pickup = $request->shippingoptionschedule;
    //     $shipping_option->own = $request->shippingoptionpostown;
    //     //===================================

    //     return DB::table(self::$table_name)
    //     ->where('id', $request->id)
    //     ->update([
    //         'admin_panel_name' => $request->adminpanelname,
    //         'logo' => $request->logo,
    //         'site_name' => $request->sitename,
    //         'website' => $request->website,
    //         'phone' => $request->phone,
    //         'email' => $request->email,
    //         'copyright' => $request->copyright,
    //         'map_key' => $request->mapkey,
    //         'news_blog_link' => $request->newsbloglink,
    //         'news_blog_link_open' => $request->newsbloglinktarget,
    //         'timezone' => $request->timezone,
    //         'time_format' => $request->timeformat,
    //         'date_format' => $request->dateformat,
    //         'imei_api_key' => $request->imeiapikey,
    //         'terms_status' => $request->statustermsconditions,
    //         // 'onaccountcreation' => $request->ac_creation,
    //         // 'onconfirmsale' => $request->confirm_sale,
    //         'display_terms' => json_encode($display_terms),
    //         'other_settings' => json_encode($other_settings),
    //         'payment_option' => json_encode($payment_option),
    //         'terms' => $request->termsconditions,
    //         // 'show_model_storage' => $request->showmodelstorage,
    //         // 'newslettter_section' => $request->newslettersection,
    //         'missing_product_section' => $request->showmissingproductsection,
    //         'top_seller_limit' => $request->topsellerlimit,
    //         'top_seller_mode' => $request->topsellermode,
    //         'order_prefix' => $request->orderprefix,
    //         'order_expiring_days' => $request->orderexpiringdays,
    //         'order_expired_days' => $request->orderexpireddays,
    //         'page_list_limit' => $request->pagelistlimit,
    //         'promocode_section' => $request->promocodesection,
    //         'is_space_between_currency_symbol' => $request->keepspacebetweencurrency,
    //         'thousand_separator' => $request->thousandseparator,
    //         'decimal_separator' => $request->decimalseparator,
    //         'decimal_number' => $request->decimalnumber,
    //         'default_payment_option' => $request->defaultpaymentoption,
    //         'recommended_payment_option' => $request->recommendedpaymentoption,
    //         'verification' => $request->verification,
    //         'header_service_hours_text' => $request->servicehourstext,
    //         'custom_js_code' => base64_encode($request->jscode),
    //         'order_tracking_tag' => base64_encode($request->ordertrackingtag),
    //     ]);
    // }

    public static function get_info_by_id($id) {
        return DB::table(self::$table_name)
        ->select('*')
        ->where('id', '=', $id)
        ->first();
    }

    private static function general_columns($request) {
        $setting_info = $request->setting_info;

        $other_settings = json_decode($setting_info->other_settings);
        $payment_option = json_decode($setting_info->payment_option);
        $display_terms = json_decode($setting_info->display_terms);
        $sales_pack = json_decode($setting_info->sales_pack);
        $shipping_option = json_decode($setting_info->shipping_option);
        //===================================
        $other_settings->newslettter_section = $request->newslettersection;
        $other_settings->show_model_storage = $request->showmodelstorage;
        //===================================
        $payment_option->bank = $request->paymentbank;
        $payment_option->paypal = $request->paymentpaypal;
        $payment_option->check = $request->paymentcheck;
        $payment_option->zelle = $request->paymentzelle;
        $payment_option->cash = $request->paymentcash;
        //===================================
        $display_terms->ac_creation = $request->onaccountcreation;
        $display_terms->confirm_sale = $request->onconfirmsale;
        //===================================
        $sales_pack->free = $request->salespackfreesalespack;
        $sales_pack->own = $request->salespackprintownnopostage;
        //===================================
        $shipping_option->free_pickup = $request->shippingoptionschedule;
        $shipping_option->own = $request->shippingoptionpostown;

        $request->logo = !empty($request->file('logosetting')) ? $request->logo : $setting_info->logo;


        return [
            'admin_panel_name' => $request->adminpanelname,
            'logo' => $request->logo,
            'site_name' => $request->sitename,
            'website' => $request->website,
            'phone' => $request->phone,
            'email' => $request->email,
            'copyright' => $request->copyright,
            'map_key' => $request->mapkey,
            'news_blog_link' => $request->newsbloglink,
            'news_blog_link_open' => $request->newsbloglinktarget,
            'timezone' => $request->timezone,
            'time_format' => $request->timeformat,
            'date_format' => $request->dateformat,
            'imei_api_key' => $request->imeiapikey,
            'terms_status' => htmlspecialchars($request->statustermsconditions),
            // 'onaccountcreation' => $request->ac_creation,
            // 'onconfirmsale' => $request->confirm_sale,
            'display_terms' => json_encode($display_terms),
            'other_settings' => json_encode($other_settings),
            'payment_option' => json_encode($payment_option),
            'terms' => $request->termsconditions,
            // 'show_model_storage' => $request->showmodelstorage,
            // 'newslettter_section' => $request->newslettersection,
            'missing_product_section' => $request->showmissingproductsection,
            'top_seller_limit' => $request->topsellerlimit,
            'top_seller_mode' => $request->topsellermode,
            'order_prefix' => $request->orderprefix,
            'order_expiring_days' => $request->orderexpiringdays,
            'order_expired_days' => $request->orderexpireddays,
            'page_list_limit' => $request->pagelistlimit,
            'promocode_section' => $request->promocodesection,
            'is_space_between_currency_symbol' => $request->keepspacebetweencurrency,
            'thousand_separator' => $request->thousandseparator,
            'decimal_separator' => $request->decimalseparator,
            'decimal_number' => $request->decimalnumber,
            'default_payment_option' => $request->defaultpaymentoption,
            'recommended_payment_option' => $request->recommendedpaymentoption,
            'verification' => $request->verification,
            'header_service_hours_text' => $request->servicehourstext,
            'custom_js_code' => htmlspecialchars($request->jscode),
            'order_tracking_tag' => htmlspecialchars($request->ordertrackingtag),
        ];
    }

    private static function email_columns($request) {
        return [
            'from_name' => $request->emailname,
            'from_email' => $request->emailemail,
            'display_department_specific_from_email_only_in_order' => $request->emaildisplaydepartment ,
            'mailer_type' => $request->emailmailer,
        ];
    }
    
    private static function social_columns($request) {
        return [
            'fb_link' => $request->socialfacebook,
            'twitter_link' => $request->socialtwitter,
            'linkedin_link' => $request->sociallinkedin ,
            'youtube_link' => $request->socialyoutube,
            'msg_link' => $request->socialmsg,
            'instagram_link' => $request->socialinstagram,
            'social_login' => $request->sociallogin,
            'google_client_id' => $request->socialgoogleclientid,
            'google_client_secret' => $request->socialgoogleclientsecret,
            'fb_app_id' => $request->socialfacebookappid,
            'fb_app_secret' => $request->socialfacebookappsecret,
        ];
    }
    
    private static function sms_columns($request) {
        return [
            'sms_sending_status' => $request->smsstatus,
            'twilio_ac_sid' => $request->smstwilioaccountsid,
            'twilio_ac_token' => $request->smstwilioaccountauthtoken ,
            'twilio_long_code' => $request->smstwiliolongcode,
        ];
    }

    private static function blog_columns($request) {
        return [
            'blog_rm_words_limit' => $request->blogwordslimit,
            'blog_recent_posts' => $request->blogrecentpost,
            'blog_categories' => $request->blogcategories ,
        ];
    }

    private static function homepage_columns($request) {
        return [
            'home_slider' => htmlspecialchars($request->processworksandslider),
            'allow_offer_popup' => $request->allowofferpopup,
            'offer_popup_title' => $request->offerpoptitle ,
            'offer_popup_content' => htmlspecialchars($request->offerpopupcontent) ,
        ];
    }

    private static function shippingapi_columns($request) {
        return [
            'shipping_api' => $request->shippingapi,
            'shipment_generated_by_cust' => $request->allowshipmentbycustomer,
            'shipping_api_key' => $request->shippingapikey ,
            'default_carrier_account' => $request->shippingdefaultcarrieraccount ,
            'carrier_account_id' => $request->shippingcarrieraccountid ,
            'shipping_parcel_length' => $request->shippingparcellength ,
            'shipping_parcel_width' => $request->shippingparcelwidth ,
            'shipping_parcel_height' => $request->shippingparcelheight ,
            'shipping_parcel_weight' => $request->shippingparcelweight ,
            // 'shipping_parcel_width' => $request->webhookurl ,
        ];
    }

    private static function sitemap_columns($request) {
        $setting_info = $request->setting_info;
        $request->sitemap = !empty($request->file('sitemapfile')) ? $request->sitemap : $setting_info->sitemap_location;

        return [
            'sitemap_location' => $request->sitemap,
        ];
    }

    private static function captcha_columns($request) {
        $captcha_settings = [
            'captcha_key' => $request->captchakey,
            'captcha_secret' => $request->captchasecret,
            'contact_form' => $request->captchacontactform,            
            'write_review_form' => $request->captchawriteareviewform,            
            'bulk_order_form' => $request->captchabulkorderform,            
            'affiliate_form' => $request->captchaaffiliateform,            
            'login_form' => $request->captchaloginform,            
            'signup_form' => $request->captchasignupform,            
            'order_track_form' => $request->captchaordertrackform,            
            'newsletter_form' => $request->captchanewsletterform,            
            'missing_product_form' => $request->captchamissingproductform,            
            'imei_number_based_search_form' => $request->captchaimeinumberbasesearchform,         
        ];

        return [
            'captcha_settings' => json_encode($captcha_settings),
        ];
    }

    private static function menutype_columns($request) {
        $other_settings = json_decode($request->setting_info->other_settings);
        $other_settings->top_right_menu = $request->toprightmenu;
        $other_settings->header_menu = $request->headermenu;
        $other_settings->footer_menu_column1 = $request->footermenucolumn1;
        $other_settings->footer_menu_column2 = $request->footermenucolumn2;
        $other_settings->footer_menu_column3 = $request->footermenucolumn3;
        $other_settings->copyright_menu = $request->copyrightmenu;
        
        return [
            'other_settings' => json_encode($other_settings),
        ];
    }
    
    public static function edit($request) {
        $request->setting_info = self::get_info_by_id($request->id);

        $columns = array_merge(
            self::general_columns($request),
            self::email_columns($request),
            self::social_columns($request),
            self::sms_columns($request),
            self::blog_columns($request),
            self::homepage_columns($request),
            self::shippingapi_columns($request),
            self::sitemap_columns($request),
            self::captcha_columns($request),
            self::menutype_columns($request),
        );

        return DB::table(self::$table_name)
        ->where('id', $request->id)
        ->update($columns);
    }
}
