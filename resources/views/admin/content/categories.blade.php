@include('include.header')

{{-- nav --}}
@include('admin.include.menu')
{{-- nav --}}
{{-- sidebar --}}
@include('admin.include.sidebar')
{{-- import form --}}
<main class=" p-3 main-content">
    <div class="row">
        <!--Big blue-->
        {{-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Library</li>
            </ol>
        </nav> --}}
        <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header row align-items-center sub-menu">
                <div class="col">
                    <span><i class="bi bi-columns-gap me-2"></i></span><span class="h6">Categories</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn order-save" id="" data-page="categories">Bulk Order Save</button>
                    <button class="btn bulk-remove" id="">Bulk Remove</button>
                    <button class="btn btn-add" data-url="{{ route('admin-categoryaddform') }}" data-title="Category">Add</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="categoryTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}" data-title='Category'>
                        <thead class="">
                            <tr>
                                <th class="col-1"><input class="form-check-input check-all" type="checkbox" value="" id=""></th>
                                <th class="col-2">Icon</th>
                                <th class="col-3">Title</th>
                                <th class="col-2">Type</th>
                                <th class="col-2">Order</th>
                                <th class="col-2" style="min-width: 100px">Actions</th>
                            </tr>
                        </thead>
                    <tbody>
                        <tr class="odd">
                            <td valign="top" colspan="6" class="dataTables_empty text-center">No matching records found</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><input class="form-check-input check-all" type="checkbox" value="" id="flexCheckDefault"></th>
                            <th>Icon</th>
                            <th>Title</th>
                            <th>Type</th>
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