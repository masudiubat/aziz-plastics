"use strict";

var KTDatatableDataLocalDemo = {
    init: function () {
        var e, t;
        (e = JSON.stringify()),
            (t = $(".kt-datatable").KTDatatable({
                data: { 
                    type: "local", 
                    source: e,
                    pageSize: 10
                    },

                layout: { scroll: !1, footer: !1 },
                sortable: !0,
                pagination: !0,
                search: { input: $("#generalSearch") },
                columns: [
                    { field: "RecordID", title: "#", sortable: !1, width: 20, type: "number", selector: { class: "kt-checkbox--solid" }, textAlign: "center" },
                    { 
                        field: "Number", 
                        title: "Number"
                     },
                    {
                        field: "Name",
                        title: "Name"
                    },
                    {
                        field: "Actions",
                        title: "Actions",
                        sortable: !1,
                        width: 110,
                        overflow: "visible",
                        autoHide: !1,
                        template: function () {
                            return '\t\t\t\t\t\t<div class="dropdown">\t\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">                                <i class="la la-cog"></i>                            </a>\t\t\t\t\t\t  \t<div class="dropdown-menu dropdown-menu-right">\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-edit"></i> Edit Details</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-leaf"></i> Update Status</a>\t\t\t\t\t\t    \t<a class="dropdown-item" href="#"><i class="la la-print"></i> Generate Report</a>\t\t\t\t\t\t  \t</div>\t\t\t\t\t\t</div>\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Edit details">\t\t\t\t\t\t\t<i class="la la-edit"></i>\t\t\t\t\t\t</a>\t\t\t\t\t\t<a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="Delete">\t\t\t\t\t\t\t<i class="la la-trash"></i>\t\t\t\t\t\t</a>\t\t\t\t\t';
                        },
                    },
                ],
            })),
            $("#kt_form_status").on("change", function () {
                t.search($(this).val().toLowerCase(), "Status");
            }),
            $("#kt_form_type").on("change", function () {
                t.search($(this).val().toLowerCase(), "Type");
            }),
            $("#kt_form_status,#kt_form_type").selectpicker();
    },
};

jQuery(document).ready(function() {
    KTDatatableDataLocalDemo.init();
});