"use strict";
var KTDropzoneDemo = {
    init: function () {
        $("#kt_dropzone_1").dropzone({
			url: "",
            paramName: "file",
            maxFiles: 1,
            maxFilesize: 20,
			acceptedFiles: ".jpg,.png",
            addRemoveLinks: !0,
            accept: function (e, o) {
                "justinbieber.jpg" == e.name ? o("Naha, you don't.") : o();
            },
        });
    },
};
KTUtil.ready(function () {
    KTDropzoneDemo.init();
});
