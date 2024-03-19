// option Menu ------------------------
var csrfToken = $('meta[name="csrf-token"]').attr("content");
var paket_id = $("#paket_id").text();
var lastIndex = 0;
var index_update = 0;
InitializeSortable();
showLoader();
getData();

//task: saat update tidak bisa tambah option

function ResetFormPertanyaan() {
    $("#kodePertanyaan").val("");
    $("#pertanyaan").val("");
    $("#tipeJawaban").val("1");
    $("#optionInput").html("");
    $("#buttonTambah").addClass("d-none");
    $("#requiredCheckbox").prop("checked", false);
}

// Show the modal when the "Tambah Pertanyaan" button is clicked
$("#tambahPertanyaanBtn").on("click", function () {
    $("#tambahPertanyaanModal").modal("show");
    $("#tambahPertanyaanModalLabel").text("Tambah Pertanyaan");
    $("#createPertanyaan").removeClass("d-none");
    $("#updatePertanyaan").addClass("d-none");
    $("#duplicatePertanyaan").addClass("d-none");

    ResetFormPertanyaan();
});

// Initialize Sortable for the container of the cards
function InitializeSortable() {
    new Sortable(document.getElementById("container"), {
        animation: 150, // milliseconds
        onUpdate: function (evt) {
            // update ketika digese dengna ajax
            var id_paket_quesioner_detile = $("#card").attr("item_id");
            var item = evt.item; // elemen yang digeser
            var newIndex = evt.newIndex; // index baru elemen yang digeser
            var oldIndex = evt.oldIndex; // index lama elemen yang digeser

            var items = [];
            document
                .querySelectorAll("#container > .row")
                .forEach(function (item, index) {
                    items.push({
                        id: item.getAttribute("item_id"),
                        content: item.textContent.trim(),
                        index: index + 1,
                    });
                });
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                type: "POST",
                url: "/paket_kuesioner_detail/update-index",
                data: {
                    items: items,
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                beforeSend: function () {
                    console.log("loading..");
                },
                success: function (response) {
                    // console.log(response);
                    getData();
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
            });
        },
        onRemove: function (evt) {
            // update ketika digese dengna ajax
            var id_paket_quesioner_detile = $("#card").attr("item_id");
            var item = evt.item; // elemen yang digeser
            var newIndex = evt.newIndex; // index baru elemen yang digeser
            var oldIndex = evt.oldIndex; // index lama elemen yang digeser

            var items = [];
            document
                .querySelectorAll("#container > .row")
                .forEach(function (item, index) {
                    items.push({
                        id: item.getAttribute("item_id"),
                        content: item.textContent.trim(),
                        index: index + 1,
                    });
                });
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                type: "POST",
                url: "/paket_kuesioner_detail/update-index",
                data: {
                    items: items,
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                beforeSend: function () {
                    console.log("loading..");
                },
                success: function (response) {
                    // console.log(response);
                    getData();
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
            });
        },
        onAdd: function (evt) {
            // update ketika digese dengna ajax
            var id_paket_quesioner_detile = $("#card").attr("item_id");
            var item = evt.item; // elemen yang digeser
            var newIndex = evt.newIndex; // index baru elemen yang digeser
            var oldIndex = evt.oldIndex; // index lama elemen yang digeser

            var items = [];
            document
                .querySelectorAll("#container > .row")
                .forEach(function (item, index) {
                    items.push({
                        id: item.getAttribute("item_id"),
                        content: item.textContent.trim(),
                        index: index + 1,
                    });
                });
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                type: "POST",
                url: "/paket_kuesioner_detail/update-index",
                data: {
                    items: items,
                },
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": csrfToken,
                },
                beforeSend: function () {
                    console.log("loading..");
                },
                success: function (response) {
                    // console.log(response);
                    getData();
                },
                error: function (xhr, status, error) {
                    console.log(error);
                },
            });
        },
    });
}

