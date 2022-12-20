const brandChart = document.querySelectorAll("#brandChart");
const modelChart = document.querySelectorAll("#modelChart");
// var termsConditionEditor, procesWordEditor, offerPopupContent;
var formEditor = [],
    formEditorClone = [];
var token = '';
var passMatch = false;
var page = '',
    table = '',
    url = '';

class Image {
    static change() {
        // logo.on('change', function(e){
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            var divNext = $(this).parent('div').next('div');
            var displayImage = divNext.find('img');

            divNext.removeClass('d-none')
            reader.onload = function(e) {
                displayImage.attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
        // })
    }
}

class Profile {
    static show() {
        $.ajax({
            url: '/admin/profile/form/edit',
            async: false,
            success: function(res) {
                var myProfile = bootbox.dialog({
                    className: 'dialog-profile dialog',
                    title: 'Profile',
                    size: 'lg',
                    message: res.response,
                    closeButton: false,
                    callback: function(e) {
                        console.log(e);
                        console.log(mysetting);
                    }
                });
            }
        })
    }

    static passwordMatching() {
        if ($(this).val() === $('#changePassword').val()) {
            passMatch = true;
            $(this).removeClass('error').prev('small').text('');
        } else {
            passMatch = false;
            $(this).addClass('error').prev('small').text('password not matched!');
        }
    }

    static update(e) {
        e.preventDefault();

        if ($('#changePassword').val() !== '')
            if ($('#changePassword').val() !== $('#retypePassword').val()) return;

        var form = $('#profileForm');
        var id = $('#formAddEdit.profile').data('id');
        $.ajax({
            type: 'POST',
            url: '/admin/profile/update',
            data: form.serialize() + '&id=' + id + '&_token=' + token,
            error: Action.errorForm,
            // success: Action.successForm
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success alert-danger');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    $('.btn.cancel').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                }
                message.text(res.response.message);

                if (res.response.is_password_change)
                    setTimeout(function() {
                        window.location.href = res.response.redirect_url;
                    }, 3000);
            }
        });
    }
}

class EditorCke {
    static load() {
        $('.ckeEditor').not('.cloned').each(function(key, val) {
            var key = key;
            var val = val;
            ClassicEditor
                .create(this, {
                    // .create( document.querySelector( '.ckeEditor' ), {
                    licenseKey: '',
                }).then(editor => {
                    // console.log( 'Editor was initialized', editor );
                    formEditor[key] = editor;
                });
        });
    }

    static loadCloned() {
        $('.ckeEditor.cloned').each(function(key, val) {
            var key = key;
            var val = val;
            $(this).parent('.editor-container').children('div').remove();
            ClassicEditor
                .create(this, {
                    // .create( document.querySelector( '.ckeEditor' ), {
                    licenseKey: '',
                }).then(editor => {
                    // console.log( 'Editor was initialized', editor );
                    // formEditor[key] = editor;
                });
        });
    }

    static loadClone() {
        var element = $('.ckeEditor.cloned');
        var index = element.length - 1;

        // element.parent('.editor-container').find('textarea.ckeEditor.cloned').remove();
        element.eq(index).parent('.editor-container').children('div').remove()

        ClassicEditor
            .create(element[index], {
                // .create( document.querySelector( '.ckeEditor' ), {
                licenseKey: '',
            }).then(editor => {
                // console.log( 'Editor was initialized', editor );
                // element.parent('.editor-container').child('div').remove()
                formEditorClone[index] = editor;
            });
        // $('.ckeEditor.cloned').each(function(key, val) {
        //     var key = key;
        //     var val = val;
        //     ClassicEditor
        //         .create(this, {
        //             // .create( document.querySelector( '.ckeEditor' ), {
        //             licenseKey: '',
        //         }).then(editor => {
        //             formEditorClone[key] = editor;
        //         });
        // })
    }
}

class Settings {
    static clikingSideMenu() {
        $('.navbar-nav.settings a').removeClass('active');
        $(this).addClass('active');
        // $('.content').addClass('d-none');
        // $('.content').addClass('d-none');
        $('.content').slideUp('slow');
        // console.log('#' + $(this).data('content'));
        $("#setting").scrollTop($("#" + $(this).data('content')).position().top)
            // $("#settingForms").scrollTop($("#" + $(this).data('content')).position().top)
        $('#' + $(this).data('content')).removeClass('d-none');
        $('#' + $(this).data('content')).slideDown('slow');
    }

    static page() {
        // var message;
        $.ajax({
            url: '/admin/settings/form/edit',
            // data: { id: $(this).data('id') },
            async: false,
            success: function(res) {
                var mysetting = bootbox.dialog({
                    className: 'dialog-settings dialog',
                    title: 'Settings',
                    size: 'lg',
                    message: res.response,
                    closeButton: false,
                    callback: function(e) {
                        console.log(e);
                        console.log(mysetting);
                    }
                });
                // table.DataTable().draw;
                EditorCke.load();
            }
        });

    }

    static searchLink() {
        // var message;
        $.ajax({
            url: '/admin/settings/page-links/get',
            data: {
                _token: token,
                search: $('#searchLink').val(),
            },
            async: false,
            success: function(res) {
                var list = `<div class="text-center">${ $('#searchLink').val() } not exist!</div>`;

                // console.log(res.response.filtered);
                if (res.response.filtered.length) list = '';
                res.response.filtered.forEach(function(filter) {
                    list += `<div class="item px-2 d-flex border-separator"><a class="open-link dropdown-item" href="${ filter.link }">${ filter.title }</a></div>`;
                });
                // console.log(list);
                $('.pagelink-container').html(list);
            }
        });

    }

    static update(e) {
        e.preventDefault();
        var form = $('#generalForm');
        var newformData = new FormData(document.getElementById("generalForm"));
        var logo = $('#logoSetting')[0].files;
        var sitemap = $('#sitemapFile')[0].files;

        newformData.append('id', $('#formAddEdit.settings').data('id'))
        newformData.append('logosetting', logo[0]);
        newformData.append('sitemapfile', sitemap[0]);
        newformData.append('_token', token);
        // newformData.append('id', $('#settingForms').data('id'));
        newformData.append('termsconditions', formEditor[0].getData());
        newformData.append('processworksandslider', formEditor[1].getData());
        newformData.append('offerpopupcontent', formEditor[2].getData());

        $('#generalForm, #companyDetailsForm, #emailForm, #socialForm, #smsForm, #blogForm, #homepageForm, #shippingAPIForm, #sitemapForm, #captchaForm, #menuTypeForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: '/admin/settings/update',
            data: newformData,
            //   data: newformData + '&id=' + $('#settingForms').data('id') + '&_token=' + token,
            error: Action.errorForm,
            success: Action.successForm
        })
    }
}

class Importing {
    static openFileForm() {
        var url = $(this).data('url');
        var addForm = bootbox.dialog({
            className: 'dialog import-file',
            title: 'Import File',
            size: 'md',
            closeButton: false,
            message: `
            <div class="container-fluid m-0 p-0 col-12 import-dialog-form">
                <div class="row m-0 p-0 h-100">
                    <div class="col-2 p-0 m-0 h-100">
                        <ul class="navbar-nav settings bg-main m-0 p-0 pb-2 h-100 position-relative">
                            <li class="">
                                <a class="nav-link px-3 active" data-content="csvTab">
                                    <span>Import</span>
                                </a>
                            </li>
                            <li class="action-button mb-1">
                                <div class="form-group col-12">
                                    <div class="col-12 p-1">
                                        <button type="submit" class="btn col-12 btn-import-csv" data-url="${url}">Import</button>
                                    </div>
                                    <div class="col-12 p-1">
                                        <button type="button" class="btn cancel col-12">Cancel</button>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-10 tab-content settings px-0 h-100 form-add-edit" id="" style="overflow-x: hidden" data-formtype="" data-id="">
                        <div class="row content p-0 m-0" id="csvTab">
                            <div class="tab-content">
                                <form method="POST" class="form py-1 position-relative add-element-container" id="csvForm">
                                    <div class="alert d-none text-center position-sticky top-0 w-100" role="alert"></div>
                                    <div class="form-group py-2 col-lg-12">
                                        <label class="form-label" for="customFile">Select CSV File</label><small class="mx-1 text-danger"></small>
                                        <input type="file" name="csvfile" accept=".csv" class="form-control form-control-sm" id="csvFinder" file="true">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `,
            // onEscape: function(result) {
            //   if ()
            // }
        });
    }

    static data(e) {
        e.preventDefault();
        var newformData = new FormData();
        var url = $(this).data('url');
        var files = $('#csvFinder')[0].files;
        console.log(url);

        newformData.append('csvfile', files[0]);
        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url,
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }
}

class Exporting {
    static data() {
        var url = $(this).data('url');
        var type = $(this).data('type');
        var files = $(this).data('files');

        switch (files) {
            case 'awaiting-order':
            case 'paid-order':
                Exporting.awaitingOrder(url, type); //also use it in paid
                break;

            case 'unpaid-order':
            case 'archive-order':
                Exporting.unpaidOrder(url, type); //also use it in archive
                break;

            case 'models':
                Exporting.models(url, type); //also use it in archive
                break;

            case 'models-pricelist':
                Exporting.modelsPricelist(url, type); //also use it in archive
                break;

            default:
                break;
        }
    }

    static modelsPricelist(url, type) {
        var id = $('#formAddEdit.pricing-list').data('id');

        window.location.href = `${url}?type=${type}&id=${id}`;

    }

