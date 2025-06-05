$('#wh-add').on('click', function(){
    resetWhForm();
    whModal.show({
        title: 'Tambah Cuti Biasa',
        buttons: [
            {
                selector: '#wh-store-add',
                show: true
            },
            {
                selector: '#wh-store-update',
                show: false
            }
        ]
    });
})

$(document).on('click','.wh-edit', function(){
    resetWhForm();
    let id = common.getRowId(this, 'data-id');
    let data = common.getForm();
    data.append('id', id);

    whModal.show({
        title: 'Kemaskini Cuti Biasa',
        buttons: [
            {
                selector: '#wh-store-add',
                show: false
            },
            {
                selector: '#wh-store-update',
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
                        common.setFormValue('#state-select', r.data.state_id, 'dropdown');
                        common.setFormValue('#day-select', r.data.day_id, 'dropdown');
                        common.setFormValue('#wh-id', r.data.id, 'string');
                    }else{
                        alerting.error(r.data);
                    }
                }
            });
        }
    });
})

$('#wh-store-add').on('click', () => whStoreUpdate('#wh-store-add'));
$('#wh-store-update').on('click', () => whStoreUpdate('#wh-store-update'));

function whStoreUpdate(selector){
    common.buttonLoadOnPress(selector);
    let v = new Validscript();

    v.validInt('#state-select', 'Negeri')
    v.validInt('#day-select', 'Hari')

    if(v.checkFail()){
        alerting.formRequired();
        common.buttonLoadOff(selector);
        return false;
    }

    v.setNewEntry('id', $('#wh-id').val());

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
                        whModal.hide();
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

$(document).on('click', '.wh-delete', function(){
    let data = common.getForm();
    data.append('id', common.getRowId(this, 'data-id'));

    alerting.fireSwal({
        text: 'Padam Cuti Biasa Ini?',
        icon: 'error',
        confirmButton: 'Padam',
        buttonColor: 'btn btn-warning',
        showCancelButton: true,
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}delete`,
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
