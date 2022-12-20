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