    static models(url, type) {
        var search = $('#search').val();
        var category = $('#categoryFilter').val();
        var brand = $('#brandFilter').val();
        var device = $('#deviceFilter').val();

        window.location.href = `${url}?type=${type}&search=${search}&category=${category}&brand=${brand}&device=${device}`;

    }

    static awaitingOrder(url, type) {
        var datefrom = $('#orderDateFromFilter').val();
        var dateto = $('#orderDateToFilter').val();
        var paymentmethod = $('#paymentMethodFilter').val();
        var search = $('#search').val();

        window.location.href = `${url}?type=${type}&search=${search}&datefrom=${datefrom}&dateto=${dateto}&paymentmethod=${paymentmethod}`;
    }

    static unpaidOrder(url, type) {
        var datefrom = $('#orderDateFromFilter').val();
        var dateto = $('#orderDateToFilter').val();
        var paymentmethod = $('#paymentMethodFilter').val();
        var search = $('#search').val();
        var status = $('#statusFilter').val();

        window.location.href = `${url}?type=${type}&status=${status}&search=${search}&datefrom=${datefrom}&dateto=${dateto}&paymentmethod=${paymentmethod}`;
    }
}


class Validation {
    static error(errorList) {
        // var validated = res.responseJSON.errors;
        var message = $('form .alert');
        message.removeClass('d-none alert-warning alert-success alert-danger');
        setTimeout(function() {
            message.addClass('d-none');
        }, 5000); // hide in 5 seconds

        message.addClass('alert-danger');
        message.text('There is required field(s) to fill');

        Object.keys(errorList).forEach(function(item) {
            // console.log(item + ' - ' + errorList[k]);
            $('input[name=' + item + '], select[name=' + item + '], textarea[name=' + item + ']').addClass('error').prev('small').text(errorList[item]);
        });
    }

    static clearErrors() {
        $('input, select, textarea').removeClass('error').prev('small').text('');
    }

    static clearFields() {
        $('form').find('input, textarea', function() {
            $(this).val('');
            $(this).text('');
        });
        bootbox.hideAll();
    }
}

class Action {
    static multiSelect() {
        if ($(this).parent('.multi-select').length == 0) return;
        $(this).toggleClass('active');
    }

    static cloneElement() {
        var container = $(this).parent('div').prev('.add-element-container').find('.cloning-container');
        if (container == 0) return;
        console.log(container);
        container.eq(container.find('.cloning-container').length - 1).clone(true).appendTo($(this).parent('div').prev('.add-element-container'))
        EditorCke.loadClone();
    }

    static removecloned() {
        if ($(this).parents('.add-element-container').find('.cloning-container').length <= 1) return;
        $(this).parents('.cloning-container').remove();
    }

    static edit() {
        var url = $(this).data('url');
        var title = $(this).data('title');
        var id = $(this).parents('tr').attr('data-id');

        console.log(id);
        $.ajax({
            url: url,
            async: false,
            data: {
                _token: token,
                id: id
            },
            success: function(res) {
                console.log(res);
                var addForm = bootbox.dialog({
                    className: 'dialog',
                    title: title,
                    size: 'lg',
                    message: res.response,
                    closeButton: false,
                    // onEscape: function(result) {
                    //   if ()
                    // }
                });

                EditorCke.load();
                EditorCke.loadCloned();
            }
        })
    }

    static editByCol() {
        var url = $(this).data('url');
        var title = $(this).data('title');
        var id = $(this).data('id');

        console.log(id);
        $.ajax({
            url: url,
            async: false,
            data: {
                _token: token,
                id: id
            },
            success: function(res) {
                console.log(res);
                var addForm = bootbox.dialog({
                    className: 'dialog',
                    title: title,
                    size: 'lg',
                    message: res.response,
                    closeButton: false,
                    // onEscape: function(result) {
                    //   if ()
                    // }
                });

                EditorCke.load();
                EditorCke.loadCloned();
            }
        })
    }

    static previewPDF() {
        // var url = $(this).data('url');
        var title = $(this).data('title');
        // var id = $(this).data('id');

        // console.log(id);
        // $.ajax({
        //     url: url,
        //     async: false,
        //     data: {
        //         _token: token,
        //         id: id
        //     },
        //     success: function(res) {
        //         console.log(res);
        var element = '<embed class="pdf-viewer-container" " ' +
            'src="https://demo10.macmetro.com/shipment_labels/Shipping-Label-MM20244.pdf#toolbar=1"' +
            'width="100%"' +
            'height="400">' +
            // var element = '<iframe src="https://demo10.macmetro.com/shipment_labels/Shipping-Label-MM20244.pdf" style="width:100%; height:500px;" frameborder="0">' +
            //     '</iframe>' +
            '';
        var addForm = bootbox.dialog({
            className: 'dialog',
            title: title,
            size: 'md',
            message: element,
            // onEscape: function(result) {
            //   if ()
            // }
        });

        //         EditorCke.load();
        //         EditorCke.loadCloned();
        //     }
        // })
    }

    // static edit() {
    //     $('button.row-edit').each(function(e){
    //         $(this).on('click', function(e){
    //             console.log($(this).parents('tr').attr('data-id'));
    //             table.DataTable().ajax.reload();
    //           });
    //     });
    // }

    static add() {
        var url = $(this).data('url');
        var title = $(this).data('title');
        $.ajax({
            url: url,
            async: false,
            success: function(res) {
                console.log(res);
                var addForm = bootbox.dialog({
                    className: 'dialog',
                    title: title,
                    size: 'lg',
                    message: res.response,
                    closeButton: false,
                    // onEscape: function(result) {
                    //   if ()
                    // }
                });

                EditorCke.load();
                EditorCke.loadCloned();
                // EditorCke.loadCloned();
            }
        })
    }

    static selected() {
        $(this).parent('tr').toggleClass('selected');
    }

    static editPrice() {
        var title = $(this).data('title');
        var id = $(this).parents('tr').attr('data-id');
        console.log(id);
        $.ajax({
            url: '/admin/models/pricing/edit',
            async: false,
            data: {
                _token: token,
                id: id
            },
            success: function(res) {
                console.log(res);
                var addPriceForm = bootbox.dialog({
                    className: 'dialog',
                    title: title,
                    size: 'lg',
                    message: res.response,
                    closeButton: false,
                    // onEscape: function(result) {
                    //   if ()
                    // }
                });
            }
        })
    }

    static cancel(e) {
        var form = $('form.form');
        var theresData = false;

        form.find('input, textarea, select').each(function(key, val) {
            // console.log($(val).val())
            // console.log(addFormEditor1.getData());
            // || addFormEditor1.getData() !== ''
            if ($(val).val() !== '') {
                theresData = true;
                return;
            }
        });

        if (!theresData) {
            bootbox.hideAll();
            return;
        }

        var confirmCancel = bootbox.confirm({
            title: 'Cancel',
            message: 'There\'s something data on the form and it will be lost.',
            size: 'sm',
            className: 'confirm-ondialog',
            callback: function(result) {
                if (result) {
                    form.find('input, textarea', function() {
                        $(this).val('');
                        $(this).text('');
                    });
                    bootbox.hideAll();
                }
            }
        });

    }

    static viewInvoice() {
        var inOrderPage = Boolean($('#orderTable').length);
        var id = inOrderPage ? $(this).parents('tr').attr('data-id') : $(this).data('id');
        var title = $(this).data('title');
        $.ajax({
            async: false,
            url: '/admin/orders/invoice/view',
            data: {
                _token: token,
                id: id,
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                console.log(res)
                bootbox.dialog({
                    title: title,
                    className: 'invoice-details',
                    size: 'md',
                    message: res.response,
                });
            }
        });
    }

    static viewMessage() {
        var inEmail = Boolean($(this).parents('#emailTable').length);
        var id = inEmail ? $(this).parents('tr').attr('data-id') : $(this).data('id');
        var title = $(this).data('title');

        $.ajax({
            async: false,
            url: '/admin/email/message/view',
            data: {
                _token: token,
                id: id,
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                bootbox.dialog({
                    title: title,
                    className: 'invoice-details',
                    size: 'lg',
                    message: res.response,
                });
                $('.badge.count-message').text(res.unreadmessages);
                if (!res.unreadmessages) $('.badge.count-message').removeClass('new-message');
            }
        });
    }

    static viewSMS() {
        var inEmail = Boolean($(this).parents('#emailTable').length);
        var id = inEmail ? $(this).parents('tr').attr('data-id') : $(this).data('id');
        var title = $(this).data('title');

        $.ajax({
            async: false,
            url: '/admin/sms/message/view',
            data: {
                _token: token,
                id: id,
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                bootbox.dialog({
                    title: title,
                    className: 'invoice-details',
                    size: 'md',
                    message: res.response,
                });
                $('.badge.count-message').text(res.unreadmessages);
                if (!res.unreadmessages) $('.badge.count-message').removeClass('new-message');
            }
        });
    }

    static viewDetails() {
        var inEmail = Boolean($(this).parents('#emailTable').length);
        var id = inEmail ? $(this).parents('tr').attr('data-id') : $(this).data('id');
        var title = $(this).data('title');

        $.ajax({
            async: false,
            url: '/admin/email/details/view',
            data: {
                _token: token,
                id: id,
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                bootbox.dialog({
                    title: title,
                    className: 'invoice-details',
                    size: 'md',
                    message: res.response,
                });
                $('.badge.count-message').text(res.unreadmessages);
                if (!res.unreadmessages) $('.badge.count-message').removeClass('new-message');
            }
        });
    }

