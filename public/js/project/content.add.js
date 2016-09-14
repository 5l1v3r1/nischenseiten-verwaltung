$(document).ready(function () {
    $('#add-projectcontent').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/api/v1/project/insert/content',
            type: 'POST',
            success: function (data) {
                var pk = data.pk;
                if (pk > 0) {
                    if ($('#projectcontent-table').length == 0) {
                        location.reload();
                    }
                    add_new_projectcontent_row(pk);
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});

function add_new_projectcontent_row(pk) {

    var row = $('<tr class="projectcontent-' + pk + '"></tr>');
    var col_id = $('<td>' + pk + '</td>');
    var col_name = $('<td><a class="update-projectcontent-name" data-pk="' + pk + '"></a></td>');
    var col_kw = $('<td><a class="update-projectcontent-keyword" data-pk="' + pk + '"></a></td>');
    var col_note = $('<td><a class="update-projectcontent-note" data-pk="' + pk + '"></a></td>');
    var col_prio = $('<td><a class="update-projectcontent-priority" data-value="0" data-pk="' + pk + '">0</a></td>');
    var col_archive = $('<td><a data-toggle="tooltip" data-title="Archivieren" class="archive-projectcontent" data-pk="' + pk + '" href="#"><i class="fa fa-archive"></i></a></td>');
    var col_delete = $('<td><a data-toggle="tooltip" data-title="Löschen" class="delete-projectcontent" data-pk="' + pk + '" href="#"><i class="fa fa-trash"></i></a></td>');

    row.append(col_id, col_name, col_kw, col_note, col_prio, col_archive, col_delete).hide().prependTo("#projectcontent-table").fadeIn();

    load_xeditable_projectcontent();
}