const mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    // .postCss('resources/css/front.css', 'public/css/front.css', [
    //     require('tailwindcss')
    // ])
    .css('resources/css/admin/index.css', 'public/css/admin.css')
    .css('resources/css/user/index.css', 'public/css/user.css')
    .scripts([
        'resources/js/admin/define-classes.js',
        'resources/js/admin/script.js',
        'resources/js/admin/brand.js',
        'resources/js/admin/categories.js',
        'resources/js/admin/customers.js',
        'resources/js/admin/dashboard.js',
        'resources/js/admin/devices.js',
        'resources/js/admin/email-templates.js',
        'resources/js/admin/email.js',
        'resources/js/admin/faqs.js',
        'resources/js/admin/forms.js',
        'resources/js/admin/menus.js',
        'resources/js/admin/models.js',
        'resources/js/admin/orders.js',
        'resources/js/admin/pages.js',
        'resources/js/admin/profile.js',
        'resources/js/admin/promo.js',
        'resources/js/admin/staffs.js',
        'resources/js/admin/starbuck-locations.js',
        'resources/js/admin/blogs.js',
    ], 'public/js/admin.js')
    .scripts([
        'node_modules/jquery/dist/jquery.js',
        'node_modules/@popperjs/core/dist/umd/popper.min.js',
        'node_modules/bootstrap/dist/js/bootstrap.min.js',
        // 'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
        'node_modules/chart.js/dist/chart.js',
        'node_modules/datatables.net/js/jquery.dataTables.min.js',
        // 'node_modules/tailwindcss/lib/index.js',
        'node_modules/bootbox/dist/bootbox.min.js',
        'resources/js/admin/dataTables.bootstrap5.min.js',
        'resources/js/ckeditor/build/ckeditor.js',
    ], 'public/js/library.js')
    .scripts([
        'resources/js/user/anim_button.js',
        'resources/js/user/bootstrapvalidator.min.js',
        'resources/js/user/jquery.matchHeight-min.js',
        'resources/js/user/jquery.autocomplete.min.js',
        'resources/js/user/intlTelInput.js',
        'resources/js/user/script.js',
    ], 'public/js/user.js')


mix.disableSuccessNotifications();
// import 'jquery/src/jquery';
// // import 'propper';
// // import 'bootstrap/dist/js/bootstrap';
// // import 'chart.js/dist/chart';