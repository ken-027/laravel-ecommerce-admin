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
                    <span><i class="bi bi-star-half me-2"></i></span><span class="h6">Reviews</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn bulk-remove" id="">Bulk Remove</button>
                    <button class="btn btn-add" data-url="{{ route('admin-reviewsaddform') }}" data-title="Form Reviews">Add</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="formReviewTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}" data-title='Review'>
                        <thead class="">
                            <tr>
                                <th class="col"><input class="form-check-input check-all" type="checkbox" value="" id=""></th>
                                <th class="col">Name</th>
                                <th class="col">Email</th>
                                <th class="col">City</th>
                                <th class="col">State</th>
                                <th class="col">Zipcode</th>
                                <th class="col">Stars</th>
                                <th class="col">Date</th>
                                {{-- <th class="col">Status</th>   --}}
                                <th class="col-1" style="min-width: 180px">Actions</th>
                            </tr>
                        </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="col"><input class="form-check-input check-row" type="checkbox" value="" id=""></th>
                            <th class="col">Name</th>
                            <th class="col">Email</th>
                            <th class="col">City</th>
                            <th class="col">State</th>
                            <th class="col">Zipcode</th>
                            <th class="col">Stars</th>
                            <th class="col">Date</th>
                            {{-- <th class="col">Status</th> --}}
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