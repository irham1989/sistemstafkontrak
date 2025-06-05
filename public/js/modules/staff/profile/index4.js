$('#update-profile').on('click', function(){
    let v = new Validscript('ms');
    v.validInt('#salutation', 'Nama Gelaran', true)
    v.validMix('#name', 'Nama')
    v.validInt('#identification-no', 'No. Kad Pengenalan')
    v.validEmail('#email', 'E-mel')
    v.validMix('#address', 'Alamat')
    v.validMix('#city', 'Daerah')
    v.validInt('#postal-code', 'Poskod')
    v.validInt('#country', 'Negara', true)
    v.validMix('#blood-type', 'Jenis Darah', true)

    v.validInt('#gender', 'Jantina', true)
    v.validInt('#religion', 'Agama', true)
    v.validRegularDate('#dob', 'Tarikh Lahir')
    v.validMix('#birth-certificate', 'No. Sijil Lahir')
    v.validInt('#birth-country', 'Negara Lahir', true)

    if(v.getFormDataByKey('country') == 106){
        v.validInt('#state', 'Negeri', true)
    }else{
        common.resetForm([
            ['#state', 'dropdown'],
        ])
    }

    if(v.getFormDataByKey('birth_country') == 106){
        v.validInt('#birth-state', 'Negeri Lahir', true)
    }else{
        common.resetForm([
            ['#birth-state', 'dropdown'],
        ])
    }

    v.validMix('#mobile-phone', 'No. Telefon')
    v.validInt('#marital', 'Taraf Perkahwinan', true)

    v.validInt('#race', 'Bangsa', true)
    v.validInt('#bumiputera', 'Bumiputera', true)

    if($('#race').find(':selected').attr('data-other') == 1){
        v.validMix('#race-other', 'Lain-lain')
    }

    // if($('#bumiputera').find(':selected').attr('data-other') == 1){
    //     v.validMix('#bumiputera-other', 'Lain-lain')
    // }

    if (v.checkFail()) {
        alerting.formRequired();
        return false;
    }

    v.setNewEntry('staff_id', staff_id);

    http.fetch({
        url: `${common.getUrl()}${moduleUrl}store-update-main`,
        data: v.data,
        method: 'POST',
        callback: function(r){
            common.buttonLoadOff('#update-profile');
            if(r.status){
                alerting.fireSwal({
                    text: r.data.message,
                    icon: 'success',
                    buttonColor: 'btn btn-success',
                    confirmButton: 'Close',
                    callback: function(){
                        window.location.href = r.data.url
                    }
                })
            }else{
                alerting.error(r.data);
            }
        }
    })
})

