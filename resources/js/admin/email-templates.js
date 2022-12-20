class AppEmailTemplate {
    static onLoad() {
        if (!$('#emailTemplateTable').length) return;

        url = window.location.pathname;
        table = $('#emailTemplateTable');
        page = 'email-templates';
        AppEmailTemplate.loadTable();
        $(document).on('submit', 'form', AppEmailTemplate.save);
        $(document).on('click', '.btn-submit', AppEmailTemplate.save);
        $(document).on('click', '#copy', AppEmailTemplate.copyClipboard);
    }

    static copyClipboard() {
        var constant_name = $("#codeVariable").val();
        var temp = $("<input>");
        $("body").append(temp);
        temp.val($('#codeVariable').val()).select();
        navigator.clipboard.writeText(temp.val()).then(() => {}).catch((error) => {})
        temp.remove();
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static changeDiscountSysmbol() {
        var currency = $('#currency').data('currency');
        console.log(currency);
        if ($(this).val() === 'percentage')
            $('#currency').data('currency', currency).text('%');
        else
            $('#currency').data('currency', currency).text(currency);
    }

    static toggleQuantity() {
        $('.quantity-container').toggleClass('d-none');
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppEmailTemplate.add(e);
        else
            AppEmailTemplate.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/email-templates/get-list',
                dataSrc: 'data',
                data: function(param) {
                    if (!$('#emailTemplateTable_wrapper #emailTemplateFilter').length) {
                        $("#emailTemplateTable_wrapper div.row:first-child").append($("#emailTemplateFilter"));
                    }

                    param._token = token;
                    param.search = $('#search').val();
                    param.type = $('#emailTemplatesType').val();
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
                {
                    data: 3,
                    render: function(data) {
                        var status_icon, status_title, action;

                        status_icon = (!data) ? 'bi-toggle-off' : 'bi-toggle-on';
                        status_title = (!data) ? 'Inactive' : 'Active';

                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Email Template" data-url="/admin/email-templates/form/edit"><i class="bi bi-pencil"></i></button>\n';
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
        newformData.append('emailcontent', formEditor[0].getData());


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

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);
        newformData.append('emailcontent', formEditor[0].getData());



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