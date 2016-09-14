$(document).ready(function () {
    $('#add-partnerprogram').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/api/v1/partnerprogram/insert',
            type: 'POST',
            success: function (data) {
                var pk = data.pk;

                if (pk > 0) {

                    if ($('#partnerprogram-table').length == 0) {
                        location.reload();
                    }

                    add_new_partnerprogram_row(pk);
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});

function add_new_partnerprogram_row(pk) {
    var row = $('<tr class="partnerprogram-' + pk + '"></tr>');
    var col_id = $('<td>' + pk + '</td>');
    var col_name = $('<td><a class="update-partnerprogram-name" data-pk="' + pk + '"></a></td>');
    var col_ideas = $('<td>0</td>');
    var col_notes = $('<td><a class="update-partnerprogram-notes" data-pk="' + pk + '"></a></td>');
    var col_owner = $('<td>' + $('#current-user-name').text() + '</td>');
    var col_delete = $('<td><a class="delete-partnerprogram" data-pk="' + pk + '" href="#"><i class="fa fa-trash"></i></a></td>');

    row.append(col_id, col_name, col_ideas, col_notes, col_owner, col_delete).hide().prependTo("#partnerprogram-table").fadeIn();

    load_xeditable_partnerprogram();
}