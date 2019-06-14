        $.each(json, function () {
            $.each(this, function (name, value) {
                console.log(name + '=' + value);
            });
        })