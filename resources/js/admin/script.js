$(document).ready(function() {
    token = $('meta[name=token]').attr('value');
    $('#showProfileBtn').on('click', Profile.show);
    $('#settingsBtn').on('click', Settings.page);
    $('.btn.btn-search-link').on('click', Settings.searchLink);
    //======================================
    $(this).on('click', 'th .check-all', Action.selectAll);
    $(this).on('change', '.data-row .multi-check', Action.selected);
    // $(this).on('change', '.check-row', Action.checkRow);

    //======================================
    $(this).on('click', '.navbar-nav.settings a:not(.export-import)', Settings.clikingSideMenu);
    //======================================
    // $(this).on('submit', '#companyDetailsForm', Settings.updateCompany);
    // $(this).on('submit', '#emailForm', Settings.updateEmail);
    // $(this).on('submit', '#socialForm', Settings.updateSocial);
    // $(this).on('submit', '#smsForm', Settings.updateSMS);
    // $(this).on('submit', '#blogForm', Settings.updateBlog);
    // $(this).on('submit', '#homepageForm', Settings.updateHomepage);
    // $(this).on('submit', '#shippingAPIForm', Settings.updateShippingAPI);
    // $(this).on('submit', '#captchaForm', Settings.updateCaptcha);
    // $(this).on('submit', '#menuTypeForm', Settings.updateMenuType);
    // $(this).on('submit', '#sitemapForm', Settings.updateSitemap);
    // $(this).on('submit', '#generalForm', Settings.updateGeneral);
    $(this).on('click', '.btn-submit-settings', Settings.update);
    $(this).on('click', '.btn-submit-profile', Profile.update);

    //======================================
    $(this).on('click', 'button.row-remove', Action.remove);
    $(this).on('click', 'button.row-update-status', Action.status);
    $(this).on('click', 'button.row-publish', Action.publish);
    $(this).on('click', 'button.row-edit', Action.edit);
    $(this).on('click', 'button.row-pricing', Action.editPrice);
    $(this).on('click', 'button.row-restore', Action.restore);
    $(this).on('click', '.btn.order-save', Action.bulkOrderSave);
    $(this).on('click', '.btn.bulk-remove', Action.bulkRemove);
    $(this).on('click', '.btn.bulk-restore', Action.bulkRestore);
    $(this).on('click', '.btn.btn-search', Action.tableReload);
    $(this).on('change', '#search', function(e) {
        if ($(this).val() === '') Action.tableReload();
    })

    // //======================================
    // if ($('#brandTable').length) { //brand page
    //   $(this).on('submit', '#addBrandForm', Brand.add);
    //   Brand.loadTable();
    // }
    //======================================
    $(this).on('change', '#logoSetting', Image.change);

    //======================================
    $(this).on('click', '.view-invoice', Action.viewInvoice);
    $(this).on('click', '.view-message', Action.viewMessage);
    $(this).on('click', '.view-sms', Action.viewSMS);
    $(this).on('click', '.email.view-details', Action.viewDetails);

    //======================================
    $(this).on('click', 'button.btn-add', Action.add);
    $(this).on('click', '.btn.cancel', Action.cancel);

    //======================================
    $(this).on('blur', '#retypePassword', Profile.passwordMatching);

    $(this).on('click', '.export-data', Exporting.data);
    $(this).on('click', '.import-data', Importing.openFileForm);
    $(this).on('click', '.btn-import-csv', Importing.data);

    //pageclass
    AppDashboard.onLoad();
    AppBrand.onLoad();
    AppCategory.onLoad();
    AppDevice.onLoad();
    AppModel.onLoad();
    AppOrder.onLoad();
    AppCustomer.onLoad();
    AppEmail.onLoad();
    AppBlog.onLoad();
    AppEmailTemplate.onLoad();
    AppFaq.onLoad();
    AppForm.onLoad();
    AppMenu.onLoad();
    AppPage.onLoad();
    AppPromo.onLoad();
    AppStaff.onLoad();
    AppStarbukLocation.onLoad();

    // alert($('.dataTables_length').length);
    $('.dataTables_filter').html(`
        <div class="row justify-content-end">
            <div class="col-xl-8">
                <div class="input-group input-group-sm">
                    <input type="search" id="search" class="form-control form-control-sm" placeholder="Search">
                    <div class="input-group-append">
                        <button class="btn btn-prepend btn-search" type="button">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>`);
});

$(document).ajaxComplete(function(result) {
    $('[data-toggle="tooltip"]').tooltip()
})