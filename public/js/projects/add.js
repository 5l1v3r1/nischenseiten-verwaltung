$(document).ready(function () {
    $('#add-project').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/api/v1/project/insert',
            type: 'POST',
            success: function (data) {
                var pk = data.pk;
                if (pk > 0) {
                    if ($('#project-table').length == 0) {
                        location.reload();
                    }

                    add_new_project_row(pk);
                    add_project_to_selecter(pk);
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});

function add_new_project_row(pk) {
    var row = $('<tr class="project-' + pk + '"></tr>');
    var col_id = $('<td>' + pk + '</td>');
    var col_name = $('<td><a class="update-project-name" data-pk="' + pk + '">http://ganze.url.zur.seite.de</a></td>');
    var col_owner = $('<td>' + $('#current-user-name').text() + '</td>');
    var col_notes = $('<td><a class="update-project-notes" data-pk="' + pk + '"></a></td>');
//    var col_ga = $('<td><a class="update-project-gaviewid" data-pk="' + pk + '"></a></td>');
    var col_delete = $('<td><a class="delete-project" data-pk="' + pk + '" href="#"><i class="fa fa-trash"></i></a></td>');

    row.append(col_id, col_name, col_owner, col_notes, col_delete).hide().prependTo("#project-table").fadeIn();

    load_xeditable_project();
}

function add_project_to_selecter(pk) {
    var row = $('<li class="current-project-' + pk + '"></li>');
    var col = $('<a href="/project/choose/' + pk + '">Neu: ganze.url.zur.seite.de</a>');
    row.append(col).prependTo("#projectname-holder").fadeIn();
}