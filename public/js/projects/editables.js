$(document).ready(function () {

    load_xeditable_project();

});

function load_xeditable_project() {
    $.fn.editable.defaults.mode = 'popup';

    $('.update-project-name').editable({
        type: 'text',
        url: '/api/v1/project/update/name',
        title: 'URL ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'URL darf nicht leer sein.';
            }
            
            if(!validateURL(value)) {
                return 'Das ist keine valide URL.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        },
        success: function (response, newValue) {
            $('.current-project-' + $(this).data('pk') + ' a').text(newValue);
        }
    });

    $('.update-project-notes').editable({
        type: 'textarea',
        url: '/api/v1/project/update/notes',
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

    $('.update-project-gaviewid').editable({
        type: 'text',
        url: '/api/v1/project/update/gaviewid',
        title: 'Google View ID ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'View ID darf nicht leer sein.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });
}