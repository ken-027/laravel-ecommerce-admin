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