    static selectAll() {
        $('input[type=checkbox]').not(this).prop('checked', this.checked);
        $('.check-row:checked').parents('tr').addClass('selected');
        $('.check-row:not(:checked)').parents('tr').removeClass('selected');
    }

    static remove() {
        // $(this).each(function(e) {
        var tr = $(this).parents('tr');
        var id = tr.attr('data-id');
        tr.addClass('selected');

        //   console.log($('.bootbox.modal.bootbox-confirm.show'));
        //   $('.bootbox.modal.bootbox-confirm.show').remove();
        //   $('.bootbox.modal.bootbox-confirm.show').next('.modal-backdrop.fade.show').remove();
        bootbox.confirm({
                size: "small",
                title: 'Deleting ' + table.data('title'),
                closeButton: false,
                message: "Are you sure?",
                callback: function(result) {
                    tr.removeClass('selected');
                    if (!result) return;
                    $.ajax({
                        type: 'POST',
                        url: '/admin/records/delete',
                        data: {
                            _token: token,
                            name: table.data('table'),
                            id: id
                        },
                        success: function(res) {
                            table.DataTable().ajax.reload(null, false);
                            console.log(res);
                        }
                    })
                }
            })
            // });
    }

    static restore() {
        // $('button.row-restore').each(function(e) {
        $(this).on('click', function(e) {
            console.log($(this).parents('tr').attr('data-id'));
            $.ajax({
                type: 'POST',
                url: '/admin/records/restore',
                data: {
                    _token: token,
                    name: table.data('table'),
                    id: $(this).parents('tr').attr('data-id')
                },
                success: function(res) {
                    table.DataTable().ajax.reload(null, false);
                    console.log(res);
                }
            })
        });
        // });
    }



    static bulkRestore() {
        bootbox.confirm({
            size: "small",
            title: 'Restoring Data',
            closeButton: false,
            message: "Selected data will be restore",
            callback: function(result) {
                if (!result) return;
                var ids = [];
                var selected_row = $('input.check-row:checked');

                if (!selected_row.length) return;

                selected_row.each(function(key, val) {
                    ids[key] = {
                        id: $(this).parents('tr').data('id'),
                    };
                });

                // console.log(ids);
                $.ajax({
                    type: 'POST',
                    url: '/admin/records/bulk-restore',
                    data: {
                        _token: token,
                        name: table.data('table'),
                        ids: ids
                    },
                    error: function(res) {
                        console.log(res);
                    },
                    success: function(res) {
                        console.log(res);
                        table.DataTable().ajax.reload(null, false);
                    }
                })
            }
        })
    }

    static bulkRemove() {
        bootbox.confirm({
            size: "small",
            title: 'Removing Data',
            closeButton: false,
            message: "Selected data will be remove",
            callback: function(result) {
                if (!result) return;
                var ids = [];
                var selected_row = $('input.check-row:checked');

                if (!selected_row.length) return;

                selected_row.each(function(key, val) {
                    ids[key] = {
                        id: $(this).parents('tr').data('id'),
                    };
                });

                // console.log(ids);
                $.ajax({
                    type: 'POST',
                    url: '/admin/records/bulk-delete',
                    data: {
                        _token: token,
                        name: table.data('table'),
                        ids: ids
                    },
                    error: function(res) {
                        console.log(res);
                    },
                    success: function(res) {
                        console.log(res);
                        table.DataTable().ajax.reload(null, false);
                    }
                })
            }
        })
    }

    static publish() {
        // $(this).each(function(e) {
        var tr = $(this).parents('tr');
        var id = tr.attr('data-id');
        tr.addClass('selected');

        bootbox.confirm({
                size: "small",
                title: 'Publishing ' + table.data('title'),
                closeButton: false,
                message: "Selected data will be update publish status",
                callback: function(result) {
                    tr.removeClass('selected');
                    if (!result) return;
                    $.ajax({
                        type: 'POST',
                        url: '/admin/publish/' + page,
                        data: {
                            _token: token,
                            id: id
                        },
                        success: function(res) {
                            table.DataTable().ajax.reload(null, false);
                            console.log(res);
                        }
                    })
                }
            })
            // });
    }

    static status() {
        var tr = $(this).parents('tr');
        var id = tr.attr('data-id');
        tr.addClass('selected');

        bootbox.confirm({
            size: "small",
            title: table.data('title') + ' Status',
            closeButton: false,
            message: "Selected data will be update status",
            callback: function(result) {
                tr.removeClass('selected');
                if (!result) return;
                $.ajax({
                    type: 'POST',
                    url: window.location.href + '/update-status',
                    data: {
                        _token: token,
                        id: id
                    },
                    success: function(res) {
                        table.DataTable().ajax.reload(null, false);
                        console.log(res);
                    }
                })
            }
        })
    }

    static bulkOrderSave() {
        bootbox.confirm({
            size: "small",
            title: 'Update Orders',
            closeButton: false,
            message: "Changes in order textboxes will be save",
            callback: function(result) {
                if (!result) return;
                var orders = [];
                $('input.order-item').each(function(key, val) {
                    orders[key] = {
                        id: $(this).parents('tr').data('id'),
                        order: $(this).val(),
                    };
                });
                $.ajax({
                    type: 'POST',
                    // /admin/brand/order/save
                    url: '/admin/' + page + '/order/save',
                    data: {
                        _token: token,
                        orders: orders,
                    },
                    error: function(res) {
                        console.log(res);
                    },
                    success: function(res) {
                        console.log(res);
                        table.DataTable().ajax.reload(null, false);
                    }
                })
            }
        })
    }

    static errorForm(res) {
        console.log(res);
        Validation.clearErrors();
        Validation.error(res.responseJSON.errors);
    }

    static successForm(res) {
        console.log(res);
        var message = $('form .alert');
        message.removeClass('d-none alert-warning alert-success alert-danger');
        setTimeout(function() {
            message.addClass('d-none');
        }, 5000); // hide in 5 seconds
        if (res.response.status)
            message.addClass('alert-success');
        else
            message.addClass('alert-warning');

        message.text(res.response.message);
        if (res.response.status) {
            $('.btn[type=submit]').attr('disabled', true)
            $('.btn.cancel').attr('disabled', true)
            setTimeout(function() {
                Validation.clearErrors();
                Validation.clearFields();
            }, 3000)
            table.DataTable().ajax.reload(null, false);
        }
    }

    static tableReload() {
        table.DataTable().ajax.reload(null, false);
    }
}







class Dialog {
    static Settings() {
        $("#myModal").on("show", function() { // wire up the OK button to dismiss the modal when shown
            $("#myModal a.btn").on("click", function(e) {
                console.log("button pressed"); // just as an example...
                $("#myModal").modal('hide'); // dismiss the dialog
            });
        });

        $("#myModal").on("hide", function() { // remove the event listeners when the dialog is dismissed
            $("#myModal a.btn").off("click");
        });

        $("#myModal").on("hidden", function() { // remove the actual elements from the DOM when fully hidden
            $("#myModal").remove();
        });

        $("#myModal").modal({ // wire up the actual modal functionality and show the dialog
            "backdrop": "static",
            "keyboard": true,
            "show": true // ensure the modal is shown immediately
        });
    }
}

