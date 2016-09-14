$(document).ready(function () {
    $('#idea-table').on('click', '.delete-idea', function () {
        var idea_pk = $(this).data('pk');
        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/idea/delete',
                data: {pk: idea_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.idea-' + idea_pk).fadeOut();
                    } else {
                        push_error(data.status, '#message', 'Eintrag konnte nicht gelöscht werden.');
                    }
                },
                error: function (data, errorThrown) {
                    push_error(data.status, '#message', data.responseText);
                    ;
                }

            });
        }
    });
});