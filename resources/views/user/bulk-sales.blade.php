@include('include.header')
@include('user.include.menu')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="block head pb-0 mb-0 border-line text-center clearfix">
                    <h1 class="h1 border-line clearfix">BULK SALES</h1>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="block content bulk-sale-form text-center clearfix">
                    <h3>DO YOU HAVE 10 OR MORE DEVICES YOU WOULD LIKE TO SELL?</h3>
                    <h4>Kindly fill out the information below and our representative will reach out to you shortly.</h4>
                    <form class="pb-5 mb-5 bv-form" action="controllers/bulk_order_form.php" method="post" id="bulk_order_form" novalidate="novalidate">
                        <div class="form-group">
                            <label for="name">NAME</label>
                            <input type="text" name="name" id="name" placeholder="" class="form-control" data-bv-field="name" />
                            <small data-bv-validator="stringLength" data-bv-validator-for="name" class="help-block" style="display: none;">This value is not valid</small>
                            <small data-bv-validator="notEmpty" data-bv-validator-for="name" class="help-block" style="display: none;">Please enter your name</small>
                        </div>
                        <div class="form-group">
                            <label for="email">EMAIL</label>
                            <input type="text" name="email" id="email" placeholder="" class="form-control" data-bv-field="email" />
                            <small data-bv-validator="notEmpty" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter your email address</small>
                            <small data-bv-validator="emailAddress" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter your valid email address</small>
                        </div>
                        <div class="form-group">
                            <label for="phone">PHONE</label>
                            <input type="text" name="phone" id="phone" placeholder="" class="form-control" data-bv-field="phone" />
                            <small data-bv-validator="stringLength" data-bv-validator-for="phone" class="help-block" style="display: none;">This value is not valid</small>
                            <small data-bv-validator="notEmpty" data-bv-validator-for="phone" class="help-block" style="display: none;">Please enter your phone</small>
                        </div>
                        <div class="form-group">
                            <label for="company_name">COMPANY (if APPLICABLE)</label>
                            <input type="text" name="company_name" id="company_name" placeholder="" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="content">COMMENT</label>
                            <textarea name="content" class="form-control" rows="3" data-bv-field="content"></textarea>
                            <small data-bv-validator="notEmpty" data-bv-validator-for="content" class="help-block" style="display: none;">Please enter your message</small>
                        </div>
                        <div class="clearfix"></div>
                        <button type="submit" class="btn btn-primary float-right">SUBMIT</button>
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