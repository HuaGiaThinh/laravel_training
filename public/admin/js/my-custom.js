$(document).ready(function () {
    // delete button
    $(".btn-delete").click(function (e) {
        e.preventDefault();

        const url = $(this).attr("href");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    "Deleted!",
                    "Your element has been deleted.",
                    "success"
                );
                window.location.href = url;
            }
        });
    });

    // change status
    $(document).on("click", ".btn-ajax-status", function (e) {
        e.preventDefault();
        let url = $(this).attr("href");
        let parent = $(this).parent();

        $.ajax({
            type: "GET",
            url: url,
            data: "data",
            dataType: "json",
            success: function (response) {
                if (response.type == 'success') {
                    parent.html(response.data.original);
                    parent
                        .find("a.btn-ajax-status")
                        .notify(response.message, {
                            className: response.type,
                            position: "top-center",
                        });
                } else {
                    parent.find("a.btn-ajax-status")
                        .notify(response.message, {
                            className: response.type,
                            position: "top-center",
                        });
                }
                
            },
        });
    });

    // active pagination
    $("#currentPage").parent().addClass("active");

    // change select box
    $(".changeSelectBox-ajax").change(function (e) {
        e.preventDefault();
        let url = $(this).data("url");
        let selectValue = $(this).val();

        url = url.replace("value_new", selectValue);
        let parent = $(this).parent();
        $.ajax({
            type: "get",
            url: url,
            dataType: "json",
            success: function (response) {
                parent.find("select.changeSelectBox-ajax")
                    .notify(response.message, {
                        className: response.type,
                        position: "top-center",
                    });
            },
        });
    });
});