$.fn.serializeControls = function() {
    var data = {};

    function buildInputObject(arr, val) {
        if (arr.length < 1)
            return val;
        var objkey = arr[0];
        if (objkey.slice(-1) == "]") {
            objkey = objkey.slice(0, -1);
        }
        var result = {};
        if (arr.length == 1) {
            result[objkey] = val;
        } else {
            arr.shift();
            var nestedVal = buildInputObject(arr, val);
            result[objkey] = nestedVal;
        }
        return result;
    }

    $.each(this.serializeArray(), function() {
        var val = this.value;
        var c = this.name.split("[");
        var a = buildInputObject(c, val);
        $.extend(true, data, a);
    });

    return data;
}
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
// var table = $('#brandTable');
class AppBrand {
    static onLoad() {
        if (!$('#brandTable').length) return;

        url = window.location.pathname;
        page = 'brand';
        table = $('#brandTable');
        AppBrand.loadTable();
        $(document).on('submit', 'form', AppBrand.save);
        $(document).on('click', '.btn-submit', AppBrand.save);
        $(document).on('change', '#logoFinder', Image.change);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppBrand.add(e);
        else
            AppBrand.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/brand/get-list',
                dataSrc: 'data',
                data: function(param) {
                    param._token = token;
                    // param.search = $("#brandTable_filter label input").val();
                    param.search = $("#search").val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                {
                    data: 1,
                    render: function(data) {
                        return '<img class="img-thumbnail icon" src="' + data + '" alt="">'
                    }
                },
                { data: 2 },
                {
                    data: 3,
                    render: function(data) {
                        return '<input type="number" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 4,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Brand" data-url="/admin/brand/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="brand" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }
}
// var table = $('#categoryTable');
// var url = '/admin/categories';
// var ajax_loading = false;

class AppCategory {
    static onLoad() {
        if (!$('#categoryTable').length) return;

        url = window.location.pathname;
        page = 'categories';
        table = $('#categoryTable');
        AppCategory.loadTable();
        $(document).on('submit', 'form', AppCategory.save);
        $(document).on('click', '.btn-submit', AppCategory.save);
        $(document).on('change', '#logoFinder', Image.change);
        $(document).on('click', '.btn.element-clone', Action.cloneElement)
        $(document).on('click', '.btn.remove-cloned', Action.removecloned)
        $(document).on('click', '.btn.remove-cloned', Action.removecloned)
        $(document).on('change', '.attributes-menu', AppCategory.toggleAttributes)
    }

    static toggleAttributes() {
        $('#' + $(this).data('id')).toggleClass('d-none');
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppCategory.add(e);
        else
            AppCategory.edit(e);
    }

    static loadTable() {
        table.DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: url + '/get-list',
                dataSrc: 'data',
                data: function(param) {
                    param._token = token;
                    // param.search = $("#categoryTable_filter label input").val();
                    param.search = $("#search").val();
                    param.limit = $('#categoryTable_length label select').val();
                    param.draw = $('#pageTable_paginate li.active a').data('dt-idx');
                },
                // success: function(res) {
                //     console.log(res);
                //     return res;
                // },
                // error: function(res) {
                //     console.log(res.responseText);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                {
                    'data': 1,
                    render: function(data) {
                        return '<img class="img-thumbnail icon" src="' + data + '" alt="">'
                    }
                },
                { 'data': 2 },
                { 'data': 3 },
                {
                    data: 4,
                    render: function(data) {
                        return '<input type="text" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 5,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Category" data-url="/admin/categories/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="categories" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear().draw();
        // table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        // newformData.append('screensizetooltip', formEditor[3].getData());
        $('#networkForm, #storageForm, #screenSizeForm, #caseSizeForm, #typeForm, #caseMaterialForm, #conditionForm, #processorForm, #ramForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('description', formEditor[0].getData());
        newformData.append('networktooltip', formEditor[1].getData());
        newformData.append('storagetooltip', formEditor[2].getData());
        newformData.append('screensizetooltip', formEditor[3].getData());
        newformData.append('casesizetooltip', formEditor[4].getData());
        newformData.append('typetooltip', formEditor[5].getData());
        newformData.append('casematerialtooltip', formEditor[6].getData());
        newformData.append('processortooltip', formEditor[7].getData());
        newformData.append('ramtooltip', formEditor[8].getData());

        // console.log(edits);
        $('.ckeEditor.cloned').each(function(val) {
            var editorVal = $(this).parent('div').find('.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred').html();
            console.log(editorVal);
            newformData.append('conditionterms[]', editorVal);
        });

        var networklogos = [];
        $('input.network-logo').each(function(key, value) {
            var file = new File([''], 'sample123.test');
            newformData.append('networkid[]', $(this).data('id'));
            newformData.append('networkslogo[]', value.files[0] == null ? file : value.files[0]);
        });

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);

        $('#networkForm, #storageForm, #screenSizeForm, #caseSizeForm, #typeForm, #caseMaterialForm, #conditionForm, #processorForm, #ramForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('description', formEditor[0].getData());
        newformData.append('networktooltip', formEditor[1].getData());
        newformData.append('storagetooltip', formEditor[2].getData());
        newformData.append('screensizetooltip', formEditor[3].getData());
        newformData.append('casesizetooltip', formEditor[4].getData());
        newformData.append('typetooltip', formEditor[5].getData());
        newformData.append('casematerialtooltip', formEditor[6].getData());
        newformData.append('processortooltip', formEditor[7].getData());
        newformData.append('ramtooltip', formEditor[8].getData());

        // console.log(edits);
        $('.ckeEditor.cloned').each(function(val) {
            var editorVal = $(this).parent('div').find('.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred').html();
            console.log(editorVal);
            newformData.append('conditionterms[]', editorVal);
        });

        $('input.network-logo').each(function(key, value) {
            var file = new File([''], 'sample123.test');
            newformData.append('networkid[]', $(this).data('id'));
            newformData.append('networkslogo[]', value.files[0] == null ? file : value.files[0]);
        });

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }
}


// formEditorClone.forEach(function(val) {
//     // console.log(val.getData())
//     newformData.append('conditionterms[]', val.getData());
// })

// newformData.append('conditionterms[]', formEditor[6].getData());



// var fileObject = '';
// if (value.files[0] != null) {
//     // var fileObject = value.files[0];
//     fileObject = {
//         'lastModified': '',
//         'lastModifiedDate': '',
//         'name': '',
//         'size': '',
//         'type': ''
//     }
// }
// networklogos[key] = { logo: fileObject };
class AppCustomer {
    static onLoad() {
        if (!$('#customerTable').length) return;

        url = '/admin/customers';
        page = 'customers';
        table = $('#customerTable');
        AppCustomer.loadTable();
        $(document).on('submit', 'form', AppCustomer.save);
        $(document).on('click', '.btn-submit', AppCustomer.save);
        // $(document).on('change', '#logoFinder', Image.change);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppCustomer.add(e);
        else
            AppCustomer.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: url + '/get-list',
                dataSrc: 'data',
                data: function(param) {
                    param._token = token;
                    param.search = $("#search").val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                {
                    data: 4,
                    render: function(data) {
                        return '<a href="/admin/orders/details" class="open-link">(' + data + ')</a>';
                    }
                },
                { data: 5 },
                { data: 6 },
                {
                    data: 7,
                    render: function(data) {
                        var status_icon, status_title, action;

                        status_icon = (!data) ? 'bi-toggle-off' : 'bi-toggle-on';
                        status_title = (!data) ? 'Inactive' : 'Active';

                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit"  data-title="Edit Customer" data-url="/admin/customers/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button class="btn row-update-status" data-toggle="tooltip" data-placement="top" title="' + status_title + '"><i class="bi ' + status_icon + '"></i></button>';

                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        // var newformData = new FormData(document.getElementById("basicForm"));
        // var files = $('#logoFinder')[0].files;

        // newformData.append('icon', files[0]);
        // newformData.append('_token', token);
        // newformData.append('description', formEditor[0].getData());

        // $('#metaForm').serializeArray().forEach(function(val) {
        //     newformData.append(val.name, val.value);
        // })

        // $.ajax({
        //     contentType: false,
        //     dataType: 'json',
        //     processData: false,
        //     type: 'POST',
        //     url: url + '/add',
        //     data: newformData,
        //     error: Action.errorForm,
        //     success: Action.successForm,
        // })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        $('#shippingForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: '/admin/customers/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }
}
class AppDashboard {
    static onLoad() {
        if (!$('#brandChart').length && !$('#modelChart').length) return;

        page = 'dashboard';

        $.ajax({
            url: '/admin/report/top-brand',
            data: {
                _token: token,
            },
            success: function(result) {
                AppDashboard.topBrand(result.data);
            }
        })

        $.ajax({
            url: '/admin/report/top-models',
            data: {
                _token: token,
            },
            success: function(result) {
                AppDashboard.topModel(result.data);
            }
        })
    }

    static topBrand(data) {
        brandChart.forEach(function(chart) {
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [data[0][1], data[1][1], data[2][1], data[3][1], data[4][1]],
                    datasets: [{
                        label: "Number of Orders",
                        data: [data[0][2], data[1][2], data[2][2], data[3][2], data[4][2]],
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                        ],
                        borderColor: [
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        });
    }

    static topModel(data) {
        modelChart.forEach(function(chart) {
            var ctx = chart.getContext("2d");
            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: [data[0][1], data[1][1], data[2][1], data[3][1], data[4][1], data[5][1], data[6][1], data[7][1], data[8][1], data[9][1]],
                    datasets: [{
                        label: "Number of Orders",
                        data: [data[0][2], data[1][2], data[2][2], data[3][2], data[4][2], data[5][2], data[6][2], data[7][2], data[8][2], data[9][2]],
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.2)",
                            "rgba(54, 162, 235, 0.2)",
                            "rgba(255, 206, 86, 0.2)",
                            "rgba(75, 192, 192, 0.2)",
                            "rgba(153, 102, 255, 0.2)",
                        ],
                        borderColor: [
                            "rgba(255, 99, 132, 1)",
                            "rgba(54, 162, 235, 1)",
                            "rgba(255, 206, 86, 1)",
                            "rgba(75, 192, 192, 1)",
                            "rgba(153, 102, 255, 1)",
                        ],
                        borderWidth: 1,
                    }, ],
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                        },
                    },
                },
            });
        });
    }
}
// var table = $('#devicesTable');
// var url = '/admin/devices';

class AppDevice {

    static onLoad() {
        if (!$('#devicesTable').length) return;

        url = window.location.pathname;
        page = 'devices';
        table = $('#devicesTable');
        page = 'devices';
        AppDevice.loadTable();
        $(document).on('submit', 'form', AppDevice.save);
        $(document).on('click', '.btn-submit', AppDevice.save);
        $(document).on('submit', '#addDeviceForm', AppDevice.add);
        $(document).on('submit', '#editDeviceForm', AppDevice.edit);
        $(document).on('change', '#logoFinder', Image.change);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppDevice.add(e);
        else
            AppDevice.edit(e);
    }


    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: '/admin/devices/get-list',
                dataSrc: 'data',
                data: function(param) {
                    param._token = token;
                    // param.search = $("#devicesTable_filter label input").val();
                    param.search = $("#search").val();
                },
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                {
                    'data': 1,
                    render: function(data) {
                        return '<img class="img-thumbnail icon" src="' + data + '" alt="">'
                    }
                },
                { 'data': 2 },
                {
                    data: 3,
                    render: function(data) {
                        return '<input type="text" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 4,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Device" data-url="/admin/devices/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="devices" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('devicepicture', files[0]);
        newformData.append('_token', token);
        newformData.append('tooltipcondition', formEditor[0].getData());
        newformData.append('tooltipnetwork', formEditor[1].getData());
        newformData.append('subtitle', formEditor[2].getData());
        newformData.append('tooltipnetwork', formEditor[3].getData());


        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    AppDevice.resfresh();
                }
                message.text(res.response.message);
            }
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('devicepicture', files[0]);
        newformData.append('_token', token);
        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('tooltipcondition', formEditor[0].getData());
        newformData.append('tooltipnetwork', formEditor[1].getData());
        newformData.append('subtitle', formEditor[2].getData());
        newformData.append('tooltipnetwork', formEditor[3].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })


        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                Validation.clearErrors();
                message.text(res.response.message);
                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields('editBrandForm');
                    }, 3000)
                    AppDevice.resfresh();
                }
            }
        })
    }
}
class AppEmailTemplate {
    static onLoad() {
        if (!$('#emailTemplateTable').length) return;

        url = window.location.pathname;
        table = $('#emailTemplateTable');
        page = 'email-templates';
        AppEmailTemplate.loadTable();
        $(document).on('submit', 'form', AppEmailTemplate.save);
        $(document).on('click', '.btn-submit', AppEmailTemplate.save);
        $(document).on('click', '#copy', AppEmailTemplate.copyClipboard);
    }

