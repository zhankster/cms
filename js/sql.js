function getCustomer(sql) {
    var data = "NA";
    try {
        $.ajax({
            type: "POST",
            url: DATA_URL,
            dataType: 'json',
            data: {
                selectQuery: sql
            },
            async: false,
            success: function (data) {
                $.each(data, function (index, item) {

                });
            }

        });

    } catch (e) {
        alert(e);
    }
    return data;
}





$(document).ready(function () {
    $('#tblSql').DataTable();

    $("#btnSql").click(function () {
        //alert("btnSql");
        var json = getCustomer("select * from users");
        alert(json);
    });





});


//$('#example').DataTable();