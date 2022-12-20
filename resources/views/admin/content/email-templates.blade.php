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
                    <span><i class="bi bi-envelope-fill me-2"></i></span><span class="h6">Email Templates</span>
                </div>
                <div class="col-sm-auto text-end">
                    <button class="btn btn-add" data-url="{{ route('admin-emailtemplateaddform') }}" data-title="Email Template">Add</button>
                </div>
            </div>
            <div class="card-body">
            <div class="table-responsive">
                <div class="pt-2 col-12 text-end" id="emailTemplateFilter">
                    <label for="" class="filterby-label">Filter By</label>
                    <select id="emailTemplatesType" class="form-control form-control-sm"> 
                      <option selected value="">- Select Type -</option>
@foreach ($email_types as $email_type)
{{-- ucwords(str_replace("_"," ", $email_type->type)) --}}
                    <option value="{{ $email_type->type }}">{{ ucwords(str_replace("_"," ", $email_type->type)) }}</option>
@endforeach
                    </select>
                  </div>
                  <table id="emailTemplateTable" class="table table-bordered table-striped data-table" style="width: 100%; min-width: 800px" data-table="{{ $table_name }}"  data-title='Email Template'>
                    <thead class="">
                        <tr>
                            <th class="col-1">No.</th>
                            <th class="col">Type</th>
                            <th class="col">Subject</th>
                            <th class="col-2" style="min-width: 120px">Actions</th>
                        </tr>
                    </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th class="col">No.</th>
                        <th class="col">Type</th>
                        <th class="col">Subject</th>
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