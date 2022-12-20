<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative" id="basicForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Name</label><small class="mx-1 text-danger"></small>
                <input type="text" name="name" class="form-control form-control-sm" value="{{ $is_edit ? $review->name : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Email</label><small class="mx-1 text-danger"></small>
                <input type="text" name="email" class="form-control form-control-sm" value="{{ $is_edit ? $review->email : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Country</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="country">
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Country -</option>
                    @foreach (country_list() as $country) }}
                        <option value="{{ $country->code }}" {{ $is_edit ? $country->code == $review->country ? 'selected' : '' : '' }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">State</label><small class="mx-1 text-danger"></small>
                <input type="text" name="state" class="form-control form-control-sm" value="{{ $is_edit ? $review->state : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">City</label><small class="mx-1 text-danger"></small>
                <input type="text" name="city" class="form-control form-control-sm" value="{{ $is_edit ? $review->city : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Zip Code</label><small class="mx-1 text-danger"></small>
                <input type="text" name="zipcode" class="form-control form-control-sm" value="{{ $is_edit ? $review->zip_code : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Device Sold</label><small class="mx-1 text-danger"></small>
                <input type="text" name="devicesold" class="form-control form-control-sm" value="{{ $is_edit ? $review->device_sold : '' }}">
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Review Website</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="reviewwebsite">
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Website -</option>
                    @foreach (review_website_list() as $key => $value) }}
                        <option value="{{ $key }}" {{ $is_edit ? $key == $review->website ? 'selected' : '' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Star Rating</label><small class="mx-1 text-danger"></small>
                <select id="" class="form-select form-select-sm" name="starrating">
                    <option value="" {{ !$is_edit ? 'selected' : '' }}>- Select Rating -</option>
                    @for ($rating = 0; $rating <= 5; $rating = $rating + 0.5)
                        <option value="{{ $rating }}" {{ $is_edit ? $rating == $review->stars ? 'selected' : '' : '' }}>{{ $rating }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Comment</label><small class="mx-1 text-danger"></small>
                <textarea name="comment" rows="5" class="form-control form-control-sm">{{ $is_edit ? $review->content : '' }}</textarea>
            </div>
            <div class="form-group py-2 col-lg-6">
                <label for="" class="form-label">Device Sold</label><small class="mx-1 text-danger"></small>
                {{-- <input type="date" id="" name="date" class="form-control form-control-sm" value="{{ $is_edit ? date('m/d/Y',strtotime($review->date)) : '' }}"> --}}
                {{-- <input type="date" id="" name="date" class="form-control form-control-sm" value="{{ $is_edit ? date_format(date_create($review->date), 'm/d/Y') : '' }}"> --}}
                <input type="date" id="" name="date" class="form-control form-control-sm" value="{{ $is_edit ? format_date_html($review->date) : '' }}">
            </div>
                <div class="form-group">
                <label for="" class="col-form-label">Publish</label>
                <div class="col">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="1" type="radio" checked name="publish"
                            {{ $is_edit ? $review->published ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault1">yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" value="0" type="radio" name="publish"
                            {{ $is_edit ? !$review->published ? 'checked' : '' : '' }} />
                        <label class="form-check-label" for="flexRadioDefault2">No</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
