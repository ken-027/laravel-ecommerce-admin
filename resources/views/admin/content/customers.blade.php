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
                    <span><i class="bi bi-people-fill me-2"></i></span><span class="h6">Customers</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn bulk-remove" id="">Bulk Remove</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table id="customerTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}"  data-title='Customer'>
                    <thead class="">
                        <tr>
                            <th class="col"><input class="form-check-input check-all" type="checkbox" value="" id=""></th>
                            <th class="col">Name</th>
                            <th class="col">Email</th>
                            <th class="col">Phone</th>
                            <th class="col">Total Trade-in</th>
                            <th class="col">User Type</th>
                            <th class="col">Date</th>
                            <th class="col" style="min-width: 130px">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th><input class="form-check-input check-all" type="checkbox" value="" id="flexCheckDefault"></th>
                        <th class="col">Name</th>
                        <th class="col">Email</th>
                        <th class="col">Phone</th>
                        <th class="col">Total Trade-in</th>
                        <th class="col">User Type</th>
                        <th class="col">Date</th>
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