    static copyClipboard() {
        var constant_name = $("#codeVariable").val();
        var temp = $("<input>");
        $("body").append(temp);
        temp.val($('#codeVariable').val()).select();
        navigator.clipboard.writeText(temp.val()).then(() => {}).catch((error) => {})
        temp.remove();
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static changeDiscountSysmbol() {
        var currency = $('#currency').data('currency');
        console.log(currency);
        if ($(this).val() === 'percentage')
            $('#currency').data('currency', currency).text('%');
        else
            $('#currency').data('currency', currency).text(currency);
    }

    static toggleQuantity() {
        $('.quantity-container').toggleClass('d-none');
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppEmailTemplate.add(e);
        else
            AppEmailTemplate.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/email-templates/get-list',
                dataSrc: 'data',
                data: function(param) {
                    if (!$('#emailTemplateTable_wrapper #emailTemplateFilter').length) {
                        $("#emailTemplateTable_wrapper div.row:first-child").append($("#emailTemplateFilter"));
                    }

                    param._token = token;
                    param.search = $('#search').val();
                    param.type = $('#emailTemplatesType').val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { data: 4 },
                { data: 1 },
                { data: 2 },
                {
                    data: 3,
                    render: function(data) {
                        var status_icon, status_title, action;

                        status_icon = (!data) ? 'bi-toggle-off' : 'bi-toggle-on';
                        status_title = (!data) ? 'Inactive' : 'Active';

                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Email Template" data-url="/admin/email-templates/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-update-status" data-toggle="tooltip" data-placement="top" title="' + status_title + '"><i class="bi ' + status_icon + '"></i></button>';

                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);
        newformData.append('emailcontent', formEditor[0].getData());


        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);
        newformData.append('emailcontent', formEditor[0].getData());



        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }
}
var number_row = 0;
class AppEmail {
    static onLoad() {
        if (!$('#emailTable').length) return;

        url = window.location.pathname;
        page = 'email';
        table = $('#emailTable');
        AppEmail.loadTable();
        $(document).on('submit', 'form', AppEmail.save);
        $(document).on('click', '.btn-submit', AppEmail.save);
        $(document).on('change', '#logoFinder', Image.change);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppEmail.add(e);
        else
            AppEmail.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: url + '/get-list',
                dataSrc: 'data',
                data: function(param) {
                    // if (!$('#emailTable_wrapper #emailFilter').length) {
                    //     $("#emailTable_wrapper div.row:first-child").append($("#emailFilter"));
                    // }
                    // param.order = $('#emailOrderId').val();
                    param._token = token;
                    param.search = $('#search').val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                {
                    'data': 1,
                    render: function(data, type, row) {
                        return '<a class="open-link view-invoice" data-title="Invoice Order #' + data + '" data-url="" data-id=' + row[9] + '>' + data + '</a>';
                    }
                },
                // { data: 2 },
                // { data: 3 },
                { data: 4 },
                { data: 5 },
                { data: 6 },
                { data: 7 },
                { data: 8 },
                {
                    // data: 9,
                    render: function(data) {
                        var action;
                        // status_icon = (data) ? 'bi-toggle-off' : 'bi-toggle-on';
                        // status_title = (!data) ? 'Active':'Inactive';
                        action = '<button class="btn view-message" data-toggle="tooltip" data-placement="top" title="Email" data-title="Message in Email"><i class="bi bi-envelope"></i></button>\n';
                        action += '<button class="btn view-sms" data-toggle="tooltip" data-placement="top" title="SMS" data-title="Message in SMS"><i class="bi bi-chat-left-text"></i></button>\n';
                        action += '<button class="btn view-details email" data-toggle="tooltip" data-placement="top" title="More details" data-title="Details"><i class="bi bi-info-square"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        // action += '<button class="btn row-update-status" data-toggle="tooltip" data-placement="top" title="' + status_title + '"><i class="bi ' + status_icon + '"></i></button>';

                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    AppEmail.resfresh();
                }
                message.text(res.response.message);
            }
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                Validation.clearErrors();
                message.text(res.response.message);
                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    Brand.resfresh();
                }
            }
        })
    }
}
var isFaq = Boolean($('#faqTable').length);
var form_url = (isFaq) ? '/admin/faqs/form/edit' : '/admin/faqs-group/form/edit';

