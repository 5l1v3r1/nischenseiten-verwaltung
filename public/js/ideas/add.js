$(document).ready(function () {

    $('#add-idea').click(function (event) {
        event.preventDefault();

        $.ajax({
            url: '/api/v1/idea/insert',
            type: 'POST',
            success: function (data) {
                var pk = data.pk;
                if (pk > 0) {
                    if ($('#idea-table').length == 0) {
                        location.reload();
                    }
                    add_new_idea_row(pk, 'top');
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });

    $('#add-idea-bottom').click(function (event) {

        event.preventDefault();
        $.ajax({
            url: '/api/v1/idea/insert',
            type: 'POST',
            success: function (data) {
                var pk = data.pk;
                if (pk > 0) {
                    if ($('#idea-table').length == 0) {
                        location.reload();
                    }
                    add_new_idea_row(pk, 'bottom');
                }
            },
            error: function (data) {
                push_error(data.status, '#message', data.responseText);
            }
        });
    });
});

function add_new_idea_row(pk, position) {
    var row = $('<tr class="idea-' + pk + '"></tr>');
    var col_id = $('<td>' + pk + '</td>');
    var col_name = $('<td><a class="update-idea-topic" data-pk="' + pk + '"></a></td>');
    var col_cat = $('<td><a class="update-idea-category" data-pk="' + pk + '"></a></td>');
    var col_sv = $('<td><a class="update-idea-sv" data-pk="' + pk + '">0</a></td>');
    var col_cpc = $('<td><a class="update-idea-cpc" data-pk="' + pk + '">0</a></td>');
    var col_ppp = $('<td><a class="update-idea-ppp" data-pk="' + pk + '">0</a></td>');
    var col_bc = $('<td><a class="update-idea-bc" data-pk="' + pk + '">0</a></td>');
    var col_pot = $('<td><span class="update-idea-potential">CPC: <span class="cpc-potential">0</span> €<br />PPP: <span class="ppp-potential">0</span> €</span></td>');
    var col_partner = $('<td><a class="update-idea-partnerprogram" data-pk="' + pk + '"></a></td>');
    var col_provision = $('<td><a class="update-idea-provision" data-pk="' + pk + '">0</a></td>');
    var col_seasonal = $('<td><a class="update-idea-seasonal" data-value="0" data-pk="' + pk + '">Nein</a></td>');
    var col_keywords = $('<td><a class="update-idea-keywords" data-pk="' + pk + '"></a></td>');
    var col_domains = $('<td><a class="update-idea-domains" data-pk="' + pk + '"></a></td>');
    var col_compower = $('<td><a class="update-idea-competitionpower" data-pk="' + pk + '"></a></td>');
    var col_ranking = $('<td><a class="update-idea-ranking" data-pk="' + pk + '"></a></td>');
    var col_edit = $('<td><a class="idea-notes" href="/ideas/note/' + pk + '"><i class="fa fa-comment-o"></i></a></td>');
    var col_refresh = $('');
    
    if (api_active) {
        var col_refresh = $('<td><a class="refresh-ideakeyword" data-pk="' + pk + '" href="#"><i class="fa fa-refresh"></i></a></td>');
    }
    var col_delete = $('<td><a class="delete-idea" data-pk="' + pk + '" href="#"><i class="fa fa-trash"></i></a></td>');

    if (position == 'top') {
        row.append(col_id, col_name, col_cat, col_sv, col_cpc, col_ppp, col_bc, col_pot, col_partner, col_provision, col_seasonal, col_keywords, col_domains, col_compower, col_ranking, col_edit, col_refresh, col_delete).hide().prependTo("#idea-table").fadeIn();
    } else {
        row.append(col_id, col_name, col_cat, col_sv, col_cpc, col_ppp, col_bc, col_pot, col_partner, col_provision, col_seasonal, col_keywords, col_domains, col_compower, col_ranking, col_edit, col_refresh, col_delete).hide().appendTo("#idea-table").fadeIn();
    }


    load_xeditable_idea();
}