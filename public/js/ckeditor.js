const ClassicEditor = require("@ckeditor/ckeditor5-build-classic");
const UploadAdapter = require("@ckeditor/ckeditor5-upload/src/uploadadapter");
ClassicEditor.builtinPlugins = [
    // Other plugins here
    UploadAdapter,
];

ClassicEditor.create(document.querySelector("#editor"), {
    // Other editor configuration here
    ckfinder: {
        uploadUrl: "/your-upload-url",
    },
    // Add this line to configure the file upload adapter
    uploadAdapter: {
        adapter: require("@ckeditor/ckeditor5-upload/src/adapters/simpleuploadadapter"),
    },
});
