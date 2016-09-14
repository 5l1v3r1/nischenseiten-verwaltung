$(document).ready(function () {
    $('#add-projectcompetition').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/api/v1/project/insert/competition',
            type: 'POST',
            success: function (data) {
                var pk = data.pk;
                if (pk > 0) {
                    if ($('#projectcompetition-table').length == 0) {
                        location.reload();
                    }
                    add_new_projectcompetition_row(pk);
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});

function add_new_projectcompetition_row(pk) {

    var row = $('<tr class="projectcompetition-' + pk + '"></tr>');
    var col_id = $('<td>' + pk + '</td>');
    var col_name = $('<td><a class="update-projectcompetition-url" data-pk="' + pk + '"></a></td>');
    var col_power = $('<td><a class="update-projectcompetition-power" data-pk="' + pk + '"></a></td>');
    var col_note = $('<td><a class="update-projectcompetition-note" data-pk="' + pk + '"></a></td>');
    var col_delete = $('<td><a data-toggle="tooltip" data-title="Löschen" class="delete-projectcompetition" data-pk="' + pk + '" href="#"><i class="fa fa-trash"></i></a></td>');

    row.append(col_id, col_name, col_power, col_note, col_delete).hide().prependTo("#projectcompetition-table").fadeIn();

    load_xeditable_projectcompetition();
    $('[data-toggle="tooltip"]').tooltip();
}