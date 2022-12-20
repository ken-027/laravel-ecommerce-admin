<div class="container-fluid m-0 p-0 col-12 dialog-form">
    <div class="row m-0 p-0 h-100">
        <div class="col-2 p-0 m-0 h-100">
            <ul class="navbar-nav settings bg-main m-0 p-0 pb-2 h-100 position-relative">
                <div class="overflow-menu">
                    <li class="pb-1">
                        <a class="nav-link px-3 active" data-content="generalSettings">
                            {{-- <span class="me-2"><i class="bi bi-gear"></i></span> --}}
                            <span>General</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="companyDetailsSettings">
                            {{-- <span class="me-2"><i class="bi bi-building"></i></span> --}}
                            <span>Company</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="emailSettings">
                            {{-- <span class="me-2"><i class="bi bi-envelope"></i></span> --}}
                            <span>Email</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="socialSettings">
                            {{-- <span class="me-2"><i class="bi bi-person-badge-fill"></i></span> --}}
                            <span>Social</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="smsSettings">
                            {{-- <span class="me-2"><i class="bi bi-chat-text"></i></span> --}}
                            <span>SMS</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="blogSettings">
                            {{-- <span class="me-2"><i class="bi bi-journal-text"></i></span> --}}
                            <span>Blog</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="homePageSettings">
                            {{-- <span class="me-2"><i class="bi bi-house"></i></span> --}}
                            <span>Home Page</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="shippingAPISettings">
                            {{-- <span class="me-2"><i class="bi bi-truck"></i></span> --}}
                            <span>Shipping API</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="sitemapSettings">
                            {{-- <span class="me-2"><i class="bi bi-diagram-2"></i></span> --}}
                            <span>Sitemap</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="captchaSettings">
                            {{-- <span class="me-2"><i class="bi bi-puzzle"></i></span> --}}
                            <span>Captcha</span>
                        </a>
                    </li>
                    <li class="pb-1">
                        <a class="nav-link px-3" data-content="menuTypeSettings">
                            {{-- <span class="me-2"><i class="bi bi-menu-up"></i></span> --}}
                            <span>Menu Type</span>
                        </a>
                    </li>
                </div>
                <li class="action-button mb-1">
                    <div class="form-group col-12">
                        <div class="col-12 p-1">
                            <button type="submit" class="btn col-12 btn-submit-settings">{{ $is_edit ? 'Update' : 'Save' }}</button>
                        </div>
                        <div class="col-12 p-1">
                            <button type="button" class="btn cancel col-12">Cancel</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-10 tab-content settings px-0 h-100 form-add-edit settings" id="formAddEdit" style="overflow-x: hidden" data-formtype="{{ $is_edit ? 'edit' : 'add' }}" data-id="{{ encrypt($id) }}">
            @include('admin.layout.forms.settings.general')
            @include('admin.layout.forms.settings.company-details')
            @include('admin.layout.forms.settings.email')
            @include('admin.layout.forms.settings.social')
            @include('admin.layout.forms.settings.sms')
            @include('admin.layout.forms.settings.blog')
            @include('admin.layout.forms.settings.homepage')
            @include('admin.layout.forms.settings.shipping-api')
            @include('admin.layout.forms.settings.sitemap')
            @include('admin.layout.forms.settings.captcha')
            @include('admin.layout.forms.settings.menu-type')
        </div>
    </div>
</div>


















{{-- <div class="container-fluid m-0 p-0 col-12 dialog-form">
    <div class="row m-0 p-0 h-100">
        <div class="col-2 p-0 m-0 h-100">
            <ul class="navbar-nav settings bg-main m-0 p-0 pb-2 h-100 position-relative">
                <li class="pb-1">
                    <a class="nav-link px-3 active" data-content="generalSettings">
                        <span class="me-2"><i class="bi bi-gear"></i></span>
                        <span>General</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="companyDetailsSettings">
                        <span class="me-2"><i class="bi bi-building"></i></span>
                        <span>Company Details</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="emailSettings">
                        <span class="me-2"><i class="bi bi-envelope"></i></span>
                        <span>Email</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="socialSettings">
                        <span class="me-2"><i class="bi bi-person-badge-fill"></i></span>
                        <span>Social</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="smsSettings">
                        <span class="me-2"><i class="bi bi-chat-text"></i></span>
                        <span>SMS</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="blogSettings">
                        <span class="me-2"><i class="bi bi-journal-text"></i></span>
                        <span>Blog</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="homePageSettings">
                        <span class="me-2"><i class="bi bi-house"></i></span>
                        <span>Home Page</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="shippingAPISettings">
                        <span class="me-2"><i class="bi bi-truck"></i></span>
                        <span>Shipping API</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="sitemapSettings">
                        <span class="me-2"><i class="bi bi-diagram-2"></i></span>
                        <span>Sitemap (XML)</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="captchaSettings">
                        <span class="me-2"><i class="bi bi-puzzle"></i></span>
                        <span>Captcha</span>
                    </a>
                 </li>
                 <li class="pb-1">
                    <a class="nav-link px-3" data-content="menuTypeSettings">
                        <span class="me-2"><i class="bi bi-menu-up"></i></span>
                        <span>Menu Type</span>
                    </a>
                 </li>
                 <li class="action-button mb-1">
                    <div class="form-group col-12">
                        <div class="col-12 p-1">
                            <button type="submit" class="btn col-12 btn-submit">{{ $is_edit ? 'Update' : 'Save' }}</button>
                        </div>
                        <div class="col-12 p-1">
                            <button type="button" class="btn cancel col-12">Cancel</button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="col-10 tab-content settings px-0 py-2 h-100" id="settingForms" data-id="{{ encrypt($setting_info->id)}}">
            @include('admin.layout.forms.settings.general')
            @include('admin.layout.forms.settings.company-details')
            @include('admin.layout.forms.settings.email')
            @include('admin.layout.forms.settings.social')
            @include('admin.layout.forms.settings.sms')
            @include('admin.layout.forms.settings.blog')
            @include('admin.layout.forms.settings.homepage')
            @include('admin.layout.forms.settings.shipping-api')
            @include('admin.layout.forms.settings.sitemap')
            @include('admin.layout.forms.settings.captcha')
            @include('admin.layout.forms.settings.menu-type')
        </div>
    </div>
</div> --}}