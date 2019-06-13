var DATA_URL = "php/connect_db.php";

function getJSON(sql) {
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