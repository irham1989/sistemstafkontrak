$('#branch-store-update').on('click', () => branchStoreUpdate('#branch-store-update'));

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

    v.setNewEntry('hq', $('#hq').val())
    v.setNewEntry('id', $('#branch-id').val());

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
                        window.location.reload();
                    }
                })
            }else{
                alerting.error(r.data);
            }

            common.buttonLoadOff(selector);
        }
    })
}