class AppFaq {
    static onLoad() {
        if (!(isFaq || $('#faqGroupTable').length)) return;

        page = isFaq ? 'faqs' : 'faqs/group';
        table = isFaq ? $('#faqTable') : $('#faqGroupTable');
        url = window.location.pathname;

        AppFaq.loadTable();
        $(document).on('submit', 'form', AppFaq.save);
        $(document).on('click', '.btn-submit', AppFaq.save);
        // $(this).on('change', '#logoFinder', Image.change);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppFaq.add(e);
        else
            AppFaq.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: url + '/get-list',
                dataSrc: 'data',
                data: function(param) {
                    // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                    param._token = token;
                    // param.search = table.find('label input').val();
                    param.search = $('#search').val();
                    // param.limit = table.find('label select').val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                { data: 1 },
                { data: 2 },
                {
                    data: 3,
                    render: function(data) {
                        return '<input type="text" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 4,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Faq" data-url="' + form_url + '"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="' + page + '" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);
        if (url == '/admin/faqs') newformData.append('answer', formEditor[0].getData());

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);
        if (url == '/admin/faqs') newformData.append('answer', formEditor[0].getData());


        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }
}
class AppForm {
    static onLoad() {
        if ($('#formContactTable').length) {
            page = 'form-contacts';
            table = $('#formContactTable');
            // url = '/admin/forms/contacts';
        } else if ($('#formReviewTable').length) {
            page = 'form-reviews';
            table = $('#formReviewTable');
            // url = '/admin/forms/reviews';
        } else if ($('#formBulkOrderTable').length) {
            page = 'form-bulkorders';
            table = $('#formBulkOrderTable');
            // url = '/admin/forms/bulk-orders';
        } else if ($('#formNewsletterTable').length) {
            page = 'form-newsletter';
            table = $('#formNewsletterTable');
            // url = '/admin/forms/newsletter';
        } else {
            return;
        }

        url = window.location.pathname;
        AppForm.loadTable();
        $(document).on('submit', 'form', AppForm.save);
        $(document).on('click', '.btn-submit', AppForm.save);
        $(document).on('change', '#logoFinder', Image.change);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppForm.add(e);
        else
            AppForm.edit(e);
    }

    static loadTable() {
        if (url == '/admin/forms/contacts') table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/forms/contacts/get-list',
                dataSrc: 'data',
                data: function(param) {
                    // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                    param._token = token;
                    param.search = $('#search').val();
                    // param.limit = table.find('label select').val();
                    // console.log(table.find('label select').val());


                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                { data: 5 },
                { data: 6 },
                {
                    data: 7,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-toggle="modal" data-target="#editCategoriesForm"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="' + page + '" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();

        else if (url == '/admin/forms/reviews') table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/forms/reviews/get-list',
                dataSrc: 'data',
                data: function(param) {
                    // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                    param._token = token;
                    param.search = $('#search').val();

                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                { data: 5 },
                { data: 6 },
                { data: 7 },
                // { data: 8 },
                {
                    data: 9,
                    render: function(data, type, row) {
                        var published_icon, publish_title, action, status_icon, status_title;

                        status_icon = (!row[8]) ? 'bi-toggle-off' : 'bi-toggle-on';
                        status_title = (!row[8]) ? 'Inactive' : 'Active';
                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';

                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Review" data-url="/admin/reviews/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="' + page + '" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        action += '<button class="btn row-update-status ms-1" data-toggle="tooltip" data-placement="top" title="' + status_title + '"><i class="bi ' + status_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();

        else if (url == '/admin/forms/bulk-orders') table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/forms/bulk-orders/get-list',
                dataSrc: 'data',
                data: function(param) {
                    // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                    param._token = token;
                    param.search = $('#search').val();

                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                { data: 5 },
                { data: 6 },
                {
                    render: function(data) {
                        var action;
                        // published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        // publish_title = (!data) ? 'Published': 'Unpublished';
                        // action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-toggle="modal" data-target="#editCategoriesForm"><i class="bi bi-pencil"></i></button>\n';
                        action = '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        // action += '<button class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        else if (url == '/admin/forms/newsletter') table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/forms/newsletter/get-list',
                dataSrc: 'data',
                data: function(param) {
                    param._token = token;
                    param.search = $('#search').val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                { data: 1 },
                { data: 2 },
                // { data: 3 },
                {
                    render: function(data) {
                        var action, status_title, status_icon;

                        status_icon = (!data) ? 'bi-toggle-off' : 'bi-toggle-on';
                        status_title = (!data) ? 'Inactive' : 'Active';

                        action = '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button class="btn row-update-status" data-toggle="tooltip" data-placement="top" title="' + status_title + '"><i class="bi ' + status_icon + '"></i></button>';
                        // action += '<button class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: '/admin/reviews/add',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    AppForm.resfresh();
                }
                message.text(res.response.message);
            }
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: '/admin/reviews/update',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                Validation.clearErrors();
                message.text(res.response.message);
                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    AppForm.resfresh();
                }
            }
        })
    }
}
class AppMenu {
    static onLoad() {
        if (!$('#menuTable').length) return;

        page = 'menus';
        url = window.location.pathname;
        table = $('#menuTable');
        AppMenu.loadTable();
        $(document).on('submit', 'form', AppMenu.save);
        $(document).on('click', '.btn-submit', AppMenu.save);
        // $('#positionMenu').on('change', AppMenu.resfresh)
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppMenu.add(e);
        else
            AppMenu.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            ajax: {
                url: url + '/get-list',
                dataSrc: 'data',
                data: function(param) {
                    if (!$('#menuTable_wrapper #menuFilter').length) {
                        $("#menuTable_wrapper div.row:first-child").append($("#menuFilter"));
                    }
                    param._token = token;
                    param.search = $("#search").val();
                    // param.search = $("#menuTable_filter label input").val();
                    param.position = $("#positionMenu option:selected").val();

                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { data: 6 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                {
                    data: 4,
                    render: function(data) {
                        return '<input type="text" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 5,
                    render: function(data) {
                        var status_icon, status_title, action;

                        status_icon = (!data) ? 'bi-toggle-off' : 'bi-toggle-on';
                        status_title = (data) ? 'Active' : 'Inactive';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Menu" data-url="/admin/menus/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button class="btn row-update-status" data-toggle="tooltip" data-placement="top" title="' + status_title + '"><i class="bi ' + status_icon + '"></i></button>';

                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    AppMenu.resfresh();
                }
                message.text(res.response.message);
            }
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);


        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                Validation.clearErrors();
                message.text(res.response.message);
                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    AppMenu.resfresh();
                }
            }
        })
    }
}
class AppModel {
    static onLoad() {
        if (!$('#modelTable').length) return;

        url = window.location.pathname;
        page = 'models';
        table = $('#modelTable');
        AppModel.loadTable();
        $(document).on('submit', 'form', AppModel.save);
        $(document).on('click', '.btn-submit', AppModel.save);
        $(document).on('change', '#logoFinder', Image.change);
        // $(document).on('change', 'select', function() { table.DataTable().ajax.reload() });
        $(document).on('click', '.btn.element-clone', Action.cloneElement);
        $(document).on('click', '.btn.remove-cloned', Action.removecloned);

        $(document).on('change', '#modelSelectCategory', AppModel.categoryChange);
    }

    static save(e) {
        e.preventDefault();

        if ($('#formAddEdit').data('formtype') == 'pricing') {
            AppModel.updatePrice(e);
            return;
        }

        if ($('#formAddEdit').data('formtype') == 'add')
            AppModel.add(e);
        else
            AppModel.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                type: 'GET',
                url: '/admin/models/get-list',
                dataSrc: 'data',
                data: function(param) {
                    if (!$('#modelTable_wrapper #modelFilter').length) {
                        $("#modelTable_wrapper div.row:first-child").append($("#modelFilter"));
                    }
                    param._token = token;
                    // param.search = $("#modelTable_filter label input").val();
                    param.search = $("#search").val();
                    param.category = $('#categoryFilter').val();
                    param.brand = $('#brandFilter').val();
                    param.device = $('#deviceFilter').val();

                },
                // error: function(err) {
                //     console.log(err);
                // },
                // success: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                {
                    'data': 1,
                    render: function(data) {
                        return '<img class="img-thumbnail icon" src="' + data + '" alt="models icon">'
                    }
                },
                { 'data': 2 },
                { 'data': 3 },
                { 'data': 4 },
                {
                    data: 5,
                    render: function(data) {
                        return '<input type="text" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 6,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Model" data-url="/admin/models/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-pricing" data-toggle="tooltip" data-placement="top" title="Pricing" data-title="Update Price list"><i class="bi bi-tag-fill"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="models" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static categoryChange(e) {
        var category = $(this).val();
        console.log(category);
        $.ajax({
            url: '/admin/models/changes/category/form',
            async: false,
            data: { id: category },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                console.log(res);
                $('#selectChangesContainer').html(res.response.html);
                $('.navbar-nav.settings li.changes-menu').addClass('d-none');
                res.response.menu.forEach(function(val) {
                    $('.navbar-nav.settings #' + val).removeClass('d-none');
                });
                EditorCke.loadCloned();
            },
        })
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        // newformData.append('screensizetooltip', formEditor[3].getData());
        $('#metaForm, #networkForm, #storageForm, #screenSizeForm, #caseSizeForm, #typeForm, #caseMaterialForm, #conditionForm, #processorForm, #ramForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('description', formEditor[0].getData());
        // newformData.append('networktooltip', formEditor[1].getData());
        // newformData.append('storagetooltip', formEditor[2].getData());
        // newformData.append('screensizetooltip', formEditor[3].getData());
        // newformData.append('casesizetooltip', formEditor[4].getData());
        // newformData.append('typetooltip', formEditor[5].getData());
        // newformData.append('casematerialtooltip', formEditor[6].getData());
        // newformData.append('processortooltip', formEditor[7].getData());
        // newformData.append('ramtooltip', formEditor[8].getData());

        // console.log(edits);
        $('.ckeEditor.cloned').each(function(val) {
            var editorVal = $(this).parent('div').find('.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred').html();
            console.log(editorVal);
            newformData.append('conditionterms[]', editorVal);
        });

        var networklogos = [];
        $('input.network-logo').each(function(key, value) {
            var file = new File([''], 'sample123.test');
            newformData.append('networkid[]', $(this).data('id'));
            newformData.append('networkslogo[]', value.files[0] == null ? file : value.files[0]);
        });

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        // newformData.append('screensizetooltip', formEditor[3].getData());
        $('#metaForm, #networkForm, #storageForm, #screenSizeForm, #caseSizeForm, #typeForm, #caseMaterialForm, #conditionForm, #processorForm, #ramForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('description', formEditor[0].getData());
        // newformData.append('networktooltip', formEditor[1].getData());
        // newformData.append('storagetooltip', formEditor[2].getData());
        // newformData.append('screensizetooltip', formEditor[3].getData());
        // newformData.append('casesizetooltip', formEditor[4].getData());
        // newformData.append('typetooltip', formEditor[5].getData());
        // newformData.append('casematerialtooltip', formEditor[6].getData());
        // newformData.append('processortooltip', formEditor[7].getData());
        // newformData.append('ramtooltip', formEditor[8].getData());

        // console.log(edits);
        $('.ckeEditor.cloned').each(function(val) {
            var editorVal = $(this).parent('div').find('.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred').html();
            console.log(editorVal);
            newformData.append('conditionterms[]', editorVal);
        });

        var networklogos = [];
        $('input.network-logo').each(function(key, value) {
            var file = new File([''], 'sample123.test');
            newformData.append('networkid[]', $(this).data('id'));
            newformData.append('networkslogo[]', value.files[0] == null ? file : value.files[0]);
        });

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }

    static updatePrice(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("pricingForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: '/admin/models/pricing/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }
}
class AppOrder {
    static onLoad() {
        if (!$('#orderTable').length) return;

        url = '/admin/orders';
        page = 'orders';
        table = $('#orderTable');
        AppOrder.loadTable();
        $(document).on('submit', 'form:not(#internalNoteForm)', AppOrder.save);
        $(document).on('submit', '#internalNoteForm', AppOrder.addComment);
        $(document).on('click', '.btn-submit', AppOrder.save);
        $(document).on('change', '#logoFinder', Image.change);
        $(document).on('click', '.customer-edit', Action.editByCol);
        $(document).on('click', '.preview-shipping', Action.previewPDF);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static addComment(e) {
        e.preventDefault();

        var newformData = new FormData(this);
        newformData.append('_token', token);
        console.log(newformData);
        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: '/admin/orders/comment/add',
            data: newformData,
            error: Action.errorForm,
            success: AppOrder.listComments
        })
    }

    static listComments(result) {
        console.log(result);
        if (result.response.status) {
            $('textarea[name=comment]').text('');
            $('.comments-container').html(result.response.comments);
        }
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppOrder.add(e);
        else {
            if ($('#formAddEdit').data('editing') == 'customer') {
                AppCustomer.edit(e);
            } else
                AppOrder.edit(e);
        }
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/orders/get-list',
                dataSrc: 'data',
                data: function(param) {
                    if (!$('#orderTable_wrapper #orderFilter').length) {
                        $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                    }
                    // $('.dataTables_filter').html('');
                    param._token = token;
                    param.search = $("#search").val();
                    param.type = $('#orderType').data('type');
                    param.paymentmethod = $('#paymentMethodFilter').val();
                    param.status = $('#statusFilter').val();
                    // param.limit = $('#orderTable_length label select').val();
                    param.datefrom = $('#orderDateFromFilter').val()
                    param.dateto = $('#orderDateToFilter').val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                {
                    'data': 1,
                    render: function(data, type, row) {
                        // console.log(row[0]);
                        return '<a class="open-link view-invoice" data-title="Invoice Order #' + data + '" data-url="">' + data + '</a>';
                    }
                },
                {
                    'data': 2,
                    render: function(data, type, row) {
                        // console.log(row[8]);
                        if (data != 'unknown')
                            return '<a class="open-link customer-edit" data-id="' + row[8] + '" data-title="Edit Customer" data-url="/admin/customers/form/edit" >' + data + '</a>';
                        else
                            return data;
                    }
                },
                { 'data': 3 },
                { 'data': 4 },
                {
                    data: 5,
                    render: function(data) {
                        return '$ ' + data;
                    }
                },
                { 'data': 6 },
                { 'data': 7 },
                {
                    render: function(data) {
                        var action;

                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Order" data-url="/admin/orders/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn preview-shipping" data-toggle="tooltip" data-placement="top" title="Address Label" data-title="Address Label PDF"><i class="bi bi-file-earmark-pdf"></i></button>\n';
                        if (url != '/admin/orders/archive') {
                            action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                            // action += '<button class="btn row-comment" data-toggle="tooltip" data-placement="top" title="Comments"><i class="bi bi-card-text"></i></button>\n';
                        } else {
                            action += '<button class="btn row-restore" data-toggle="tooltip" data-placement="top" title="Restore"><i class="bi bi-arrow-clockwise"></i></button>\n';
                        }
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }
}
class AppPage {
    static onLoad() {
        if (!$('#pageTable').length) return;

        url = window.location.pathname;;
        page = 'pages';
        table = $('#pageTable');
        AppPage.loadTable();
        $(document).on('submit', 'form', AppPage.save);
        $(document).on('click', '.multi-select .multi-item', Action.multiSelect);
        $(document).on('click', '.btn-submit', AppPage.save);
        $(document).on('change', '#logoFinder', Image.change);
    }


    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            Pages.add(e);
        else
            Pages.edit(e);
    }

    static loadTable() {
        table.DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            ajax: {
                url: url + '/get-list',
                dataSrc: 'data',
                data: function(param) {
                    param._token = token;
                    param.search = $("#search").val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { data: 7 },
                { data: 1 },
                {
                    'data': 2,
                    render: function(data) {
                        // console.log(row[0]);
                        return '<a target="_blank" class="open-link" href="/' + data + '">' + data + '</a>';
                    }
                },
                { data: 3 },
                { data: 4 },
                { data: 5 },
                {
                    data: 6,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Page" data-url="/admin/pages/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="pages" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    Pages.resfresh();
                }
                message.text(res.response.message);
            }
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                Validation.clearErrors();
                message.text(res.response.message);
                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    Pages.resfresh();
                }
            }
        })
    }
}
var url = window.location.pathname;

$(document).ready(function(e) {
    $(this).on('change', '#showPassword', function(e) {
        if ($(this).is(':checked'))
            $('#password').attr('type', 'text');
        else
            $('#password').attr('type', 'password');
    });

    $('#loginForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/admin/profile/login',
            data: $(this).serialize(),
            error: function(err) {
                console.log(err);
            },
            success: function(result) {
                console.log(result);
                if (result.response.status) {
                    $('#alertLoginError').addClass('alert-success').removeClass('alert-danger d-none').text(result.response.message);
                    window.location.href = result.response.redirect_url;
                    return;
                }
                $('#alertLoginError').removeClass('d-none');
            },
        })
    })

    $('#forgotPasswordForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '/account/reset-password',
            data: $(this).serialize(),
            error: function(err) {
                console.log(err);
            },
            success: function(result) {
                console.log(result);
                $('#alertLoginError').text(result.response.message);
                setTimeout(function() {
                    $('#alertLoginError').addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (result.response.status) {
                    $('#alertLoginError').removeClass('alert-danger d-none').addClass('alert-success');
                    window.location.href = result.response.redirect_url;
                } else {
                    $('#alertLoginError').removeClass('alert-success d-none').addClass('alert-danger');
                }
            },
        })
    })

    $('#resetPasswordForm').on('submit', function(e) {
        e.preventDefault();
        var password = $('#password').val();
        var confirmpassword = $('#confirmPassword').val();

        if (password != confirmpassword) {
            $('.confirm-password.text-danger').text('confirm password not match!');
            return;
        } else {
            $('.confirm-password.text-danger').text('');
        }

        $.ajax({
            type: 'POST',
            url: '/account/update-password',
            data: $(this).serialize(),
            error: Action.errorForm,
            success: function(result) {
                console.log(result);
                $('#alertLoginError').text(result.response.message);
                setTimeout(function() {
                    $('#alertLoginError').addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (result.response.status) {
                    $('#alertLoginError').removeClass('alert-danger d-none').addClass('alert-success');
                    window.location.href = result.response.redirect_url;
                } else {
                    $('#alertLoginError').removeClass('alert-success d-none').addClass('alert-danger');
                }
            },
        })
    })


})
class AppPromo {
    static onLoad() {
        if (!$('#promoTable').length) return;

        url = window.location.pathname;
        page = 'promo';
        table = $('#promoTable');
        AppPromo.loadTable();
        $(document).on('submit', 'form', AppPromo.save);
        $(document).on('click', '.btn-submit', AppPromo.save);
        $(document).on('change', '#logoFinder', Image.change);
        $(document).on('change', 'input[name=discounttype]', AppPromo.changeDiscountSysmbol)
        $(document).on('change', 'input[name=activationsamecustomer]', AppPromo.toggleQuantity)
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static changeDiscountSysmbol() {
        var currency = $('#currency').data('currency');
        console.log(currency);
        if ($(this).val() === 'percentage')
            $('#currency').data('currency', currency).text('%');
        else
            $('#currency').data('currency', currency).text(currency);
    }

    static toggleQuantity() {
        $('.quantity-container').toggleClass('d-none');
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppPromo.add(e);
        else
            AppPromo.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/promo/get-list',
                dataSrc: 'data',
                data: function(param) {
                    // $("#menuTable_wrapper div.row:first-child").append($("#menuFilter"));
                    param._token = token;
                    param.search = $('#search').val();
                },
                // success: function(res) {
                //     console.log(res);
                // },
                // error: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { data: 6 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                {
                    data: 5,
                    render: function(data) {
                        var action, status_icon, status_title;

                        status_icon = (!data) ? 'bi-toggle-off' : 'bi-toggle-on';
                        status_title = (!data) ? 'Inactive' : 'Active';

                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Promo" data-url="/admin/promos/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button class="btn row-update-status" data-toggle="tooltip" data-placement="top" title="' + status_title + '"><i class="bi ' + status_icon + '"></i></button>';

                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#promoForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    AppPromo.resfresh();
                }
                message.text(res.response.message);
            }
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        $('#promoForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })


        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: function(res) {
                console.log(res);
                Validation.clearErrors();
                Validation.error(res.responseJSON.errors);
            },
            success: function(res) {
                console.log(res);
                var message = $('form .alert');
                message.removeClass('d-none alert-warning alert-success');
                setTimeout(function() {
                    message.addClass('d-none');
                }, 5000); // hide in 5 seconds
                if (res.response.status)
                    message.addClass('alert-success');
                else
                    message.addClass('alert-warning');

                Validation.clearErrors();
                message.text(res.response.message);
                if (res.response.status) {
                    $('.btn.btn-submit').attr('disabled', true)
                    setTimeout(function() {
                        Validation.clearErrors();
                        Validation.clearFields();
                    }, 3000)
                    AppPromo.resfresh();
                }
            }
        })
    }
}
var is_Staff = Boolean($('#staffTable').length);
// var isFaq = Boolean($('#staffTable').length);

class AppStaff {
    static onLoad() {
        if (!(is_Staff || $('#staffGroupTable').length)) return;

        page = is_Staff ? 'staffs' : 'staffs/group';
        table = is_Staff ? $('#staffTable') : $('#staffGroupTable');
        url = window.location.pathname;

        AppStaff.loadTable();
        $(document).on('submit', 'form', AppStaff.save);
        $(document).on('click', '.btn-submit', AppStaff.save);
        $(document).on('change', '#logoFinder', Image.change);
        $(document).on('click', '.view-permission', AppStaff.viewPermission);
    }

    static viewPermission() {
        var id = $(this).parents('tr').attr('data-id');
        $.ajax({
            async: false,
            url: url + '/view-permission',
            data: {
                _token: token,
                id: id,
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                console.log(res)
                bootbox.dialog({
                    title: 'Permissions',
                    className: 'info-permission',
                    size: 'md',
                    message: res.response,
                });
            }
        });
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if (is_Staff && !($('input[name=password]').val() == $('input[name=confirmpassword]').val())) return;

        if ($('#formAddEdit').data('formtype') == 'add') {
            AppStaff.add(e);
        } else {
            AppStaff.edit(e);
        }
    }

    static loadTable() {
        if (is_Staff) {
            table.DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                async: false,
                ajax: {
                    url: '/admin/staffs/get-list',
                    dataSrc: 'data',
                    data: function(param) {
                        // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                        param._token = token;
                        param.search = $('#search').val();
                        // param.search = table.find('label input').val();

                    },
                    // success: function(res) {
                    //     console.log(res);
                    // },
                    // error: function(res) {
                    //     console.log(res);
                    // }
                },
                columns: [
                    { data: 1 },
                    { data: 2 },
                    { data: 3 },
                    {
                        data: 4,
                        render: function(data) {
                            var status_icon, status_title, action;

                            status_icon = (!data) ? 'bi-toggle-off' : 'bi-toggle-on';
                            status_title = (!data) ? 'Inactive' : 'Active';

                            action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Staff" data-url="/admin/staffs/form/edit"><i class="bi bi-pencil"></i></button>\n';
                            action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                            action += '<button class="btn row-update-status" data-toggle="tooltip" data-placement="top" title="' + status_title + '"><i class="bi ' + status_icon + '"></i></button>';
                            return action;
                        }
                    }
                ],
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $(nRow).attr('data-id', aData[0]);
                    $(nRow).attr('class', 'data-row');
                },
                "columnDefs": [
                    { className: "multi-check", "targets": [0] }
                ]
            }).clear();
            table.DataTable().draw();
        } else {
            table.DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                async: false,
                ajax: {
                    url: '/admin/staffs/group/get-list',
                    dataSrc: 'data',
                    data: function(param) {
                        // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                        param._token = token;
                        param.search = $('#search').val();



                    },
                    // success: function(res) {
                    //     console.log(res);
                    // },
                    // error: function(res) {e
                    //     console.log(res);
                    // }
                },
                columns: [
                    { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                    { data: 1 },
                    {
                        data: 2,
                        render: function(data, type, row) {
                            return '<a target="_blank" class="open-link view-permission">' + data + '</a>';
                        }
                    },
                    {
                        data: 3,
                        render: function(data) {
                            var published_icon, publish_title, action;

                            published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                            publish_title = (!data) ? 'Published' : 'Unpublished';
                            action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Staff Group" data-url="/admin/staffs/group/form/edit"><i class="bi bi-pencil"></i></button>\n';
                            action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                            action += '<button class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                            return action;
                        }
                    }
                ],
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $(nRow).attr('data-id', aData[0]);
                    $(nRow).attr('class', 'data-row');
                },
                "columnDefs": [
                    { className: "multi-check", "targets": [0] }
                ]
            }).clear();
            table.DataTable().draw();
        }

    }

