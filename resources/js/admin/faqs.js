var isFaq = Boolean($('#faqTable').length);
var form_url = (isFaq) ? '/admin/faqs/form/edit' : '/admin/faqs-group/form/edit';

class AppFaq {
    static onLoad() {
        if (!(isFaq || $('#faqGroupTable').length)) return;

        page = isFaq ? 'faqs' : 'faqs/group';
        table = isFaq ? $('#faqTable') : $('#faqGroupTable');
        url = window.location.pathname;

        AppFaq.loadTable();
        $(document).on('submit', 'form', AppFaq.save);
        $(document).on('click', '.btn-submit', AppFaq.save);
        // $(this).on('change', '#logoFinder', Image.change);
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppFaq.add(e);
        else
            AppFaq.edit(e);
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
                    // $("#orderTable_wrapper div.row:first-child").append($("#orderFilter"));
                    param._token = token;
                    // param.search = table.find('label input').val();
                    param.search = $('#search').val();
                    // param.limit = table.find('label select').val();
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
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Faq" data-url="' + form_url + '"><i class="bi bi-pencil"></i></button>\n';
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
        }).clear();
        table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);
        if (url == '/admin/faqs') newformData.append('answer', formEditor[0].getData());

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
        if (url == '/admin/faqs') newformData.append('answer', formEditor[0].getData());


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