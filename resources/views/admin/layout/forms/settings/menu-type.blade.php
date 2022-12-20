<div class="row content p-0 m-0 d-none" id="menuTypeSettings">
    <div class="tab-content">   
         {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-menu-up"></i></span>Menu Type</h3> --}}
         <form method="POST" class="form col-lg-6 position-relative" id="menuTypeForm">
               <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
               <div class="form-group">
               <label for="" class="col-form-label">Top Right Menu</label>
               <div class="col">
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="1" type="radio" name="toprightmenu" id="" {{ $other_settings->top_right_menu ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault1">Enable</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="0" type="radio" name="toprightmenu" id="" {{ !$other_settings->top_right_menu ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault2">Disable</label>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-form-label">Header Menu</label>
               <div class="col">
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="1"  type="radio" name="headermenu" id="" {{ $other_settings->header_menu ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault1">Enable</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="0"  type="radio" name="headermenu" id="" {{ !$other_settings->header_menu ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault2">Disable</label>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-form-label">Footer Menu Column 1</label>
               <div class="col">
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="1"  type="radio" name="footermenucolumn1" id="" {{ $other_settings->footer_menu_column1 ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault1">Enable</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="0"  type="radio" name="footermenucolumn1" id="" {{ !$other_settings->footer_menu_column1 ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault2">Disable</label>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-form-label">Footer Menu Column 2</label>
               <div class="col">
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="1"  type="radio" name="footermenucolumn2" id="" {{ $other_settings->footer_menu_column2 ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault1">Enable</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="0"  type="radio" name="footermenucolumn2" id="" {{ !$other_settings->footer_menu_column2 ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault2">Disable</label>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-form-label">Footer Menu Column 3</label>
               <div class="col">
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="1"  type="radio" name="footermenucolumn3" id="" {{ $other_settings->footer_menu_column3 ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault1">Enable</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="0"  type="radio" name="footermenucolumn3" id="" {{ !$other_settings->footer_menu_column3 ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault2">Disable</label>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="" class="col-form-label">Copyright Menu</label>
               <div class="col">
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="1"  type="radio" name="copyrightmenu" id="" {{ $other_settings->copyright_menu ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault1">Enable</label>
                  </div>
                  <div class="form-check form-check-inline">
                     <input class="form-check-input" value="0"  type="radio" name="copyrightmenu" id="" {{ !$other_settings->copyright_menu ? 'checked' : '' }} />
                     <label class="form-check-label" for="flexRadioDefault2">Disable</label>
                  </div>
               </div>
            </div>
            {{-- <div class="form-group py-2">
               <button type="submit" class="btn">Update</button>
            </div> --}}
         </form>
    </div>
</div>