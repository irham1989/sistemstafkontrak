let branchModal = new Modals({selector: '#branch-modal'});

let table = new DatatableInit({
    url: `${common.getUrl()}${moduleUrl}branch-list`,
    method: 'POST',
    selector: '#branch-list',
    prev: '#branch-prev',
    next: '#branch-next',
    columns: [
        {
            data: 'branch'
        },
        {
            data: 'state'
        },
        {
            data: 'action',
            raw: function (full) {
                return `<div class="dropdown">
                      <button class="btn btn-icon btn-warning" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-pencil fs-4"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><a href="${common.getUrl()}admin/branch/${full.id}/main" class="dropdown-item text-warning">Kemaskini</a></li>
                        <li><button class="dropdown-item text-danger branch-delete">Padam</button></li>
                      </ul>
                    </div>`;

            }
        }
    ]
})
table.setSearchButton('#branch-list-search').setupChangePage('#branch-prev', '#branch-next');
table.run();

function resetBranchForm(){
    common.resetForm([
        ['#name', 'string'],
        ['#state', 'dropdown'],
        ['#hq', 'dropdown'],
    ])

    common.setFormValue('#branch-id', '', 'string');
}
