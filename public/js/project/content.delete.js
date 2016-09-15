$(document).ready(function () {
    $('#projectcontent-table').on('click', '.delete-projectcontent', function (event) {
        event.preventDefault();
        var projectcontent_pk = $(this).data('pk');

        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/project/delete/content',
                data: {pk: projectcontent_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.projectcontent-' + projectcontent_pk).fadeOut();
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

    $('#projectcontent-table').on('click', '.archive-projectcontent', function (event) {
        event.preventDefault();
        
        var projectcontent_pk = $(this).data('pk');
        var really_delete = confirm("Soll der Eintrag wirklich archiviert werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/project/archive/content',
                data: {pk: projectcontent_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.projectcontent-' + projectcontent_pk).fadeOut();
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