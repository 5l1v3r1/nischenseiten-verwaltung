$(document).ready(function () {
    $('#projectkeyword-table').on('click', '.refresh-projectkeyword', function (event) {
        event.preventDefault();
        var projectkeyword_pk = $(this).data('pk');
        var current_button = $(this);

        var keyword = $('.projectkeyword-' + projectkeyword_pk + ' .update-projectkeyword-name').html();

        if (keyword != '' && keyword != 'Eintragen...') {
            current_button.find('.fa').addClass('fa-spin').addClass('green');

            $.ajax({
                url: '/api/v1/project/check/keyword',
                data: {pk: projectkeyword_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status == 1) {
                        refresh_keyword_data_in_row(projectkeyword_pk, data.keyword);
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
            push_error(200, '#message', 'Das Keyword ist leer, hör auf deine Credits zu verballern!');
        }

    });

});

function refresh_keyword_data_in_row(pk, keyword) {
    $('.projectkeyword-' + pk + ' .update-projectkeyword-sv').html(keyword.searchvolume);
    $('.projectkeyword-' + pk + ' .update-projectkeyword-cpc').html(keyword.cpc);
    $('.projectkeyword-' + pk + ' .update-projectkeyword-comp').html(keyword.competition);
}