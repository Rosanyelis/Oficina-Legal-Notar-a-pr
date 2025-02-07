
/**
 * app-ecommerce-product-list
 */

"use strict";


// Datatable (jquery)
$(function () {
    let borderColor, bodyBg, headingColor;

    if (isDarkStyle) {
        borderColor = config.colors_dark.borderColor;
        bodyBg = config.colors_dark.bodyBg;
        headingColor = config.colors_dark.headingColor;
    } else {
        borderColor = config.colors.borderColor;
        bodyBg = config.colors.bodyBg;
        headingColor = config.colors.headingColor;
    }

    // Variable declaration for table
    var dt_product_table = $(".datatables-facturable"),
        productAdd = "";


    // E-commerce Products datatable

    if (dt_product_table.length) {
        var dt_products = dt_product_table.DataTable({
            ajax: {
                url: "/reporte-facturable",
                data: function(d) {
                    d.start = $('#filterdateStart').val();
                    d.end =  $('#filterdateEnd').val();
                    d.status = $('#filterStatus').val();
                    d.priority = $('#filterPriority').val();
                }
            },
            columns: [
                // columns according to JSON
                { data: 'id' },
                { data: 'created_at' },
                { data: 'firstname' },
                { data: 'billable_task' },
                { data: 'time_billable_task' },
                { data: 'title'},
                { data: 'priority'},
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: "control",
                    searchable: false,
                    orderable: false,
                    responsivePriority: 1,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + moment(full["created_at"]).format("DD/MM/YYYY") + "</span>";
                    },
                    responsivePriority: 1,
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["firstname"] + " " + full["second_name"] + " " + full["lastname"] +"</span>";
                    },
                    responsivePriority: 2,
                },
                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["billable_task"]+ "</span>";
                    },
                    responsivePriority: 1,
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["time_billable_task"] + "</span>";
                    },
                },
                {
                    targets: 5,
                    render: function (data, type, full, meta) {
                        return "<span class='text-nowrap'> " + full["title"] + "</span>";
                    },
                    responsivePriority: 4,
                },
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        var status = full["priority"];
                        if (status == 'Sin Definir') {
                            return '<span class="badge bg-info">' + status + '</span>';
                        } else if (status == 'Alta') {
                            return '<span class="badge bg-danger">' + status + '</span>';
                        } else if (status == 'Media') {
                            return '<span class="badge bg-warning">' + status + '</span>';
                        } else if (status == 'Baja') {
                            return '<span class="badge bg-primary">' + status + '</span>';
                        }
                    },
                },
            ],
            dom:
                '<"card-header d-flex border-top rounded-0 flex-wrap pb-md-0 pt-0"' +
                '<"me-5 ms-n2"f>' +
                '<"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center gap-4"lB>>' +
                ">t" +
                '<"row mx-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                ">",
            lengthMenu: [7, 10, 20, 50, 70, 100], //for length of menu
            language: {
                sLengthMenu: "_MENU_",
                search: "",
                searchPlaceholder: "Buscar",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                paginate: {
                    next: '<i class="ri-arrow-right-s-line"></i>',
                    previous: '<i class="ri-arrow-left-s-line"></i>',
                },
            },
            // Buttons with Dropdown
            buttons: [
                {
                    extend: "collection",
                    className:
                        "btn btn-outline-success dropdown-toggle me-4 waves-effect waves-light",
                    text: '<i class="ri-upload-2-line ri-16px me-2"></i><span class="d-none d-sm-inline-block">Exportar </span>',
                    buttons: [
                        {
                            extend: "pdf",
                            text: '<i class="ri-file-pdf-line me-1"></i>Pdf',
                            className: "dropdown-item",
                            action: function (e, dt, button, config) {
                                // var user = $("#users").val();
                                // var day = $("#filterday").val();

                                // window.open("/ventas/generar-pdf?user=" + user + "&day=" + day, "_blank");
                            },
                        }
                    ],
                },
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Detalles de Tarea Nº " + data["id"];
                        },
                    }),
                    type: "column",
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            // eliminar la etiqueta <br/> del title
                            col.title = col.title.replace(/<br>/g, " ");
                            return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                      col.rowIndex +
                                      '" data-dt-column="' +
                                      col.columnIndex +
                                      '">' +
                                      "<td>" +
                                      col.title +
                                      ":" +
                                      "</td> " +
                                      "<td>" +
                                      col.data +
                                      "</td>" +
                                      "</tr>"
                                : "";
                        }).join("");

                        return data
                            ? $('<table class="table"/><tbody />').append(data)
                            : false;
                    },
                },
            },
            // contador de ventas y que si se filtra los contadores se actualicen cuando se filtre
            drawCallback: function(settings) {
                var api = this.api();
                var count = api.rows().count();
                $('#total').text(count);
            }
        });
        $(".dt-action-buttons").addClass("pt-0");
        $(".dt-buttons").addClass("d-flex flex-wrap");
    }
    $('#filterdateEnd').on('change', function() {
        var start = $('#filterdateStart').val();
        var end = $('#filterdateEnd').val();
        if (start > end) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'La fecha de inicio no puede ser mayor a la fecha final',
                position: 'top-center',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                buttonsStyling: false
            });
            return false;
        }
        if (start == '' || end == '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debe seleccionar ambas fechas',
                position: 'top-center',
                customClass: {
                    confirmButton: 'btn btn-primary waves-effect waves-light'
                    },
                buttonsStyling: false
            });

            $('#filterdateStart').val('');
            $('#filterdateEnd').val('');
        }
        dt_products.ajax.reload();
    });
    $('#filterStatus').on('change', function() {
        dt_products.ajax.reload();
    });
    $('#filterPriority').on('change', function() {
        console.log($('#filterPriority').val());

        dt_products.ajax.reload();
    });
    $('#reset_filter').on('click', function () {
        $('#filterStatus').val('');
        $('#filterPriority').val('');
        $('#filterdateStart').val('');
        $('#filterdateEnd').val('');
        dt_products.ajax.reload();
    });
});
