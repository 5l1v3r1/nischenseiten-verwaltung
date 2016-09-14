$(document).ready(function () {

    load_xeditable_projectnote();

});

function load_xeditable_projectnote() {
    $.fn.editable.defaults.mode = 'popup';

    $('.update-projectnote-name').editable({
        type: 'text',
        url: '/api/v1/project/update/note/name',
        title: 'Titel ändern',
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

    $('.update-projectnote-content').editable({
        type: 'textarea',
        url: '/api/v1/project/update/note/content',
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
    
    $('.update-projectnote-deadline').editable({
        type: 'date',
        url: '/api/v1/project/update/note/deadline',
        title: 'Deadline ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        format: 'dd.m.yyyy',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'Deadline darf nicht leer sein.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-projectnote-priority').editable({
        type: 'select',
        url: '/api/v1/project/update/note/priority',
        title: 'Notiz ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        source: [
            {value: '1', text: "1 Stern"},
            {value: '2', text: "2 Sterne"},
            {value: '3', text: "3 Sterne"},
            {value: '4', text: "4 Sterne"},
            {value: '5', text: "5 Sterne"}
        ],
        display: function (value) {
            var empty_stars = 5 - value;

            var star_tpl = '';
            var start = 0;

            while (start < value) {
                star_tpl += '<i class="fa fa-star"></i>';
                start++;
            }
            var start = 0;
            while (start < empty_stars) {
                star_tpl += '<i class="fa fa-star-o"></i>';
                start++;
            }
            $(this).html(star_tpl);
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('[data-toggle="tooltip"]').tooltip();

}