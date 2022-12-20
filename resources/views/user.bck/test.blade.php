@php
use Illuminate\Support\Facades\Hash;
use EasyPost\EasyPost;
use EasyPost\Shipment;


// header('Content-Type: application/json');
// $json = '{"show_model_storage":"model_details","newslettter_section":"0","top_right_menu":"0","header_menu":"1","footer_menu_column1":"1","footer_menu_column2":"1","footer_menu_column3":"1","copyright_menu":"1"}';
// $get = (array)json_decode($json);


// EasyPost::setApiKey('EZTK07bc07e75e3a4ebbafd6c78f4d52b7c8uy22knJIYyl8pOYUaVV9fA');
//@weaken: 3/2/22
//@description: this is for function name
// $shipment = Shipment::retrieve('shp_0d20f18fb3ee48d7a97913610b85ad1f');
/*
/##########################################################
#  @weaken: //
#  @description: 
###########################################################
*/
// $shipment = '
// object(EasyPost\Address)#9 (7) { ["_apiKey":protected]=> string(58) "EZTK07bc07e75e3a4ebbafd6c78f4d52b7c8uy22knJIYyl8pOYUaVV9fA" ["_retrieveOptions":protected]=> array(0) { } ["_values":protected]=> array(20) { ["id"]=> string(36) "adr_23869ab4a0d211ec96aaac1f6bc72124" ["object"]=> string(7) "Address" ["created_at"]=> string(25) "2022-03-11T00:28:14+00:00" ["updated_at"]=> string(25) "2022-03-11T00:28:14+00:00" ["name"]=> NULL ["company"]=> string(11) "ZELU MEXICO" ["street1"]=> string(27) "AV MOLIERE 328, PISO 6. COL" ["street2"]=> string(0) "" ["city"]=> string(14) "MIGUEL HIDALGO" ["state"]=> string(11) "MEXICO CITY" ["zip"]=> string(5) "11510" ["country"]=> string(2) "MX" ["phone"]=> string(10) "0000000000" ["email"]=> string(12) "HOLA@ZELU.MX" ["mode"]=> string(4) "test" ["carrier_facility"]=> NULL ["residential"]=> NULL ["federal_tax_id"]=> NULL ["state_tax_id"]=> NULL ["verifications"]=> object(EasyPost\EasyPostObject)#10 (7) { ["_apiKey":protected]=> string(58) "EZTK07bc07e75e3a4ebbafd6c78f4d52b7c8uy22knJIYyl8pOYUaVV9fA" ["_retrieveOptions":protected]=> array(0) { } ["_values":protected]=> array(1) { ["delivery"]=> object(EasyPost\EasyPostObject)#11 (7) { ["_apiKey":protected]=> string(58) "EZTK07bc07e75e3a4ebbafd6c78f4d52b7c8uy22knJIYyl8pOYUaVV9fA" ["_retrieveOptions":protected]=> array(0) { } ["_values":protected]=> array(3) { ["success"]=> bool(true) ["errors"]=> array(0) { } ["details"]=> object(EasyPost\EasyPostObject)#12 (7) { ["_apiKey":protected]=> string(58) "EZTK07bc07e75e3a4ebbafd6c78f4d52b7c8uy22knJIYyl8pOYUaVV9fA" ["_retrieveOptions":protected]=> array(0) { } ["_values":protected]=> array(3) { ["latitude"]=> float(19.43654) ["longitude"]=> float(-99.20135) ["time_zone"]=> string(19) "America/Mexico_City" } ["_unsavedValues":protected]=> array(0) { } ["_immutableValues":protected]=> array(2) { [0]=> string(7) "_apiKey" [1]=> string(2) "id" } ["_parent":"EasyPost\EasyPostObject":private]=> *RECURSION* ["_name":"EasyPost\EasyPostObject":private]=> string(7) "details" } } ["_unsavedValues":protected]=> array(0) { } ["_immutableValues":protected]=> array(2) { [0]=> string(7) "_apiKey" [1]=> string(2) "id" } ["_parent":"EasyPost\EasyPostObject":private]=> *RECURSION* ["_name":"EasyPost\EasyPostObject":private]=> string(8) "delivery" } } ["_unsavedValues":protected]=> array(0) { } ["_immutableValues":protected]=> array(2) { [0]=> string(7) "_apiKey" [1]=> string(2) "id" } ["_parent":"EasyPost\EasyPostObject":private]=> *RECURSION* ["_name":"EasyPost\EasyPostObject":private]=> string(13) "verifications" } } ["_unsavedValues":protected]=> array(0) { } ["_immutableValues":protected]=> array(2) { [0]=> string(7) "_apiKey" [1]=> string(2) "id" } ["_parent":"EasyPost\EasyPostObject":private]=> NULL ["_name":"EasyPost\EasyPostObject":private]=> NULL }
// ';

