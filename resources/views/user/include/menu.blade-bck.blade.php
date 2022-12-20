@php
    $setting_info = general_setting_info();
    $menus = App\Models\Admin\Menu::get_client_menu();
@endphp
<div class="container-fluid p-3 menu-container">
   <div class="row">
      <div class="col-2 logo-container">
         <a href="/"><img class="company-logo" src="{{  asset('storage/setting/'. base64_encode($setting_info->id) . '/logo/' . $setting_info->logo) }}" alt="{{ $setting_info->admin_panel_name }}"></a>
      </div>
      <div class="col-10 d-flex justify-content-center">
         <div class="col-xl-10 navigation">
            <ul class="d-flex justify-content-end align-items-center h-100">
               @foreach ($menus as $menu)
                  @if (!$menu->parent)
                     <li class="d-flex">
                        <a {{ $menu->have_sub_menu ? 'role=button data-bs-toggle=dropdown aria-expanded=false' : "href=$menu->url" }} href="{{ $menu->url }}" target="{{ $menu->is_open_new_window ? '_blank' : '' }}" >{{ capitalize_word($menu->menu_name) }}
                           @if ($menu->have_sub_menu)
                              <i class="bi bi-chevron-compact-down ms-1"></i>
                           @endif
                        </a>
                        @if ($menu->have_sub_menu)
                           <ul class="dropdown-menu">
                              @foreach (App\Models\Admin\Menu::get_sub_menu($menu->id) as $sub_menu)
                                 <li class="">
                                    <a href="{{ $sub_menu->url }}" class="submenu-link">{{ capitalize_word($sub_menu->menu_name) }}</a>
                                 </li>
                              @endforeach
                           </ul>
                        @endif
                     </li>                              
                  @endif
               @endforeach
            </ul>
         </div>
         <div class="col-xl-2 justify-content-end">
            <ul class="d-flex justify-content-end align-items-center h-100 menu-action">
               <li class="pe-2">
                  <a href="/order/cart" class="cart"><span class="me-2"><i class="bi bi-bag-heart-fill cart-icon"></i><span class="count-cart">0</span></span></a>
               </li>
               <li>
                  <a href="/account" class="btn login">Login</a>
               </li>
               {{-- <a href="/account" class="login">Account</a>  --}}
            </ul>
         </div>
      </div>
   </div>
</div>