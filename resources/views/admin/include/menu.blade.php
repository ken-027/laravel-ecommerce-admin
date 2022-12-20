<meta name="token" value='{{ csrf_token() }}'>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
       <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
          >
       <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
       </button>
       <a class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold" href="/" target="_blank">
           <img src="{{  asset('storage/setting/'. base64_encode(decrypt(request()->session()->get('settings')->id)) . '/logo/' . request()->session()->get('settings')->logo) }}" class="logo" alt="">
        </a>
       <button 
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
          >
       <span class="navbar-toggler-icon"></span>
       </button>
       <div class="collapse navbar-collapse" id="topNavBar">
          {{-- <form class="d-flex ms-auto my-3 my-lg-0">
             <div class="input-group">
                <input
                   class="form-control"
                   type="search"
                   placeholder="Search"
                   aria-label="Search"
                   />
                <button class="btn btn-primary" type="submit">
                  <i class="bi bi-search"></i>
                </button>
             </div>
          </form> --}}
          <div class="ms-auto justify-content-center">
            <div class="col-md-6 col-lg-12">
                <div class="input-group input-group-sm position-relative">
                    <input type="search" id="searchLink" class="form-control form-control-sm" placeholder="Search Pages">
                    <div class="input-group-append">
                        <button 
                           class="btn btn-prepend btn-search-link"
                           {{-- href="#" --}}
                           role="button"
                           data-bs-toggle="dropdown"
                           aria-expanded="false">
                            <i class="bi bi-search"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-end custom-dropdown pagelink-container">
                           {{-- @foreach (admin_page_links() as $key => $page) --}}
                              <div class="item px-2 d-flex border-separator"><a class="open-link dropdown-item" href=""></a></div>
                           {{-- @endforeach --}}
                        </div>
                    </div>
                </div>
            </div>
         </div>
          <ul class="navbar-nav">
            @php $unread_messages = unread_messages() @endphp
            <li class="nav-item dropdown">
               <a 
                  class="nav-link ms-2 email-notif"
                  href="#"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  >
                 <i class="bi bi-envelope"></i><span class="badge custom-badge count-message {{ count($unread_messages) ? 'new-message' : '' }}">{{ count($unread_messages) }}</span>
               </a>
               <ul class="dropdown-menu dropdown-menu-end message-container">
                  @if (!count($unread_messages))
                     <li><a class="dropdown-item text-center">no message</a></li>
                  @else
                     @foreach ($unread_messages as $message)
                        <li class="d-flex border-separator"><a class="dropdown-item open-link view-message inbox" data-toggle="tooltip" data-placement="bottom" title="{{ $message->subject }}" data-title="Message" data-id="{{ encrypt($message->id) }}">{{ substr($message->subject, 0, 35) }}...</a></li>
                     @endforeach
                  @endif
               </ul>
            </li>
             <li class="nav-item dropdown">
                <a 
                   class="nav-link dropdown-toggle ms-2"
                   href="#"
                   role="button"
                   data-bs-toggle="dropdown"
                   aria-expanded="false"
                   >
                  <i class="bi bi-person-fill"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                   <li><a class="dropdown-item" id="showProfileBtn">Profile</a></li>
                     {{-- @if(authAdmin()->type == "mini-admin") --}}
                        <li><a class="dropdown-item" id="settingsBtn" data-id="{{ request()->session()->get('settings')->id }}">Settings</a></li>
                     {{-- @endif --}}
                   <li><a class="dropdown-item" href="/admin/profile/logout">Logout</a></li>
                </ul>
             </li>
          </ul>
       </div>
    </div>
 </nav>
<!-- @if (app()->environment() == 'local')
   <div class="clear-cache"><a href="/update-app" target="_blank"><i class="bi bi-trash"></i></a></div>
@endif -->