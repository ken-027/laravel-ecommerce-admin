<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Order Status</label><small class="mx-1 text-danger"></small>
                <select id="modelSelectCategory" class="form-select form-select-sm" name="category">
                    <option value="">- Select Status -</option>
                    @foreach ($order_status as $status)
                        <option value="{{ encrypt($status->id) }}" {{ $is_edit ? $status->id == $order_info->status ? 'selected' : '' : '' }}>{{ $status->status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Order Item</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="device">
                    <option value="">- Select Item -</option>
                    @foreach ($order_items as $key => $item)
                        <option value="{{ encrypt($item->order_item_id) }}" {{ $key == 0 ? 'selected' : '' }}>{{ $item->brand_title . ' - ' . $item->model_title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">From Email</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="brand">
                    <option value="">- Select Email -</option>
                    {{-- @foreach ($brand as $brand_item)
                        <option value="{{ encrypt($brand_item->id) }}" {{ $is_edit ? $brand_item->id == $mobile->brand_id ? 'selected' : '' : '' }}>{{ $brand_item->title }}</option>
                    @endforeach --}}
                </select>
            </div>
            <div class="form-group py-2">
                <label for="" class="form-label">Description</label>
                <div class="editor-container order-edit" style="">
                    <textarea id="" class="ckeEditor" name="description">{{ $is_edit ? htmlspecialchars_decode($email->body) : '' }}</textarea>
                </div>
            </div>
            {{-- <div class="form-group py-2 mb-2">
                <button type="submit" class="btn">Save</button>
                <button type="button" class="btn cancel mx-1">Cancel</button>
            </div> --}}
        </form>
    </div>
</div>