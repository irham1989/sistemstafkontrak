$("#leave-date-range").flatpickr({
    altInput: true,
    altFormat: "d-m-Y",
    dateFormat: "Y-m-d",
    mode: "range",
    minDate: "today"
});

$('#leave-approver').select2({
    ajax: {
        url: `${common.getUrl()}${moduleUrl}get-approver`,
        dataType: 'json',
        data: function (params) {
            let query = {
                search: params.term,
                branch_id: $('#position-branch-id').val(),
                staff_id: $('#staff-id').val(),
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
