<?php 

use App\Models\Admin\Admin;
use App\Models\Admin\GeneralSetting;
use App\Models\Admin\Email;

function user_type($type){
    return $type == 'member' ?  3 : 1;  
}

function get_user_type($type){
    return $type == 3 ?  'member' : 'guest';  
}

function authAdmin()
{
    $id = decrypt(session()->get('account')->id);
    return Admin::get_account_by_id($id);
}

function get_token($link)
{
    $link  = explode('/',$link);
    return $link[count($link) - 1]; 
}


function get_title_of_page($route_name) {
    $title = '';
    switch ($route_name) { 
        case 'admin-dashboard': $title = 'Dashboard | Admin ' . config('app.name'); break;
        case 'admin-category': $title = 'Categories | Admin ' . config('app.name'); break;      
        case 'admin-brand': $title = 'Brand | Admin ' . config('app.name'); break;
        case 'admin-model': $title = 'Models | Admin ' . config('app.name'); break;
        case 'awaiting-orders': $title = 'Awaiting Orders | Admin ' . config('app.name'); break;
        case 'unpaid-orders': $title = 'Unpaid Orders | Admin ' . config('app.name'); break;
        case 'paid-orders': $title = 'Paid Orders | Admin ' . config('app.name'); break;
        case 'archive-orders': $title = 'Archive Orders | Admin ' . config('app.name'); break;
        case 'admin-customer': $title = 'Customers | Admin ' . config('app.name'); break;
        case 'contacts-forms': $title = 'Form Contacts | Admin ' . config('app.name'); break;
        case 'reviews-forms': $title = 'Form Reviews | Admin ' . config('app.name'); break;
        case 'bulkord-forms': $title = 'Form Bulk Orders | Admin ' . config('app.name'); break;
        case 'newsletter-forms': $title = 'Form Newsletter | Admin ' . config('app.name'); break;
        case 'admin-blogs': $title = 'Blogs | Admin ' . config('app.name'); break;
        case 'admin-blogs-categories': $title = 'Blog Categories | Admin ' . config('app.name'); break;
        case 'admin-page': $title = 'Pages | Admin ' . config('app.name'); break;
        case 'admin-menu': $title = 'Menus | Admin ' . config('app.name'); break;
        case 'admin-staffs': $title = 'Staffs | Admin ' . config('app.name'); break;
        case 'admin-staffsgroup': $title = 'Staff Groups | Admin ' . config('app.name'); break;
        case 'admin-faqs': $title = 'Faqs | Admin ' . config('app.name'); break;
        case 'admin-faqsgroup': $title = 'Faq Groups | Admin ' . config('app.name'); break;
        case 'admin-promo': $title = 'Promos | Admin ' . config('app.name'); break;
        case 'admin-emailtemplate': $title = 'Email Templates | Admin ' . config('app.name'); break;
        case 'admin-email': $title = 'Emails | Admin ' . config('app.name'); break;
        case 'admin-starbucklocation': $title = 'Starbuck Locations | Admin ' . config('app.name'); break;
        case 'admin-login': $title = 'Login | Admin ' . config('app.name'); break;
        
        default: $title = config('app.name'); break;
    }

    return "$title Buyback Website";
}

function amount_format($amount) {
    return number_format($amount, 2);
}

function unread_messages() {
    $staff_id = decrypt(session()->get('account')->id);
    return Email::get_unread_message_by_staff($staff_id);
}

function general_setting_info() {
    return GeneralSetting::get_list();
}

function get_settings_session() {
    return request()->session()->get('settings');
}

function is_valid_url($url, $site) {
	$url_check = '/^(https?:\/\/)?(www\.)?'.$site.'.com\//';
    return (bool)preg_match($url_check, $url) == 1;
}

function capitalize_word($word) {
    return ucwords(strtolower($word));
}

