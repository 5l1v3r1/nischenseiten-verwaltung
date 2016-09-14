$(document).ready(function () {
    $('#user-table').on('click', '.delete-user', function () {
        var user_pk = $(this).data('pk');
        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/user/delete',
                data: {pk: user_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.user-' + user_pk).fadeOut();
                    } else {
                        push_error(data.status, '#message', 'Eintrag konnte nicht gelöscht werden.');
                    }
                },
                error: function (data, errorThrown) {
                    push_error(data.status, '#message', data.responseText);
                }

            });
        }
    });
});