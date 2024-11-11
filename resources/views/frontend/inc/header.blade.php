<section class="header">
    <input type="hidden" name="_token" id="table_csrf_token" value="{!! csrf_token() !!}">
    
    <section class="top-header">
        <?php
        $mobile = SM::get_setting_value('mobile');
        $email = SM::get_setting_value('email');
        $address = SM::get_setting_value('address');
        $country = SM::get_setting_value('country');
        if (Auth::check()) {
            $blogAuthor = Auth::user();
            $fname = $blogAuthor->firstname . ' ' . $blogAuthor->lastname;
            $fname = trim($fname) != '' ? $fname : $blogAuthor->username;
        } else {
            $fname = 'My Account';
            $logonMoadal = 'data-toggle="modal" data-target="#loginModal"';
        }
        ?>
        <div class="bg-opacity">
            <div class="container-fluid">
                <!--<div class="top-bar-social top-hotline">-->
                <!--    <a href="tel:{{ $mobile }}"><img style="height: 25px;" src="/storage/uploads/support.png">-->
                <!--        {{ $mobile }} </a>-->
                <!--</div>-->
                <!--<div class="top-bar-social">-->
                <!--    @empty(!SM::smGetThemeOption('social_facebook'))-->
                <!--        <a target="_blank" href="{{ SM::smGetThemeOption('social_facebook') }}">-->
                <!--            <img style="height: 25px;" src="/storage/uploads/icon-for-zenvo_web-01.png">-->
                <!--        </a>-->
                <!--    @endempty-->
                <!--    @empty(!SM::smGetThemeOption('social_twitter'))-->
                <!--        <a href="{{ SM::smGetThemeOption('social_twitter') }}">-->
                <!--            <i class="fa fa-twitter"></i>-->
                <!--        </a>-->
                <!--    @endempty-->
                <!--    @empty(!SM::smGetThemeOption('social_google_plus'))-->
                <!--        <a target="_blank" href="{{ SM::smGetThemeOption('social_google_plus') }}">-->
                <!--            <i class="fa fa-google-plus"></i>-->
                <!--        </a>-->
                <!--    @endempty-->
                <!--    @empty(!SM::smGetThemeOption('social_linkedin'))-->
                <!--        <a target="_blank" href="{{ SM::smGetThemeOption('social_linkedin') }}">-->
                <!--            <i class="fa fa-linkedin"></i>-->
                <!--        </a>-->
                <!--    @endempty-->
                <!--    @empty(!SM::smGetThemeOption('social_github'))-->
                <!--        <a href="{{ SM::smGetThemeOption('social_github') }}">-->
                <!--            <i class="fa fa-github"></i>-->
                <!--        </a>-->
                <!--    @endempty-->
                <!--    @empty(!SM::smGetThemeOption('social_pinterest'))-->
                <!--        <a href="{{ SM::smGetThemeOption('social_pinterest') }}">-->
                <!--            <i class="fa fa-pinterest-p"> </i>-->
                <!--        </a>-->
                <!--    @endempty-->
                <!--    @empty(!SM::smGetThemeOption('social_youtube'))-->
                <!--        <a target="_blank" href="{{ SM::smGetThemeOption('social_youtube') }}">-->
                <!--            <img style="height: 25px;" src="/storage/uploads/icon-for-zenvo_web-02.png">-->
                <!--        </a>-->
                <!--    @endempty-->
                <!--    @empty(!SM::smGetThemeOption('social_instagram'))-->
                <!--        <a target="_blank" href="{{ SM::smGetThemeOption('social_instagram') }}">-->
                <!--            <img style="height: 25px;" src="/storage/uploads/icon-for-zenvo_web-03.png">-->
                <!--        </a>-->
                <!--    @endempty-->
                <!--</div>-->
                <!--<div class="support-link">-->
                <!--    <a href="{{ url('/about') }}">About Us</a>-->
                <!--</div>-->
            </div>
        </div>
    </section>
    <div class="bg-opacity">
        <div class="container-fluid">
            <!--/.top-header -->
            <!-- MAIN HEADER -->
            <div class="main-header">
                    <div class='contact-link'>
                        <a href="{{ url('/contact') }}" class='contactUs'><i class="fa fa-envelope-o" aria-hidden="true"></i> Contact Us</a>
                        <a href="{{ url('/contact') }}" class='contactUs'> Download app 
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g id="iOS-icon">
                                <g id="Apple logo">
                                <path d="M15.8784 11.9482C15.8914 10.9396 16.433 9.98526 17.2923 9.45698C16.7502 8.68279 15.8423 8.19193 14.8976 8.16237C13.8901 8.05662 12.9133 8.76527 12.3999 8.76527C11.8765 8.76527 11.086 8.17287 10.2348 8.19039C9.12524 8.22623 8.09086 8.85706 7.55104 9.82711C6.39064 11.8362 7.25619 14.7888 8.36776 16.4128C8.9239 17.208 9.57386 18.0962 10.4243 18.0647C11.2566 18.0302 11.5674 17.534 12.572 17.534C13.5672 17.534 13.8588 18.0647 14.7266 18.0447C15.6196 18.0302 16.1823 17.246 16.7189 16.4432C17.1185 15.8766 17.4259 15.2504 17.6299 14.5877C16.5805 14.1438 15.8796 13.0877 15.8784 11.9482Z" fill="#707070"/>
                                <path d="M14.2394 7.09437C14.7263 6.50985 14.9662 5.75854 14.9081 5C14.1642 5.07813 13.477 5.43367 12.9836 5.99577C12.501 6.54496 12.2498 7.28305 12.2973 8.0126C13.0415 8.02026 13.7731 7.67436 14.2394 7.09437Z" fill="#707070"/>
                                </g>
                                <rect id="Rectangle 27" x="0.5" y="0.5" width="23" height="23" rx="1.5" stroke="#EAEAEA"/>
                                </g>
                            </svg> 
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.5" y="0.5" width="23" height="23" rx="1.5" stroke="#EAEAEA"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M14.4579 8.35285L7.62408 4.38968C7.35939 4.23114 7.05047 4.13965 6.7199 4.13965C6.10946 4.13965 5.5649 4.47065 5.25104 4.9543L5.34149 5.04473L11.5541 11.256L14.4579 8.35285ZM4.96973 6.08711V17.8392L10.847 11.9631L4.96973 6.08711ZM5.25106 18.972C5.56495 19.4557 6.10958 19.7867 6.7199 19.7867C7.04336 19.7867 7.34704 19.6992 7.60747 19.5457L7.62816 19.5336L14.4696 15.585L11.5541 12.6701L5.3415 18.8816L5.25106 18.972ZM15.3664 15.0674L18.0482 13.5196C18.5971 13.2233 18.9697 12.6446 18.9697 11.9773C18.9697 11.3148 18.6021 10.739 18.0587 10.4417L18.0525 10.4375L15.353 8.87196L12.2613 11.9631L15.3664 15.0674Z" fill="#707070"/>
                            </svg>
                        </a>
                    </div>
                    <div class="logo">
                        <a href="{{ url('/') }}">
                            <img class="logo-brand" alt="{{ SM::get_setting_value('site_name') }}"
                                src="{{ SM::sm_get_the_src(SM::sm_get_site_logo(), 171, 45) }}" />
                        </a>
                    </div>
                    <div class="col-xs-4 col-sm-6 col-12 header-search-box">
                        <div class="input-group category-search">
                            <input type="hidden" name="search_param" value="all" id="search_param">
                            <input type="text" class="form-control" id="search_text" name="search_text"
                                placeholder="Search All Products..">
                            <span class="input-group-btn">
                                <button class="btn btn-default custom-btn" type="button"><span
                                        class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </div>
                    
                    <div id="user-info-top" class="user-info pull-right">
                        <div class="dropdown ">
                            <a class="current-open" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                href="{{ '/dashboard' }}"><span>
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.08014 8.51999C8.03348 8.51332 7.97348 8.51332 7.92014 8.51999C6.74681 8.47999 5.81348 7.51999 5.81348 6.33999C5.81348 5.13332 6.78681 4.15332 8.00014 4.15332C9.20681 4.15332 10.1868 5.13332 10.1868 6.33999C10.1801 7.51999 9.25348 8.47999 8.08014 8.51999Z" stroke="#707070" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12.4935 12.92C11.3068 14.0067 9.7335 14.6667 8.00017 14.6667C6.26684 14.6667 4.6935 14.0067 3.50684 12.92C3.5735 12.2934 3.9735 11.68 4.68684 11.2C6.5135 9.98671 9.50017 9.98671 11.3135 11.2C12.0268 11.68 12.4268 12.2934 12.4935 12.92Z" stroke="#707070" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.99967 14.6668C11.6816 14.6668 14.6663 11.6821 14.6663 8.00016C14.6663 4.31826 11.6816 1.3335 7.99967 1.3335C4.31778 1.3335 1.33301 4.31826 1.33301 8.00016C1.33301 11.6821 4.31778 14.6668 7.99967 14.6668Z" stroke="#707070" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
{{ $fname ? $fname : "User Profile "}}</span></a>
                            <ul class="dropdown-menu mega_dropdown" role="menu">
                                @if (Auth::check())
                                    <li><a href="{{ '/dashboard' }}">Profile</a></li>
                                    <li><a href="{{ url('/dashboard/wishlist') }}">Wishlists</a></li>
                                    <li><a href="{{ '/logout' }}">Logout</a></li>
                                @else
                                    <li><a href="{{ '/login' }}">Login</a></li>
                                    {{-- <li class="my-accounts"><a href="#" data-toggle="modal"
                                            data-target="#loginModal">Login</a></li>
                                    <li class="my-accounts"><a href="#" data-toggle="modal"
                                            data-target="#loginModal">Register</a></li> --}}
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="Language">
                        <!--<select class="form-select" aria-label="Default select example">-->
                        <!--  <option value="1">BD</option>-->
                        <!--  <option value="2">Int</option>-->
                        <!--</select>-->
                    </div>
                </div>
        </div>
    </div>
    @include('frontend.common.mainnav')
</section>

