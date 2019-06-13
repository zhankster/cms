var DATA_URL = "php/connect_db.php";

function getCustomer(sql) {
    var data = "NA";
    try {
        return $.ajax({
            type: "POST",
            url: DATA_URL,
            dataType: 'json',
            data: {
                selectQuery: sql
            },
            async: false,
            success: function (data) {
                $.each(data, function (index, item) {
                    //alert(item.first_name);
                });
            }

        }).responseJSON

    } catch (e) {
        alert(e);
    }

}

$(document).ready(function () {
    $('#tblCustomers').DataTable();

    $("#btnSql").click(function () {
        //alert("btnSql");
    });

    $(document).on("click", "#tblCustomers tr", function (e) {
        id = $(this).find("td:first").text();
        json = getJSON("select * from customers where id =" + id);

        $.each(json, function (index, item) {
            $("#txtCompanyName").val(item.company_name);
            $("#txtDescription").val(item.description);
        })


        // $.each(json, function () {
        //     $.each(this, function (name, value) {
        //         console.log(name + '=' + value);
        //     });
        // })

    });



});