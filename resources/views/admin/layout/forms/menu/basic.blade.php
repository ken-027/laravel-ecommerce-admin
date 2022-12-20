

<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Select Page</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="page">
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Category -</option>
                    @foreach ($pages as $page) }}
                        <option value="{{ encrypt($page->id) }}" {{ $is_edit ? $page->id == $menu->page_id ? 'selected' : '' : '' }}>{{ $page->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Url</label><small class="mx-1 text-danger"></small>
                <input type="text" name="url" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $menu->url : '' }}" {{ $is_edit ? $menu->page_id ? 'readonly' : '' : '' }}>
                @if (!$is_edit || !$menu->page_id)
                    <input name="iscustomurl" value="1" type="checkbox" class="form-check-input" {{ $is_edit ? $menu->is_custom_url ? 'checked' : '' : '' }} />
                    <label for="" class="form-check-label">Custom Url</label>
                @endif
                <div class="form-group"></div>
                <input name="opennewwindow" value="1" type="checkbox" class="form-check-input" {{ $is_edit ? $menu->is_open_new_window ? 'checked' : '' : '' }} />
                <label for="" class="form-check-label">Is Open New Window</label>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Name</label><small class="mx-1 text-danger"></small>
                <input type="text" name="name" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $menu->menu_name : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Custom CSS Class</label><small class="mx-1 text-danger"></small>
                <input type="text" name="cssclass" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $menu->css_menu_class : '' }}">
            </div>

            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Custom CSS Fa Icon</label><small class="mx-1 text-danger"></small>
                <input type="text" name="cssclassicon" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $menu->css_menu_fa_icon : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Parent Menu</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="parentmenu" readonly >
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Order</label><small class="mx-1 text-danger"></small>
                <input type="number" name="order" class="form-control form-control-sm mb-1" value="{{ $is_edit ? $menu->ordering : '' }}">
            </div>
            <div class="form-group">
                <label for="" class="col-form-label">Status</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" checked name="status"
                            {{ $is_edit ? $menu->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">Active</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="status"
                            {{ $is_edit ? !$menu->status ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">Inactive</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
