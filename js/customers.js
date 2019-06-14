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
            $("#txtAddress1").val(item.address1);
            $("#txtAddress2").val(item.address2);
            $("#selCountries").val(item.country).change();
            $("#txtCity").val(item.city);
            $("#selState").val(item.state).change();
            $("#txtPostalCode").val(item.postal_code);
            $("#txtPhone1").val(item.phone1);
            $("#txtPhone2").val(item.phone2);
            $("#txtFax").val(item.fax);
            $("#txtEmail").val(item.email);
            if (String(item.active) === "1") {
                $('#chkActive').prop('checked', true);
            } else {
                $('#chkActive').prop('checked', false);
            }
        })




    });



});