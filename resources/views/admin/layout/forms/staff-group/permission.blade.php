<div class="row content p-0 m-0 d-none" id="permissionTab">
    <div class="tab-content">     
        <form method="POST" class="form py-1 position-relative" id="permissionForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Orders</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[order][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->order->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[order][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->order->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[order][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->order->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Models</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[model][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->model->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[model][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->model->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[model][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->model->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[model][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->model->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Devices</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[device][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->device->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[device][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->device->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[device][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->device->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[device][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->device->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Brand</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[brand][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->brand->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[brand][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->brand->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[brand][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->brand->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[brand][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->brand->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Categories</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[category][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->category->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[category][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->category->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[category][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->category->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[category][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->category->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Customers</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[customer][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->customer->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[customer][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->customer->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[customer][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->customer->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[customer][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->customer->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Pages Management</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[page][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->page->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[page][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->page->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[page][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->page->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[page][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->page->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Menus Management</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[menu][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->menu->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[menu][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->menu->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[menu][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->menu->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[menu][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->menu->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Forms</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[form][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->form->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[form][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->form->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[form][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->form->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[form][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->form->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Blogs</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[blog][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->blog->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[blog][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->blog->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[blog][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->blog->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[blog][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->blog->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Faqs</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[faq][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->faq->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[faq][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->faq->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[faq][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->faq->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[faq][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->faq->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Promo Code</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[promocode][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->promocode->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">View</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[promocode][add]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->promocode->add ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[promocode][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->promocode->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[promocode][delete]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->promocode->delete ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Delete</label>
                </div>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Email Templates</label><small class="mx-1 text-danger"></small>
                <div class="form-group col-lg-6">
                    <input name="permission[emailtemplate][view]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->emailtemplate->view ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Add</label>
                </div>
                <div class="form-group col-lg-6">
                    <input name="permission[emailtemplate][edit]" value="1" type="checkbox" class="form-check-input" {{  $is_edit ? $permissions->emailtemplate->edit ? 'checked' : '' : ''}} />
                    <label for="" class="form-check-label">Edit</label>
                </div>
            </div>
        </form>
    </div>
</div>
