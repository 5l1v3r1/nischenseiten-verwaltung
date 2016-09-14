$(document).ready(function () {

    load_xeditable_idea();
});

function load_xeditable_idea() {
    $.fn.editable.defaults.mode = 'popup';

    $('.update-idea-topic').editable({
        type: 'text',
        url: '/api/v1/idea/update/topic',
        title: 'Thema ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.trim(value) == '') {
                return 'Thema darf nicht leer sein.';
            }
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-idea-sv').editable({
        type: 'text',
        url: '/api/v1/idea/update/sv',
        title: 'SV ändern',
        send: 'always',
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
        },
        success: function (data, newValue) {
            var current_pk = $(this).data('pk');
            update_potentials(current_pk, newValue, 'sv');
        }
    });

    $('.update-idea-provision').editable({
        type: 'text',
        url: '/api/v1/idea/update/provision',
        title: 'Provision ändern',
        send: 'always',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.isNumeric(value) === false) {
                return 'Bitte einen numerischen Wert eintragen';
            }
        },
        display: function (value) {
            $(this).text(value + ' %');
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        },
        success: function (data, newValue) {
            var current_pk = $(this).data('pk');
            update_potentials(current_pk, newValue, 'provision');
        }
    });

    $('.update-idea-cpc').editable({
        type: 'text',
        url: '/api/v1/idea/update/cpc',
        title: 'CPC ändern',
        send: 'always',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.isNumeric(value) === false) {
                return 'Bitte einen numerischen Wert eintragen';
            }
        },
        display: function (value) {
            $(this).text(value + ' €');
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        },
        success: function (data, newValue) {
            var current_pk = $(this).data('pk');
            update_potentials(current_pk, newValue, 'cpc');
        }
    });

    $('.update-idea-ppp').editable({
        type: 'text',
        url: '/api/v1/idea/update/ppp',
        title: 'PPP ändern',
        send: 'always',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.isNumeric(value) === false) {
                return 'Bitte einen numerischen Wert eintragen';
            }
        },
        display: function (value) {
            $(this).text(value + ' €');
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        },
        success: function (data, newValue) {
            var current_pk = $(this).data('pk');
            update_potentials(current_pk, newValue, 'ppp');
        }
    });

    $('.update-idea-bc').editable({
        type: 'text',
        url: '/api/v1/idea/update/buyconversion',
        title: 'Kaufconversion ändern',
        send: 'always',
        placement: 'bottom',
        ajaxOptions: {
            dataType: 'json'
        },
        validate: function (value) {
            if ($.isNumeric(value) === false) {
                return 'Bitte einen numerischen Wert eintragen';
            }
        },
        display: function (value) {
            $(this).text(value + ' %');
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        },
        success: function (data, newValue) {
            var current_pk = $(this).data('pk');
            update_potentials(current_pk, newValue, 'bc');
        }
    });

    $('.update-idea-category').editable({
        type: 'select',
        url: '/api/v1/idea/update/category',
        title: 'Kategorie ändern',
        send: 'always',
        placement: 'bottom',
        emptytext: 'Eintragen...',
        source: '/api/v1/category/get',
        ajaxOptions: {
            dataType: 'json'
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-idea-partnerprogram').editable({
        type: 'select',
        url: '/api/v1/idea/update/partnerprogram',
        title: 'Partnerprogramm ändern',
        send: 'always',
        emptytext: 'Eintragen...',
        placement: 'bottom',
        source: '/api/v1/partnerprogram/get',
        ajaxOptions: {
            dataType: 'json'
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-idea-seasonal').editable({
        type: 'select',
        url: '/api/v1/idea/update/seasonal',
        title: 'Kategory ändern',
        send: 'always',
        placement: 'bottom',
        source: [{value: 0, text: "Nein"}, {value: 1, text: "Ja"}],
        ajaxOptions: {
            dataType: 'json'
        },
        success: function (data) {
            console.log(data);
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-idea-keywords').editable({
        type: 'textarea',
        url: '/api/v1/idea/update/keywords',
        title: 'Keywords ändern',
        send: 'always',
        placement: 'bottom',
        emptytext: 'Eintragen...',
        ajaxOptions: {
            dataType: 'json'
        },
        success: function (data) {
            console.log(data);
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-idea-domains').editable({
        type: 'textarea',
        url: '/api/v1/idea/update/domains',
        title: 'Domains ändern',
        send: 'always',
        placement: 'bottom',
        emptytext: 'Eintragen...',
        ajaxOptions: {
            dataType: 'json'
        },
        success: function (data) {
            console.log(data);
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-idea-competitionpower').editable({
        type: 'select',
        url: '/api/v1/idea/update/competitionpower',
        title: 'Stärke der Konkurrenz ändern',
        send: 'always',
        placement: 'bottom',
        emptytext: 'Eintragen...',
        source: [
            {value: 'Sehr stark', text: "Sehr stark"},
            {value: 'Stark', text: "Stark"},
            {value: 'Mittel', text: "Mittel"},
            {value: 'Schwach', text: "Schwach"},
            {value: 'Sehr schwach', text: "Sehr schwach"},
            {value: 'Nicht vorhanden', text: "Nicht vorhanden"}
        ],
        ajaxOptions: {
            dataType: 'json'
        },
        success: function (data) {
            console.log(data);
        },
        error: function (response, newValue) {
            push_error(response.status, '#message', response.responseText);
        }
    });

    $('.update-idea-ranking').editable({
        type: 'select',
        url: '/api/v1/idea/update/ranking',
        title: 'Stärke der Konkurrenz ändern',
        send: 'always',
        placement: 'bottom',
        emptytext: 'Eintragen...',
        source: [
            {value: '1', text: "1 Stern"},
            {value: '2', text: "2 Sterne"},
            {value: '3', text: "3 Sterne"},
            {value: '4', text: "4 Sterne"},
            {value: '5', text: "5 Sterne"},
        ],
        ajaxOptions: {
            dataType: 'json'
        },
        success: function (data) {
            console.log(data);
        },
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

}

function update_potentials(pk, newValue, type) {

    console.log(pk);
    if (type === 'sv') {
        var sv = newValue;
    } else {
        var sv = $('.idea-' + pk + ' .update-idea-sv').html().replace(/[^0-9.]/g, "");
    }

    if (type === 'cpc') {
        var cpc = newValue;
    } else {
        var cpc = $('.idea-' + pk + ' .update-idea-cpc').html().replace(/[^0-9.]/g, "");
    }

    if (type === 'ppp') {
        var ppp = newValue;
    } else {
        var ppp = $('.idea-' + pk + ' .update-idea-ppp').html().replace(/[^0-9.]/g, "");
    }

    if (type === 'bc') {
        var bc = newValue;
    } else {
        var bc = $('.idea-' + pk + ' .update-idea-bc').html().replace(/[^0-9.]/g, "");
    }

    if (type === 'provision') {
        var provision = newValue;
    } else {
        var provision = $('.idea-' + pk + ' .update-idea-provision').html().replace(/[^0-9.]/g, "");
    }


    var cpc_potential = sv * (bc / 100) * cpc;
    var cpc_potential = cpc_potential.toFixed(2);

    var ppp_potential = sv * (bc / 100) * ppp * (provision / 100);
    var ppp_potential = ppp_potential.toFixed(2);

    $('.idea-' + pk + ' .cpc-potential').html(cpc_potential);
    $('.idea-' + pk + ' .ppp-potential').html(ppp_potential);
}