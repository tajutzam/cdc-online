$(document).ready(function () {
    // option Menu ------------------------

    $("#tipeJawaban").change(function (e) {
        $("#optionInput").html("");
        if (
            $("#tipeJawaban").val() === "select" ||
            $("#tipeJawaban").val() === "checkbox"
        ) {
            $("#buttonTambah").removeClass("d-none");
        } else {
            $("#buttonTambah").addClass("d-none");
        }
    });

    $("#buttonTambah").click(function (e) {
        if (isAllOptionsFilled()) {
            TambahOption();
        } else {
            alert("Option tidak boleh kosong!");
        }
    });

    function isAllOptionsFilled() {
        var allOptionsFilled = true;
        $("#optionInput input[name='option']").each(function () {
            if ($(this).val().trim() === "") {
                allOptionsFilled = false;
                return false; // Break the loop
            }
        });
        return allOptionsFilled;
    }

    function TambahOption() {
        var title = $("#optionInput_title");

        var elementTitle = `<label for="option" class="form-label" id="optionInput_title">Option</label>`;
        $option = `<div class="d-flex mb-2">
                                <a href="#" class="btn btn-danger mr-2 delete-option"><span class="fa-solid fa-xmark"></span></a>
                                <input type="text" class="form-control" id="option" name="option" required>
                            </div>`;

        if (title.length != 1) {
            $("#optionInput").append(elementTitle);
        }
        $("#optionInput").append($option);
    }

    $("#optionInput").on("click", ".delete-option", function (e) {
        e.preventDefault();
        $(this).closest(".d-flex").remove();
    });

    // option Menu ------------------------

    $("#createPertanyaan").click(function (e) {
        e.preventDefault();
        $.ajax({
            type: "method",
            url: "url",
            data: "data",
            dataType: "dataType",
            success: function (response) {},
            error: function (xhr, status, error) {},
        });
    });
});
