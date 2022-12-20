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
                    <span><i class="bi bi-list me-2"></i></span><span class="h6">Menus</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn order-save" id="" data-page="menus">Bulk Order Save</button>
                    <button class="btn btn-add" data-url="{{ route('admin-menusaddform') }}" data-title="Brand">Add</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <div id="menuFilter" class="order-filter pt-2 col-12 text-end">
                    <label for="" class="filterby-label">Filter By</label>
                    {{-- <input type="date" id="orderDateFromFilter" class="form-control-sm form-control-inline">
                    <input type="date" id="orderDateToFilter" class="form-control-sm  form-control-inline"> --}}
                    <select id="positionMenu" class="form-control form-select form-select-sm"> 
                        <option value="" selected>- Select All -</option>
@foreach ($menu_position as $key => $position)
                        <option {{ $key==0 ? 'selected': '' }} value="{{ $position->position }}">{{ ucwords(str_replace("_"," menu ",$position->position)) }}</option>
@endforeach
                    </select>
                </div>
{{-- table --}}
                <table id="menuTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}"  data-title='Menu'>
                    <thead class="">
                        <tr>
                            <th class="col">#</th>
                            <th class="col">Page Name</th>
                            <th class="col">Menu Name</th>
                            <th class="col">Parent Menu</th>
                            <th class="col-2">Order</th>
                            <th class="col-2" style="min-width: 150px">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="col"></th>
                        <th class="col">Page Name</th>
                        <th class="col">Menu Name</th>
                        <th class="col">Parent Menu</th>
                        <th class="col">Order</th>
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