<div class="row content p-0 m-0" id="generalSettings">
    <div class="tab-content">   
        <form method="POST" class="form py-1 position-relative" id="generalForm">
            <div class="alert d-none text-center position-sticky top-0 col-lg-6" role="alert"></div>
            {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-gear"></i></span>General Settings</h3> --}}
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Admin Panel Name</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->admin_panel_name }}" name="adminpanelname">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="customFile" class="col-form-label">Front Logo</label><small class="mx-1 text-danger"></small>
                <input type="file" id="logoSetting" name="logosetting" class="form-control form-control-sm" id="customFile" />
            </div>
            @if (!empty($setting_info->logo))
                <div class="form-group col-lg-3">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail"><img class="form-control" id="output" src="{{ asset('storage/setting/'. base64_encode($setting_info->id) . '/logo/' . $setting_info->logo) }}" width="200"></div>
                        <div class="fileupload-preview fileupload-exists fileupload-large flexible thumbnail"></div>
                    </div>
                </div>
                {{-- <div class="form-group py-2">
                    <button type="button" class="btn">Remove</button>
                </div> --}}
            @endif
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Site Name</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->site_name }}" name="sitename">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Website</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->website }}" name="website">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Header/Footer Phone</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->phone }}" name="phone">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Header/Footer Email</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->email }}" name="email">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Copyright</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->copyright }}" name="copyright">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Map Key</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->map_key }}" name="mapkey">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">News Blog Link</label>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->news_blog_link }}" name="newsbloglink">
                <div class="pt-2">
                    <div class="form-check form-check-inline">
                       <input class="form-check-input" value="same" type="radio" name="newsbloglinktarget" {{ $setting_info->news_blog_link_open == 'same' ? 'checked' : '' }} />
                       <label class="form-check-label" for="flexRadioDefault1">Same Window</label>
                    </div>
                    <div class="form-check form-check-inline">
                       <input class="form-check-input" value="new" type="radio" name="newsbloglinktarget" {{ $setting_info->news_blog_link_open == 'new' ? 'checked' : '' }} />
                       <label class="form-check-label" for="flexRadioDefault2">Open Window</label>
                    </div>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                @php
                    $timezone_list =timezone_list();
                @endphp
                <label for="" class="form-label">Timezone</label><small class="mx-1 text-danger"></small>
                <select name="timezone" id="" class="form-select form-select-sm">
                    @foreach ($timezone_list as $get_timezone)
                        <option value="{{ $get_timezone['value'] }}" {{ $setting_info->timezone == $get_timezone['value'] ? 'selected':'' }}>{{ $get_timezone['display'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Time Format</label><small class="mx-1 text-danger"></small>
                <select name="timeformat" id="" class="form-select form-select-sm">
                    <option value="12_hour" {{ $setting_info->time_format == '12_hour' ? 'selected':'' }}>12 hour</option>
                    <option value="24_hour" {{ $setting_info->time_format == '24_hour' ? 'selected':'' }}>24 hour</option>
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label class="form-label" for="input">Date Format</label><small class="mx-1 text-danger"></small>
                <div class="">
                   <select class="form-select  form-select-sm" id="date_format" name="dateformat">
                      <option value="m/d/Y" {{ $setting_info->date_format=='m/d/Y' ? 'selected' : '' }}>m/d/Y ex. {{ date("m/d/Y") }}</option>
                      <option value="d-m-Y" {{ $setting_info->date_format=='d-m-Y' ? 'selected' : '' }}>d-m-Y ex. {{ date("d-m-Y") }}</option>
                      <option value="M/d/Y" {{ $setting_info->date_format=='M/d/Y' ? 'selected' : '' }}>M/d/Y ex. {{ date("M/d/Y") }}</option>
                      <option value="d-M-Y" {{ $setting_info->date_format=='d-M-Y' ? 'selected' : '' }}>d-M-Y ex. {{ date("d-M-Y") }}</option>
                      <option value="m/d/y" {{ $setting_info->date_format=='m/d/y' ? 'selected' : '' }}>m/d/y ex. {{ date("m/d/y") }}</option>
                      <option value="d-m-y" {{ $setting_info->date_format=='d-m-y' ? 'selected' : '' }}>d-m-y ex. {{ date("d-m-y") }}</option>
                      <option value="M/d/y" {{ $setting_info->date_format=='M/d/y' ? 'selected' : '' }}>M/d/y ex. {{ date("M/d/y") }}</option>
                      <option value="d-M-y" {{ $setting_info->date_format=='d-M-y' ? 'selected' : '' }}>d-M-y ex. {{ date("d-M-y") }}?></option>
                   </select>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">IMEI API Key</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->imei_api_key }}" name="imeiapikey">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Status of Terms & Conditions</label><small class="mx-1 text-danger"></small>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" name="statustermsconditions" {{ $setting_info->terms_status ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Enable</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="statustermsconditions" {{ !$setting_info->terms_status ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Disable</label>
                     </div>
                </div>
            </div>
            <div class="py-2 col-lg-6">
                <label for="" class="form-label">Display Terms & Conditions</label>
                <div class="form-group form-check py-2">
                    <div>
                      <input name="onaccountcreation" value='1' type="checkbox" class="form-check-input" {{ $display_terms->ac_creation ? 'checked': '' }}>
                      <label for="" class="form-check-label">On Account Creation</label>
                    </div>
                    <div>
                        <input name="onconfirmsale" value="1" type="checkbox" class="form-check-input" {{ $display_terms->confirm_sale ? 'checked': '' }}>
                        <label for="" class="form-check-label">On Confirm Sale</label>
                      </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Terms & Conditions</label>
                <div class="editor-container" style="">
                    <textarea id="editor" name="termsconditions" class="ckeEditor">{!! htmlspecialchars_decode($setting_info->terms) !!}</textarea>
                </div>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Show Model Storage</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="models" type="radio" name="showmodelstorage" {{ $other_settings->show_model_storage == 'models' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Model</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="model_details" type="radio" name="showmodelstorage" {{ $other_settings->show_model_storage == 'model_details' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Model's Detail</label>
                     </div>
                </div>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Show Missing Product Section</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" name="showmissingproductsection" {{ $setting_info->missing_product_section ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="showmissingproductsection" {{ !$setting_info->missing_product_section ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                     </div>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Top Seller Limit</label><small class="mx-1 text-danger"></small>
                <input type="number" class="form-control form-control-sm" value="{{ $setting_info->top_seller_limit }}" name="topsellerlimit">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Top Seller Mode</label><small class="mx-1 text-danger"></small>
                <select name="topsellermode" id="" class="form-select  form-select-sm">
                    <option value="model_specific" {{ $setting_info->top_seller_mode == 'model_specific' ? 'selected':'' }}>Model Specific</option>
                    <option value="storage_specific" {{ $setting_info->top_seller_mode == 'storage_specific' ? 'selected':'' }}>Model's Storage Specific</option>
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Order Prefix</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->order_prefix }}" name="orderprefix">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Order Expiring Days</label><small class="mx-1 text-danger"></small>
                <input type="number" class="form-control form-control-sm" value="{{ $setting_info->order_expiring_days }}" name="orderexpiringdays">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Order Expired Days</label><small class="mx-1 text-danger"></small>
                <input type="number" class="form-control form-control-sm" value="{{ $setting_info->order_expired_days }}" name="orderexpireddays">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Page List Limit</label><small class="mx-1 text-danger"></small>
                <select name="pagelistlimit" id="" class="form-select  form-select-sm">
                    <option value="5" {{ $setting_info->page_list_limit == 5 ? 'selected' : '' }}>5</option>
                    <option value="10" {{ $setting_info->page_list_limit == 10 ? 'selected' : '' }}>10</option>
                    <option value="15" {{ $setting_info->page_list_limit == 15 ? 'selected' : '' }}>15</option>
                    <option value="20" {{ $setting_info->page_list_limit == 20 ? 'selected' : '' }}>20</option>
                    <option value="25" {{ $setting_info->page_list_limit == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $setting_info->page_list_limit == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $setting_info->page_list_limit == 100 ? 'selected' : '' }}>100</option>
                    <option value="200" {{ $setting_info->page_list_limit == 200 ? 'selected' : '' }}>200</option>
                    <option value="500" {{ $setting_info->page_list_limit == 500 ? 'selected' : '' }}>500</option>
                </select>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Promocode Section</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" name="promocodesection" {{ $setting_info->promocode_section ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Yes</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="promocodesection" {{ !$setting_info->promocode_section ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                     </div>
                </div>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Display Currency</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="prefix" type="radio" name="displaycurrency" {{ $setting_info->disp_currency == 'prefix'? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Prefix</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="postfix" type="radio" name="displaycurrency" {{ $setting_info->disp_currency == 'postfix' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Postfix</label>
                     </div>
                </div>
            </div>
            <div class="py-2 col-lg-6">
                <div class="form-group form-check py-2">
                    <div>
                      <input name="keepspacebetweencurrency" value="1" type="checkbox" class="form-check-input" {{ $setting_info->is_space_between_currency_symbol ? 'checked': '' }}>
                      <label for="" class="form-check-label">Keep space between currency sysmbol and amount</label>
                    </div>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Thousand Separator</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->thousand_separator }}" name="thousandseparator">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Decimal Separator</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->decimal_separator }}" name="decimalseparator">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Number of Decimals</label><small class="mx-1 text-danger"></small>
                <input type="text" class="form-control form-control-sm" value="{{ $setting_info->decimal_number }}" name="decimalnumber">
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Newsletter Section</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" name="newslettersection" {{ $other_settings->newslettter_section ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Show</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="newslettersection" {{ !$other_settings->newslettter_section ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Hide</label>
                     </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Payment Option</label>
            </div>
            <div>
                <div class="py-1">
                    <input name="paymentbank" value="1" type="checkbox" class="form-check-input" {{ $payment_option->bank ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Bank</label>
                </div>       
                <div class="py-1">
                    <input name="paymentpaypal" value="1" type="checkbox" class="form-check-input" {{ $payment_option->paypal ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Paypal</label>
                </div>          
                <div class="py-1">
                    <input name="paymentcheck" value="1" type="checkbox" class="form-check-input" {{ $payment_option->check ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Cheque/Check</label>
                </div>       
                <div class="py-1">
                    <input name="paymentzelle" value="1" type="checkbox" class="form-check-input" {{ $payment_option->zelle ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Zelle</label>
                </div>       
                <div class="py-1">
                    <input name="paymentcash" value="1" type="checkbox" class="form-check-input" {{ $payment_option->cash ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Cash</label>
                </div>        
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Default Payment Option</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="bank" type="radio" name="defaultpaymentoption" {{ $setting_info->default_payment_option == 'bank' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Bank</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="paypal" type="radio" name="defaultpaymentoption" {{ $setting_info->default_payment_option == 'paypal' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Paypal</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="check" type="radio" name="defaultpaymentoption" {{ $setting_info->default_payment_option == 'check' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Cheque/Check</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="zelle" type="radio" name="defaultpaymentoption" {{ $setting_info->default_payment_option == 'zelle' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Zelle</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="cash" type="radio" name="defaultpaymentoption" {{ $setting_info->default_payment_option == 'cash' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Cash</label>
                     </div>
                </div>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Recommended Payment Option</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="bank" type="radio" name="recommendedpaymentoption" {{ $setting_info->recommended_payment_option == 'bank' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Bank</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="paypal" type="radio" name="recommendedpaymentoption" {{ $setting_info->recommended_payment_option == 'paypal' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Paypal</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="check" type="radio" name="recommendedpaymentoption" {{ $setting_info->recommended_payment_option == 'check' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Cheque/Check</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="zelle" type="radio" name="recommendedpaymentoption" {{ $setting_info->recommended_payment_option == 'zelle' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Zelle</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="cash" type="radio" name="recommendedpaymentoption" {{ $setting_info->recommended_payment_option == 'cash' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Cash</label>
                     </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="form-label">Sales Pack</label>
            </div>
            <div>
                <div class="py-1">
                    <input name="salespackfreesalespack" value="1" type="checkbox" class="form-check-input" {{ $sales_pack->free ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Send free sales pack</label>
                </div>       
                <div class="py-1">
                    <input name="salespackprintownnopostage" value="1" type="checkbox" class="form-check-input" {{ $sales_pack->own ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Print your own no postage sales labels</label>
                </div>             
            </div>
            <div class="form-group">
                <label for="" class="form-label">Shipping Option</label>
            </div>
            <div>
                <div class="py-1">
                    <input name="shippingoptionpostown" value="1" type="checkbox" class="form-check-input" {{ $shipping_option->own ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Post Your Own</label>
                </div>       
                <div class="py-1">
                    <input name="shippingoptionschedule" value="1" type="checkbox" class="form-check-input" {{ $shipping_option->free_pickup ? 'checked' : ''}} />
                    <label for="" class="form-check-label">Schedule a Free Pickup</label>
                </div>             
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Verification</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="none" type="radio" name="verification" {{ $setting_info->verification == 'none' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">None</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="email" type="radio" name="verification" {{ $setting_info->verification == 'email' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Email</label>
                     </div>
                     <div class="form-check form-check-inline">
                        <input class="form-check-input" value="sms" type="radio" name="verification" {{ $setting_info->verification == 'sms' ? 'checked' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">SMS</label>
                     </div>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Service Hours Text(Header)</label><small class="mx-1 text-danger"></small>
                <textarea name="servicehourstext" id="" cols="30" rows="5" class="form-control form-control-sm">{{ $setting_info->header_service_hours_text }}</textarea>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">JS code before &#60;&#47;head&#62;</label><small class="mx-1 text-danger"></small>
                <textarea name="jscode" id="" cols="30" rows="5" class="form-control form-control-sm">{!! htmlspecialchars_decode($setting_info->custom_js_code) !!}</textarea>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Order Tracking Tag (JS code before &#60;&#47;head&#62;)</label><small class="mx-1 text-danger"></small>
                <textarea name="ordertrackingtag" id="" cols="30" rows="5" class="form-control form-control-sm">{!!  htmlspecialchars_decode($setting_info->order_tracking_tag) !!}</textarea>
            </div>
            {{-- <div class="form-group py-2">
                <button type="submit" class="btn">Update</button>
            </div> --}}
        </form>
    </div>
</div>
