class AppModel {
    static onLoad() {
        if (!$('#modelTable').length) return;

        url = window.location.pathname;
        page = 'models';
        table = $('#modelTable');
        AppModel.loadTable();
        $(document).on('submit', 'form', AppModel.save);
        $(document).on('click', '.btn-submit', AppModel.save);
        $(document).on('change', '#logoFinder', Image.change);
        // $(document).on('change', 'select', function() { table.DataTable().ajax.reload() });
        $(document).on('click', '.btn.element-clone', Action.cloneElement);
        $(document).on('click', '.btn.remove-cloned', Action.removecloned);

        $(document).on('change', '#modelSelectCategory', AppModel.categoryChange);
    }

    static save(e) {
        e.preventDefault();

        if ($('#formAddEdit').data('formtype') == 'pricing') {
            AppModel.updatePrice(e);
            return;
        }

        if ($('#formAddEdit').data('formtype') == 'add')
            AppModel.add(e);
        else
            AppModel.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                type: 'GET',
                url: '/admin/models/get-list',
                dataSrc: 'data',
                data: function(param) {
                    if (!$('#modelTable_wrapper #modelFilter').length) {
                        $("#modelTable_wrapper div.row:first-child").append($("#modelFilter"));
                    }
                    param._token = token;
                    // param.search = $("#modelTable_filter label input").val();
                    param.search = $("#search").val();
                    param.category = $('#categoryFilter').val();
                    param.brand = $('#brandFilter').val();
                    param.device = $('#deviceFilter').val();

                },
                // error: function(err) {
                //     console.log(err);
                // },
                // success: function(res) {
                //     console.log(res);
                // }
            },
            columns: [
                { render: function(data, type, row) { return '<input class="form-check-input check-row" type="checkbox" value="" id=""></input>' } },
                {
                    'data': 1,
                    render: function(data) {
                        return '<img class="img-thumbnail icon" src="' + data + '" alt="models icon">'
                    }
                },
                { 'data': 2 },
                { 'data': 3 },
                { 'data': 4 },
                {
                    data: 5,
                    render: function(data) {
                        return '<input type="text" class="form-control form-control-sm w-50 order-item" value="' + data + '">';
                    }
                },
                {
                    data: 6,
                    render: function(data) {
                        var published_icon, publish_title, action;

                        published_icon = (data) ? 'bi-file-earmark-arrow-up' : 'bi-file-earmark-arrow-down';
                        publish_title = (!data) ? 'Published' : 'Unpublished';
                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" title="Edit" data-title="Edit Model" data-url="/admin/models/form/edit"><i class="bi bi-pencil"></i></button>\n';
                        action += '<button class="btn row-pricing" data-toggle="tooltip" data-placement="top" title="Pricing" data-title="Update Price list"><i class="bi bi-tag-fill"></i></button>\n';
                        action += '<button class="btn row-remove" data-toggle="tooltip" data-placement="top" title="Delete"><i class="bi bi-trash"></i></button>\n';
                        action += '<button data-page="models" class="btn row-publish" data-toggle="tooltip" data-placement="top" title="' + publish_title + '"><i class="bi ' + published_icon + '"></i></button>';
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

    static categoryChange(e) {
        var category = $(this).val();
        console.log(category);
        $.ajax({
            url: '/admin/models/changes/category/form',
            async: false,
            data: { id: category },
            error: function(err) {
                console.log(err);
            },
            success: function(res) {
                console.log(res);
                $('#selectChangesContainer').html(res.response.html);
                $('.navbar-nav.settings li.changes-menu').addClass('d-none');
                res.response.menu.forEach(function(val) {
                    $('.navbar-nav.settings #' + val).removeClass('d-none');
                });
                EditorCke.loadCloned();
            },
        })
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));
        var files = $('#logoFinder')[0].files;

        newformData.append('icon', files[0]);
        newformData.append('_token', token);
        // newformData.append('screensizetooltip', formEditor[3].getData());
        $('#metaForm, #networkForm, #storageForm, #screenSizeForm, #caseSizeForm, #typeForm, #caseMaterialForm, #conditionForm, #processorForm, #ramForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('description', formEditor[0].getData());
        // newformData.append('networktooltip', formEditor[1].getData());
        // newformData.append('storagetooltip', formEditor[2].getData());
        // newformData.append('screensizetooltip', formEditor[3].getData());
        // newformData.append('casesizetooltip', formEditor[4].getData());
        // newformData.append('typetooltip', formEditor[5].getData());
        // newformData.append('casematerialtooltip', formEditor[6].getData());
        // newformData.append('processortooltip', formEditor[7].getData());
        // newformData.append('ramtooltip', formEditor[8].getData());

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
        // newformData.append('screensizetooltip', formEditor[3].getData());
        $('#metaForm, #networkForm, #storageForm, #screenSizeForm, #caseSizeForm, #typeForm, #caseMaterialForm, #conditionForm, #processorForm, #ramForm').serializeArray().forEach(function(val, key) {
            newformData.append(val.name, val.value);
        });

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('description', formEditor[0].getData());
        // newformData.append('networktooltip', formEditor[1].getData());
        // newformData.append('storagetooltip', formEditor[2].getData());
        // newformData.append('screensizetooltip', formEditor[3].getData());
        // newformData.append('casesizetooltip', formEditor[4].getData());
        // newformData.append('typetooltip', formEditor[5].getData());
        // newformData.append('casematerialtooltip', formEditor[6].getData());
        // newformData.append('processortooltip', formEditor[7].getData());
        // newformData.append('ramtooltip', formEditor[8].getData());

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
            url: url + '/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }

    static updatePrice(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("pricingForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        $.ajax({
            contentType: false,
            dataType: 'json',
            processData: false,
            type: 'POST',
            url: '/admin/models/pricing/update',
            data: newformData,
            error: Action.errorForm,
            success: Action.successForm,
        })
    }
}