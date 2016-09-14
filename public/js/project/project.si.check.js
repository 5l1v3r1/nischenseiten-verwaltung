$(document).ready(function () {
    $('#metrics-panel').on('click', '#update-project-si', function (event) {
        event.preventDefault();
        var current_button = $(this);
        var really_delete = false;

        if (!validateURL(current_button.data('url'))) {
            push_error(200, '#message', 'Die Projekt URL scheint nicht valide zu sein!');
        } else {
            var really_delete = confirm("Soll der SI wirklich aktualisiert werden? Das lohnt sich etwa 1x pro Woche (ich empfehle Sonntag oder Montag).");
        }

        if (really_delete) {

            current_button.find('.fa').addClass('fa-spin').addClass('green');
            $.ajax({
                url: '/api/v1/project/create/si',
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    current_button.find('.fa').removeClass('fa-spin').removeClass('green');
                    console.log(data);
                    if(data.status === 1) {
                        location.reload();
                    } else {
                        push_error(data.status, '#message', data.error);
                    }
                },
                error: function (data, errorThrown) {
                    push_error(data.status, '#message', data.responseText);
                    current_button.find('.fa').removeClass('fa-spin').removeClass('green');
                    console.log(data);
                }

            });
            
        }
    });

});

