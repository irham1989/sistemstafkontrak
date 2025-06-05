$('#position-add').on('click', function(){
    resetPositionForm();
    positionModal.show({
        title: 'Tambah Jawatan',
        buttons: [
            {
                selector: '#position-store-add',
                show: true
            },
            {
                selector: '#position-store-update',
                show: false
            }
        ]
    });
})

$(document).on('click','.position-edit', function(){
    resetPositionForm();
    let id = common.getRowId(this, 'data-id');
    let data = common.getForm();
    data.append('id', id);

    positionModal.show({
        title: 'Kemaskini Jawatan',
        buttons: [
            {
                selector: '#position-store-add',
                show: false
            },
            {
                selector: '#position-store-update',
                show: true
            }
        ],
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}position-get-info`,
                data: data,
                method: 'POST',
                callback: function(r){
                    if(r.status){
                        common.setFormValue('#position-name', r.data.name, 'dropdown');
                        common.setFormValue('#position-grade', r.data.grade, 'dropdown');
                        common.setFormValue('#position-holiday', r.data.holiday, 'string');
                        common.setFormValue('#position-id', r.data.id, 'string');
                    }else{
                        alerting.error(r.data);
                    }
                }
            });
        }
    });
})

$('#position-store-add').on('click', () => positionStoreUpdate('#position-store-add'));
$('#position-store-update').on('click', () => positionStoreUpdate('#position-store-add'));

function positionStoreUpdate(selector){
    common.buttonLoadOnPress(selector);
    let v = new Validscript('ms');

    v.validInt('#position-name', 'Jawatan', true)
    v.validInt('#position-grade', 'Gred', true)
    v.validDoubleInt('#position-holiday', 'Bilangan Cuti')

    if(v.checkFail()){
        alerting.formRequired();
        common.buttonLoadOff(selector);
        return false;
    }

    v.setNewEntry('id', $('#position-id').val());
    v.setNewEntry('branch_id', branch_id);

    http.fetch({
        url: `${common.getUrl()}${moduleUrl}position-store-update`,
        data: v.data,
        method: 'POST',
        callback: function(r){
            console.log(r);
            if(r.status){
                alerting.fireSwal({
                    text: r.data.message,
                    icon: 'success',
                    buttonColor: 'btn btn-success',
                    confirmButton: 'Close',
                    callback: function(){
                        positionModal.hide();
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

$(document).on('click', '.position-delete', function(){
    let data = common.getForm();
    data.append('id', common.getRowId(this, 'data-id'));

    alerting.fireSwal({
        text: 'Padam Jawatan?',
        icon: 'warning',
        confirmButton: 'Ya',
        buttonColor: 'btn btn-warning',
        showCancelButton: true,
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}position-delete`,
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
