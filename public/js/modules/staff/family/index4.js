$('#fam-add').on('click', function(){
    resetFamForm();
    famModal.show({
        title: 'Tambah Maklumat Keluarga',
        buttons: [
            {
                selector: '#fam-store-add',
                show: true
            },
            {
                selector: '#fam-store-update',
                show: false
            }
        ]
    });
})

$(document).on('click','.fam-edit', function(){
    resetFamForm();
    let id = common.getRowId(this, 'data-id');
    let data = common.getForm();
    data.append('id', id);

    famModal.show({
        title: 'Kemaskini Maklumat Keluarga',
        buttons: [
            {
                selector: '#fam-store-add',
                show: false
            },
            {
                selector: '#fam-store-update',
                show: true
            }
        ],
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}get-info-family`,
                data: data,
                method: 'POST',
                callback: function(r){
                    if(r.status){
                        common.setFormValue('#fam-relation', r.data.relation, 'dropdown')
                        common.setFormValue('#fam-name', r.data.name, 'string')
                        common.setFormValue('#fam-email', r.data.email, 'string')
                        common.setFormValue('#fam-dob', r.data.dob, 'string')
                        common.setFormValue('#fam-phone', r.data.phone, 'string')
                        common.setFormValue('#fam-id', r.data.id, 'string');
                    }else{
                        alerting.error(r.data);
                    }
                }
            });
        }
    });
})

$('#fam-store-add').on('click', () => famStoreUpdate('#fam-store-add'));
$('#fam-store-update').on('click', () => famStoreUpdate('#fam-store-update'));

function famStoreUpdate(selector){
    common.buttonLoadOnPress(selector);
    let v = new Validscript('ms');
    v.validString('#fam-relation', 'Hubungan', true)
    v.validMix('#fam-name', 'Nama')
    v.validRegularDate('#fam-dob', 'Tarikh Lahir')
    v.validMix('#fam-phone', 'No. Telefon')

    if(v.checkFail()){
        alerting.formRequired();
        common.buttonLoadOff(selector);
        return false;
    }

    v.setNewEntry('fam_email', $('#fam-email').val());
    v.setNewEntry('staff_id', staff_id)

    http.fetch({
        url: `${common.getUrl()}${moduleUrl}store-update-family`,
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
                        famModal.hide();
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

$(document).on('click', '.fam-delete', function(){
    let data = common.getForm();
    data.append('id', common.getRowId(this, 'data-id'));

    alerting.fireSwal({
        text: 'Padam Data Ini?',
        icon: 'error',
        confirmButton: 'Padam',
        buttonColor: 'btn btn-warning',
        showCancelButton: true,
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}delete-family`,
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
