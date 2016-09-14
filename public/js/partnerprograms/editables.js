$(document).ready(function () {

    load_xeditable_partnerprogram();

});

function load_xeditable_partnerprogram() {
    $.fn.editable.defaults.mode = 'popup';

    $('.update-partnerprogram-name').editable({
        type: 'text',
        url: '/api/v1/partnerprogram/update/name',
        title: 'Name ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'Partnerprogramm darf nicht leer sein.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-partnerprogram-notes').editable({
        type: 'textarea',
        url: '/api/v1/partnerprogram/update/notes',
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