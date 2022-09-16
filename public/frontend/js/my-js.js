$(document).ready(function () {
    // Prevent closing from click inside dropdown
    // $(document).on('click', '.dropdown-menu', function (e) {
    //     e.stopPropagation();
    // });

    // make it as accordion for smaller screens
    if ($(window).width() < 992) {
        $(".dropdown-menu a").click(function (e) {
            e.preventDefault();
            if ($(this).next(".submenu").length) {
                $(this).next(".submenu").toggle();
            }
            $(".dropdown").on("hide.bs.dropdown", function () {
                $(this).find(".submenu").hide();
            });
        });
    }

    // generate voucher code
    $(".ajax-generate-voucher-code").click(function (e) {
        e.preventDefault();
        const url = $(this).attr("href");
        let parent = $(this).parent();
        const modal = $("#modal-voucher");

        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            success: function (response) {
                console.log(response);

                if (response.type == 'old_code') {
                    modal.find(".modal-body").html(
                        '<h4>Bạn có voucher chưa sử dụng: </h4>'
                        + '<h3 style="color:red">' + response.data + '</h3>'
                    );
                } else {
                    modal.find(".modal-body h3").html(response.data);
                }
            },
        });
    });
});
