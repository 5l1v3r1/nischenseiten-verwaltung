$(document).ready(function () {
    $('#add-user').click(function (event) {
        event.preventDefault();

        if (valid_user_data()) {

            $.ajax({
                url: '/api/v1/user/insert',
                type: 'POST',
                data: $('#new-user-add-form').serialize(),
                success: function (data) {
                    console.log(data);

                    var pk = data.user.id;

                    if (pk > 0) {
                        if ($('#user-table').length == 0) {
                            location.reload();
                        }

                        add_new_user_row(data.user);

                    }
                },
                error: function (data) {
                    console.log(data);
                    push_error(data.status, '#message', data.responseText);
                }
            });
        }
    });

});

function valid_user_data() {
    var username = $('#name').val();
    var email = $('#email').val();
    var pw_1 = $('#password').val();
    var pw_2 = $('#password_confirmation').val();
    var group = $('#group_id').val();

    if (username == '' || email == '' || pw_1 == '' || pw_2 == '') {
        push_error(200, '#message', 'Es fehlen einige Angaben zum neuen Nutzer!');
        return false;
    }

    if (pw_1 != pw_2) {
        push_error(200, '#message', 'Passwörter scheinen nicht gleich zu sein');
        return false;
    }

    if (group <= 0) {
        push_error(200, '#message', 'Du musst dem Nutzer eine Gruppe zuordnen');
        return false;
    }
    return true;


}

function add_new_user_row(user) {

    var row = $('<tr class="user-' + user.id + '"></tr>');
    var col_id = $('<td>' + user.id + '</td>');
    var col_name = $('<td><a class="update-user-name" data-pk="' + user.id + '">' + user.name + '</a></td>');
    var col_projects = $('<td>0</td>');
    var col_mail = $('<td><a class="update-user-email" data-pk="' + user.id + '">' + user.email + '</a></td>');
    var col_group = $('<td><a class="update-user-role" data-value="' + user.role_id + '" data-pk="' + user.id + '">' + user.role_id + '</a></td>');
    var col_note = $('<td><a class="update-user-note" data-pk="' + user.id + '"></a></td>');
    var col_delete = $('<td><a class="delete-user" data-pk="' + user.id + '" href="#"><i class="fa fa-trash"></i></a></td>');

    row.append(col_id, col_name, col_projects, col_mail, col_group, col_note, col_delete).hide().prependTo("#user-table").fadeIn();

    load_xeditable_user();
}
