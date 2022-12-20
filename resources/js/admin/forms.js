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