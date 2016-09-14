$(document).ready(function () {
    $('#backlink-table').on('click', '.refresh-link', function () {
        var backlink_pk = $(this).data('pk');
        var current_button = $(this);
        var target = $('.backlink-' + backlink_pk + ' .update-backlink-target').text();
        var source = $('.backlink-' + backlink_pk + ' .update-backlink-source').text();
        var really_delete = false;

        if (!validateURL(target) || !validateURL(source)) {
            push_error(200, '#message', 'Linkziel und Linkquelle dürfen nicht leer sein!');
        } else {
            var really_delete = confirm("Soll der Backlink wirklich geprüft werden?");
        }

        if (really_delete) {



            current_button.find('.fa').addClass('fa-spin').addClass('green');
            $.ajax({
                url: '/api/v1/project/check/backlink',
                data: {pk: backlink_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    current_button.find('.fa').removeClass('fa-spin').removeClass('green');
                    update_status_col(backlink_pk, data);
                    console.log(data);
                },
                error: function (data, errorThrown) {
                    push_error(data.status, '#message', data.responseText);
                    current_button.find('.fa').removeClass('fa-spin').removeClass('green');
                }

            });
            
        }
    });

});

function update_status_col(backlink_pk, data) {
    if (data.check_status === 200) {
        $('.backlink-' + backlink_pk + ' .status').html('<span class="green">200</span>');
    } else {
        $('.backlink-' + backlink_pk + ' .status').html('<span class="red">' + data.check_status + '</span>');
    }

    if (data.found === 1) {
        $('.backlink-' + backlink_pk + ' .found').html('<span class="green">Ja</span>');
    } else {
        $('.backlink-' + backlink_pk + ' .found').html('<span class="red">Nein</span>');
    }

}