// echo($shipment);
$html = '
<br><meta name="viewport" content="width=device-width, initial-scale=1"><style>@import url("https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i&display=swap"); 
/*--- Preheader declaration in style block in addition to inline for Outlook */
.preheader { color: transparent; display: none !important; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0; }</style><div class="preheader" style="color: transparent; display: none !important; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">Hi Cong Le, We have updated&nbsp;the status of your Offer# MM20270&nbsp; to&nbsp;Delivered.This means that your device(s) was/were successfully delivered to us.What\'s next?Your device(s) will be tested and processed by our technicians.&nbsp;We will email you any other important updates after this step is completed.Regards,MacMetro.com TeamPhone:&nbsp;(904) 310-0080Email:&nbsp; support@macmetro.com</div><table cellspacing="0" cellpadding="0" style="font-family:\'Montserrat\',Helvetica,Roboto,Arial,sans-serif;font-size:1em;margin:0;padding:0;background-color:#f1f1f1;color:#000;width:100%">
<tbody>
<tr>
<td align="center" style="padding:0">
<table cellspacing="0" cellpadding="0" style="border:1px solid #ddd;max-width:650px;width:100%">
<tbody>
<tr>
<td style="text-align:left;background:#fff">
<table cellspacing="0" cellpadding="0" style="padding-top:0px;padding-bottom:0px;width:100%">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" style="font-family:\'Montserrat\',Helvetica,Roboto,Arial,sans-serif; max-width:650px;width:100%;padding-top:0px;background:#ffffff;margin-bottom:0px!important;margin:0 auto;">
<tbody>
<tr style="background:#000000;">
<td align="left" style="font-family:\'Montserrat\',Helvetica,Roboto,Arial,sans-serif; width:25%;padding-top:10px;padding-bottom:10px;padding-left:20px;padding-right:0px">
<a style="border:none;" href="https://www.1guygadget.com" target="_blank"><img src="/images/xlogo.png.pagespeed.ic.D7T9cxPM_o.png" width="auto" height="50" alt="1GuyGadget Logo" class="CToWUd">
</a>
</td>
<td align="right" style="font-family:\'Montserrat\',Helvetica,Roboto,Arial,sans-serif; width:65%;padding-top:10px;padding-bottom:10px;padding-left:0px;padding-right:20px;font-size:17px;color:#f1bb00">
<strong>PHONE</strong><br><a style="color:#fff;text-decoration:none" href="tel:+1-904-310-0080" target="_blank">9043100080</a>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="padding-top:15px;padding-left:20px;padding-right:20px">
<table cellspacing="0" cellpadding="0" style="padding-top:0px;background:#ffffff;margin-top:0px!important;margin:20px auto">
<tbody>
<tr>
<td>
<table width="100%" style="padding-top:0px;padding-bottom:0px;font-size:18px">
<tbody>
<tr>
<td>
<table width="100%" cellspacing="0" cellpadding="0">
<tbody>
<tr>
<td style="font-family:\'Montserrat\',Helvetica,Roboto,Arial,sans-serif; "><div><br><br><h3>Hi Cong Le,</h3><br>We have updated&nbsp;the status of your<b> Offer# MM20270&nbsp;</b> to&nbsp;<b>Delivered</b>.<br>This means that your device(s) was/were successfully delivered to us.<br><br><h3>What\'s next?</h3><div>Your device(s) will be tested and processed by our technicians.&nbsp;We will email you any other important updates after this step is completed.<br></div><div><br></div><div><br></div>Regards,<br>MacMetro.com Team<br><br><b>Phone:</b>&nbsp;(904) 310-0080<br><b>Email:</b>&nbsp; support@macmetro.com<br><br><br></div></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table cellspacing="0" cellpadding="0" style="max-width:650px;width:100%">
<tbody>
<tr>
<td>
<table cellspacing="0" cellpadding="0" style="max-width:650px;width:100%;padding-top:0px;font-size:15px;text-align:center;margin-top:20px!important;margin-bottom:20px!important;margin:20px auto">
<tbody>
<tr>
<td style="font-family:\'Montserrat\',Helvetica,Roboto,Arial,sans-serif; padding:10px;color:#333">
<p>
<a href="#" style="text-decoration:none; color:#333">
MacMetro | Po Box 3061 | Jacksonville, FL | 32206
</a>
</p>
<p><i>If we served you right, refer someone to us!</i></p>
<a href="https://www.facebook.com/" style="text-decoration:none" rel="noreferrer" target="_blank"><img src="/images/xfb1gg.png.pagespeed.ic.e3JApJP3fw.png" alt="Facebook Page" width="32" height="32"></a> &nbsp;
<a href="https://twitter.com/" style="text-decoration:none" rel="noreferrer" target="_blank"><img src="/images/xtwitter1gg.png.pagespeed.ic.moMbrrleGX.png" alt="Twitter Page" width="32" height="32"></a> &nbsp;
<a href="https://www.instagram.com/" style="text-decoration:none" rel="noreferrer" target="_blank"><img src="/images/xinsta1gg.png.pagespeed.ic.QqPewhskIQ.png" alt="Instagram Page" width="32" height="32"></a> &nbsp;
</td>
</tr>
<tr align="center">
<td style="font-family:\'Montserrat\',Helvetica,Roboto,Arial,sans-serif; padding-top:15px;padding-bottom:10px"><a style="text-decoration:none;font-size:15px;color:#333" href="/" target="_blank">© 2018-2022<span> MacMetro</span>.com</a></td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>

