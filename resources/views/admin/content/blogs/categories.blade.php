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
                    <span><i class="bi bi-columns-gap me-2"></i></span><span class="h6">Blog Categories</span>
                </div>
                <div class="col-sm-auto text-end">
                    {{-- <button class="btn bulk-remove" id="">Bulk Remove</button> --}}
                    <button class="btn btn-add" data-url="{{ route('admin-blogcategoryaddform') }}" data-title="Blog Categories">Add</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table id="blogCategoryTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px;" data-table="{{ $table_name }}" data-title='Blog Categories'>
                    <thead class="">
                        <tr>
                            <th class="col-1">#</th>
                            <th class="col-9">Title</th>
                            <th class="col-2" style="min-width: 130px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
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