function admin_page_links($search = '') {
    $links = [
        'Dashboard' => route('admin-dashboard'),
        'Category' => route('admin-category'),
        'Brand' => route('admin-brand'),
        'Email/SMS' => route('admin-email'),
        'Email Templates' => route('admin-emailtemplate'),
        'Promo' => route('admin-promo'),
        'Page' => route('admin-page'),
        'Menu' => route('admin-menu'),
        'Customer' => route('admin-customer'),
        'Model' => route('admin-model'),
        'Device' => route('admin-device'),
        'Awaiting Order' => route('awaiting-orders'),
        'Unpaid Order' => route('unpaid-orders'),
        'Paid Order' => route('paid-orders'),
        'Archive Order' => route('archive-orders'),
        'Contact Form' => route('contacts-forms'),
        'Review Form' => route('reviews-forms'),
        'Bulk Order Form' => route('bulkord-forms'),
        'Newsletter Form' => route('newsletter-forms'),
        'Blog' => route('admin-blogs'),
        'Blog Category' => route('admin-blogs-categories'),
        'Staff' => route('admin-staffs'),
        'Staff Group' => route('admin-staffsgroup'),
        'Faq' => route('admin-faqs'),
        'Faq Group' => route('admin-faqsgroup'),
        'Starbuck Location' => route('admin-starbucklocation'),
    ];

    $search_key = preg_grep("/{$search}/i", $links);

    return $search_key;
}

function timezone_list() {
    $return = array();
    $timezone_identifiers_list = timezone_identifiers_list();
    foreach($timezone_identifiers_list as $timezone_identifier){
        $date_time_zone = new DateTimeZone($timezone_identifier);
        $date_time = new DateTime('now', $date_time_zone);
        $hours = floor($date_time_zone->getOffset($date_time) / 3600);
        $mins = floor(($date_time_zone->getOffset($date_time) - ($hours*3600)) / 60);
        $hours = 'GMT' . ($hours < 0 ? $hours : '+'.$hours);
        $mins = ($mins > 0 ? $mins : '0'.$mins);
        $text = str_replace("_"," ",$timezone_identifier);
        
        //$dateTime = new DateTime(); 
        //$dateTime->setTimeZone(new DateTimeZone($timezone_identifier)); 
        //$short_timezone = $dateTime->format('T'); 

        $array=array();
        $array['display']=$text.' ('.$hours.':'.$mins.')';
        $array['value']=$timezone_identifier;
        //$array['short_timezone']=$short_timezone;
        $return[] =$array; 
    }
    return $return;
}

