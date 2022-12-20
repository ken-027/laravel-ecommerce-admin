@include('include.header')

{{-- nav --}}
@include('admin.include.menu')
{{-- nav --}}
{{-- sidebar --}}
@include('admin.include.sidebar')
{{-- import form --}}
<main class=" p-3 main-content">
    <div class="row">
        <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header row align-items-center sub-menu">
                <div class="col">
                    <span><i class="bi bi-phone me-2"></i></span><span class="h6">Models</span>
                </div>
                <div class="col-sm-auto text-end">
                    {{-- <button class="btn" data-toggle="modal" data-target="#">Export</button>
                    <button class="btn" data-toggle="modal" data-target="#">Import</button> --}}
                    <button class="btn order-save" id="" data-page="models">Bulk Order Save</button>
                    <button class="btn bulk-remove" id="">Bulk Remove</button>
                    <button class="btn btn-add" data-url="{{ route('admin-modelsaddform') }}" data-title="Models">Add</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
              <div class="pt-2 px-0 row" id="modelFilter">
                <div class="col-md-2 d-flex">
                    <div class="me-2">
                        <button 
                            class="btn btn-onfilter btn-export" 
                            title="Export"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-file-earmark-arrow-up"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end onfilter-dropdown-container">
                            <li class="item d-flex border-separator"><a class="w-100 open-link export-data csv" data-url="{{ route('models-export') }}" data-type="csv" data-files="models">CSV</a></li>
                            <li class="item d-flex border-separator"><a class="w-100 open-link export-data pdf" data-url="{{ route('models-export') }}" data-type="pdf" data-files="models">PDF</a></li>
                        </ul>
                    </div>
                    <div>
                        <button 
                            class="btn btn-onfilter btn-import" 
                            {{-- data-toggle="tooltip" 
                            data-placement="top"  --}}
                            title="Import"
                            role="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-file-earmark-arrow-down"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end onfilter-dropdown-container">
                            <li class="item d-flex border-separator"><a class="w-100 open-link import-data csv" data-url="{{ route('models-import') }}" data-type="csv" data-files="models">CSV</a></li>
                            {{-- <li class="item d-flex border-separator"><a class="w-100 open-link">PDF</a></li> --}}
                        </ul>
                    </div>
                </div>
                <div class="col-md-10 text-end px-0">
                    <label for="" class="filterby-label">Filter By</label>
                    <select id="categoryFilter" class="form-control form-control-sm"> 
                        <option selected value="">- Select Category -</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->title }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    <select id="brandFilter" class="form-control form-control-sm">
                        <option selected value="">- Select Brand -</option>
                        @foreach ($brand as $brand_row)
                            <option value="{{ $brand_row->title }}">{{ $brand_row->title }}</option>
                        @endforeach
                    </select>
                    <select id="deviceFilter" class="form-control form-control-sm">
                        <option selected value="">- Select Device -</option>
                        @foreach ($devices as $device)
                            <option value="{{ $device->title }}">{{ $device->title }}</option>
                        @endforeach
                    </select>
                </div>
              </div>
              <table id="modelTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}" data-title='Model'>
                <thead class="">
                    <tr>
                        <th class="col-1"><input class="form-check-input check-all" type="checkbox" value="" id=""></th>
                        <th class="col-2">Icon</th>
                        <th class="col-3">Title</th>
                        <th class="col-2">Device</th>
                        <th class="col-2">Brand</th>
                        <th class="col-2">Order</th>
                        <th class="col-2" style="min-width: 180px">Actions</th>
                    </tr>
                </thead>
            <tbody>
            </tbody>
            <tfoot>
                <tr>
                    <th><input class="form-check-input check-all" type="checkbox" value="" id="flexCheckDefault"></th>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Device</th>
                    <th>Brand</th>
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