<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="locationModalLabel"><strong>STARBUCKS COFFEE SHOPS</strong></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                @foreach (App\Models\Admin\StarbuckLocation::get_all() as $location)                   
                    <p class="text-center address">
                        <strong>{{$location->name}}</strong><br />
                        {{$location->address}}<br />
                        <a class="btn btn-primary" href="{{$location->map_link}}" target="_blank">GET DIRECTIONS</a>
                    </p>
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
