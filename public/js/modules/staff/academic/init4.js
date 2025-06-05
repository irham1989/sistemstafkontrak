$("#profession-cert-date").flatpickr({
    dateFormat: "d-m-Y",
});

let academicModal = new Modals({selector: '#academic-modal'});

let academicData = common.getForm(false)
academicData.append('staff_id', staff_id)

let table = new DatatableInit({
    url: `${common.getUrl()}${moduleUrl}academic-list`,
    method: 'POST',
    data: academicData,
    selector: '#academic-list',
    prev: '#academic-prev',
    next: '#academic-next',
    columns: [
        {
            data: 'institution'
        },
        {
            data: 'certificate'
        },
        {
            data: 'specialization'
        },
        {
            data: 'grade'
        },
        {
            data: 'action',
            raw: function (full) {
                return `<div class="dropdown">
                      <button class="btn btn-icon btn-warning" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-pencil fs-4"></i>
                      </button>
                      <ul class="dropdown-menu">
                        <li><button class="dropdown-item text-warning academic-edit">Kemaskini</button></li>
                        <li><button class="dropdown-item text-danger academic-delete">Padam</button></li>
                      </ul>
                    </div>`;

            }
        }
    ]
})
table.setupChangePage('#academic-prev', '#academic-next');
table.run();

function resetAcademicForm(){
    common.resetForm([
        ['#qualification', 'dropdown'],
        ['#cert-name', 'string'],
        ['#institution-name', 'string'],
        ['#institution-location', 'string'],
        ['#major-specialization', 'string'],
        ['#minor-specialization', 'string'],
        ['#profession-cert', 'string'],
        ['#profession-cert-date', 'string'],
        ['#overall-grade', 'string'],
    ])

    common.setFormValue('#academic-id', '', 'string');
}
