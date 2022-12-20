@include('include.header')
@include('include.menu')

<section>
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="block head pb-0 mb-0 border-line text-center clearfix">
                <h1 class="h1 border-line clearfix">WHAT OUR CUSTOMERS SAID ABOUT US</h1>
             </div>
          </div>
       </div>
       <div class="row">
          <div class="col-md-12">
             <div class="block content clearfix">
                <div class="row">
                   <div class="col-md-7">
                      <div class="review-list clearfix">
                         <h3>Reviews</h3>
                         <div class="reviews-block clearfix">
                            <div class="review-star-block clearfix">
                               <p><span class="rating-star clearfix">
                                  <a href="#"><i class="fas fa-star"></i></a><a href="#"><i class="fas fa-star"></i></a><a href="#"><i class="fas fa-star"></i></a><a href="#"><i class="fas fa-star"></i></a><a href="#"><i class="fas fa-star"></i></a>	</span>
                                  iPhone X	
                               </p>
                               <h4><strong>Emily Reagan (San Marcos, Texas)</strong> July 22, 2019</h4>
                               <h5>I met up with one of their representatives at a local Starbuck. He was very cautious and was on time. This company gave me the highest offer for my phone. I will be doing business with you again in the future.</h5>
                            </div>
                         </div>
                         <div class="reviews-block clearfix">
                            <div class="review-star-block clearfix">
                               <p><span class="rating-star clearfix">
                                  <a href="#"><i class="fas fa-star"></i></a><a href="#"><i class="fas fa-star"></i></a><a href="#"><i class="fas fa-star"></i></a><a href="#"><i class="fas fa-star"></i></a><a href="#"><i class="fas fa-star"></i></a>	</span>
                                  iPhone 7 Plus	
                               </p>
                               <h4><strong>Justin Long (Austin, Texas)</strong> July 22, 2019</h4>
                               <h5>These guys are who they say they are! The best part is; they offer the highest price you can get around and the pay fast! it was a pleasure doing business with you, MacMetro.com.</h5>
                            </div>
                         </div>
                      </div>
                   </div>
                   <div class="col-md-5">
                      <div class="block contact-form review-form clearfix">
                         <h3>Write a review</h3>
                         <form action="controllers/review_form.php" class="pb-5 mb-5 bv-form" method="post" id="review_form" enctype="multipart/form-data" novalidate="novalidate">
                            <div class="form-group">
                               <label for="name">NAME</label>
                               <input type="text" name="name" id="name" class="form-control" data-bv-field="name">
                               <small data-bv-validator="stringLength" data-bv-validator-for="name" class="help-block" style="display: none;">This value is not valid</small><small data-bv-validator="notEmpty" data-bv-validator-for="name" class="help-block" style="display: none;">Please enter your name</small>
                            </div>
                            <div class="form-group">
                               <label for="email">EMAIL</label>
                               <input type="email" name="email" id="email" class="form-control" data-bv-field="email">
                               <small data-bv-validator="notEmpty" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter your email address</small><small data-bv-validator="emailAddress" data-bv-validator-for="email" class="help-block" style="display: none;">Please enter your valid email address</small>
                            </div>
                            <div class="form-group">
                               <label for="phone">Phone</label>
                               <input type="tel" name="phone" id="phone" class="form-control" data-bv-field="phone">
                               <small data-bv-validator="stringLength" data-bv-validator-for="phone" class="help-block" style="display: none;">This value is not valid</small><small data-bv-validator="notEmpty" data-bv-validator-for="phone" class="help-block" style="display: none;">Please enter your phone</small>
                            </div>
                            <div class="form-row">
                               <div class="form-group col-md-4">
                                  <label for="city">City</label>
                                  <input type="text" name="city" id="city" class="form-control" data-bv-field="city">
                                  <small data-bv-validator="stringLength" data-bv-validator-for="city" class="help-block" style="display: none;">This value is not valid</small><small data-bv-validator="notEmpty" data-bv-validator-for="city" class="help-block" style="display: none;">Please enter your city</small>
                               </div>
                               <div class="form-group col-md-4">
                                  <label for="state">STATE</label>
                                  <input type="text" name="state" id="state" class="form-control" data-bv-field="state">
                                  <small data-bv-validator="stringLength" data-bv-validator-for="state" class="help-block" style="display: none;">This value is not valid</small><small data-bv-validator="notEmpty" data-bv-validator-for="state" class="help-block" style="display: none;">Please enter your state</small>
                               </div>
                               <div class="form-group col-md-4">
                                  <label for="zip_code">ZIP CODE</label>
                                  <input type="text" class="form-control" name="zip_code" id="zip_code" data-bv-field="zip_code">
                                  <small data-bv-validator="stringLength" data-bv-validator-for="zip_code" class="help-block" style="display: none;">This value is not valid</small><small data-bv-validator="notEmpty" data-bv-validator-for="zip_code" class="help-block" style="display: none;">Please enter your zip code</small>
                               </div>
                            </div>
                            <div class="form-group">
                               <label for="device_sold">DEVICE SOLD</label>
                               <input type="text" class="form-control" name="device_sold" id="device_sold" data-bv-field="device_sold">
                               <small data-bv-validator="notEmpty" data-bv-validator-for="device_sold" class="help-block" style="display: none;">Please enter your device sold</small>
                            </div>
                            <div class="form-group">
                               <label for="stars">RATING</label>
                               <select name="stars" id="stars" class="form-control" data-bv-field="stars">
                                  <option value=""> - Rating Star - </option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                               </select>
                               <small data-bv-validator="notEmpty" data-bv-validator-for="stars" class="help-block" style="display: none;">Please select rating star</small>
                            </div>
                            <div class="form-group">
                               <label for="content">COMMENT</label>
                               <textarea class="form-control" id="content" name="content" rows="3" data-bv-field="content"></textarea>
                               <small data-bv-validator="notEmpty" data-bv-validator-for="content" class="help-block" style="display: none;">Please enter your content</small>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-primary float-right">SUBMIT</button>
                            <input type="hidden" name="submit_form" id="submit_form">
                            <input type="hidden" value="">
                         </form>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>

@include('include.footer-page')
@include('include.footer')