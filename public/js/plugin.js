var param = {
    enableTime: true,
    dateFormat: "Y-m-d H:i",
    minDate: new Date().fp_incr(1),
    locale: "zh_tw"
};

document.getElementById("dateStart").flatpickr(param);
document.getElementById("dateEnd").flatpickr(param);
document.getElementById("enrollDeadline").flatpickr(param);

document.getElementById("dateStart").addEventListener("change", function() {
    document.getElementById("dateEnd").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: new Date(document.getElementById("dateStart").value),
        locale: "zh_tw"
    });
});

document.getElementById("dateEnd").addEventListener("change", function() {
    document.getElementById("enrollDeadline").flatpickr({
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        minDate: new Date(),
        maxDate: new Date(document.getElementById("dateStart").value).fp_incr(
            -1
        ),
        locale: "zh_tw"
    });
});

tinymce.init({
    selector: "#moreInfo",
    plugins:
        "preview paste searchreplace autolink visualblocks visualchars image link media table hr nonbreaking toc insertdatetime advlist lists wordcount imagetools textpattern noneditable quickbars",
    imagetools_cors_hosts: ["picsum.photos"],
    menubar: "file edit view insert tools table",
    removed_menuitems: "newdocument, charmap, emoticons",
    toolbar:
        "undo redo | bold italic underline strikethrough superscript subscript | fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | preview | image media link",
    toolbar_sticky: true,
    image_advtab: true,
    image_caption: true,
    relative_urls: false,
    remove_script_host: false,
    quickbars_selection_toolbar:
        "bold italic | quicklink h2 h3 blockquote quickimage quicktable",
    noneditable_noneditable_class: "mceNonEditable",
    toolbar_mode: "sliding",
    contextmenu: "link image imagetools table",
    height: 600,
    language: "zh_TW",
    file_picker_types: "image",
    images_upload_handler: function(blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open("POST", "/php/postAcceptor.php");

        xhr.onload = function() {
            var json;

            if (xhr.status < 200) {
                failure("HTTP Error: " + xhr.status);
                return;
            }

            if (xhr.status >= 400 && xhr.status < 500) {
                failure("錯誤: " + xhr.responseText);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != "string") {
                failure("Invalid JSON: " + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append("file", blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    }
});
