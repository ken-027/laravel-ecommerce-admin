class AppPage {
    static onLoad() {
        if (!$('#pageTable').length) return;

        url = window.location.pathname;;
        page = 'pages';
        table = $('#pageTable');
        AppPage.loadTable();
        $(document).on('submit', 'form', AppPage.save);
        $(document).on('click', '.multi-select .multi-item', Action.multiSelect);
        $(document).on('click', '.btn-submit', AppPage.save);
        $(document).on('change', '#logoFinder', Image.change);
    }


    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            Pages.add(e);
        else
            Pages.edit(e);
    }

    static loadTable() {
        table.DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
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
                { data: 7 },
                { data: 1 },
                {
                    'data': 2,
                    render: function(data) {
                        // console.log(row[0]);
                        return '<a target="_blank" class="open-link" href="/' + data + '">' + data + '</a>';
                    }
                },
                { data: 3 },
                { data: 4 },
                { data: 5 },
                {
                    data: 6,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Page" data-url="/admin/pages/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="pages" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
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
                    Pages.resfresh();
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
                    Pages.resfresh();
                }
            }
        })
    }
}