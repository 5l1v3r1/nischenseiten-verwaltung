$(document).ready(function () {
    $('#partnerprogram-table').on('click', '.delete-partnerprogram', function (event) {
        event.preventDefault();
        var partnerprogram_pk = $(this).data('pk');
        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/partnerprogram/delete',
                data: {pk: partnerprogram_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.partnerprogram-' + partnerprogram_pk).fadeOut();
                    } else {
                        push_error(data.status, '#message', 'Eintrag konnte nicht gelöscht werden.');

                    }
                },
                error: function (data, errorThrown) {
                    push_error(data.status, '#message', errorThrown);
                }

            });
        }
    });
});