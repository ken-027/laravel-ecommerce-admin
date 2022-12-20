@include('include.header')

{{-- nav --}}
@include('admin.include.menu')
{{-- nav --}}
{{-- sidebar --}}
@include('admin.include.sidebar')

<main class=" p-3 main-content">
    <div class="row">
        <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header row align-items-center sub-menu">
                <div class="col">
                    <span><i class="bi bi-card-list me-2"></i></span><span class="h6">Brand</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn order-save" id="orderSaveBtn" data-page="brand">Bulk Order Save</button>
                    <button class="btn bulk-remove" id="">Bulk Remove</button>
                    <button class="btn btn-add" data-url="{{ route('admin-brandaddform') }}" data-title="Brand">Add</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table id="brandTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px;" data-table="{{ $table_name }}" data-title='Brand'>
                    <thead class="">
                        <tr>
                            <th class="col-1"><input class="form-check-input check-all" type="checkbox" value="" id="flexCheckDefault"></th>
                            <th class="col-2">Icon</th>
                            <th class="col-5">Title</th>
                            <th class="col-2">Order</th>
                            {{-- <input type="button" class="btn btn-add order-save" id="orderSaveBtn" data-page="brand" value="Bulk Save"/> --}}
                            <th class="col-2" style="min-width: 150px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
{{-- @include('admin.layout.tables.brand') --}}
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><input class="form-check-input check-all" type="checkbox" value="" id="flexCheckDefault"></th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Order</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    </table>
            </div>
            </div>
        </div>
        </div>
</main>

@include('include.footer')