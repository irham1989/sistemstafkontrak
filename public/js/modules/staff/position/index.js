$('#update-position').on('click', function(){
    common.buttonLoadOnPress('#update-position');
    let v = new Validscript();
    v.validInt('#state-select', 'Negeri', true)
    v.validInt('#branch-select', 'Penempatan', true)
    v.validInt('#position-select', 'Jawatan/Gred', true)

    if (v.checkFail()) {
        alerting.formRequired();
        return false;
    }

    v.setNewEntry('staff_id', staff_id);

    http.fetch({
        url: `${common.getUrl()}${moduleUrl}store-update-position`,
        data: v.data,
        method: 'POST',
        callback: function(r){
            common.buttonLoadOff('#update-position');
            if(r.status){
                alerting.fireSwal({
                    text: r.data.message,
                    icon: 'success',
                    buttonColor: 'btn btn-success',
                    confirmButton: 'Close',
                    callback: function(){
                        window.location.href = `${common.getUrl()}${moduleUrl}${user_id}/${page}`;
                    }
                })
            }else{
                alerting.error(r.data);
            }
        }
    })
})

$('#update-leave-balance').on('click', function(){
    common.buttonLoadOnPress('#update-leave-balance')
    let v = new Validscript()
    v.validDoubleInt('#new-leave-balance', 'Jumlah Cuti Baru')

    if (v.checkFail()) {
        alerting.formRequired();
        return false;
    }

    v.setNewEntry('staff_id', staff_id);

    http.fetch({
        url: `${common.getUrl()}${moduleUrl}store-update-new-leave-balance`,
        data: v.data,
        method: 'POST',
        callback: function(r){
            common.buttonLoadOff('#update-leave-balance');
            if(r.status){
                alerting.fireSwal({
                    text: r.data.message,
                    icon: 'success',
                    buttonColor: 'btn btn-success',
                    confirmButton: 'Close',
                    callback: function(){
                        window.location.reload()
                    }
                })
            }else{
                alerting.error(r.data);
            }
        }
    })
})
