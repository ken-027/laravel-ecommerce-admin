class AppPromo {
    static onLoad() {
        if (!$('#promoTable').length) return;

        url = window.location.pathname;
        page = 'promo';
        table = $('#promoTable');
        AppPromo.loadTable();
        $(document).on('submit', 'form', AppPromo.save);
        $(document).on('click', '.btn-submit', AppPromo.save);
        $(document).on('change', '#logoFinder', Image.change);
        $(document).on('change', 'input[name=discounttype]', AppPromo.changeDiscountSysmbol)
        $(document).on('change', 'input[name=activationsamecustomer]', AppPromo.toggleQuantity)
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
            AppPromo.add(e);
        else
            AppPromo.edit(e);
    }

    static loadTable() {
        table.DataTable({
            processing: true,
            serverSide: true,
            ordering: false,
            async: false,
            ajax: {
                url: '/admin/promo/get-list',
                dataSrc: 'data',
                data: function(param) {
                    // $("#menuTable_wrapper div.row:first-child").append($("#menuFilter"));
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
                { data: 6 },
                { data: 1 },
                { data: 2 },
                { data: 3 },
                { data: 4 },
                {
                    data: 5,
                    render: function(data) {
                        var action, status_icon, status_title;

                        status_icon = (!data) ? 'bi-toggle-off' : 'bi-toggle-on';
                        status_title = (!data) ? 'Inactive' : 'Active';

                        action = '<button class="btn row-edit" data-toggle="tooltip" data-placement="top" data-title="Edit Promo" data-url="/admin/promos/form/edit"><i class="bi bi-pencil"></i></button>\n';
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
    }

    static add(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('_token', token);
        newformData.append('description', formEditor[0].getData());

        $('#promoForm').serializeArray().forEach(function(val) {
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
                    AppPromo.resfresh();
                }
                message.text(res.response.message);
            }
        })
    }

    static edit(e) {
        e.preventDefault();
        var newformData = new FormData(document.getElementById("basicForm"));

        newformData.append('id', $('#formAddEdit').data('id'));
        newformData.append('_token', token);

        $('#promoForm').serializeArray().forEach(function(val) {
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
                    AppPromo.resfresh();
                }
            }
        })
    }
}