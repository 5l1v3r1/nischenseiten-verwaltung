$(document).ready(function () {

    load_xeditable_projectkeyword();

});

function load_xeditable_projectkeyword() {
    $.fn.editable.defaults.mode = 'popup';

    $('.update-projectkeyword-name').editable({
        type: 'text',
        url: '/api/v1/project/update/keyword/name',
        title: 'Keyword ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'Keyword darf nicht leer sein.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-projectkeyword-sv').editable({
        type: 'text',
        url: '/api/v1/project/update/keyword/sv',
        title: 'SV ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.isNumeric(value) === false) {
                return 'Bitte einen numerischen Wert eintragen';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-projectkeyword-cpc').editable({
        type: 'text',
        url: '/api/v1/project/update/keyword/cpc',
        title: 'CPC ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.isNumeric(value) === false) {
                return 'Bitte einen numerischen Wert eintragen';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-projectkeyword-comp').editable({
        type: 'text',
        url: '/api/v1/project/update/keyword/competition',
        title: 'Konkurrenz ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.isNumeric(value) === false) {
                return 'Bitte einen numerischen Wert eintragen';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-projectkeyword-note').editable({
        type: 'textarea',
        url: '/api/v1/project/update/keyword/note',
        title: 'Notiz ändern',
        send: 'always',
        placement: 'bottom',
        emptytext: 'Eintragen...',
        ajaxOptions: {
            dataType: 'json'
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-projectkeyword-done').editable({
        type: 'select',
        url: '/api/v1/project/update/keyword/content',
        title: 'Notiz ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        source: [
            {value: '0', text: "Nein"},
            {value: '1', text: "Ja"}
        ],
        display: function (value) {
            if (value === 0) {
                $(this).text('Nein');
            } else {
                $(this).text('Ja');
            }

        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('[data-toggle="tooltip"]').tooltip();
}