function create_slug($str) {
    if($str !== mb_convert_encoding( mb_convert_encoding($str, 'UTF-32', 'UTF-8'), 'UTF-8', 'UTF-32') )
        $str = mb_convert_encoding($str, 'UTF-8', mb_detect_encoding($str));
    $str = htmlentities($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', '\\1', $str);
    $str = html_entity_decode($str, ENT_NOQUOTES, 'UTF-8');
    $str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'), '-', $str);
    $str = strtolower( trim($str, '-') );
    return $str;
}

function to_object(&$arr) {
    $arr = json_decode($arr);
}

function review_website_list() {
    return (object)[
        'trustpilot'=>'Trustpilot', 
        'sitejabber'=>'SiteJabber', 
        '1guygadget'=>'1GuyGadget', 
        'resellerratings'=>'ResellerRatings', 
        'bbb'=>'BBB',
    ];
}

function format_date_html($date) {
   return date('Y-m-d', strtotime($date));
}

function format_date_db($date) {
    return date('Y-m-d G:i:s', strtotime($date));
}

function format_date_client($date) {
    return date('F d,Y', strtotime($date));
}

function format_date_table($date) {
    return date_format(date_create($date), 'M/d/Y g:i a');
}

function format_datetime($date) {
    return date_format(date_create($date), 'M/d/Y g:i a');
}

function format_date($date) {
    return date_format(date_create($date), 'M/d/Y');
}

function format_time($time) {
    return date_format(date_create($time), 'g:i a');
}

function csv_to_object($filename = '', $delimiter = ',')
{
    if (!file_exists($filename) || !is_readable($filename))
        return false;

    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false)
    {
        while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
        {
            if (!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }

    return $data;
}

function array_keys_checker($array, $keys) {
    return !array_diff_key(array_flip($keys), $array);
}

function get_access_permission($permissions = [], $return_all = true) {
    $access_permission = [];
    $access_permission_all = [];

    $permission = $return_all ? permissions() : $permissions;
    
    $permissions = json_decode(json_encode($permissions), true); //make array
    foreach ($permission as $key => $permission) {
        foreach ($permission as $access => $value) {
            if (!$return_all) {
                $value = $permissions[$key][$access];
                if ($value) 
                    $access_permission[$key][$access] = $value;
            }
            else {
                $value = (!empty($permissions[$key][$access])) ? !empty($permissions[$key][$access]) ? $permissions[$key][$access] : 0 : 0;
                $access_permission_all[$key][$access] = $value;
            }
        }
    }
    $permnissions = $return_all ? $access_permission_all : $access_permission;
    return json_decode(json_encode($permnissions));
}
// function get_access_permission($permissions, $return_all = true) {
//     $access_permission = [];
//     $access_permission_all = [];

//     $all_permission = permissions();

//     $permissions = json_decode(json_encode($permissions), true); //make array
//     foreach ($permissions as $key => $permission) {
//         foreach ($permission as $access => $value) {
//             $value = $permissions[$key][$access];
//             if (!$return_all) {
//                 if ($value) 
//                     $access_permission[$key][$access] = $value;
//             }
//             else {
//                 $access_permission_all[$key][$access] = $value;
//             }
//         }
//     }
//     $permnissions = $return_all ? $access_permission_all : $access_permission;
//     return json_decode(json_encode($permnissions));
// }

function permissions() {
    $permission = [
        'order' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'model' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'device' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'brand' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'category' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'customer' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'page' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'menu' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'form' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'blog' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'faq' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'promocode' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
        'emailtemplate' => [
            'view' => 0,
            'add' => 0,
            'edit' => 0,
            'delete' => 0,
        ],
    ];

    return json_decode(json_encode($permission));
}

function order_status_list() {
    $order_status = [
        "code" => "awaiting_shipment",
        "status" => "Awaiting Shipment",
        "shipped" => "Shipped",
        "delivered" => "Delivered",
        "returned_to_sender" => "Returned To Sender", 
        "shipment_problem" => "Shipment Problem",
        "submitted" => "Submitted",
        "processing" => "Processing",
        "completed" => "Completed",
        "problem" => "Problem", 
        "received" => "Received", 
        "expired" => "Expired",
        "cancelled" => "Cancelled",
    ];
    ksort($order_status);
    return (object)$order_status;
}


function country_list() {
    $countries =   [
            ['name' => 'Afghanistan', 'code' => 'AF'],
            ['name' => 'Åland Islands', 'code' => 'AX'],
            ['name' => 'Albania', 'code' => 'AL'],
            ['name' => 'Algeria', 'code' => 'DZ'],
            ['name' => 'American Samoa', 'code' => 'AS'],
            ['name' => 'Andorra', 'code' => 'AD'],
            ['name' => 'Angola', 'code' => 'AO'],
            ['name' => 'Anguilla', 'code' => 'AI'],
            ['name' => 'Antarctica', 'code' => 'AQ'],
            ['name' => 'Antigua and Barbuda', 'code' => 'AG'],
            ['name' => 'Argentina', 'code' => 'AR'],
            ['name' => 'Armenia', 'code' => 'AM'],
            ['name' => 'Aruba', 'code' => 'AW'],
            ['name' => 'Australia', 'code' => 'AU'],
            ['name' => 'Austria', 'code' => 'AT'],
            ['name' => 'Azerbaijan', 'code' => 'AZ'],
            ['name' => 'Bahamas', 'code' => 'BS'],
            ['name' => 'Bahrain', 'code' => 'BH'],
            ['name' => 'Bangladesh', 'code' => 'BD'],
            ['name' => 'Barbados', 'code' => 'BB'],
            ['name' => 'Belarus', 'code' => 'BY'],
            ['name' => 'Belgium', 'code' => 'BE'],
            ['name' => 'Belize', 'code' => 'BZ'],
            ['name' => 'Benin', 'code' => 'BJ'],
            ['name' => 'Bermuda', 'code' => 'BM'],
            ['name' => 'Bhutan', 'code' => 'BT'],
            ['name' => 'Bolivia, Plurinational State of', 'code' => 'BO'],
            ['name' => 'Bonaire, Sint Eustatius and Saba', 'code' => 'BQ'],
            ['name' => 'Bosnia and Herzegovina', 'code' => 'BA'],
            ['name' => 'Botswana', 'code' => 'BW'],
            ['name' => 'Bouvet Island', 'code' => 'BV'],
            ['name' => 'Brazil', 'code' => 'BR'],
            ['name' => 'British Indian Ocean Territory', 'code' => 'IO'],
            ['name' => 'Brunei Darussalam', 'code' => 'BN'],
            ['name' => 'Bulgaria', 'code' => 'BG'],
            ['name' => 'Burkina Faso', 'code' => 'BF'],
            ['name' => 'Burundi', 'code' => 'BI'],
            ['name' => 'Cambodia', 'code' => 'KH'],
            ['name' => 'Cameroon', 'code' => 'CM'],
            ['name' => 'Canada', 'code' => 'CA'],
            ['name' => 'Cape Verde', 'code' => 'CV'],
            ['name' => 'Cayman Islands', 'code' => 'KY'],
            ['name' => 'Central African Republic', 'code' => 'CF'],
            ['name' => 'Chad', 'code' => 'TD'],
            ['name' => 'Chile', 'code' => 'CL'],
            ['name' => 'China', 'code' => 'CN'],
            ['name' => 'Christmas Island', 'code' => 'CX'],
            ['name' => 'Cocos (Keeling) Islands', 'code' => 'CC'],
            ['name' => 'Colombia', 'code' => 'CO'],
            ['name' => 'Comoros', 'code' => 'KM'],
            ['name' => 'Congo', 'code' => 'CG'],
            ['name' => 'Congo, the Democratic Republic of the', 'code' => 'CD'],
            ['name' => 'Cook Islands', 'code' => 'CK'],
            ['name' => 'Costa Rica', 'code' => 'CR'],
            ['name' => 'Côte d\'Ivoire', 'code' => 'CI'],
            ['name' => 'Croatia', 'code' => 'HR'],
            ['name' => 'Cuba', 'code' => 'CU'],
            ['name' => 'Curaçao', 'code' => 'CW'],
            ['name' => 'Cyprus', 'code' => 'CY'],
            ['name' => 'Czech Republic', 'code' => 'CZ'],
            ['name' => 'Denmark', 'code' => 'DK'],
            ['name' => 'Djibouti', 'code' => 'DJ'],
            ['name' => 'Dominica', 'code' => 'DM'],
            ['name' => 'Dominican Republic', 'code' => 'DO'],
            ['name' => 'Ecuador', 'code' => 'EC'],
            ['name' => 'Egypt', 'code' => 'EG'],
            ['name' => 'El Salvador', 'code' => 'SV'],
            ['name' => 'Equatorial Guinea', 'code' => 'GQ'],
            ['name' => 'Eritrea', 'code' => 'ER'],
            ['name' => 'Estonia', 'code' => 'EE'],
            ['name' => 'Ethiopia', 'code' => 'ET'],
            ['name' => 'Falkland Islands (Malvinas)', 'code' => 'FK'],
            ['name' => 'Faroe Islands', 'code' => 'FO'],
            ['name' => 'Fiji', 'code' => 'FJ'],
            ['name' => 'Finland', 'code' => 'FI'],
            ['name' => 'France', 'code' => 'FR'],
            ['name' => 'French Guiana', 'code' => 'GF'],
            ['name' => 'French Polynesia', 'code' => 'PF'],
            ['name' => 'French Southern Territories', 'code' => 'TF'],
            ['name' => 'Gabon', 'code' => 'GA'],
            ['name' => 'Gambia', 'code' => 'GM'],
            ['name' => 'Georgia', 'code' => 'GE'],
            ['name' => 'Germany', 'code' => 'DE'],
            ['name' => 'Ghana', 'code' => 'GH'],
            ['name' => 'Gibraltar', 'code' => 'GI'],
            ['name' => 'Greece', 'code' => 'GR'],
           ['name' => 'Greenland', 'code' => 'GL'],
            ['name' => 'Grenada', 'code' => 'GD'],
            ['name' => 'Guadeloupe', 'code' => 'GP'],
            ['name' => 'Guam', 'code' => 'GU'],
            ['name' => 'Guatemala', 'code' => 'GT'],
            ['name' => 'Guernsey', 'code' => 'GG'],
            ['name' => 'Guinea', 'code' => 'GN'],
            ['name' => 'Guinea-Bissau', 'code' => 'GW'],
            ['name' => 'Guyana', 'code' => 'GY'],
            ['name' => 'Haiti', 'code' => 'HT'],
            ['name' => 'Heard Island and McDonald Mcdonald Islands', 'code' => 'HM'],
            ['name' => 'Holy See (Vatican City State)', 'code' => 'VA'],
            ['name' => 'Honduras', 'code' => 'HN'],
            ['name' => 'Hong Kong', 'code' => 'HK'],
            ['name' => 'Hungary', 'code' => 'HU'],
            ['name' => 'Iceland', 'code' => 'IS'],
            ['name' => 'India', 'code' => 'IN'],
            ['name' => 'Indonesia', 'code' => 'ID'],
            ['name' => 'Iran, Islamic Republic of', 'code' => 'IR'],
            ['name' => 'Iraq', 'code' => 'IQ'],
            ['name' => 'Ireland', 'code' => 'IE'],
            ['name' => 'Isle of Man', 'code' => 'IM'],
            ['name' => 'Israel', 'code' => 'IL'],
            ['name' => 'Italy', 'code' => 'IT'],
            ['name' => 'Jamaica', 'code' => 'JM'],
            ['name' => 'Japan', 'code' => 'JP'],
            ['name' => 'Jersey', 'code' => 'JE'],
            ['name' => 'Jordan', 'code' => 'JO'],
            ['name' => 'Kazakhstan', 'code' => 'KZ'],
            ['name' => 'Kenya', 'code' => 'KE'],
            ['name' => 'Kiribati', 'code' => 'KI'],
            ['name' => 'Korea, Democratic People\'s Republic of', 'code' => 'KP'],
            ['name' => 'Korea, Republic of', 'code' => 'KR'],
            ['name' => 'Kuwait', 'code' => 'KW'],
            ['name' => 'Kyrgyzstan', 'code' => 'KG'],
            ['name' => 'Lao People\'s Democratic Republic', 'code' => 'LA'],
            ['name' => 'Latvia', 'code' => 'LV'],
            ['name' => 'Lebanon', 'code' => 'LB'],
            ['name' => 'Lesotho', 'code' => 'LS'],
            ['name' => 'Liberia', 'code' => 'LR'],
            ['name' => 'Libya', 'code' => 'LY'],
            ['name' => 'Liechtenstein', 'code' => 'LI'],
            ['name' => 'Lithuania', 'code' => 'LT'],
            ['name' => 'Luxembourg', 'code' => 'LU'],
            ['name' => 'Macao', 'code' => 'MO'],
            ['name' => 'Macedonia, the Former Yugoslav Republic of', 'code' => 'MK'],
            ['name' => 'Madagascar', 'code' => 'MG'],
            ['name' => 'Malawi', 'code' => 'MW'],
            ['name' => 'Malaysia', 'code' => 'MY'],
            ['name' => 'Maldives', 'code' => 'MV'],
            ['name' => 'Mali', 'code' => 'ML'],
            ['name' => 'Malta', 'code' => 'MT'],
            ['name' => 'Marshall Islands', 'code' => 'MH'],
            ['name' => 'Martinique', 'code' => 'MQ'],
            ['name' => 'Mauritania', 'code' => 'MR'],
            ['name' => 'Mauritius', 'code' => 'MU'],
            ['name' => 'Mayotte', 'code' => 'YT'],
            ['name' => 'Mexico', 'code' => 'MX'],
            ['name' => 'Micronesia, Federated States of', 'code' => 'FM'],
            ['name' => 'Moldova, Republic of', 'code' => 'MD'],
            ['name' => 'Monaco', 'code' => 'MC'],
            ['name' => 'Mongolia', 'code' => 'MN'],
            ['name' => 'Montenegro', 'code' => 'ME'],
            ['name' => 'Montserrat', 'code' => 'MS'],
            ['name' => 'Morocco', 'code' => 'MA'],
            ['name' => 'Mozambique', 'code' => 'MZ'],
            ['name' => 'Myanmar', 'code' => 'MM'],
            ['name' => 'Namibia', 'code' => 'NA'],
            ['name' => 'Nauru', 'code' => 'NR'],
            ['name' => 'Nepal', 'code' => 'NP'],
            ['name' => 'Netherlands', 'code' => 'NL'],
            ['name' => 'New Caledonia', 'code' => 'NC'],
            ['name' => 'New Zealand', 'code' => 'NZ'],
            ['name' => 'Nicaragua', 'code' => 'NI'],
            ['name' => 'Niger', 'code' => 'NE'],
            ['name' => 'Nigeria', 'code' => 'NG'],
            ['name' => 'Niue', 'code' => 'NU'],
            ['name' => 'Norfolk Island', 'code' => 'NF'],
            ['name' => 'Northern Mariana Islands', 'code' => 'MP'],
            ['name' => 'Norway', 'code' => 'NO'],
            ['name' => 'Oman', 'code' => 'OM'],
            ['name' => 'Pakistan', 'code' => 'PK'],
            ['name' => 'Palau', 'code' => 'PW'],
            ['name' => 'Palestine, State of', 'code' => 'PS'],
            ['name' => 'Panama', 'code' => 'PA'],
            ['name' => 'Papua New Guinea', 'code' => 'PG'],
            ['name' => 'Paraguay', 'code' => 'PY'],
            ['name' => 'Peru', 'code' => 'PE'],
            ['name' => 'Philippines', 'code' => 'PH'],
            ['name' => 'Pitcairn', 'code' => 'PN'],
            ['name' => 'Poland', 'code' => 'PL'],
            ['name' => 'Portugal', 'code' => 'PT'],
            ['name' => 'Puerto Rico', 'code' => 'PR'],
            ['name' => 'Qatar', 'code' => 'QA'],
            ['name' => 'Réunion', 'code' => 'RE'],
            ['name' => 'Romania', 'code' => 'RO'],
            ['name' => 'Russian Federation', 'code' => 'RU'],
            ['name' => 'Rwanda', 'code' => 'RW'],
            ['name' => 'Saint Barthélemy', 'code' => 'BL'],
            ['name' => 'Saint Helena, Ascension and Tristan da Cunha', 'code' => 'SH'],
            ['name' => 'Saint Kitts and Nevis', 'code' => 'KN'],
            ['name' => 'Saint Lucia', 'code' => 'LC'],
           ['name' => 'Saint Martin (French part)', 'code' => 'MF'],
            ['name' => 'Saint Pierre and Miquelon', 'code' => 'PM'],
            ['name' => 'Saint Vincent and the Grenadines', 'code' => 'VC'],
            ['name' => 'Samoa', 'code' => 'WS'],
            ['name' => 'San Marino', 'code' => 'SM'],
            ['name' => 'Sao Tome and Principe', 'code' => 'ST'],
            ['name' => 'Saudi Arabia', 'code' => 'SA'],
            ['name' => 'Senegal', 'code' => 'SN'],
            ['name' => 'Serbia', 'code' => 'RS'],
            ['name' => 'Seychelles', 'code' => 'SC'],
            ['name' => 'Sierra Leone', 'code' => 'SL'],
            ['name' => 'Singapore', 'code' => 'SG'],
            ['name' => 'Sint Maarten (Dutch part)', 'code' => 'SX'],
            ['name' => 'Slovakia', 'code' => 'SK'],
            ['name' => 'Slovenia', 'code' => 'SI'],
            ['name' => 'Solomon Islands', 'code' => 'SB'],
           ['name' => 'Somalia', 'code' => 'SO'],
            ['name' => 'South Africa', 'code' => 'ZA'],
            ['name' => 'South Georgia and the South Sandwich Islands', 'code' => 'GS'],
            ['name' => 'South Sudan', 'code' => 'SS'],
            ['name' => 'Spain', 'code' => 'ES'],
            ['name' => 'Sri Lanka', 'code' => 'LK'],
            ['name' => 'Sudan', 'code' => 'SD'],
            ['name' => 'Suriname', 'code' => 'SR'],
            ['name' => 'Svalbard and Jan Mayen', 'code' => 'SJ'],
            ['name' => 'Swaziland', 'code' => 'SZ'],
            ['name' => 'Sweden', 'code' => 'SE'],
            ['name' => 'Switzerland', 'code' => 'CH'],
            ['name' => 'Syrian Arab Republic', 'code' => 'SY'],
            ['name' => 'Taiwan', 'code' => 'TW'],
            ['name' => 'Tajikistan', 'code' => 'TJ'],
            ['name' => 'Tanzania, United Republic of', 'code' => 'TZ'],
            ['name' => 'Thailand', 'code' => 'TH'],
            ['name' => 'Timor-Leste', 'code' => 'TL'],
            ['name' => 'Togo', 'code' => 'TG'],
            ['name' => 'Tokelau', 'code' => 'TK'],
            ['name' => 'Tonga', 'code' => 'TO'],
            ['name' => 'Trinidad and Tobago', 'code' => 'TT'],
            ['name' => 'Tunisia', 'code' => 'TN'],
            ['name' => 'Turkey', 'code' => 'TR'],
            ['name' => 'Turkmenistan', 'code' => 'TM'],
            ['name' => 'Turks and Caicos Islands', 'code' => 'TC'],
            ['name' => 'Tuvalu', 'code' => 'TV'],
            ['name' => 'Uganda', 'code' => 'UG'],
            ['name' => 'Ukraine', 'code' => 'UA'],
            ['name' => 'United Arab Emirates', 'code' => 'AE'],
            ['name' => 'United Kingdom', 'code' => 'GB'],
            ['name' => 'United States', 'code' => 'US'],
            ['name' => 'United States Minor Outlying Islands', 'code' => 'UM'],
            ['name' => 'Uruguay', 'code' => 'UY'],
            ['name' => 'Uzbekistan', 'code' => 'UZ'],
            ['name' => 'Vanuatu', 'code' => 'VU'],
            ['name' => 'Venezuela, Bolivarian Republic of', 'code' => 'VE'],
            ['name' => 'Viet Nam', 'code' => 'VN'],
            ['name' => 'Virgin Islands, British', 'code' => 'VG'],
            ['name' => 'Virgin Islands, U.S.', 'code' => 'VI'],
            ['name' => 'Wallis and Futuna', 'code' => 'WF'],
            ['name' => 'Western Sahara', 'code' => 'EH'],
            ['name' => 'Yemen', 'code' => 'YE'],
            ['name' => 'Zambia', 'code' => 'ZM'],
            ['name' => 'Zimbabwe', 'code' => 'ZW'],
        ];

        return json_decode(json_encode($countries));
}

function mail_templates($data) {
    $data = (array)$data;
    $empty_type = (bool)empty($data['type']);
    
    $template_type_array = array(
        "admin_reply_from_order"=>"Admin Reply from Order",
        "admin_reply_from_offer"=>"Admin Reply from Offer",
        "customer_reply_from_offer"=>"Customer Reply from Offer",
        "reset_password"=>"Send Password Reset Link To Customer",
        "new_order_email_to_customer"=>"New Order Email To Customer",
        "new_order_email_to_admin"=>"New Order Email To Admin",
        "signup_verification_for_email"=>"Signup Verification For Email",
        "customer_profile_edit_from_admin"=>"Customer Profile Edit From Admin",
        "contact_form_alert"=>"Contact Form Alert By Customer",
        "review_form_alert"=>"Review Form Alert To Admin",
        "review_thank_you_email_to_customer"=>"Review Thank You Email To Customer",
        "bulk_order_form_alert"=>"Bulk Order Form Alert To Admin",
        "bulk_order_thank_you_email_to_customer"=>"Bulk Order Thank You Email To Customer",
        "quote_request_form_alert"=>"Quote Request Form Alert By Customer",
        "affiliate_form_alert"=>"Affiliate Form Alert By Customer",
        "order_expiring"=>"Order Expiring (Automated)",
        "order_expired"=>"Order Expired (Automated)",
        "shipment_label_email_to_customer"=>"Shipment Label Email To Customer",
        "newsletter_thank_you_email_to_customer"=>"Newsletter Thank You Email To Contractor",
        "newsletter_form_alert"=>"Newsletter Form Alert To Admin",
        "order_payment_status_paid_alert_email_to_customer"=>"Order Payment Status Paid Alert Email To Customer",
    );
    
    $to_admin_tmpl_array = array("customer_reply_from_offer","new_order_email_to_admin","contact_form_alert","quote_request_form_alert","affiliate_form_alert","newsletter_form_alert");
    $to_customer_tmpl_array = array("admin_reply_from_order","admin_reply_from_offer","reset_password","new_order_email_to_customer","signup_verification_for_email","customer_profile_edit_from_admin","order_expiring","order_expired","newsletter_thank_you_email_to_customer","order_payment_status_paid_alert_email_to_customer");
    
    if(!empty($data['is_fixed']) && $data['is_fixed'] == '0') {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$customer_company_name}',
            '{$order_id}',
            '{$order_payment_method}',
            '{$order_date}',
            '{$order_approved_date}',
            '{$order_expire_date}',
            '{$order_sales_pack}',
            '{$current_date_time}',
            '{$order_item_model}',
            '{$order_item_price}',
            '{$order_item_storage}',
            '{$order_item_condition}',
            '{$order_item_locks}');
    } elseif(!$empty_type && $data['type']=="order_payment_status_paid_alert_email_to_customer") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$customer_company_name}',
            '{$order_id}',
            '{$order_payment_method}',
            '{$order_date}',
            '{$order_approved_date}',
            '{$order_expire_date}',
            '{$order_status}',
            '{$order_sales_pack}',
            '{$current_date_time}');
    } elseif(!$empty_type && $data['type']=="contact_form_alert") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$order_id}',
            '{$form_subject}',
            '{$form_message}');
    } elseif(!$empty_type && $data['type']=="review_form_alert" || !$empty_type && $data['type']=="review_thank_you_email_to_customer") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fullname}',
            '{$customer_email}',
            '{$country}',
            '{$state}',
            '{$city}',
            '{$stars}',
            '{$form_title}',
            '{$form_message}',
            '{$device_sold}',
            '{$zip_code}',
            '{$customer_phone}');
    } elseif(!$empty_type && $data['type']=="bulk_order_form_alert" || !$empty_type && $data['type']=="bulk_order_thank_you_email_to_customer") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fullname}',
            '{$customer_email}',
            '{$customer_phone}',
            '{$country}',
            '{$state}',
            '{$city}',
            '{$zip_code}',
            '{$company_name}',
            '{$devices}',
            '{$form_message}');
    } elseif(!$empty_type && $data['type']=="affiliate_form_alert") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$current_date_time}',
            '{$company_name}',
            '{$web_address}',
            '{$form_subject}',
            '{$form_message}',
            '{$item_name}');
    } elseif(!$empty_type && $data['type']=="quote_request_form_alert") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$current_date_time}',
            '{$form_subject}',
            '{$form_message}',
            '{$item_name}');
    } elseif(!$empty_type && $data['type']=="signup_verification_for_email") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$current_date_time}',
            '{$verification_code}',
            '{$verification_link}',
            '{$admin_phone}');
    } elseif(!$empty_type && $data['type']=="shipment_label_email_to_customer" || !$empty_type && $data['type']=="new_order_email_to_customer" || !$empty_type && $data['type']=="new_order_email_to_admin") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$order_id}',
            '{$order_payment_method}',
            '{$order_date}',
            '{$order_approved_date}',
            '{$order_expire_date}',
            '{$order_status}',
            '{$order_sales_pack}',
            '{$current_date_time}',
            '{$order_item_list}');
    } elseif(!$empty_type && $data['type']=="customer_profile_edit_from_admin") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_password}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$customer_status}',
            '{$current_date_time}');
    } elseif(!$empty_type && $data['type']=="reset_password") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$current_date_time}',
            '{$password_reset_link}');
    } elseif(!$empty_type && $data['type']=="admin_reply_from_order") {
        $constants_array = array(
            '{$logo}',
            '{$header_logo}',
            '{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$customer_company_name}',
            '{$order_id}',
            '{$order_status}',
            '{$order_payment_method}',
            '{$order_date}',
            '{$order_approved_date}',
            '{$order_expire_date}',
            '{$order_sales_pack}',
            '{$current_date_time}');
    } elseif(!$empty_type && $data['type']=="admin_reply_from_offer") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$customer_company_name}',
            '{$order_id}',
            '{$order_payment_method}',
            '{$order_date}',
            '{$order_approved_date}',
            '{$order_expire_date}',
            '{$order_status}',
            '{$order_sales_pack}',
            '{$current_date_time}',
            '{$order_note}',
            '{$order_item_list}',
            '{$offer_accept_link}',
            '{$offer_reject_link}');
    } elseif(!$empty_type && $data['type']=="customer_reply_from_offer") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$order_id}',
            '{$order_payment_method}',
            '{$order_date}',
            '{$order_approved_date}',
            '{$order_expire_date}',
            '{$order_status}',
            '{$offer_status}',
            '{$order_sales_pack}',
            '{$current_date_time}',
            '{$order_note}',
            '{$order_item_list}');
    } elseif(!$empty_type && $data['type']=="newsletter_form_alert" || !$empty_type && $data['type']=="newsletter_thank_you_email_to_customer") {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fullname}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_email}');
    } else {
        $constants_array = array(
            '{$logo}','{$header_logo}','{$footer_logo}',
            '{$admin_logo}',
            '{$admin_email}',
            '{$admin_username}',
            '{$admin_site_url}',
            '{$admin_panel_name}',
            '{$admin_phone}',
            '{$from_name}',
            '{$from_email}',
            '{$site_name}',
            '{$site_url}',
            '{$customer_fname}',
            '{$customer_lname}',
            '{$customer_fullname}',
            '{$customer_phone}',
            '{$customer_email}',
            '{$customer_password}',
            '{$customer_address_line1}',
            '{$customer_address_line2}',
            '{$customer_city}',
            '{$customer_state}',
            '{$customer_country}',
            '{$customer_postcode}',
            '{$customer_status}',
            '{$order_id}',
            '{$order_payment_method}',
            '{$order_date}',
            '{$order_approved_date}',
            '{$order_expire_date}',
            '{$order_status}',
            '{$offer_status}',
            '{$verification_link}',
            '{$verification_code}',
            '{$password_reset_link}',
            '{$order_note}',
            '{$order_item_list}',
            '{$offer_accept_link}',
            '{$offer_reject_link}',
            '{$company_name}',
            '{$web_address}');
    }

    $return = [
        'admin' => $to_admin_tmpl_array,
        'customer' => $to_customer_tmpl_array,
        'type' => $template_type_array,
        'data' => $constants_array,
    ];

    return json_decode(json_encode($return));
}