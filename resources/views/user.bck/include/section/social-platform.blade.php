@php
    $setting_info = !empty($setting_info) ? $setting_info : general_setting_info();
@endphp
<div class="social-container">
    @if (is_valid_url($setting_info->fb_link, 'facebook'))
        <div class="py-3">
            <a href="{{$setting_info->fb_link}}" class="" title="facebook" target="_blank">
                <i class="social-icon bi bi-facebook"></i>
            </a>
        </div>
    @endif
    @if (is_valid_url($setting_info->twitter_link, 'twitter'))
        <div class="py-3">
            <a href="{{$setting_info->twitter_link}}" class="" title="twitter" target="_blank">
                <i class="social-icon bi bi-twitter"></i>
            </a>
        </div>
    @endif
    @if (is_valid_url($setting_info->linkedin_link, 'linkedin'))
        <div class="py-3">
            <a href="{{$setting_info->linkedin_link}}" class="" title="linkin" target="_blank">
                <i class="social-icon bi bi-linkedin"></i>
            </a>
        </div>
    @endif
    @if (is_valid_url($setting_info->instagram_link, 'instagram'))
        <div class="py-3">
            <a href="{{$setting_info->instagram_link}}" class="" title="instagram" target="_blank">
                <i class="social-icon bi bi-instagram"></i>
            </a>
        </div>
    @endif
    @if (is_valid_url($setting_info->youtube_link, 'youtube'))
        <div class="py-3">
            <a href="{{$setting_info->youtube_link}}" class="" title="youtube" target="_blank">
                <i class="social-icon bi bi-youtube"></i>
            </a>
        </div>
    @endif
    @if (is_valid_url($setting_info->msg_link, 'messenger'))
        <div class="py-3">
            <a href="{{$setting_info->msg_link}}" class="" title="messenger" target="_blank">
                <i class="social-icon bi bi-messenger"></i>
            </a>
        </div>
    @endif
    <div class="py-3 info-how">
        <a role="button" title="how to sell" data-bs-toggle="modal" data-bs-target="#howToSell">
            <i class="social-icon bi bi-info-circle"></i>
        </a>
    </div>
</div>
@include('user.include.modal.how-to-sell')