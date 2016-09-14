$(document).ready(function () {

    load_xeditable_user();

});

function load_xeditable_user() {
    $.fn.editable.defaults.mode = 'popup';

    $('.update-user-name').editable({
        type: 'text',
        url: '/api/v1/user/update/name',
        title: 'Name ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'Kategorie darf nicht leer sein.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-user-email').editable({
        type: 'text',
        url: '/api/v1/user/update/email',
        title: 'Mail ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-user-role').editable({
        type: 'select',
        url: '/api/v1/user/update/role',
        title: 'Gruppe ändern',
        send: 'always',
        source: '/api/v1/roles/get',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-user-note').editable({
        type: 'textarea',
        url: '/api/v1/user/update/note',
        title: 'Notiz ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });
}