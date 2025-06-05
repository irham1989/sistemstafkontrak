let tableData = common.getForm(false)
tableData.append('user_id', user_id)
tableData.append('is_super', is_super)
tableData.append('is_admin', is_admin)
tableData.append('is_approval', is_approval)
tableData.append('is_staff', is_staff)

let table = new DatatableInit({
    url: `${common.getUrl()}${moduleUrl}approval-list`,
    method: 'POST',
    selector: '#approval-list',
    data: tableData,
    prev: '#approval-prev',
    next: '#approval-next',
    columns: [
        {
            data: 'name'
        },
        {
            data: 'h_date'
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

                if(status_id == 1){
                    btn = `<div class="dropdown">
                      <button class="btn btn-icon btn-warning" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           <i class="fas fa-pencil fs-4"></i>
                      </button>
                      <ul class="dropdown-menu">
                        ${btn}
                        <li><button class="dropdown-item text-success approval-approve" data-approve="1">Sahkan Cuti</button></li>
                        <li><button class="dropdown-item text-danger approval-approve" data-approve="2">Tidak Sahkan Cuti</button></li>
                      </ul>
                    </div>`;
                }
                return btn;
            }
        }
    ]
})
table.setSearchButton('#approval-list-search').setupChangePage('#approval-prev', '#approval-next');
table.run();
