<div class="row content p-0 m-0 d-none" id="sitemapSettings">
    <div class="tab-content">   
            {{-- <h3><span class="me-2" style="font-size: 22px"><i class="bi bi-diagram-2"></i></span>Sitemap (XML) File for SEO</h3> --}}
            <form method="POST" class="col-lg-6 form position-relative" id="sitemapForm">
               <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
               {{-- @if (Storage::exists($setting_info->sitemap_location))
                   <div class="form-group">
                       <input type="text" readonly class="form-control form-control-sm" value="sitemap.xml">
                   </div>
               @endif --}}
               <div class="form-group">
                    <label class="form-label" for="customFile" class="col-form-label">Upload Sitemap(XML) File</label><small class="mx-1 text-danger"></small>
                    <input type="file" name="sitemapfile" class="form-control form-control-sm" id="sitemapFile" file="true" />
               </div>
                {{-- <div class="form-group py-2">
                    <button type="submit" class="btn">Upload</button>
                </div> --}}
            </form>
    </div>
</div>