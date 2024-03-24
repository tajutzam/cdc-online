$(document).ready(function () {
    $("#example").DataTable({
        select: false,
        order: [[3, "desc"]],
    });
    $("#mytable").DataTable({
        select: false,
    });
});
