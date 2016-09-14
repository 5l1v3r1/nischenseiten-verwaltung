$(document).ready(function () {
    $('#add-projectkeyword').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/api/v1/project/insert/keyword',
            type: 'POST',
            success: function (data) {
                var pk = data.pk;
                if (pk > 0) {
                    if ($('#projectkeyword-table').length == 0) {
                        location.reload();
                    }
                    add_new_projectkeyword_row(pk);
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});

function add_new_projectkeyword_row(pk) {

    var row = $('<tr class="projectkeyword-' + pk + '"></tr>');
    var col_id = $('<td>' + pk + '</td>');
    var col_name = $('<td><a class="update-projectkeyword-name" data-pk="' + pk + '"></a></td>');
    var col_done = $('<td><a class="update-projectkeyword-done" data-value="0" data-pk="' + pk + '">0</a></td>');
    var col_sv = $('<td><a class="update-projectkeyword-sv" data-pk="' + pk + '">0</a></td>');
    var col_cpc = $('<td><a class="update-projectkeyword-cpc" data-pk="' + pk + '">0</a></td>');
    var col_comp = $('<td><a class="update-projectkeyword-comp" data-pk="' + pk + '">0</a></td>');
    var col_note = $('<td><a class="update-projectkeyword-note" data-pk="' + pk + '"></a></td>');
    var col_refresh = $('<td><a class="refresh-projectkeyword" data-pk="' + pk + '"><i class="fa fa-refresh"></i></a></td>');
    var col_delete = $('<td><a data-toggle="tooltip" data-title="Löschen" class="delete-projectkeyword" data-pk="' + pk + '" href="#"><i class="fa fa-trash"></i></a></td>');

    if (api_active) {
        row.append(col_id, col_name, col_done, col_sv, col_cpc, col_comp, col_note, col_refresh, col_delete).hide().prependTo("#projectkeyword-table").fadeIn();
    } else {
        row.append(col_id, col_name, col_done, col_sv, col_cpc, col_comp, col_note, col_delete).hide().prependTo("#projectkeyword-table").fadeIn();
    }
    
    load_xeditable_projectkeyword();
}