$(document).ready(function () {
    $('#projectkeyword-table').on('click', '.delete-projectkeyword', function () {
        var projectkeyword_pk = $(this).data('pk');

        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/project/delete/keyword',
                data: {pk: projectkeyword_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.projectkeyword-' + projectkeyword_pk).fadeOut();
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