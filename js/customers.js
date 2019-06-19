var DATA_URL = "php/connect_db.php";
var CUST_ID = "0";

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

function clearCustForm() {
    $("#txtCompanyName").val("");
    $("#txtDescription").val("");
    $("#txtAddress1").val("");
    $("#txtAddress2").val("");
    $("#selCountries").val("Choose...").change();
    $("#txtCity").val("");
    $("#selState").val("Choose...").change();
    $("#txtPostalCode").val("");
    $("#txtPhone1").val("");
    $("#txtPhone2").val("");
    $("#txtFax").val("");
    $("#txtEmail").val("");
    $('#chkActive').prop('checked', true);
    $("#custBtnSubmit").text("Add Customer");
    $("#txtID").val("0");
    $("#txtPostType").val("add");
    CUST_ID = "0";

    $("#custBtnSubmit").text("Add Customer");
}

function validateCustomer() {
    $(".customer").removeClass("err");
    if ($("#txtCompanyName").val().trim() == "") {
        $("#txtModErr").html("A person or company must be entered");
        $("#modErr").modal();
        $("#txtCompanyName").addClass("err");
        return false;
    }
}

$(document).ready(function () {
    $('#tblCustomers').DataTable();

    $("#custBtnClear").click(function () {
        //alert("btnSql");
        //alert("ID: " + $("#txtID").val() + " Post Type:" + $("#txtPostType").val());
        clearCustForm();
    });

    $(document).on("click", "#tblCustomers tr", function (e) {
        validateCustomer();
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
            $("#txtID").val(item.id);
            CUST_ID = item.id;
            $("#txtPostType").val("update");
        })

        $("#custBtnSubmit").text("Update Customer");

    });



});