"use strict";
var KTDatatableHtmlTableDemo = {
    init: function () {
        var t;
        (t = $(".kt-datatable").KTDatatable({
            data: { saveState: { cookie: !1 } },
            search: { input: $("#generalSearch") },
            columns: [
                { field: "Name", title: "Name"},
                { field: "Phone", title: "Phone" },
                { field: "Email", title: "Email" },                
                { field: "Sport", title: "Sport" },
                { field: "Type", title: "Type" },
                { field: "Action", title: "Action" }
            ],
        })),
            $("#kt_form_name").on("change", function () {
                t.search($(this).val().toLowerCase(), "Name");
            }),
            $("#kt_form_type").on("change", function () {
                t.search($(this).val().toLowerCase(), "Type");
            }),
            $("#kt_form_status,#kt_form_type").selectpicker();
    },
};
jQuery(document).ready(function () {
    KTDatatableHtmlTableDemo.init();
});
