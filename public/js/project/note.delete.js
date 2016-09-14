$(document).ready(function () {
    $('#projectnotes-table').on('click', '.delete-projectnote', function () {
        var projectnote_pk = $(this).data('pk');

        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/project/delete/note',
                data: {pk: projectnote_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.projectnote-' + projectnote_pk).fadeOut();
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

    $('#projectnotes-table').on('click', '.archive-projectnote', function () {
        var projectnote_pk = $(this).data('pk');
        var really_delete = confirm("Soll der Eintrag wirklich archiviert werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/project/archive/note',
                data: {pk: projectnote_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.projectnote-' + projectnote_pk).fadeOut();
                    } else {
                        push_error(data.status, '#message', 'Eintrag konnte nicht archiviert werden.');
                    }
                },
                error: function (data, errorThrown) {
                    push_error(data.status, '#message', data.responseText);
                }

            });
        }
    });
});