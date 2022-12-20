// var table = $('#categoryTable');
// var url = '/admin/categories';
// var ajax_loading = false;

class AppCategory {
    static onLoad() {
        if (!$('#categoryTable').length) return;

        url = window.location.pathname;
        page = 'categories';
        table = $('#categoryTable');
        AppCategory.loadTable();
        $(document).on('submit', 'form', AppCategory.save);
        $(document).on('click', '.btn-submit', AppCategory.save);
        $(document).on('change', '#logoFinder', Image.change);
        $(document).on('click', '.btn.element-clone', Action.cloneElement)
        $(document).on('click', '.btn.remove-cloned', Action.removecloned)
        $(document).on('click', '.btn.remove-cloned', Action.removecloned)
        $(document).on('change', '.attributes-menu', AppCategory.toggleAttributes)
    }

    static toggleAttributes() {
        $('#' + $(this).data('id')).toggleClass('d-none');
    }

    static resfresh() {
        table.DataTable().ajax.reload(null, false);
    }

    static save(e) {
        e.preventDefault();
        if ($('#formAddEdit').data('formtype') == 'add')
            AppCategory.add(e);
        else
            AppCategory.edit(e);
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
                    // param.search = $("#categoryTable_filter label input").val();
                    param.search = $("#search").val();
                    param.limit = $('#categoryTable_length label select').val();
                    param.draw = $('#pageTable_paginate li.active a').data('dt-idx');
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
                {
                    'data': 1,
                    render: function(data) {
                        return '<img class="img-thumbnail icon" src="' + data + '" alt="">'
                    }
                },
                { 'data': 2 },
                { 'data': 3 },
                {
                    data: 4,
                    render: function(data) {
                        return '<input type="text" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 5,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Category" data-url="/admin/categories/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="categories" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
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
        // table.DataTable().draw();
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        // newformData.append('screensizetooltip', formEditor[3].getData());
        $('#networkForm, #storageForm, #screenSizeForm, #caseSizeForm, #typeForm, #caseMaterialForm, #conditionForm, #processorForm, #ramForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('description', formEditor[0].getData());
        newformData.append('networktooltip', formEditor[1].getData());
        newformData.append('storagetooltip', formEditor[2].getData());
        newformData.append('screensizetooltip', formEditor[3].getData());
        newformData.append('casesizetooltip', formEditor[4].getData());
        newformData.append('typetooltip', formEditor[5].getData());
        newformData.append('casematerialtooltip', formEditor[6].getData());
        newformData.append('processortooltip', formEditor[7].getData());
        newformData.append('ramtooltip', formEditor[8].getData());

        // console.log(edits);
        $('.ckeEditor.cloned').each(function(val) {
            var editorVal = $(this).parent('div').find('.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred').html();
            console.log(editorVal);
            newformData.append('conditionterms[]', editorVal);
        });

        var networklogos = [];
        $('input.network-logo').each(function(key, value) {
            var file = new File([''], 'sample123.test');
            newformData.append('networkid[]', $(this).data('id'));
            newformData.append('networkslogo[]', value.files[0] == null ? file : value.files[0]);
        });

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
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);

        $('#networkForm, #storageForm, #screenSizeForm, #caseSizeForm, #typeForm, #caseMaterialForm, #conditionForm, #processorForm, #ramForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('description', formEditor[0].getData());
        newformData.append('networktooltip', formEditor[1].getData());
        newformData.append('storagetooltip', formEditor[2].getData());
        newformData.append('screensizetooltip', formEditor[3].getData());
        newformData.append('casesizetooltip', formEditor[4].getData());
        newformData.append('typetooltip', formEditor[5].getData());
        newformData.append('casematerialtooltip', formEditor[6].getData());
        newformData.append('processortooltip', formEditor[7].getData());
        newformData.append('ramtooltip', formEditor[8].getData());

        // console.log(edits);
        $('.ckeEditor.cloned').each(function(val) {
            var editorVal = $(this).parent('div').find('.ck.ck-content.ck-editor__editable.ck-rounded-corners.ck-editor__editable_inline.ck-blurred').html();
            console.log(editorVal);
            newformData.append('conditionterms[]', editorVal);
        });

        $('input.network-logo').each(function(key, value) {
            var file = new File([''], 'sample123.test');
            newformData.append('networkid[]', $(this).data('id'));
            newformData.append('networkslogo[]', value.files[0] == null ? file : value.files[0]);
        });

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


// formEditorClone.forEach(function(val) {
//     // console.log(val.getData())
//     newformData.append('conditionterms[]', val.getData());
// })

// newformData.append('conditionterms[]', formEditor[6].getData());



// var fileObject = '';
// if (value.files[0] != null) {
//     // var fileObject = value.files[0];
//     fileObject = {
//         'lastModified': '',
//         'lastModifiedDate': '',
//         'name': '',
//         'size': '',
//         'type': ''
//     }
// }
// networklogos[key] = { logo: fileObject };