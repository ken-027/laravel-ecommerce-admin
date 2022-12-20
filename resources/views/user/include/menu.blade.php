<div id="top">
    <div class="container menu-container">
        <div class="row">
            <div class="col-6 col-sm-3 col-md-4 col-lg-3 col-xl-3 mobile-logo">
                <div class="block logo pr-0 pt-0 mr-0 pb-0 clearfix">
                    <a href="/"><img src="{{  asset('storage/setting/'. base64_encode($setting_info->id) . '/logo/' . $setting_info->logo) }}" alt="{{ $setting_info->admin_panel_name }}" alt="MacMetro.com" /></a>
                </div>
            </div>
            <div class="col-3 col-sm-6 col-md-4 col-lg-6 col-xl-6 mobile-nav">
                <div class="block main-menu clearfix">
                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                            <img src="images/nav-bar.png" alt="" />
                        </button>
                        <div class="collapse navbar-collapse" id="navbarMain">
                            <ul>
                                @foreach (App\Models\Admin\Menu::get_client_menu() as $menu)
                                    @if (!$menu->parent)
                                        <li class="{{ $menu->have_sub_menu ? 'dropdown' : '' }}">
                                            <a href="{{ $menu->have_sub_menu ? '' : $menu->url }}" target="{{ $menu->is_open_new_window ? '_blank' : '' }}" class="" {{$menu->have_sub_menu ? 'data-bs-toggle=dropdown role=button aria-haspopup=true aria-expanded=false' : ''}}>
                                                {{ capitalize_word($menu->menu_name) }}
                                                @if ($menu->have_sub_menu)
                                                    {{-- <i class="bi bi-chevron-compact-down ms-1"></i> --}}
                                                @endif
                                                @if ($menu->have_sub_menu) <i class="bi bi-chevron-compact-down ms-1"></i> @endif
                                            </a>
                                            <div class="clearfix"></div>
                                            @if ($menu->have_sub_menu)
                                                <ul class="dropdown-menu">
                                                    @foreach (App\Models\Admin\Menu::get_sub_menu($menu->id) as $sub_menu)
                                                        <li>
                                                            <a href="{{$sub_menu->url}}" class=""><span class="{{$sub_menu->css_menu_fa_icon}}"></span>{{capitalize_word($sub_menu->menu_name)}}</a>
                                                        </li>    
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endif
                                @endforeach
                                <li class="mobile-menu">
                                    <a href="login" class="login">Login</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-3 col-sm-3 col-md-4 col-lg-3 col-xl-3 mobile-site-menu">
                <div class="block site-menu clearfix">
                    <ul>
                        <li>
                            <a href="/order/review" class="cart"><img src="/images/icons/cart.png" alt="cart">Cart<span>0</span></a>
                        </li>
                        <li>
                            <a href="/account" class="login">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
