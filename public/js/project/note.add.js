$(document).ready(function () {
    $('#add-projectnote').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/api/v1/project/insert/note',
            type: 'POST',
            success: function (data) {
                console.log(data);
                var pk = data.pk;
                if (pk > 0) {
                    if ($('#projectnotes-table').length == 0) {
                        location.reload();
                    }
                    add_new_projectnote_row(pk);
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});

function add_new_projectnote_row(pk) {
    var current_time = new Date();

    var row = $('<tr class="projectnote-' + pk + '"></tr>');
    var col_date = $('<td>' + current_time.getDate() + '.' + (current_time.getMonth() + 1) + '.' + current_time.getFullYear() + '</td>');
    var col_name = $('<td><a class="update-projectnote-name" data-pk="' + pk + '"></a></td>');
    var col_content = $('<td><a class="update-projectnote-content" data-pk="' + pk + '"></a></td>');
    var col_prio = $('<td><a class="update-projectnote-priority" data-value="0" data-pk="' + pk + '">0</a></td>');
    var col_deadline = $('<td><a class="update-projectnote-deadline" data-pk="' + pk + '"></a></td>');
    var col_archive = $('<td><a data-toggle="tooltip" data-title="Archivieren" class="archive-projectnote" data-pk="' + pk + '" href="#"><i class="fa fa-archive"></i></a></td>');
    var col_delete = $('<td><a data-toggle="tooltip" data-title="Löschen" class="delete-projectnote" data-pk="' + pk + '" href="#"><i class="fa fa-trash"></i></a></td>');

    row.append(col_date, col_name, col_content, col_prio, col_deadline, col_archive, col_delete).hide().prependTo("#projectnotes-table").fadeIn();

    load_xeditable_projectnote();
}