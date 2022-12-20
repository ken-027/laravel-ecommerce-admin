@include('include.header')
@include('include.menu')
<section class="blog clearfix">
  <div class="container-fluid">
     <div class="row">
        <div class="col-md-9">
           <div class="block heading page-heading">
              <h1><strong>Blog of Wer.Org</strong></h1>
           </div>
@foreach ($get_post as $post)
<?php $category = []; ?>
          <div class="block clearfix">
              <img src="/assets{{ $post->image_path }}" alt="">
              <h1 class="h3"><a href="/blog/{{ Crypt::encryptString($post->blog_id) }}">{{ $post->title }}</a></h1>
              <div class="blog-credits">Posted on <span class="date">{{ date('jS F Y g:i a', strtotime($post->date_posted)) }}</span> in 
   @foreach ($get_post_cat_by_blog as $key => $get_cat)
      @if ($get_cat->blog_id == $post->blog_id)
            <?php $category[] = $get_cat->name ?>
      @endif
   @endforeach
   @foreach ($category as $key => $cat)
      <a href="/blog/category/{{ $cat }}">{{ $cat }}</a>@if ($key +1 != count($category)), @endif
   @endforeach
              </div>
              <p>{{ $post->description }}</p>
              <p><a href="/blog/{{ Crypt::encryptString($post->blog_id) }}">Read More</a></p>
           </div>
@endforeach
           <div class="row">
              <div class="col-md-8"></div>
              <div class="col-md-4">
                 <select class="custom-select" name="pagination_limit" id="pagination_limit" onchange="window.open(this.options[this.selectedIndex].value, '_top');">
                    <option value="/blog?pagination_limit=5">5</option>
                    <option value="/blog?pagination_limit=10" selected="selected">10</option>
                    <option value="/blog?pagination_limit=15">15</option>
                    <option value="/blog?pagination_limit=20">20</option>
                    <option value="/blog?pagination_limit=25">25</option>
                    <option value="/blog?pagination_limit=50">50</option>
                    <option value="/blog?pagination_limit=100">100</option>
                    <option value="/blog?pagination_limit=200">200</option>
                    <option value="/blog?pagination_limit=500">500</option>
                 </select>
              </div>
           </div>
        </div>
@include('sub-pages.blog.recent')
     </div>
  </div>
</section>

@include('include.footer-page');
@include('include.footer')