    static add(e) {
        e.preventDefault();

        var newformData = new FormData(document.getElementById("basicForm"));

        // if (is_Staff && $('input[name=password]').val() !== '' && $('input[name=confirmpassword]').val() !== '') return;

        newformData.append('_token', token);

        if (!is_Staff) {
            var json = JSON.stringify($('#permissionForm').serializeControls(), null, 2);
            newformData.append('permissions', json);
        }



        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }

    static edit(e) {
        e.preventDefault();

        var newformData = new FormData(document.getElementById("basicForm"));

        // if (is_Staff && $('input[name=password]').val() !== '' && $('input[name=confirmpassword]').val() !== '') return;

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        if (!is_Staff) {
            var json = JSON.stringify($('#permissionForm').serializeControls(), null, 2);
            newformData.append('permissions', json);
        }


        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }
}
class AppStarbukLocation {
    static onLoad() {
        if (!$('#starbuckLocationTable').length) return;

        url = window.location.pathname;
        page = 'starbuck-locations';
        table = $('#starbuckLocationTable');
        AppStarbukLocation.loadTable();
        $(document).on('submit', 'form', AppStarbukLocation.save);
        $(document).on('click', '.btn-submit', AppStarbukLocation.save);
        $(document).on('change', '#logoFinder', Image.change);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppStarbukLocation.add(e);
        else
            AppStarbukLocation.edit(e);
    }

