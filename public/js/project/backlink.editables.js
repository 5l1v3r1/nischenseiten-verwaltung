$(document).ready(function () {

    load_xeditable_backlink();

});

function load_xeditable_backlink() {
    $.fn.editable.defaults.mode = 'popup';

    $('.update-backlink-source').editable({
        type: 'text',
        url: '/api/v1/project/update/backlink/linksource',
        title: 'URL ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'Quelle darf nicht leer sein.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-backlink-target').editable({
        type: 'textarea',
        url: '/api/v1/project/update/backlink/linktarget',
        title: 'URL ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'Ziel darf nicht leer sein.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-backlink-text').editable({
        type: 'text',
        url: '/api/v1/project/update/backlink/linktext',
        title: 'URL ändern',
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

    $('.update-backlink-relation').editable({
        type: 'select',
        url: '/api/v1/project/update/backlink/linkrelation',
        title: 'Notiz ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        source: [
            {value: 'Follow', text: "Follow"},
            {value: 'Nofollow', text: "Nofollow"}
        ],
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-backlink-note').editable({
        type: 'textarea',
        url: '/api/v1/project/update/backlink/note',
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



    $('[data-toggle="tooltip"]').tooltip();

}