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