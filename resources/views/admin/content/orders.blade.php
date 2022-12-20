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
                    <span>
                        @if (request()->routeIs('awaiting-orders'))
                            <i class="bi bi-hourglass-bottom me-2" id="orderType" data-type="awaiting"></i></span><span class="h6">Awaiting Orders
                        @elseif (request()->routeIs('unpaid-orders'))
                            <i class="bi bi-credit-card me-2" id="orderType" data-type="unpaid"></i></span><span class="h6">Unpaid Orders
                        @elseif (request()->routeIs('paid-orders'))
                            <i class="bi bi-cash-stack me-2" id="orderType" data-type="paid"></i></span><span class="h6">Paid Orders
                        @elseif (request()->routeIs('archive-orders'))
                            <i class="bi bi-archive me-2" id="orderType" data-type="archive"></i></span><span class="h6">Archive Orders
                        @endif
                    </span>
                </div>
                <div class="col-sm-auto text-end">
                    {{-- <button class="btn" data-toggle="modal" data-target="#">Export</button>
                    <button class="btn" data-toggle="modal" data-target="#">Import</button> --}}
                    @if (request()->routeIs('archive-orders'))
                        <button class="btn bulk-restore" id="">Bulk Restore</button>
                    @else 
                        <button class="btn bulk-remove" id="">Bulk Archive</button>
                    @endif
                    {{-- <button class="btn" data-toggle="modal" data-target="#addCategoriesForm">Add</button> --}}
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <div id="orderFilter" class="order-filter pt-2 px-0 row">
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
                                @if (request()->routeIs('awaiting-orders'))
                                    <li class="item d-flex border-separator"><a class="w-100 open-link export-data csv" data-url="{{ route('awaiting-orders-export') }}" data-type="csv" data-files="awaiting-order">CSV</a></li>
                                    <li class="item d-flex border-separator"><a class="w-100 open-link export-data pdf" data-url="{{ route('awaiting-orders-export') }}" data-type="pdf" data-files="awaiting-order">PDF</a></li>
                                @elseif (request()->routeIs('unpaid-orders'))
                                    <li class="item d-flex border-separator"><a class="w-100 open-link export-data csv" data-url="{{ route('unpaid-orders-export') }}" data-type="csv" data-files="unpaid-order">CSV</a></li>
                                    <li class="item d-flex border-separator"><a class="w-100 open-link export-data pdf" data-url="{{ route('unpaid-orders-export') }}" data-type="pdf" data-files="unpaid-order">PDF</a></li>
                                @elseif (request()->routeIs('paid-orders'))
                                    <li class="item d-flex border-separator"><a class="w-100 open-link export-data csv" data-url="{{ route('paid-orders-export') }}" data-type="csv" data-files="paid-order">CSV</a></li>
                                    <li class="item d-flex border-separator"><a class="w-100 open-link export-data pdf" data-url="{{ route('paid-orders-export') }}" data-type="pdf" data-files="paid-order">PDF</a></li>
                                @elseif (request()->routeIs('archive-orders'))
                                    <li class="item d-flex border-separator"><a class="w-100 open-link export-data csv" data-url="{{ route('archive-orders-export') }}" data-type="csv" data-files="archive-order">CSV</a></li>
                                    <li class="item d-flex border-separator"><a class="w-100 open-link export-data pdf" data-url="{{ route('archive-orders-export') }}" data-type="pdf" data-files="archive-order">PDF</a></li>
                                @endif
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
                                @if (request()->routeIs('awaiting-orders'))
                                    <li class="item d-flex border-separator"><a class="w-100 open-link import-data csv" data-url="{{ route('awaiting-orders-import') }}" data-type="pdf" data-files="awaiting-order">CSV</a></li>
                                @elseif (request()->routeIs('unpaid-orders'))
                                    <li class="item d-flex border-separator"><a class="w-100 open-link import-data csv" data-url="{{ route('unpaid-orders-import') }}" data-type="pdf" data-files="unpaid-order">CSV</a></li>
                                @elseif (request()->routeIs('paid-orders'))
                                    <li class="item d-flex border-separator"><a class="w-100 open-link import-data csv" data-url="{{ route('paid-orders-import') }}" data-type="pdf" data-files="paid-order">CSV</a></li>
                                @elseif (request()->routeIs('archive-orders'))
                                    <li class="item d-flex border-separator"><a class="w-100 open-link import-data csv" data-url="{{ route('archive-orders-import') }}" data-type="pdf" data-files="archive-order">CSV</a></li>
                                @endif
                                {{-- <li class="item d-flex border-separator"><a class="w-100 open-link">PDF</a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 text-end px-0">
                        <label for="" class="filterby-label">Filter By</label>
                        <input type="date" id="orderDateFromFilter" class="form-control-sm form-control-inline" value="{{ format_date_html(date('Y-m-d', strtotime('-1 month', strtotime(date('Y-m-d'))))) }}">
                        <input type="date" id="orderDateToFilter" class="form-control-sm  form-control-inline" value="{{ format_date_html(date('Y-m-d')) }}">
                        <select id="paymentMethodFilter" class="form-control form-control-sm"> 
                            <option selected value="">- Payment Method -</option>
                            @foreach ($payment_method as $method)
                                <option value="{{ $method->type }}">{{ $method->type }}</option>
                            @endforeach
                        </select>

                        @if (request()->routeIs('unpaid-orders') || request()->routeIs('archive-orders'))
                            <select id="statusFilter" class="form-control form-control-sm"> 
                                <option selected value="">- Status -</option>
                                @foreach ($status as $status_row)
                                    <option value="{{ $status_row->status }}">{{ $status_row->status }}</option>
                                @endforeach
                            </select>
                        @endif
                    </div>
                </div>
                <table id="orderTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}"  data-title='Order'>
                    <thead class="">
                        <tr>
                            <th class="col"><input class="form-check-input check-all" type="checkbox" value="" id=""></th>
                            <th class="col">Order ID</th>
                            <th class="col">Customer</th>
                            <th class="col">Date</th>
                            <th class="col">Date Approved</th>
                            <th class="col">Price</th>
                            <th class="col">Payment Method</th>
                            <th class="col">Status</th>
                            <th class="col" style="min-width: 150px">Actions</th>
                        </tr>
                    </thead>
                <tbody>
{{-- @include('admin.layout.tables.order') --}}
                </tbody>
                <tfoot>
                    <tr>
                        <th class=""><input class="form-check-input check-all" type="checkbox" value="" id="flexCheckDefault"></th>
                        <th class="col">Order ID</th>
                        <th class="col">Customer</th>
                        <th class="col">Date</th>
                        <th class="col">Date Approved</th>
                        <th class="col">Price</th>
                        <th class="col">Payment Method</th>
                        <th class="col">Status</th>
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