// Handle the form submission
$("#tambahPertanyaanForm").submit(function (e) {
    e.preventDefault();
    $("#tambahPertanyaanModal").modal("hide");
});

$("#tipeJawaban").change(function (e) {
    $("#optionInput").html("");
    if ($("#tipeJawaban").val() === "8" || $("#tipeJawaban").val() === "12") {
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

function ResetFormPertanyaan() {
    $("#kodePertanyaan").val("");
    $("#pertanyaan").val("");
    $("#tipeJawaban").val("1");
    $("#optionInput").html("");
    $("#buttonTambah").addClass("d-none");
    $("#requiredCheckbox").prop("checked", false);
}

function TambahOption() {
    var title = $("#optionInput_title");

    var elementTitle = `<label for="option" class="form-label" id="optionInput_title">Option</label>`;
    $option = `<div class="d-flex mb-2">
                                <a href="#" class="btn btn-danger mr-2 delete-option"><span class="fa-solid fa-xmark"></span></a>
                                <input type="text" class="form-control" id="optionInput" name="option" required>
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

function cardPertanyaan(id, pertanyaan, tipe, order_index) {
    var pertanyaanCard =
        `<div class="row" item_id="` +
        id +
        `" index="` +
        order_index +
        `" id="card">
            <div class="col-sm-12">
                <div class="card" id="item_kuesioner_1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 pe-0 me-0">
                                <strong> ` +
        order_index +
        `. ` +
        pertanyaan +
        ` <span style="color: red">*</span></strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-1">
                                <div class="badge badge-success p-2 mt-1">` +
        tipe +
        `</div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 text-end">
                                <div class="btn btn-info"onclick="duplicateDetail('` +
        id +
        `','` +
        order_index +
        `')" >
                                    Duplikat
                                </div>
     
                           <div class="btn btn-warning" onclick="updateDetail('` +
        id +
        `','` +
        order_index +
        `')">
                                    Edit 
                                </div>
                                <div class="btn btn-danger" onclick="deleteDetail('` +
        id +
        `')" >
                                    Hapus
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>`;
    return pertanyaanCard;
}
function showLoader() {
    $(".loader").removeClass("d-none");
}
function hideLoader() {
    $(".loader").addClass("d-none");
}

function getData() {
    $.ajax({
        type: "GET",
        url: "/paket_kuesioner_detail/" + paket_id,
        dataType: "json",
        success: function (response) {
            hideLoader();
            $("#container").html("");
            response[0].forEach((_, index, arr) => {
                var id = arr[index]["id"];
                var pertanyaan = arr[index]["pertanyaan"];
                var tipe = arr[index]["tipe"]["display_value"];
                var order_index = arr[index]["index"];
                $("#container").append(
                    cardPertanyaan(id, pertanyaan, tipe, order_index)
                );
            });
            lastIndex = response[1]["index"];
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

$("#createPertanyaan").click(function (e) {
    var kodePertanyaan = $("#kodePertanyaan").val();
    var pertanyaan = $("#pertanyaan").val();
    var tipeJawaban = $("#tipeJawaban").val();
    var optionInput = $('input[type="text"]#optionInput')
        .map(function () {
            return $(this).val();
        })
        .get();
    var isRequired = $("#requiredCheckbox").is(":checked") ? 1 : 0;
    var index = lastIndex + 1;
    var data = {
        kodePertanyaan: kodePertanyaan,
        pertanyaan: pertanyaan,
        tipeJawaban: tipeJawaban,
        id_paket_quesioners: parseInt(paket_id),
        isRequired: isRequired,
        index: index,
        optionInput: optionInput,
    };
    createQuesioner(data);
    // console.log(JSON.stringify(data));
});

function createQuesioner(data) {
    var isRequired = $("#requiredCheckbox").is(":checked") ? 1 : 0;
    var index = lastIndex + 1;
    $.ajax({
        type: "POST",
        url: "/paket_kuesioner_detail",
        data: { items: data },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        beforeSend: function () {
            console.log("loading..");
        },
        success: function (response) {
            // console.log(response);
            ResetFormPertanyaan();
            getData();
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

function updateDetail(id, order_index) {
    index_update = order_index;
    ResetFormPertanyaan();
    getData();
    $("#tambahPertanyaanModal").modal("show");
    $("#tambahPertanyaanModalLabel").text("Edit Pertanyaan");
    $("#createPertanyaan").addClass("d-none");
    $("#updatePertanyaan").removeClass("d-none");
    $("#duplicatePertanyaan").addClass("d-none");

    $.ajax({
        type: "GET",
        url: "/paket_kuesioner_detail/" + id + "/edit",
        dataType: "json",
        success: function (response) {
            // console.log(response);
            $("#id_item").val(response["id"]);
            $("#kodePertanyaan").val(response["kode_pertanyaan"]);
            $("#pertanyaan").val(response["pertanyaan"]);
            $("#tipeJawaban").val(response["tipe"]["id"]);
            $("#requiredCheckbox").prop(
                "checked",
                response["is_required"] == "1" ? true : false
            );
            if (
                $("#tipeJawaban").val() == "8" ||
                $("#tipeJawaban").val() == "12"
            ) {
                fillEditForm(JSON.parse(response["options"]));
                $("#buttonTambah").removeClass("d-none");
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

function fillEditForm(data) {
    data.forEach((element) => {
        var title = $("#optionInput_title");
        var elementTitle = `<label for="option" class="form-label" id="optionInput_title">Option</label>`;
        $option =
            `<div class="d-flex mb-2">
                                <a href="#" class="btn btn-danger mr-2 delete-option"><span class="fa-solid fa-xmark"></span></a>
                                <input type="text" class="form-control" id="optionInput" name="option" value="` +
            element +
            `" required>
                            </div>`;

        if (title.length != 1) {
            $("#optionInput").append(elementTitle);
        }

        $("#optionInput").append($option);
    });
}

$("#updatePertanyaan").click(function (e) {
    ResetFormPertanyaan;
    var id = $("#id_item").val();
    var kodePertanyaan = $("#kodePertanyaan").val();
    var pertanyaan = $("#pertanyaan").val();
    var tipeJawaban = $("#tipeJawaban").val();
    var optionInput = $('input[type="text"]#optionInput')
        .map(function () {
            return $(this).val();
        })
        .get();
    var isRequired = $("#requiredCheckbox").is(":checked") ? 1 : 0;
    var index = lastIndex + 1;
    var data = {
        id: id,
        kodePertanyaan: kodePertanyaan,
        pertanyaan: pertanyaan,
        tipeJawaban: tipeJawaban,
        id_paket_quesioners: parseInt(paket_id),
        isRequired: isRequired,
        index: index_update,
        optionInput: optionInput,
    };
    updateQuestion(data);
});

function updateQuestion(data) {
    // console.log(data);
    $.ajax({
        type: "PUT",
        url: "/paket_kuesioner_detail/" + data.id,
        data: { items: data },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        beforeSend: function () {
            console.log("loading..");
        },
        success: function (response) {
            // console.log(response);
            getData();
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

function deleteDetail(id) {
    $.ajax({
        type: "DELETE",
        url: "/paket_kuesioner_detail/" + id,
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        beforeSend: function () {
            console.log("loading..");
        },
        success: function (response) {
            $("[item_id='" + id + "']").fadeOut("fast", function () {
                $(this).remove();

                // Memanggil ulang Sortable setelah elemen dihapus
                InitializeSortable();
                updateIndex();
            });
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

function duplicateDetail(id, order_index) {
    index_update = order_index;
    ResetFormPertanyaan();
    getData();
    $("#tambahPertanyaanModal").modal("show");
    $("#tambahPertanyaanModalLabel").text("Duplicate Pertanyaan");
    $("#createPertanyaan").addClass("d-none");
    $("#updatePertanyaan").addClass("d-none");
    $("#duplicatePertanyaan").removeClass("d-none");

    $.ajax({
        type: "GET",
        url: "/paket_kuesioner_detail/" + id + "/edit",
        dataType: "json",
        success: function (response) {
            // console.log(response);
            $("#id_item").val(response["id"]);
            $("#kodePertanyaan").val(response["kode_pertanyaan"]);
            $("#pertanyaan").val(response["pertanyaan"] + "- Copy");
            $("#tipeJawaban").val(response["tipe"]["id"]);
            $("#requiredCheckbox").prop(
                "checked",
                response["is_required"] == "1" ? true : false
            );
            if (
                $("#tipeJawaban").val() == "8" ||
                $("#tipeJawaban").val() == "12"
            ) {
                fillEditForm(JSON.parse(response["options"]));
                $("#buttonTambah").removeClass("d-none");
            }
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

$("#duplicatePertanyaan").click(function (e) {
    var kodePertanyaan = $("#kodePertanyaan").val();
    var pertanyaan = $("#pertanyaan").val();
    var tipeJawaban = $("#tipeJawaban").val();
    var optionInput = $('input[type="text"]#optionInput')
        .map(function () {
            return $(this).val();
        })
        .get();
    var isRequired = $("#requiredCheckbox").is(":checked") ? 1 : 0;
    var data = {
        kodePertanyaan: kodePertanyaan,
        pertanyaan: pertanyaan,
        tipeJawaban: tipeJawaban,
        id_paket_quesioners: parseInt(paket_id),
        isRequired: isRequired,
        index: parseInt(index_update),
        optionInput: optionInput,
    };
    duplicateQuesionerAndOrderIndex(data, index_update);
    // console.log(JSON.stringify(data));
});

function duplicateQuesionerAndOrderIndex(data, beforeIndex) {
    $.ajax({
        type: "POST",
        url: "/paket_kuesioner_detail",
        data: { items: data },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        beforeSend: function () {
            console.log("loading..");
        },
        success: function (response) {
            //get data masukkan ke elemnt
            // console.log(response["newId"]);

            var id = response["newId"];
            var pertanyaan = response["data"][0]["pertanyaan"];
            var tipe = response["data"][0]["tipe"]["display_value"];
            var order_index = parseInt(beforeIndex) + 1;

            $("div.row[index='" + beforeIndex + "']").after(
                cardPertanyaan(id, pertanyaan, tipe, order_index)
            );
            // getData();
            // InitializeSortable();
            updateIndexDuplicate(id, order_index);
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

function updateIndexDuplicate(id, order_index) {
    var items = [];
    var no = 0;

    document
        .querySelectorAll("#container > .row")
        .forEach(function (item, index) {
            no++;
            var itemId = item.getAttribute("item_id");
            var newIndex = itemId + 1;

            items.push({
                id: itemId,
                content: item.textContent.trim(),
                index: no,
            });
        });

    // console.log(items);
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        type: "POST",
        url: "/paket_kuesioner_detail/update-index",
        data: {
            items: items,
        },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        beforeSend: function () {
            console.log("loading..");
        },
        success: function (response) {
            // console.log(response);
            getData();
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}

function updateIndex() {
    var items = [];
    document
        .querySelectorAll("#container > .row")
        .forEach(function (item, index) {
            items.push({
                id: item.getAttribute("item_id"),
                content: item.textContent.trim(),
                index: index + 1,
            });
        });
    var csrfToken = $('meta[name="csrf-token"]').attr("content");

    $.ajax({
        type: "POST",
        url: "/paket_kuesioner_detail/update-index",
        data: {
            items: items,
        },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
        },
        beforeSend: function () {
            console.log("loading..");
        },
        success: function (response) {
            // console.log(response);
            getData();
        },
        error: function (xhr, status, error) {
            console.log(error);
        },
    });
}
