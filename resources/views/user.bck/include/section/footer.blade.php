@php 
    $setting_info = !empty($setting_info) ? $setting_info : general_setting_info(); 
    $menus = !empty($menus) ? $menus : App\Models\Admin\Menu::get_client_menu();
@endphp
<div class="footer section px-4">
    <div class="item">
        <h4 class="title-bold">Phone</h4>
        <p>{{ $setting_info->phone }}</p>
    </div>
    <div class="item">
        <h4 class="title-bold">Extras</h4>
        <ul class="extras">
            @foreach ($menus as $menu)
                @if (!$menu->have_sub_menu && !$menu->parent)
                    <li><a href="{{ $menu->url }}" target="{{ $menu->is_open_new_window ? '_blank' : '' }}">{{ capitalize_word($menu->menu_name) }}</a></li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="item">
        <h4 class="title-bold">Connect</h4>
        <ul class="connect">
            @if (is_valid_url($setting_info->fb_link, 'facebook'))
                <li>
                    <a href="{{ $setting_info->fb_link }}" target="_blank"><i class="bi bi-facebook"></i>Facebook</a>
                </li>
            @endif
            @if (is_valid_url($setting_info->twitter_link, 'twitter'))
                <li>
                    <a href="{{ $setting_info->twitter_link }}" target="_blank"><i class="bi bi-twitter"></i>Twitter</a>
                </li>
            @endif
            @if (is_valid_url($setting_info->linkedin_link, 'linkedin'))
                <li>
                    <a href="{{ $setting_info->linkedin_link }}" target="_blank"><i class="bi bi-linkedin"></i>LinkedIn</a>
                </li>
            @endif
            @if (is_valid_url($setting_info->instagram_link, 'instagram'))
                <li>
                    <a href="{{ $setting_info->instagram_link }}" target="_blank"><i class="bi bi-instagram"></i>Instagram</a>
                </li>
            @endif
            @if (is_valid_url($setting_info->youtube_link, 'youtube'))
                <li>
                    <a href="{{ $setting_info->youtube_link }}" target="_blank"><i class="bi bi-youtube"></i>Youtube</a>
                </li>
            @endif
            @if (is_valid_url($setting_info->msg_link, 'messenger'))
                <li>
                    <a href="{{ $setting_info->msg_link }}" target="_blank"><i class="bi bi-messenger"></i>Messenger</a>
                </li>
            @endif
        </ul>
    </div>
    <div class="item">
        <div class="mobile">
            <div class="screen">
                <img class="logo" src="{{ asset('storage/setting/'.base64_encode($setting_info->id).'/logo/'.$setting_info->logo) }}" alt="{{$setting_info->admin_panel_name}}">
                <h5 class="c-green">Subscribe</h5>
                <p>Sign up to receive tips, news and offers</p>
                <small class="error"></small>                
                <input type="email" class="form-control form-control-md" placeholder="name@example.com">
            </div>
            <div class="home" id="sendEmail" title="send email"><i class="bi bi-send"></i></div>
        </div>
    </div>
</div>
<div class="copyright">{{ $setting_info->copyright }}</div>