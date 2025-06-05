$('#state-select').on('change', function (){
    window.location.href = `${common.getUrl()}${moduleUrl}${user_id}/${page}?state_select=${$(this).val()}`;
})

$('#branch-select').on('change', function (){
    window.location.href = `${common.getUrl()}${moduleUrl}${user_id}/${page}?state_select=${$('#state-select').val()}&branch_select=${$(this).val()}`;
})

$('#branch-select').select2({
    ajax: {
        url: `${common.getUrl()}${moduleUrl}get-branch-by-state`,
        dataType: 'json',
        data: function (params) {
            let query = {
                search: params.term,
                state_select: $('#state-select').val(),
            }
            return query;
        },
        processResults: function (data) {
            return {
                results: data.items
            };
        }
    },
});

$('#position-select').select2({
    ajax: {
        url: `${common.getUrl()}${moduleUrl}get-position-by-branch`,
        dataType: 'json',
        data: function (params) {
            let query = {
                search: params.term,
                branch_select: $('#branch-select').val(),
            }
            return query;
        },
        processResults: function (data) {
            return {
                results: data.items
            };
        }
    },
});
