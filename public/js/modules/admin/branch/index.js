$('#branch-add').on('click', function(){
    resetBranchForm();
    branchModal.show({
        title: 'Tambah Penempatan',
        buttons: [
            {
                selector: '#branch-store-add',
                show: true
            },
            {
                selector: '#branch-store-update',
                show: false
            }
        ]
    });
})

$('#branch-store-add').on('click', () => branchStoreUpdate('#branch-store-add'));

function branchStoreUpdate(selector){
    common.buttonLoadOnPress(selector);
    let v = new Validscript('ms');

    v.validMix('#name', 'Nama')
    v.validInt('#state', 'Negeri', true)

    if(v.checkFail()){
        alerting.formRequired();
        common.buttonLoadOff(selector);
        return false;
    }

    v.setNewEntry('hq', $('#hq').val());
    v.setNewEntry('id', $('#branch-id').val());

    http.fetch({
        url: `${common.getUrl()}${moduleUrl}store-update`,
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
                        window.location.href = `${common.getUrl()}admin/branch/${r.data.id}/main`;
                    }
                })
            }else{
                alerting.error(r.data);
            }

            common.buttonLoadOff(selector);
        }
    })
}

$(document).on('click', '.branch-delete', function(){
    let data = common.getForm();
    data.append('id', common.getRowId(this, 'data-id'));

    alerting.fireSwal({
        text: 'Padam Penempatan?',
        icon: 'warning',
        confirmButton: 'Ya',
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
