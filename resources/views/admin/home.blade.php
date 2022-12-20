@include('include.header')

{{-- nav --}}
@include('admin.include.menu')
{{-- nav --}}

{{-- sidebar --}}
@include('admin.include.sidebar')
{{-- sidebar --}}

<main class=" pt-3 main-content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
        <h4>Dashboard</h4>
   
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 mb-4">
        <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">
                <h5>Awaiting Orders</h5>
                <div class="h1 mt-1 py-0 my-0">{{ number_format($total_awaiting, 0) }}</div>
            </div>
            <div class="card-footer d-flex">
                <a href="/admin/orders/awaiting" class="text-decoration-none text-light">View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
        </div>
        <div class="col-md-4 mb-4">
        <div class="card bg-warning text-dark h-100">
            <div class="card-body py-5">
                <h5>Unpaid Orders</h5>
                <div class="h1 mt-1 py-0 my-0">{{ number_format($total_unpaid, 0) }}</div>
            </div>
                <div class="card-footer d-flex">
                <a href="/admin/orders/unpaid" class="text-decoration-none text-dark">View Details</a>
                <span class="ms-auto">  
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
        </div>
        <div class="col-md-4 mb-4">
        <div class="card bg-success text-white h-100">
            <div class="card-body py-5">
                <h5>Paid Orders</h5>
                <div class="h1 mt-1 py-0 my-0">{{ number_format($total_paid, 0) }}</div>
            </div>
                <div class="card-footer d-flex">
                <a href="/admin/orders/paid" class="text-decoration-none text-light">View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
        </div>
        <!-- <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white h-100">
            <div class="card-body py-5">
                Archive Orders
                <div class="h4 mt-1 py-0 my-0">{{ number_format($total_archive, 0) }}</div>
            </div>
                <div class="card-footer d-flex">
                <a href="/admin/orders/archive" class="text-decoration-none text-light">View Details</a>
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
        </div> -->
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Top 5 Brands 
            </div>
            <div class="card-body">
            <canvas id="brandChart" class="chart" width="400" height="200"></canvas>
            </div>
        </div>
        </div>
        <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
            <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                Top 10 Models
            </div>
            <div class="card-body">
            <canvas id="modelChart" class="chart" width="400" height="200"></canvas>
            </div>
        </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 mb-3">
            
        </div>
    </div>
    </div>
</main>

@include('include.footer')
