<form method="POST" class="form p-2 px-3 position-relative" id="permissionForm">
    <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
    <div class="form-group py-2">
        @foreach ($permissions as $title => $permission)
            <div class="list-group mb-3">
                <div type="button" class="list-group-item text-start active view-permission">{{ ucwords($title) }}</div>
                @foreach ($permission as $access => $value)
                    <div class="list-group-item text-start">Able to <strong>{{ ucwords($access) }}</strong></div>
                @endforeach
            </div>
        @endforeach
    </div>
</form>