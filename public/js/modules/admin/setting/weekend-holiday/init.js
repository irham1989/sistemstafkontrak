let whModal = new Modals({selector: '#wh-modal'});

let table = new DatatableInit({
    url: `${common.getUrl()}${moduleUrl}list`,
    method: 'POST',
    selector: '#wh-list',
    prev: '#wh-prev',
    next: '#wh-next',
    columns: [
        {
            data: 'state'
        },
        {
            data: 'day'
        },
        {
            data: 'action',
            raw: function (full) {
                return `<div class="dropdown">
                      <button class="btn btn-icon btn-warning" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-pencil fs-4"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><button class="dropdown-item text-warning wh-edit">Kemaskini</button></li>
                        <li><button class="dropdown-item text-danger wh-delete">Padam</button></li>
                      </ul>
                    </div>`;

            }
        }
    ]
})
table.setSearchButton('#wh-list-search').setupChangePage('#wh-prev', '#wh-next');
table.run();

function resetWhForm(){
    common.resetForm([
        ['#state-select', 'dropdown'],
        ['#day-select', 'dropdown'],
    ])

    common.setFormValue('#wh-id', '', 'string');
}
