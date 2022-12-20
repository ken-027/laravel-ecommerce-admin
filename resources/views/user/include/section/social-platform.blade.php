{{-- <div id="siteSiderMenu"> --}}
<ul class="social-container">
    <li class="py-3">
        @if (is_valid_url($setting_info->fb_link, 'facebook'))
            <a target="_blank" href="{{$setting_info->fb_link}}"><i class="bi bi-facebook me-1"></i></a>
        @endif
    </li>
    <li class="py-3">
        @if (is_valid_url($setting_info->msg_link, 'messenger'))
            <a target="_blank" href="{{$setting_info->msg_link}}"><i class="bi bi-messenger me-1"></i></a>
        @endif
    </li>
    <li class="py-3">
        @if (is_valid_url($setting_info->twitter_link, 'twitter'))
            <a target="_blank" href="{{$setting_info->twitter_link}}"><i class="bi bi-twitter me-1"></i></a>
        @endif
    </li>
    <li class="py-3">
        @if (is_valid_url($setting_info->linkedin_link, 'linkedin'))
            <a target="_blank" href="{{$setting_info->linkedin_link}}"><i class="bi bi-linkedin me-1"></i></a>
        @endif
    </li>
    <li class="py-3">
        @if (is_valid_url($setting_info->instagram_link, 'instagram'))
            <a target="_blank" href="{{$setting_info->instagram_link}}"><i class="bi bi-instagram me-1"></i></a>
        @endif
    </li>
    <li class="py-3">
        @if (is_valid_url($setting_info->youtube_link, 'youtube'))
            <a target="_blank" href="{{$setting_info->youtube_link}}"><i class="bi bi-youtube me-1"></i></a>
        @endif
    </li>
</ul>

