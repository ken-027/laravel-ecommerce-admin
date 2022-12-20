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
                    <span>
                        <i class="bi bi-collection me-2"></i></span><span class="h6">Staff Groups
                    </span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn bulk-remove" id="">Bulk Remove</button>
                    <button class="btn btn-add" data-url="{{ route('admin-staffgroupaddform') }}" data-title="Staff Group">Add</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table id="staffGroupTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}" data-title='Staff'>
                    <thead class="">
                        <tr>
                            <th class="col-1"><input class="form-check-input check-all" type="checkbox" value="" id=""></th>
                            <th class="col">Name</th>
                            <th class="col">Permissions</th>
                            <th class="col-2" style="min-width: 150px">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="col-1 check-all"><input class="form-check-input" type="checkbox" value="" id=""></th>
                        <th class="col">Name</th>
                        <th class="col">Permissions</th>
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