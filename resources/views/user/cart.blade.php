@include('include.header')
@include('user.include.menu')
<section id="content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="block content mt-5 clearfix">
                    <div class="block cart-page clearfix">
                        <h1 class="text-center">Here's Your Cart</h1>
                        <div class="block head cart-saerch-page mt-0 pt-0 text-center clearfix">
                            <div class="h2 mb-4">Your Cart is Empty</div>
                            <form class="form-inline" action="search" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control srch_list_of_model" name="search" id="staticEmail2" placeholder="Search device here" required="" autocomplete="off" />
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </form>
                            <div class="h2 text-center pt-3 pb-3">OR</div>
                            <a href="device-type-or-brand" class="btn btn-primary btn-lg pl-5 pr-5">CHOOSE YOUR DEVICE TYPE OR BRAND</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include('user.include.section.footer')
@include('include.footer')