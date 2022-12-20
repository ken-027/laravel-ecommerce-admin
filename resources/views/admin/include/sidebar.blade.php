<div class="offcanvas offcanvas-start sidebar-nav bg-dark " tabindex="-1" id="sidebar">
   <div class="offcanvas-body p-0">
      <nav class="navbar-dark nav-pad-50">
         <ul class="navbar-nav">
            <li>
               <div class="text-muted small fw-bold px-4 company-title">
                  <span class="">MacMetro Dashboard</span>
               </div>
            </li>
            <li>
               <a href="/admin/dashboard" class="nav-link px-3 {{ !request()->routeIs('admin-dashboard')? : 'active' }}">
                    <span class="me-2"><i class="bi bi-house-fill"></i></span>
                    <span>Dashboard</span>
               </a>
            </li>
                <li class="m">
                    <hr class="dropdown-divider bg-light" />
                </li>
            </li>
            <li>
                <div class="text-muted small fw-bold  px-3">
                  Menu
                </div>
            </li>
            <li>
                <a href="/admin/categories" class="nav-link px-3 {{ !request()->routeIs('admin-category')? : 'active' }}">
                    <span class="me-2"><i class="bi bi-columns-gap"></i></span>
                    <span>Categories</span>
                </a>
             </li>
             <li>
                <a href="/admin/brand" class="nav-link px-3 {{ !request()->routeIs('admin-brand')? : 'active' }}">
                    <span class="me-2"><i class="bi bi-card-list"></i></span>
                    <span>Brand</span>
                </a>
             </li>
             <li>
                <a href="/admin/devices" class="nav-link px-3 {{ !request()->routeIs('admin-device')? : 'active' }}">
                    <span class="me-2"><i class="bi bi-tablet-landscape"></i></span>
                    <span>Devices</span>
                </a>
             </li>
             <li>
                <a href="/admin/models" class="nav-link px-3  {{ !request()->routeIs('admin-model')? : 'active' }}">
                    <span class="me-2"><i class="bi bi-phone"></i></span>
                    <span>Models</span>
                </a>
             </li>
            <li>
               <a class="nav-link px-3 sidebar-link {{ !strstr(url()->current(), '/orders/')? : 'active' }}" data-bs-toggle="collapse" href="#sub-orders">
                    <span class="me-2"><i class="bi bi-layout-split"></i></span>
                    <span>Orders</span>
                    <span class="ms-auto">
                        <span class="right-icon">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </span>
               </a>
               <div class="collapse {{ !strstr(url()->current(), '/orders/')? : 'show' }}" id="sub-orders">
                  <ul class="navbar-nav ps-3">
                     <li>
                        <a href="/admin/orders/awaiting" class="nav-link px-3 {{ !request()->routeIs('awaiting-orders')? : 'active' }}">
                        <span class="me-2">
                            <i class="bi bi-hourglass-bottom"></i>
                        </span>
                        <span>Awaiting Orders</span>
                        </a>
                     </li>
                     <li>
                        <a href="/admin/orders/unpaid" class="nav-link px-3 {{ !request()->routeIs('unpaid-orders')? : 'active' }}">
                        <span class="me-2">
                            <i class="bi bi-credit-card"></i>
                        </span>
                        <span>Unpaid Orders</span>
                        </a>
                     </li>
                     <li>
                        <a href="/admin/orders/paid" class="nav-link px-3 {{ !request()->routeIs('paid-orders')? : 'active' }}">
                        <span class="me-2">
                            <i class="bi bi-cash-stack"></i>
                        </span>
                        <span>Paid Orders</span>
                        </a>
                     </li>
                     <li>
                        <a href="/admin/orders/archive" class="nav-link px-3 {{ !request()->routeIs('archive-orders')? : 'active' }}">
                        <span class="me-2">
                            <i class="bi bi-archive"></i>
                        </span>
                        <span>Archive Orders</span>
                        </a>
                     </li>
                  </ul>
               </div>
            </li>
            <li>
                <a href="/admin/customers" class="nav-link px-3 {{ !request()->routeIs('admin-customer')? : 'active' }}">
                    <span class="me-2"><i class="bi bi-people-fill"></i></span>
                    <span>Customers</span>
                </a>
            </li>
            <li>
                <a class="nav-link px-3 sidebar-link {{ !strstr(url()->current(), '/forms/')? : 'active' }}" data-bs-toggle="collapse" href="#sub-forms">
                     <span class="me-2"><i class="bi bi-stickies"></i></span>
                     <span>Forms</span>
                     <span class="ms-auto">
                         <span class="right-icon">
                             <i class="bi bi-chevron-down"></i>
                         </span>
                     </span>
                </a>
                <div class="collapse {{ !strstr(url()->current(), '/forms/')? : 'show' }}" id="sub-forms">
                   <ul class="navbar-nav ps-3">
                      <li>
                        <a href="/admin/forms/contacts" class="nav-link px-3 {{ !request()->routeIs('contacts-forms')? : 'active' }}">
                            <span class="me-2">
                            <i class="bi bi-person-lines-fill"></i>
                            </span>
                            <span>Contacts</span>
                        </a>
                      </li>
                      <li>
                        <a href="/admin/forms/reviews" class="nav-link px-3 {{ !request()->routeIs('reviews-forms')? : 'active' }}">
                        <span class="me-2">
                            <i class="bi bi-star-half"></i>
                        </span>
                        <span>Reviews</span>
                        </a>
                      </li>
                      <li>
                        <a href="/admin/forms/bulk-orders" class="nav-link px-3 {{ !request()->routeIs('bulkord-forms')? : 'active' }}">
                        <span class="me-2">
                            <i class="bi bi-layout-split"></i>
                        </span>
                        <span>Bulk Orders</span>
                        </a>
                      </li>
                      <li>
                        <a href="/admin/forms/newsletter" class="nav-link px-3 {{ !request()->routeIs('newsletter-forms')? : 'active' }}">
                            <span class="me-2">
                                <i class="bi bi-newspaper"></i>
                            </span>
                            <span>Newsletter</span>
                        </a>
                      </li>
                   </ul>
                </div>
            </li>
            <li>
                <a class="nav-link px-3 sidebar-link {{ !(request()->routeIs('admin-blogs') || request()->routeIs('admin-blogs-categories'))? : 'active' }}" data-bs-toggle="collapse" href="#sub-blogs">
                     <span class="me-2"><i class="bi bi-journal-text"></i></span>
                     <span>Blogs</span>
                     <span class="ms-auto">
                         <span class="right-icon">
                             <i class="bi bi-chevron-down"></i>
                         </span>
                     </span>
                </a>
                <div class="collapse {{ !(request()->routeIs('admin-blogs') || request()->routeIs('admin-blogs-categories'))? : 'show' }}" id="sub-blogs">
                   <ul class="navbar-nav ps-3">
                      <li>
                         <a href="/admin/blogs" class="nav-link px-3 {{ !request()->routeIs('admin-blogs')? : 'active' }}">
                         <span class="me-2">
                             <i class="bi bi-journal-text"></i>
                         </span>
                         <span>Blog</span>
                         </a>
                      </li>
                      <li>
                         <a href="/admin/blogs/categories" class="nav-link px-3 {{ !request()->routeIs('admin-blogs-categories')? : 'active' }}">
                         <span class="me-2">
                             <i class="bi bi-columns-gap"></i>
                         </span>
                         <span>Blog Categories</span>
                         </a>
                      </li>
                   </ul>
                </div>
             </li>
            <li>
                <a href="/admin/pages" class="nav-link px-3 {{ !request()->routeIs('admin-page')? : 'active' }}">
                    <span class="me-2"><i class="bi bi-file-earmark-break"></i></span>
                    <span>Pages</span>
                </a>
            </li>
            <li>
                <a href="/admin/menus" class="nav-link px-3 {{ !request()->routeIs('admin-menu')? : 'active' }}">
                    <span class="me-2"><i class="bi bi-list"></i></span>
                    <span>Menus</span>
                </a>
            </li>
            @if (authAdmin()->type == 'super_admin' || authAdmin()->type == 'admin' )
                <li>              
                    <a class="nav-link px-3 sidebar-link {{ !strstr(url()->current(), '/staffs')? : 'active' }}" data-bs-toggle="collapse" href="#sub-staffs">
                        <span class="me-2"><i class="bi bi-person-circle"></i></span>
                        <span>Staffs</span>
                        <span class="ms-auto">
                            <span class="right-icon">
                                <i class="bi bi-chevron-down"></i>
                            </span>
                        </span>
                    </a>
                    <div class="collapse {{ !strstr(url()->current(), '/staffs')? : 'show' }}" id="sub-staffs">
                    <ul class="navbar-nav ps-3">
                        <li>
                            <a href="/admin/staffs" class="nav-link px-3 {{ !request()->routeIs('admin-staffs')? : 'active' }}">
                                <span class="me-2">
                                    <i class="bi bi-person-circle"></i>
                                </span>
                                <span>Staffs</span>
                            </a>
                        </li>
                        <li>
                            <a href="/admin/staffs/group" class="nav-link px-3 {{ !request()->routeIs('admin-staffsgroup')? : 'active' }}">
                                <span class="me-2">
                                    <i class="bi bi-collection"></i>
                                </span>
                            <span>Staff Groups</span>
                            </a>
                        </li>
                    </ul>
                    </div>
                </li>
            @endif            
            <li>
                <a class="nav-link px-3 sidebar-link {{ !strstr(url()->current(), '/faqs')? : 'active' }}" data-bs-toggle="collapse" href="#sub-faqs">
                     <span class="me-2"><i class="bi bi-info-square"></i></span>
                     <span>Faqs</span>
                     <span class="ms-auto">
                         <span class="right-icon">
                             <i class="bi bi-chevron-down"></i>
                         </span>
                     </span>
                </a>
                <div class="collapse {{ !strstr(url()->current(), '/faqs')? : 'show' }}" id="sub-faqs">
                   <ul class="navbar-nav ps-3">
                      <li>
                        <a href="/admin/faqs" class="nav-link px-3 {{ !request()->routeIs('admin-faqs')? : 'active' }}">
                            <span class="me-2">
                                <i class="bi bi-info-square"></i>
                            </span>
                            <span>Faqs</span>
                        </a>
                      </li>
                      <li>
                        <a href="/admin/faqs/group" class="nav-link px-3 {{ !request()->routeIs('admin-faqsgroup')? : 'active' }}">
                            <span class="me-2">
                                <i class="bi bi-collection"></i>
                            </span>
                            <span>Faqs Groups</span>
                        </a>
                      </li>
                   </ul>
                </div>
            </li>
            <li>
                <a href="/admin/promo" class="nav-link px-3 {{ !request()->routeIs('admin-promo')? : 'active' }}">
                    <span class="me-2">
                        <i class="bi bi-percent"></i>
                    </span>
                    <span>Promo</span>
                </a>
             </li>
             <li>
                <a href="/admin/email-templates" class="nav-link px-3 {{ !request()->routeIs('admin-emailtemplate')? : 'active' }}">
                    <span class="me-2">
                        <i class="bi bi-envelope-fill"></i>
                    </span>
                    <span>Email Templates</span>
                </a>
             </li>
             <li>
                <a href="/admin/email" class="nav-link px-3 {{ !request()->routeIs('admin-email')? : 'active' }}">
                    <span class="me-2">
                        <i class="bi bi-envelope"></i>
                    </span>
                    <span>Email/SMS</span>
                </a>
            </li> 
            <li>
                <a href="/admin/starbuck-locations" class="nav-link px-3 {{ !request()->routeIs('admin-starbucklocation')? : 'active' }}">
                    <span class="me-2">
                        <i class="bi bi-geo-alt"></i>
                    </span>
                    <span>Starbuck Locations</span>
                </a>
            </li> 
        </ul>
        <p class="navbar-text copyright">{{ get_settings_session()->copyright }}</p>
    </nav>
   </div>
</div>