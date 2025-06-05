let tableData = common.getForm(false)
tableData.append('user_id', user_id)
tableData.append('is_super', is_super)
tableData.append('is_admin', is_admin)
tableData.append('is_approval', is_approval)
tableData.append('is_staff', is_staff)

let table = new DatatableInit({
    url: `${common.getUrl()}${moduleUrl}request-list`,
    method: 'POST',
    selector: '#request-list',
    data: tableData,
    prev: '#request-prev',
    next: '#request-next',
    columns: [
        {
            data: 'approver_name'
        },
        {
            data: 'dates'
        },
        {
            data: 'days'
        },
        {
            data: 'reason'
        },
        {
            data: 'status'
        },
        {
            data: 'action',
            raw: function (full) {
                let status_id = full.status_id;
                let btn = '-';
                if(status_id == 1) {
                    btn = `<div class="dropdown">
                          <button class="btn btn-icon btn-warning" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                               <i class="fas fa-pencil fs-4"></i>
                          </button>
                          <ul class="dropdown-menu">
                                <li><button class="dropdown-item text-danger request-delete">Padam Permohonan</button></li>
                          </ul>
                        </div>`
                }
                return btn;
            }
        }
    ]
})
table.setSearchButton('#request-list-search').setupChangePage('#request-prev', '#request-next');
table.run();
