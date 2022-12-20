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
                    <span><i class="bi bi-file-earmark-break me-2"></i></span><span class="h6">Pages</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn btn-add" data-url="{{ route('admin-pagesaddform') }}" data-title="Pages">Add</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table id="pageTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}" data-title='Page'>
                    <thead class="">
                        <tr>
                            <th class="col">#</th>
                            <th class="col">Title</th>
                            <th class="col">SEF Url</th>
                            <th class="col">Meta Title</th>
                            <th class="col">Meta Description</th>
                            <th class="col">Meta Keywords</th>
                            <th class="col" style="min-width: 150px">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="col"></th>
                        <th class="col">Title</th>
                        <th class="col">SEF Url</th>
                        <th class="col">Meta Title</th>
                        <th class="col">Meta Description</th>
                        <th class="col">Meta Keywords</th>
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