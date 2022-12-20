@include('include.header')

@include('user.include.menu')

  <section class="bg-white">
    <div class="container-fluid account-container">
      <div class="row">      
          <div class="col-md-2">
            <div class="nav-account-list my100 bg-secondary">
                <div class="nav-account-item" nav-toggle="nav" target="account-content">
                  <i class="far fa-user"></i>
                  <span>My Profile</span>
                </div>
                <div class="nav-account-item" nav-toggle="nav" target="account-content-order">
                  <i class="fas fa-box"></i>
                  <span>My Trade In</span>
                </div>  
                <div class="nav-account-item" nav-toggle="nav" target="account-content-address">
                  <i class="fas fa-box"></i>
                  <span>My Address</span>
                </div>         
                <div class="nav-account-item" nav-toggle="nav" target="account-content-change-password">
                  <i class="far fa-user"></i>
                  <span>Change Password</span>
                </div>
                <div class="nav-account-item" onclick="document.getElementById('form-logout').submit();">
                  <i class="far fa-user"></i>
                  <span>Logout</span>
                  <form action="{{route('user.logout')}}" method="post"  id="form-logout">@csrf</form>
                </div>               
            </div>
          </div>

          <div class="col-md-10">
            <div class="account-content-wrapper my100 bg-secondary">

         

                <div class="nav-content account-content active">
                    <h3 class="px15">My Profile</h3>
                    <label class="px15">Please, ensure that your contact details are entered correctly. Click the “UPDATE” button after any change has been made.</label>
                    <div class="mt-1">

                      <div id="notify-update-profile" class="col-md-6 column">

                      </div>

                      <form id="form-update-profile" action="{{ route('account.update') }}" method="post">         
                          @csrf             
                          @method('put')
                     
                          <div class="mb-3 col-md-6">
                            <label for="" class="text-sm">First Name</label>
                              <input type="text" class="form-control w-2/4"  name="firstname" id=""  value="{{ auth()->user()->first_name }}">
                            </div>
                            <div class="mb-3 col-md-6">
                                  <label for="" class="text-sm">Last  Name</label>
                                  <input type="text" class="form-control w-2/4" name="lastname" id="" value="{{ auth()->user()->last_name }}">
                            </div> 
                      
                                      
                       
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label text-sm">Phone Number</label>
                              <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="phone" value="{{ auth()->user()->phone }}">
                            </div>
        
                            <div class="mb-3 col-md-6">
                              <label for="exampleFormControlInput1" class="form-label text-sm">Email address</label>
                              <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" name="email"  value="{{ auth()->user()->email }}" disabled>
                            </div>
              

                        <div class="mb-3 col-md-12 mt-20">                           
                                <button id="btn-update-profile" class="btn btn-primary">Save Changes</button>
                        </div>
                      </form>
                    </div>       
                </div> 
                <div class="nav-content account-content-address">
                  <h3 class="px15">My Address</h3>
                  <label class="px15">Please, ensure that your contact details are entered correctly. Click the “UPDATE” button after any change has been made.</label>
                  <div class="mt-1">    
                    
                    <div id="notify-update-address" class="col-md-6">

                    </div>


                    <form id="form-update-address" action="{{ route('account.update.address') }}" method="post">         
                        @csrf             
                        @method('put')
                   
                      <div class="mb-3 col-md-6">
                         <label for="" class="text-sm">ADDRESS 1</label>
                         <input type="text" class="form-control w-2/4"  name="address" id=""  value="{{ auth()->user()->address }}">
                      </div>
                      <div class="mb-3 col-md-6">
                            <label for="" class="text-sm">ADDRESS 2</label>
                            <input type="text" class="form-control w-2/4" name="address2" id="" value="{{ auth()->user()->address2 }}">
                      </div>                                    
                     
                      <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-sm">CITY</label>
                        <input type="text" class="form-control" name="city" value="{{ auth()->user()->city }}">
                      </div>
      
                      <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-sm">STATE</label>
                        <input type="text" class="form-control"  name="state"  value="{{ auth()->user()->state }}">
                      </div>
                     

                      <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-sm">Zipcode</label>
                        <input type="text" class="form-control"  name="postcode"  value="{{ auth()->user()->postcode }}">
                      </div>

                      <div class="mb-3 col-md-6">
                        <label for="exampleFormControlInput1" class="form-label text-sm">Country</label>
                        <input type="text" class="form-control" name="country"  value="{{ auth()->user()->Country }}">
                      </div>

                      <div class="mb-3 col-md-12 mt-20">
                          <button id="btn-update-address" class="btn btn-primary">Update</button>                                                   
                      </div>
                    </form>
                  </div>       
                </div>
                <div class="nav-content account-content-change-password">
                  <h3 class="px15">Change Password</h3>
                  <label class="px15">Type in your new password and then click the "UPDATE" button to save it</label>
                  <div class="mt-1">
                    <div id="notify-update-password" class="col-md-6">

                    </div>
                    <form id="form-update-password" action="{{ route('account.update.password') }}" method="post">         
                        @csrf             
                        @method('put')
                    
                        <div class="mb-3 col-md-6">
                          <label for="" class="text-sm">New Password</label>
                            <input type="password" class="form-control w-2/4"  name="password" id=""  value="">
                          </div>
                          <div class="mb-3 col-md-6">
                                <label for="" class="text-sm">Confirm password</label>
                                <input type="password" class="form-control w-2/4" name="password_confirmation" id="" value="">
                         </div> 
                   
                                    
                    
                      <div class="mb-3 col-md-12 mt-20">
                          <button id="btn-update-password" class="btn btn-primary">Save Changes</button>
                                                   
                      </div>
                    </form>
                  </div>       
                </div> 
                <div class="nav-content account-content-order">
                  <h3 class="px15">My Trade In</h3>
                  <label class="px15">Please, ensure that your contact details are entered correctly. Click the “UPDATE” button after any change has been made.</label>
                  <div class="mt-1">
                    
               
                  </div>       
              </div>
                
                

                
                
                
            </div>
            
          </div>
          



        
      </div>
    </div>
  </section>





@include('user.include.section.footer')
@include('include.footer')
	  
