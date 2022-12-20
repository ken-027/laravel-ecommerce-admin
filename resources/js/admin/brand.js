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