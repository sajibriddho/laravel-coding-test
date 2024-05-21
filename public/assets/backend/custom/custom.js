
$(document).ready(function () {
    link_submit_alert(".remove_user_access", "Remove", "Remove User Access?", "Removed", "", "Your request has been processed")
    link_submit_alert(".active_user_access", "Active", "Active User Access?", "Removed", "", "Your request has been processed")
    link_submit_alert(".remove_actor", "Remove", "Remove User?", "Removed", "You won't be able to revert this!", "Your request has been processed")

    function link_submit_alert(confirm_submit, button, alertTitle, afterMessage, textmassage, message_type) {
        $(document).on("click", confirm_submit, function (e) {
            e.preventDefault();
            var link = $(this).attr("href");
            Swal.fire({
                title: alertTitle,
                text: textmassage,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#2c9b10",
                cancelButtonColor: "#e42061",
                confirmButtonText: button,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(afterMessage, message_type, "success");
                }
            });
        });
    }
});
