$(document).ready(function () {

    load_xeditable_category();

});

function load_xeditable_category() {
    $.fn.editable.defaults.mode = 'popup';

    $('.update-category-name').editable({
        type: 'text',
        url: '/api/v1/category/update/name',
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

    $('.update-category-notes').editable({
        type: 'textarea',
        url: '/api/v1/category/update/notes',
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