<br>';

// $admin = admin_page_links('location');

// $my_array = ['foo' => 1, 'hello' => 'world'];
// $allowed  = ['Model'];
// $filtered = array_filter(
//     $admin,
//     function ($key) use ($allowed) {
//         return in_array($key, $allowed);
//     },
//     ARRAY_FILTER_USE_KEY
// );
// echo var_dump($filtered);
// exit(var_dump(array_intersect_key($admin, array_flip(['Model']))));
// $keys = array_keys($admin);
// $search = 'category';
// $result = preg_grep("/{$search}/i", $keys);
// echo var_dump($admin);

// $path = '/about';
// $url = $path ?: '/';

// echo $url; // /about
// echo var_dump(htmlspecialchars($html));

$required = array('key1', 'key31', 'key3');

$data = array(
    'key1' => 10,
    'key2' => 20,
    'key3' => 30,
    'key4' => 40,
);

echo var_dump(array_keys_checker($data, $required));

// echo var_dump(unread_messages());
// echo var_dump(admin_page_links(''));
// $get = (object)timezone_list();
// echo $json;
// var_dump($get['footer_menu_column1']);
// foreach ($get as $key => $value) {
//     # code...
//     var_dump($value->display);

// echo 'base_64';
// echo  Storage::disk('public')->get('setting/MQ==/logo-new-green.png') ;
// echo asset('storage/setting/MQ==/logo-new-green.png');
// print_r(country_list());

// foreach (country_list() as $value) {
//     echo $value['code'];
// }

// $str = json_decode('{"order":{"view":"1","add":0,"edit":"1","delete":"1"},"model":{"view":0,"add":"1","edit":"1","delete":0},"device":{"view":"1","add":"1","edit":0,"delete":"1"},"brand":{"view":0,"add":0,"edit":0,"delete":0},"category":{"view":0,"add":0,"edit":0,"delete":0},"customer":{"view":0,"add":"1","edit":"1","delete":0},"page":{"view":0,"add":0,"edit":0,"delete":0},"menu":{"view":0,"add":0,"edit":0,"delete":0},"form":{"view":0,"add":0,"edit":0,"delete":"1"},"blog":{"view":0,"add":0,"edit":0,"delete":0},"faq":{"view":0,"add":0,"edit":0,"delete":0},"promocode":{"view":0,"add":0,"edit":0,"delete":0},"emailtemplate":{"view":0,"add":0,"edit":0,"delete":0}}');
// $res = get_access_permission($str, false);
// $res = array_keys((array)$res);
// print_r($res);
// exit();

// echo Hash::make('admin');
// $g = App\Models\Admin\CategoriesAttribute::get_network_list(45);

// echo var_dump(empty($sdfg));
// echo var_dumpt(json_decode('"{\"GOOD\":0,\"BROKEN\":0}"'));
exit();
// $data = ['d','adf'];

// $data[] = 'hello';
// $data[] = 'hello1';
// $data[] = 'hello2';

// echo var_dump($data);


// }
@endphp