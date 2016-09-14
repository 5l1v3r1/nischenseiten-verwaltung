$(document).ready(function () {
    $('#update-ranking').click(function (event) {
        event.preventDefault();
        $.ajax({
            url: '/api/v1/project/update/rankings',
            type: 'POST',
            success: function (data) {
                if(data.error === '') {
                    location.reload();
                } else {
                    push_error(data.status, '#message', data.error);
                }
                
                
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});