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
                    <span><i class="bi bi-percent me-2"></i></span><span class="h6">Promo</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn btn-add" data-url="{{ route('admin-promoaddform') }}" data-title="Promo">Add</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <table id="promoTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}"  data-title='Promo'>
                    <thead class="">
                        <tr>
                            <th class="col">ID</th>
                            <th class="col">Promo Code</th>
                            <th class="col">From Date</th>
                            <th class="col">Expire Date</th>
                            <th class="col">Discount</th>
                            {{-- <th class="col">Active</th> --}}
                            <th class="col" style="min-width: 150px">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="col">ID</th>
                        <th class="col">Promo Code</th>
                        <th class="col">From Date</th>
                        <th class="col">Expire Date</th>
                        <th class="col">Discount</th>
                        {{-- <th class="col">Active</th> --}}
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