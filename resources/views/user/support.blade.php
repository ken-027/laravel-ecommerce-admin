@include('include.header')
@include('user.include.menu')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block head pb-0 mb-0 border-line text-center clearfix"><h1 class="h1 border-line clearfix">FREQUENTLY ASKED QUESTIONS</h1></div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @foreach (App\Models\Admin\FaqGroup::get_all() as $parent_index => $faq_group)
                    <div class="block content accordion-block clearfix">
                        <div class="h2 text-center">{{strtoupper($faq_group->title)}}</div>
                        <div class="accordion" id="faq{{$parent_index}}">
                            @foreach (App\Models\Admin\Faq::get_list_by_group($faq_group->id) as $index => $faq)
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-g-{{$index}}" aria-bs-expanded="true" aria-bs-controls="collapseOne">
                                                {{capitalize_word($faq->title)}}<i class="bi bi-plus-square-fill"></i><i class="bi bi-minus-square-fill"></i>
                                            </button>
                                        </h2>
                                    </div>
                                    <div id="collapse-g-{{$index}}" class="collapse" aria-labelledby="headingOne" data-parent="#faq{{$parent_index}}">
                                        <div class="card-body">{!!$faq->description!!}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="block head pb-0 mb-0 border-line text-center clearfix">
                    <h1 class="h1 border-line clearfix">CONTACT US</h1>
                    <p class="pt-3 pb-3">You can reach us with the information below if you still have questions, and we would be glad to help.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="block address-block clearfix">
                    <h3>ADDRESS</h3>
                    <p>
                        <strong>{{capitalize_word($setting_info->admin_panel_name)}}</strong><br />
                        {{$setting_info->company_address}}<br />
                        {{$setting_info->company_city}}, {{$setting_info->company_state}} {{$setting_info->company_zipcode}}
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block address-block clearfix">
                    <h3>EMAIL</h3>
                    <p><a href="mailto:{{$setting_info->email}}">{{$setting_info->email}}</a></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="block address-block clearfix">
                    <h3>PHONE</h3>
                    <p><a href="tel:{{$setting_info->phone}}">{{$setting_info->phone}}</a></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="block contact-form clearfix">
                    <form class="pb-5 mb-5 bv-form" action="controllers/contact.php" method="post" id="contact_form" novalidate="novalidate">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">FIRST NAME AND LAST NAME</label>
                                <input type="text" name="name" id="name" placeholder="" class="form-control" data-bv-field="name" />
                                <small data-bv-validator="stringLength" data-bv-validator-for="name" class="help-block" style="display: none;">This value is not valid</small>
                                <small data-bv-validator="notEmpty" data-bv-validator-for="name" class="help-block" style="display: none;">Please enter name</small>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">EMAIL</label>
                                <input type="text" name="email" id="email" placeholder="" class="form-control" data-bv-field="email" />
                                <small data-bv-validator="notEmpty" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter email address</small>
                                <small data-bv-validator="emailAddress" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter valid email address</small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="subject">SUBJECT</label>
                            <input type="text" name="subject" id="subject" placeholder="" class="form-control" data-bv-field="subject" />
                            <small data-bv-validator="notEmpty" data-bv-validator-for="subject" class="help-block" style="display: none;">Please enter your subject</small>
                        </div>
                        <div class="form-group">
                            <label for="message">MESSAGE</label>
                            <textarea name="message" id="message" placeholder="" class="form-control" rows="3" data-bv-field="message"></textarea>
                            <small data-bv-validator="notEmpty" data-bv-validator-for="message" class="help-block" style="display: none;">Please enter your message</small>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-primary mt-md-5 float-right">SEND MESSAGE</button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <input type="hidden" name="submit_form" id="submit_form" />
                        <input type="hidden" value="" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include('user.include.section.footer')
@include('include.footer')