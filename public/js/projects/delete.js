$(document).ready(function () {
    $('#project-table').on('click', '.delete-project', function () {
        var project_pk = $(this).data('pk');
        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/project/delete',
                data: {pk: project_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.project-' + project_pk).fadeOut();
                        $('.current-project-' + project_pk).hide();
                        $('#current-active-project-' + project_pk).hide();
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