$('#user-add').on('click', function(){
    resetUserForm();
    userModal.show({
        title: 'Tambah Pengguna',
        buttons: [
            {
                selector: '#user-store-add',
                show: true
            },
            {
                selector: '#user-store-update',
                show: false
            }
        ]
    });
})

$(document).on('click','.user-edit', function(){
    resetUserForm();
    let id = common.getRowId(this, 'data-id');
    let data = common.getForm();
    data.append('id', id);

    userModal.show({
        title: 'Kemaskini Pengguna',
        buttons: [
            {
                selector: '#user-store-add',
                show: false
            },
            {
                selector: '#user-store-update',
                show: true
            }
        ],
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}get-info`,
                data: data,
                method: 'POST',
                callback: function(r){
                    if(r.status){
                        common.setFormValue('#name', r.data.name, 'string');
                        common.setFormValue('#email', r.data.email, 'string');
                        common.setFormValue('#role', r.data.role_ids, 'dropdown');
                        common.setFormValue('#identification_no', r.data.ic_no, 'string');
                        common.setFormValue('#user-id', r.data.id, 'string');

                        $('#role').trigger('change');
                    }else{
                        alerting.error(r.data);
                    }
                }
            });
        }
    });
})

$('#user-store-add').on('click', () => userStoreUpdate('#user-store-add'));
$('#user-store-update').on('click', () => userStoreUpdate('#user-store-update'));

function userStoreUpdate(selector){
    common.buttonLoadOnPress(selector);
    let v = new Validscript('ms');

    v.validMix('#name', 'Nama')
    v.validEmail('#email', 'E-Mel')
    v.validInt('#identification_no', 'No. IC')
    v.validInt('#role', 'Role')
    if(v.checkFail()){
        alerting.formRequired();
        common.buttonLoadOff(selector);
        return false;
    }

    v.setNewEntry('id', $('#user-id').val());

    http.fetch({
        url: `${common.getUrl()}${moduleUrl}store-update`,
        data: v.data,
        method: 'POST',
        callback: function(r){
            if(r.status){
                alerting.fireSwal({
                    text: r.data.message,
                    icon: 'success',
                    buttonColor: 'btn btn-success',
                    confirmButton: 'Close',
                    callback: function(){
                        userModal.hide();
                        table.reload();
                    }
                })
            }else{
                alerting.error(r.data);
            }

            common.buttonLoadOff(selector);
        }
    })
}

$(document).on('click', '.user-active', function(){
    let data = common.getForm();
    data.append('id', common.getRowId(this, 'data-id'));
    let currentActive = $(this).attr('data-active');

    data.append('active', currentActive)

    alerting.fireSwal({
        text: currentActive == 0 ? 'Aktifkan Pengguna?' : 'Nyahaktifkan Pengguna?',
        icon: currentActive == 0 ? 'warning' : 'error',
        confirmButton: 'Ya',
        buttonColor: 'btn btn-warning',
        showCancelButton: true,
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}user-active`,
                data: data,
                method: 'POST',
                callback: function(r){
                    if(r.status){
                        alerting.fireSwal({
                            text: r.data.message,
                            icon: 'success',
                            buttonColor: 'btn btn-success',
                            confirmButton: 'Close',
                            callback: function(){
                                table.reload();
                            }
                        })
                    }else{
                        alerting.error(r.data);
                    }
                }
            });
        }
    })
})
