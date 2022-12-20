<footer class="home">
    <div id="bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-xl-3">
                    <div class="block customer-service head clearfix">
                        <div class="h3">PHONE</div>
                        <a href="tel:{{$setting_info->phone}}" class="phn-number">{{$setting_info->phone}}</a>
                        {{-- <a href="support" class="support-fa pt-5">SUPPORT &amp; FAQ</a>
                        <a href="privacy-policy" class="support-fa pt-1">PRIVACY POLICY</a>
                        <a href="terms-and-conditions" class="support-fa pt-1">TERMS OF SERVICE</a> --}}
                    </div>
                </div>
                <div class="col-md-2 col-lg-3 col-xl-3">
                    <div class="block customer-service">
                        <div class="h3 border-line">EXTRAS</div>
                        <ul>
                            @foreach (App\Models\Admin\Menu::get_client_menu() as $menu)
                                @if (!$menu->parent)
                                    <li>
                                        <a href="{{$menu->url}}" class="support-fa" target="{{$menu->is_open_new_window ? '_blank' : '' }}">{{capitalize_word($menu->menu_name)}}</a>
                                    </li>
                                @endif
                            @endforeach
                            {{-- <li>
                                <a href="reviews" class="support-fa">REVIEWS</a>
                            </li>
                            <li>
                                <a href="order-track" class="support-fa">TRACK</a>
                            </li>
                            <li>
                                <a href="bulk-sales" class="support-fa">BULK SALES</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-xl-3">
                    <div class="block customer-service">
                        <div class="h3 border-line">CONNECT</div>
                        <ul>
                            <li>
                                @if (is_valid_url($setting_info->fb_link, 'facebook'))
                                    {{-- <a href="https://twitter.com/" class="support-fa"><i class="fab fa-twitter"></i>TWITTER</a> --}}
                                    <a href="{{$setting_info->fb_link}}" class="support-fa"><i class="bi bi-facebook"></i>FACEBOOK</a>
                                @endif
                            </li>
                            <li>
                                @if (is_valid_url($setting_info->msg_link, 'messenger'))
                                    {{-- <a href="https://twitter.com/" class="support-fa"><i class="fab fa-twitter"></i>TWITTER</a> --}}
                                    <a href="{{$setting_info->msg_link}}" class="support-fa"><i class="bi bi-messenger"></i>MESSENGER</a>
                                @endif
                            </li>
                            <li>
                                @if (is_valid_url($setting_info->twitter_link, 'twitter'))
                                    {{-- <a href="https://twitter.com/" class="support-fa"><i class="fab fa-twitter"></i>TWITTER</a> --}}
                                    <a href="{{$setting_info->twitter_link}}" class="support-fa"><i class="bi bi-twitter"></i>TWITTER</a>
                                @endif
                            </li>
                            <li>
                                @if (is_valid_url($setting_info->linkedin_link, 'linkedin'))
                                    {{-- <a href="https://twitter.com/" class="support-fa"><i class="fab fa-twitter"></i>TWITTER</a> --}}
                                    <a href="{{$setting_info->linkedin_link}}" class="support-fa"><i class="bi bi-linkedin"></i>LINKEDIN</a>
                                @endif
                            </li>
                            <li>
                                @if (is_valid_url($setting_info->instagram_link, 'instagram'))
                                    {{-- <a href="https://twitter.com/" class="support-fa"><i class="fab fa-twitter"></i>TWITTER</a> --}}
                                    <a href="{{$setting_info->instagram_link}}" class="support-fa"><i class="bi bi-instagram"></i>INSTAGRAM</a>
                                @endif
                            </li>
                            <li>
                                @if (is_valid_url($setting_info->youtube_link, 'youtube'))
                                    {{-- <a href="https://twitter.com/" class="support-fa"><i class="fab fa-twitter"></i>TWITTER</a> --}}
                                    <a href="{{$setting_info->youtube_link}}" class="support-fa"><i class="bi bi-youtube"></i>YOUTUBE</a>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3">
                    <div class="block content-text mb-0 clearfix">
                        <img src="images/xlogo.png.pagespeed.ic.csIb0z78Su.png" alt="" />
                        <form method="post" action="controllers/newsletter.php" id="f_newsletter_form">
                            <legend>SUBSCRIBE</legend>
                            <p>Sign up to receive tips, news and offers</p>
                            <div class="form-wrap">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="f_newsletter_email" id="f_newsletter_email" placeholder="name@example.com" autocomplete="off" />
                                    <small id="f_newsletter_email_error_msg" class="help-block m_validations_showhide hide" style="">Please enter email address</small>
                                </div>
                                <input type="hidden" name="newsletter" />
                                <button type="button" class="btn btn-primary f_newsletter_btn"><i class="far fa-envelope"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="copyright">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="block copyright">{{$setting_info->copyright}}</div>
                    {{-- <div class="block copyright">©2022 MacMetro. All rights reserved.</div> --}}
                </div>
            </div>
        </div>
    </div>
</footer>
