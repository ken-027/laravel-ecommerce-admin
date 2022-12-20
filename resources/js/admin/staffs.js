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