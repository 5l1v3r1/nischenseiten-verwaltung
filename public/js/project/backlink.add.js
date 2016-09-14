$(document).ready(function () {
    $('#add-backlink').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/api/v1/project/insert/backlink',
            type: 'POST',
            success: function (data) {
                var pk = data.pk;
                if (pk > 0) {
                    if ($('#backlink-table').length == 0) {
                        location.reload();
                    }
                    add_new_backlink_row(pk);
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});

function add_new_backlink_row(pk) {
    var current_time = new Date();
    var row = $('<tr class="backlink-' + pk + '"></tr>');
    var col_id = $('<td>' + pk + '</td>');
    var col_source = $('<td><a class="update-backlink-source" data-pk="' + pk + '"></a></td>');
    var col_target = $('<td><a class="update-backlink-target" data-pk="' + pk + '"></a></td>');
    var col_text = $('<td><a class="update-backlink-text" data-pk="' + pk + '"></a></td>');
    var col_rel = $('<td><a class="update-backlink-relation" data-pk="' + pk + '"></a></td>');
    var col_status = $('<td><span class="status">Status: <span class="green">200</span></span><br />Gefunden: <span class="found"><span class="green">Ja</span></span></td>');
    var col_note = $('<td><a class="update-backlink-note" data-pk="' + pk + '"></a></td>');
    var col_checked = $('<td>' + current_time.getDate() + '.' + (current_time.getMonth() + 1) + '.' + current_time.getFullYear() + '</td>');
    var col_checker = $('<td></td>');
    var col_delete = $('<td><a data-toggle="tooltip" data-title="Löschen" class="delete-backlink" data-pk="' + pk + '" href="#"><i class="fa fa-trash"></i></a></td>');

    row.append(col_id, col_source, col_target, col_text, col_rel, col_status, col_note, col_checked, col_checker, col_delete).hide().prependTo("#backlink-table").fadeIn();

    load_xeditable_backlink();
    $('[data-toggle="tooltip"]').tooltip();
}