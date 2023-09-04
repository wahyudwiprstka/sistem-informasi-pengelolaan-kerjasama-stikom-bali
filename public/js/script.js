$(document).ready(function () {
    // $("#dropzone-file").on("change", function () {
    //     $("#file-upload-text").attr("class", "hidden");
    // });
    $("#dropzone-file").on("change", function () {
        if ($("#dropzone-file").val() !== "") {
            $("#file-upload-text").attr("class", "hidden");
            $("#file-uploaded-text").text(
                $("#dropzone-file")
                    .val()
                    .replace(/C:\\fakepath\\/i, "")
            );
        }
    });

    if ($("#jenis").val() == "mou") {
        $("#dasar").addClass("hidden");
    } else {
        $("#dasar").removeClass("hidden");
    }

    $("#jenis").on("change", function () {
        if ($("#jenis").val() == "mou") {
            $("#dasar").addClass("hidden");
        } else {
            $("#dasar").removeClass("hidden");
        }
    });
});

// var tes = @json($kerjasama);

// const myChart = new Chart("myChart", {
//     type: "scatter",
//     data: {},
//     options: {},
// });
