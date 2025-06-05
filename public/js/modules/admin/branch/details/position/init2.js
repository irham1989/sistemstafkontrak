let positionModal = new Modals({selector: '#position-modal'});

let branchPositionData = common.getForm(false);
branchPositionData.append('branch_id', branch_id);

let table = new DatatableInit({
    url: `${common.getUrl()}${moduleUrl}position-list`,
    method: 'POST',
    selector: '#position-list',
    data: branchPositionData,
    prev: '#position-prev',
    next: '#position-next',
    columns: [
        {
            data: 'position'
        },
        {
            data: 'grade'
        },
        {
            data: 'holiday'
        },
        {
            data: 'action',
            raw: function (full) {
                return `<div class="dropdown">
                      <button class="btn btn-icon btn-warning" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-pencil fs-4"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><button class="dropdown-item text-warning position-edit">Kemaskini</button></li>
                        <li><button class="dropdown-item text-danger position-delete">Padam</button></li>
                      </ul>
                    </div>`;

            }
        }
    ]
})
table.setSearchButton('#position-list-search').setupChangePage('#position-prev', '#position-next');
table.run();

function resetPositionForm(){
    common.resetForm([
        ['#position-name', 'dropdown'],
        ['#position-grade', 'dropdown'],
        ['#position-holiday', 'string'],
    ])

    common.setFormValue('#position-id', '', 'string');
}
