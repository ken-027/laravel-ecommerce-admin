class AppOrder {
    static onLoad() {
        if (!$('#orderTable').length) return;

        url = '/admin/orders';
        page = 'orders';
        table = $('#orderTable');
        AppOrder.loadTable();
        $(document).on('submit', 'form:not(#internalNoteForm)', AppOrder.save);
        $(document).on('submit', '#internalNoteForm', AppOrder.addComment);
        $(document).on('click', '.btn-submit', AppOrder.save);
        $(document).on('change', '#logoFinder', Image.change);
        $(document).on('click', '.customer-edit', Action.editByCol);
        $(document).on('click', '.preview-shipping', Action.previewPDF);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static addComment(e) {
        e.preventDefault();

        var newformData = new FormData(this);
        newformData.append('_token', token);
        console.log(newformData);
        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: '/admin/orders/comment/add',
            data: newformData,
            error: Action.errorForm,
            success: AppOrder.listComments
        })
    }

    static listComments(result) {
        console.log(result);
        if (result.response.status) {
            $('textarea[name=comment]').text('');
            $('.comments-container').html(result.response.comments);
        }
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppOrder.add(e);
        else {
            if ($('#formAddEdit').data('editing') == 'customer') {
                AppCustomer.edit(e);
            } else
                AppOrder.edit(e);
        }
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/orders/get-list',
                dataSrc: 'data',
                data: function(param) {
                    if (!$('#orderTable_wrapper #orderFilter').length) {
                        $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                    }
                    // $('.dataTables_filter').html('');
                    param._token = token;
                    param.search = $("#search").val();
                    param.type = $('#orderType').data('type');
                    param.paymentmethod = $('#paymentMethodFilter').val();
                    param.status = $('#statusFilter').val();
                    // param.limit = $('#orderTable_length label select').val();
                    param.datefrom = $('#orderDateFromFilter').val()
                    param.dateto = $('#orderDateToFilter').val();
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
                        // console.log(row[0]);
                        return '<a class="open-link view-invoice" data-title="Invoice Order #' + data + '" data-url="">' + data + '</a>';
                    }
                },
                {
                    'data': 2,
                    render: function(data, type, row) {
                        // console.log(row[8]);
                        if (data != 'unknown')
                            return '<a class="open-link customer-edit" data-id="' + row[8] + '" data-title="Edit Customer" data-url="/admin/customers/form/edit" >' + data + '</a>';
                        else
                            return data;
                    }
                },
                { 'data': 3 },
                { 'data': 4 },
                {
                    data: 5,
                    render: function(data) {
                        return '$ ' + data;
                    }
                },
                { 'data': 6 },
                { 'data': 7 },
                {
                    render: function(data) {
                        var action;

                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Order" data-url="/admin/orders/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn preview-shipping" data-toggle="tooltip" data-placement="top" title="Address Label" data-title="Address Label PDF"><i class="bi bi-file-earmark-pdf"></i></button>\n';
                        if (url != '/admin/orders/archive') {
                            action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                            // action += '<button class="btn row-comment" data-toggle="tooltip" data-placement="top" title="Comments"><i class="bi bi-card-text"></i></button>\n';
                        } else {
                            action += '<button class="btn row-restore" data-toggle="tooltip" data-placement="top" title="Restore"><i class="bi bi-arrow-clockwise"></i></button>\n';
                        }
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
            success: Action.successForm
        })
    }
}