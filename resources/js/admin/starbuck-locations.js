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