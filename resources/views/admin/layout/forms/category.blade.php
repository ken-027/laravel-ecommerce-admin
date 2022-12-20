<div class="container-fluid m-0 p-0 col-12 dialog-form">
   <div class="row m-0 p-0 h-100">
       <div class="col-2 p-0 m-0 h-100">
           <ul class="navbar-nav settings bg-main m-0 p-0 pb-2 h-100 position-relative">
               <li class="">
                   <a class="nav-link px-3 active" data-content="basicTab">
                       <span>Basic</span>
                   </a>
               </li>
               {{-- <li class="">
                   <a class="nav-link px-3" data-content="metaTab">
                       <span>Metadata</span>
                   </a>
               </li> --}}
               <li class="{{ $is_edit ? !empty($category->network_title) ? '' : 'd-none' : 'd-none' }}" id="networkMenu">
                   <a class="nav-link px-3" data-content="networkTab">
                       <span>Network</span>
                   </a>
               </li>
               <li class="{{ $is_edit ? !empty($category->storage_title) ? '' : 'd-none' : 'd-none' }}" id="storageMenu">
                   <a class="nav-link px-3" data-content="storageTab">
                       <span>Storage</span>
                   </a>
               </li>
               <li class="{{ $is_edit ? !empty($category->screen_size_title) ? '' : 'd-none' : 'd-none' }}" id="screenSizeMenu">
                   <a class="nav-link px-3" data-content="screenSizeTab">
                       <span>Screen Size</span>
                   </a>
               </li>
               <li class="{{ $is_edit ? !empty($category->case_size_title) ? '' : 'd-none' : 'd-none' }}" id="caseSizeMenu">
                   <a class="nav-link px-3" data-content="caseSizeTab">
                       <span>Case Size</span>
                   </a>
               </li>
               <li class="{{ $is_edit ? !empty($category->type_title) ? '' : 'd-none' : 'd-none' }}" id="typeMenu">
                   <a class="nav-link px-3" data-content="typeTab">
                       <span>Type</span>
                   </a>
               </li>
               <li class="{{ $is_edit ? !empty($category->case_material_title) ? '' : 'd-none' : 'd-none' }}" id="caseMaterialMenu">
                   <a class="nav-link px-3" data-content="caseMaterialTab">
                       <span>Case Material</span>
                   </a>
               </li>
               <li class="{{ $is_edit ? !empty($category->condition_title) ? '' : 'd-none' : 'd-none' }}" id="conditionMenu">
                   <a class="nav-link px-3" data-content="conditionTab">
                       <span>Condition</span>
                   </a>
               </li>
               <li class="{{ $is_edit ? !empty($category->processor_title) ? '' : 'd-none' : 'd-none' }}" id="processorMenu">
                   <a class="nav-link px-3" data-content="processorTab">
                       <span>Processor</span>
                   </a>
               </li>
               <li class="{{ $is_edit ? !empty($category->ram_title) ? '' : 'd-none' : 'd-none' }}" id="ramMenu">
                   <a class="nav-link px-3" data-content="ramTab">
                       <span>Ram (Memory)</span>
                   </a>
               </li>
               {{-- <li class="d-none">
                   <a class="nav-link px-3" data-content="pricingTab">
                       <span>Pricing</span>
                   </a>
               </li> --}}
               <li class="action-button mb-1">
                   <div class="form-group col-12">
                       <div class="col-12 p-1">
                           <button type="submit" class="btn col-12 btn-submit">{{ $is_edit ? 'Update' : 'Save' }}</button>
                       </div>
                       <div class="col-12 p-1">
                           <button type="button" class="btn cancel col-12">Cancel</button>
                       </div>
                   </div>
               </li>
           </ul>
       </div>
       <div class="col-10 tab-content settings category-container px-0 h-100 form-add-edit" id="formAddEdit" style="overflow-x: hidden" data-formtype="{{ $is_edit ? 'edit' : 'add' }}" data-id="{{ $id }}">
           @include('admin.layout.forms.category.basic')
           {{-- @include('admin.layout.forms.category.meta') --}}
           @include('admin.layout.forms.category.network')
           @include('admin.layout.forms.category.storage')
           @include('admin.layout.forms.category.screen-size')
           @include('admin.layout.forms.category.case-size')
           @include('admin.layout.forms.category.type')
           @include('admin.layout.forms.category.case-material')
           @include('admin.layout.forms.category.condition')
           @include('admin.layout.forms.category.processor')
           @include('admin.layout.forms.category.ram') 
           {{-- 
           {{-- @include('admin.layout.forms.category.pricing') --}}
       </div>
   </div>
</div>
