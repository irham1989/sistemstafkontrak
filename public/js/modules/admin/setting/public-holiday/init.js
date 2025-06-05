let phModal = new Modals({selector: '#ph-modal'});

let table = new DatatableInit({
    url: `${common.getUrl()}${moduleUrl}list`,
    method: 'POST',
    selector: '#ph-list',
    prev: '#ph-prev',
    next: '#ph-next',
    columns: [
        {
            data: 'year'
        },
        {
            data: 'state'
        },
        {
            data: 'name'
        },
        {
            data: 'date'
        },
    ]
})
table.setSearchButton('#ph-list-search').setupChangePage('#ph-prev', '#ph-next');
table.run();

function resetPhForm(){
    common.resetForm([
        ['#question', 'string'],
        ['#answer', 'string'],
    ])

    common.setFormValue('#faq-id', '', 'string');
}
