@include('include.header')
@include('include.menu')

<section id="tracking" style="margin-top: 0.1px">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="block head pb-0 mb-0 border-line text-center clearfix">
                <h1 class="h1 border-line clearfix">Tracking System</h1>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-6">
             <div class="block tracking-text-block clearfix">
                <h2>What is my offer status?</h2>
                <p>Use our unique tracking system to monitor the progress of your offer.</p>
                <p>Enter the email address used at checkout and your offer number to see the status of your offer.</p>
             </div>
          </div>
          <div class="col-md-6">
             <div class="block tracking-form clearfix">
                <form action="controllers/order_track.php" method="post" id="contact_form" novalidate="novalidate" class="bv-form">
                   <div class="form-group">
                      <label class="text-uppercase" for="exampleInputEmail1">Email</label>
                      <input type="email" name="email" id="email" class="form-control" value="" data-bv-field="email">
                      <small data-bv-validator="notEmpty" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter email address</small><small data-bv-validator="emailAddress" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter valid email address</small>
                   </div>
                   <div class="form-group">
                      <label class="text-uppercase" for="exampleInputEmail1">Order number</label>
                      <input type="text" name="order_id" id="order_id" class="form-control" data-bv-field="order_id">
                      <small data-bv-validator="notEmpty" data-bv-validator-for="order_id" class="help-block" style="display: none;">Please enter order id</small>
                   </div>
                   <button type="submit" class="btn btn-primary">TRACK</button>
                   <input type="hidden" name="submit_form" id="submit_form">
                   <input type="hidden" value="">
                </form>
             </div>
          </div>
       </div>
    </div>
 </section>


@include('include.footer-page')
@include('include.footer')