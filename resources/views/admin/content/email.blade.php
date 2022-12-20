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
                    <span><i class="bi bi-envelope me-2"></i></span><span class="h6">Email</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn bulk-remove" id="">Bulk Remove</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                    {{-- <div class="pt-2 col-12 text-end" id="emailFilter">
                    <label for="" class="filterby-label">Filter By</label>
                    <select id="emailOrderId" class="form-control form-control-sm"> 
                        <option selected value="">- Select Order ID -</option>
                        @foreach ($order_id_list as $order_id)
                            <option value="{{ $order_id->order_id }}">{{ $order_id->order_id }}</option>
                        @endforeach
                    </select>
                  </div> --}}
                  <table id="emailTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}"  data-title='Email'>
                    <thead class="">
                        <tr>
                            <th class="col"><input class="form-check-input check-all" type="checkbox" value="" id=""></th>
                            <th class="col">Order ID</th>
                            {{-- <th class="col">From Email</th>
                            <th class="col">To Email</th> --}}
                            <th class="col">Subject</th>
                            <th class="col">SMS Phone</th>
                            <th class="col">IP</th>
                            <th class="col">Lead Source</th>
                            <th class="col">Date</th>
                            <th class="col" style="min-width: 170px">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="col"><input class="form-check-input check-all" type="checkbox" value="" id=""></th>
                        <th class="col">Order ID</th>
                        {{-- <th class="col">From Email</th>
                        <th class="col">To Email</th> --}}
                        <th class="col">Subject</th>
                        <th class="col">SMS Phone</th>
                        <th class="col">IP</th>
                        <th class="col">Lead Source</th>
                        <th class="col">Date</th>
                        <th class="col">Actions</th>
                    </tr>
                </tfoot>
                </table>
                </div>
            </div>
        </div>
        </div>
</main>

@include('include.footer')