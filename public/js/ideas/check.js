$(document).ready(function () {
    $('#idea-table').on('click', '.refresh-ideakeyword', function (event) {
        event.preventDefault();
        var idea_pk = $(this).data('pk');
        var current_button = $(this);

        var keyword = $('.idea-' + idea_pk + ' .update-idea-topic').html();

        if (keyword != '' && keyword != 'Eintragen...') {
            current_button.find('.fa').addClass('fa-spin').addClass('green');

            $.ajax({
                url: '/api/v1/idea/check/keyword',
                data: {pk: idea_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status == 1) {
                        refresh_keyword_data_in_row(idea_pk, data.keyword);
                        push_error(200, '#message', 'Keyword wurde aktualisiert - verbleibende Kredits: ' + data.credits_left);
                        
                    } else {
                        push_error(data.status, '#message', data.error);
                    }
                    current_button.find('.fa').removeClass('fa-spin').removeClass('green');
                },
                error: function (data, errorThrown) {
                    current_button.find('.fa').removeClass('fa-spin').removeClass('green');
                    push_error(data.status, '#message', data.responseText);
                }

            });

        } else {
            push_error(200, '#message', 'Das Hauptkeyword ist leer, hör auf deine Credits zu verballern!');
        }

    });

});

function refresh_keyword_data_in_row(pk, keyword) {
    $('.idea-' + pk + ' .update-idea-sv').html(keyword.searchvolume);
    $('.idea-' + pk + ' .update-idea-cpc').html(keyword.cpc);
    load_xeditable_idea();
    
}