@include('include.header')
@include('include.menu-bck')
    <div class="bg-white w-full">
        <div class="container">
            <div class="header">
               
                <div class="flex-items-center gap-3">
                    <span id="open-menu" class="md:hidden text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                          </svg>
                    </span>
                    <img src="/images/logo.png" class="w-24 md:w-44"  alt="" srcset="">
                </div>
               
                <div class="hidden  md:w-2/5 md:flex md:items-center">
                    <div class="flex items-center flex-auto  rounded-bl rounded-tl border border-grey-400">
                        <input type="text" class="w-full outline-none py-2 px-3 border-0" name="search" placeholder="Search your device">
                        <span class="text-slate-500 ml-1 mr-1 hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </span>
                    </div>
                    <button class="p-2 px-5 text-white border rounded-br rounded-tr border-indigo-800 bg-indigo-700">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                         <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                         </svg>
                    </button>
                </div>
                <nav>
                    <ul class="flex gap-5">                       
                        <li class="md:hidden">                         
                            <div id="open-search" class="nav-item">
                                <span class="text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </span>
                            </div>   
                        </li>
                        <li>
                            <a href="" class="text-slate-500">
                                    <div class="nav-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    <span></span>
                                </div>
                                    
                            </a>                    
                        </li>
                        <li>
                            <a href="" class="text-slate-500">
                                <div class="nav-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                    </svg>                                   
                                </div>                    
                            </a>
                        </li>
                    </ul>
                </nav>            
            </div>            
        </div>
        <div class="border-grey-800 border-b"></div>
        <div class="container">            
            <nav id="navigation" class="sm-navigation md-navigation left-[-80%]">
                <div class="flex  items-center pb-5  md:hidden">                   
                    <span id="close-menu" class="text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                          </svg>
                    </span>
                </div>
                <div class="inline-between-center md:hidden">                    
                   <div class="flex gap-3">
                        <div class="w-16 h-16 flex items-center justify-center rounded-full overflow-hidden border-2 border-grey-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-9 w-9" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-start">
                            <span class="font-semibold  text-slate-600">Jesus Andales</span>
                            <span class="font-normal text-slate-500">jesusandales@gmail.com</span>
                        </div>
                   </div>
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                          </svg>
                    </span>
                </div>
                
                <ul class="flex flex-col mt-6 md:mt-0 md:flex-row md:gap-9 md:p-0 md:justify-center">
                    <li>                        
                        <a href="#"  class="nav-dropdown nav-item-a inline-between-center gap-2 hover:text-indigo-500 md:justify-start">Sell your devices
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </a>
                        <div class="dropdownlist md:p-2 md-dropdownlist hidden">
                            <a href="" class="dropdown-item md:w-1/6 md:mb-2  md:hover:bg-slate-300">
                                <div class="flex items-center gap-1">
                                     <img src="/images/device/svg/Android Phone.svg" class="w-7" alt="">
                                     {{-- <i class="fas fa-mobile-alt"></i> --}}
                                     <span>Phone</span>
                                </div>
                                
                            </a>
                            <a href="" class="dropdown-item md:w-1/6  md:mb-2 md:hover:bg-slate-300">
                                <div class="flex items-center gap-1">
                                    <img src="/images/device/svg/Samsung Tablet.svg" class="w-7" alt="">
                                    <span>Tablet</span>
                                </div>                              
                            </a>
                            <a href="" class="dropdown-item md:w-1/6  md:mb-2 md:hover:bg-slate-300">
                                <div class="flex items-center gap-1">
                                    <img src="/images/device/svg/Apple Watch.svg" class="w-7" alt="">
                                    <span>Apple Watch</span>
                                </div>
                            </a>
                            <a href="" class="dropdown-item md:w-1/6  md:mb-2 md:hover:bg-slate-300">
                                <div class="flex items-center gap-1">
                                    <img src="/images/device/svg/Airpods.svg" class="w-7" alt="">
                                    <span>Airpods</span>
                                </div>
                            </a>
                            <a href="" class="dropdown-item md:w-1/6  md:mb-2 md:hover:bg-slate-300">
                                <div class="flex items-center gap-1">
                                    <img src="/images/device/svg/Android Phone.svg" class="w-7" alt="">
                                    <span>Andriod Phone</span>
                                </div>
                            </a>
                            <a href="" class="dropdown-item md:w-1/6 md:mb-2 md:hover:bg-slate-300">
                                <div class="flex items-center gap-1">
                                    <img src="/images/device/svg/Android Tablet.svg" class="w-7" alt="">
                                    <span>Andriod Tablet</span>
                                </div>
                            </a>
                            <a href="" class="dropdown-item md:w-1/6 md:mb-2 hover:bg-slate-300">
                                <div class="flex items-center gap-1">
                                    <img src="/images/device/svg/Laptop.svg" class="w-7" alt="">
                                    <span>Laptop</span>
                                </div>
                            </a>
                        </div>
                    </li>
                    <li><a href="#" class="nav-item-a py-2">Reviews</a></li>
                    <li><a href="#" class="nav-item-a py-2">Track</a></li>
                    <li><a href="#" class="nav-item-a py-2">Support</a></li>
                    <li><a href="#" class="nav-item-a py-2">Bulk Sales</a></li>
                    
                </ul>
            </nav>    
        </div>     
      </div>
      <!-- search container -->
      <div class="sm-search  md:hidden right-[-100%] hidden">
          <div class="flex-items-center gap-4 px-5 py-4 bor-bottom">
                <span id="close-search" class="text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16l-4-4m0 0l4-4m-4 4h18" />
                     </svg>
                </span>
                <div class="flex-items-center flex-auto">
                    <span class="text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </span>
                    <input type="text" id="sm-input-search" class="w-full outline-none py-2 px-3 border-0 input-search" name="search" placeholder="Search your device">
                    <span  class="seach-close-icon text-slate-500 ml-1 mr-1 hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                </div>
          </div>
      </div>
 </div>
@include('include.footer')