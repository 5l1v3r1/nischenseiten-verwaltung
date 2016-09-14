$(document).ready(function () {
    $('#category-table').on('click', '.delete-category', function () {
        var category_pk = $(this).data('pk');
        var really_delete = confirm("Soll der Eintrag wirklich gelöscht werden?");

        if (really_delete) {
            $.ajax({
                url: '/api/v1/category/delete',
                data: {pk: category_pk},
                dataType: 'JSON',
                type: 'POST',
                success: function (data) {
                    if (data.status === 1) {
                        $('.category-' + category_pk).fadeOut();
                    } else {
                        push_error(data.status, '#message', 'Eintrag konnte nicht gelöscht werden.');
                    }
                },
                error: function (data, errorThrown) {
                    push_error(data.status, '#message', data.responseText);
                }

            });
        }
    });
});