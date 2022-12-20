<div class="row content p-0 m-0" id="basicTab">
    <div class="tab-content">
        <form method="POST" class="form py-1 position-relative add-element-container" id="profileForm">
            <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
            <div class="form-group col-lg-6 py-2">
                <label for="" class="form-label">Username</label><small class="mx-1 text-danger"></small>
                <input type="text" name="username" class="form-control form-control-sm exept" value="{{ $profile->username }}">
            </div>
            <div class="form-group col-lg-6 py-2">
                <label for="" class="form-label">Email</label><small class="mx-1 text-danger"></small>
                <input type="email" name="email" class="form-control form-control-sm exept" value="{{ $profile->email }}">
            </div>
            <div class="form-group col-lg-6 py-2">
                <label for="" class="form-label">Change Password</label><small class="mx-1 text-danger"></small>
                <input type="password" id="changePassword" name="newpassword" class="form-control form-control-sm">
            </div>
            <div class="form-group col-lg-6 py-2">
                <label for="" class="form-label">Retype Password</label><small class="mx-1 text-danger"></small>
                <input type="password" id="retypePassword" name="" class="form-control form-control-sm">
            </div>
        </form>
    </div>
</div>
