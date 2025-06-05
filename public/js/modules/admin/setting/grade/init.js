let gradeModal = new Modals({selector: '#grade-modal'});

let table = new DatatableInit({
    url: `${common.getUrl()}${moduleUrl}list`,
    method: 'POST',
    selector: '#grade-list',
    prev: '#grade-prev',
    next: '#grade-next',
    columns: [
        {
            data: 'name'
        },
        {
            data: 'action',
            raw: function (full) {
                return `<div class="dropdown">
                      <button class="btn btn-icon btn-warning" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-pencil fs-4"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><button class="dropdown-item text-warning grade-edit">Kemaskini</button></li>
                        <li><button class="dropdown-item text-danger grade-delete">Padam</button></li>
                      </ul>
                    </div>`;

            }
        }
    ]
})
table.setSearchButton('#grade-list-search').setupChangePage('#grade-prev', '#grade-next');
table.run();

function resetGradeForm(){
    common.resetForm([
        ['#grade-name', 'string'],
    ])

    common.setFormValue('#grade-id', '', 'string');
}
