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