    static refresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static loadTable() {
        table.DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            async: false,
            ajax: {
                url: '/admin/starbuck-locations/get-list',
                dataSrc: 'data',
                data: function(param) {
                    param._token = token;
                    param.search = $("#search").val();
                },
                // success: function(res) {
                //     console.log(res);
                //     return res;
                // },
                // error: function(res) {
                //     console.log(res.responseText);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                { 'data': 1 },
                { 'data': 2 },
                {
                    data: 3,
                    render: function(data) {
                        return '<input type="text" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 4,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Starbuck Location" data-url="/admin/starbuck-locations/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="' + page + '" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
                        return action;
                    }
                }
            ],
            "fnCreatedRow": function(nRow, aData, iDataIndex) {
                $(nRow).attr('data-id', aData[0]);
                $(nRow).attr('class', 'data-row');
            },
            "columnDefs": [
                { className: "multi-check", "targets": [0] }
            ]
        }).clear().draw();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }
}
var isBlog = Boolean($('#blogTable').length);

class AppBlog {
    static onLoad() {
        if (!isBlog && !$('#blogCategoryTable').length) return;

        page = isBlog ? 'blogs' : 'blogs/group';
        table = isBlog ? $('#blogTable') : $('#blogCategoryTable');
        url = window.location.pathname;

        AppBlog.loadTable();
        $(document).on('submit', 'form', AppBlog.save);
        $(document).on('click', '.btn-submit', AppBlog.save);
        $(document).on('change', '#logoFinder', Image.change);
        // $(document).on('click', '.view-permission', AppBlog.viewPermission);
    }

    static viewPermission() {
        var id = $(this).parents('tr').attr('data-id');
        $.ajax({
            async: false,
            url: url + '/view-permission',
            data: {
                _token: token,
                id: id,
            },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                console.log(res)
                bootbox.dialog({
                    title: 'Permissions',
                    className: 'info-permission',
                    size: 'md',
                    message: res.response,
                });
            }
        });
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add') {
            if (isBlog) AppBlog.add(e);
            else AppBlog.addCategory(e);
        } else {
            if (isBlog) AppBlog.edit(e);
            else AppBlog.editCategory(e);
        }
    }

    static loadTable() {
        if (isBlog) {
            table.DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                async: false,
                ajax: {
                    url: '/admin/blogs/get-list',
                    dataSrc: 'data',
                    data: function(param) {
                        // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                        param._token = token;
                        param.search = $('#search').val();

                    },
                    // success: function(res) {
                    //     console.log(res);
                    // },
                    // error: function(res) {
                    //     console.log(res);
                    // }
                },
                columns: [
                    { data: 4 },
                    { data: 1 },
                    { data: 2 },
                    { data: 3 },
                    {
                        render: function() {
                            var action;

                            action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Staff" data-url="/admin/blogs/form/edit"><i class="bi bi-pencil"></i></button>\n';
                            action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                            return action;
                        }
                    }
                ],
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $(nRow).attr('data-id', aData[0]);
                    $(nRow).attr('class', 'data-row');
                },
                "columnDefs": [
                    { className: "multi-check", "targets": [0] }
                ]
            }).clear();
            table.DataTable().draw();
        } else {
            table.DataTable({
                processing: true,
                serverSide: true,
                ordering: false,
                async: false,
                ajax: {
                    url: '/admin/blogs/categories/get-list',
                    dataSrc: 'data',
                    data: function(param) {
                        // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                        param._token = token;
                        param.search = $('#search').val();
                    },
                    // success: function(res) {
                    //     console.log(res);
                    // },
                    // error: function(res) {
                    //     console.log(res);
                    // }
                },
                columns: [
                    { data: 3 },
                    { data: 1 },
                    {
                        data: 2,
                        render: function(data) {
                            var action;

                            action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Staff Group" data-url="/admin/blogs/categories/form/edit"><i class="bi bi-pencil"></i></button>\n';
                            action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                            return action;
                        }
                    }
                ],
                "fnCreatedRow": function(nRow, aData, iDataIndex) {
                    $(nRow).attr('data-id', aData[0]);
                    $(nRow).attr('class', 'data-row');
                },
                "columnDefs": [
                    { className: "multi-check", "targets": [0] }
                ]
            }).clear();
            table.DataTable().draw();
        }
    }

    static add(e) {
        e.preventDefault();

        var newformData = new FormData(document.getElementById("basicForm"));

        var categories = JSON.stringify($('#basicForm').serializeControls().categories, null, 2);
        console.log(categories);
        newformData.append('_token', token);
        newformData.append('categories', categories == null ? '' : categories);
        newformData.append('content', formEditor[0].getData());

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }

    static addCategory(e) {
        e.preventDefault();

        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/add',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }

    static edit(e) {
        e.preventDefault();

        var newformData = new FormData(document.getElementById("basicForm"));

        var categories = JSON.stringify($('#basicForm').serializeControls().categories, null, 2);
        newformData.append('_token', token);
        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('content', formEditor[0].getData());
        newformData.append('categories', categories == null ? '' : categories);

        $('#metaForm').serializeArray().forEach(function(val) {
            newformData.append(val.name, val.value);
        })

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }

    static editCategory(e) {
        e.preventDefault();

        var newformData = new FormData(document.getElementById("basicForm"));

        if (isBlog && $('input[name=password]').val() !== '' && $('input[name=confirmpassword]').val() !== '' && !passMatch) return;

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        if (!isBlog) {
            var json = JSON.stringify($('#permissionForm').serializeControls(), null, 2);
            newformData.append('permissions', json);
        }


        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm
        })
    }
}