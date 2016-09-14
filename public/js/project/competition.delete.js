$(document).ready(function () {
    $('#projectcompetition-table').on('click', '.delete-projectcompetition', function () {
        var projectcompetition_pk = $(this).data('pk');

        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/project/delete/competition',
                data: {pk: projectcompetition_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.projectcompetition-' + projectcompetition_pk).fadeOut();
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