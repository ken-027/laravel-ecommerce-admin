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