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