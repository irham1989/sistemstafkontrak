$('#academic-add').on('click', function(){
    resetAcademicForm();
    academicModal.show({
        title: 'Tambah Akademik',
        buttons: [
            {
                selector: '#academic-store-add',
                show: true
            },
            {
                selector: '#academic-store-update',
                show: false
            }
        ]
    });
})

$(document).on('click','.academic-edit', function(){
    resetAcademicForm();
    let id = common.getRowId(this, 'data-id');
    let data = common.getForm();
    data.append('id', id);

    academicModal.show({
        title: 'Kemaskini Akademik',
        buttons: [
            {
                selector: '#academic-store-add',
                show: false
            },
            {
                selector: '#academic-store-update',
                show: true
            }
        ],
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}get-info-academic`,
                data: data,
                method: 'POST',
                callback: function(r){
                    if(r.status){
                        common.setFormValue('#qualification', r.data.academic_qualification_id, 'dropdown');
                        common.setFormValue('#cert-name', r.data.certificate_name, 'string');
                        common.setFormValue('#institution-name', r.data.institution_name, 'string');
                        common.setFormValue('#institution-location', r.data.institution_location, 'string');
                        common.setFormValue('#major-specialization', r.data.major_specialization, 'string');
                        common.setFormValue('#minor-specialization', r.data.minor_specialization, 'string');
                        common.setFormValue('#profession-cert', r.data.professional_certification, 'string');
                        common.setFormValue('#profession-cert-date', r.data.professional_certification_date, 'string');
                        common.setFormValue('#overall-grade', r.data.overall_grade, 'string');

                        common.setFormValue('#academic-id', r.data.id, 'string');
                    }else{
                        alerting.error(r.data);
                    }
                }
            });
        }
    });
})

$('#academic-store-add').on('click', () => academicStoreUpdate('#academic-store-add'));
$('#academic-store-update').on('click', () => academicStoreUpdate('#academic-store-update'));

function academicStoreUpdate(selector){
    common.buttonLoadOnPress(selector);
    let v = new Validscript('ms');

    v.validInt('#qualification', 'Tahap Pendidikan', true)
    v.validMix('#cert-name', 'Nama Sijil')
    v.validMix('#institution-name', 'Nama Institusi')
    v.validMix('#institution-location', 'Lokasi Institusi')
    v.validMix('#major-specialization', 'Pengkhususan Major')

    if($('#profession-cert-date').val() != ''){
        v.validRegularDate('#profession-cert-date', 'Tarikh Penganugerahaan')
    }

    if($('#profession-cert').val() != ''){
        v.validMix('#profession-cert', 'Kelayakan Sijil')
    }

    if($('#overall-grade').val() != ''){
        v.validMix('#overall-grade', 'Gred Keseluruhan')
    }

    if(v.checkFail()){
        alerting.formRequired();
        common.buttonLoadOff(selector);
        return false;
    }

    v.setNewEntry('id', $('#academic-id').val());
    v.setNewEntry('minor_specialization;', $('#minor-specialization').val());
    v.setNewEntry('staff_id', staff_id)

    http.fetch({
        url: `${common.getUrl()}${moduleUrl}store-update-academic`,
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
                        academicModal.hide();
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

$(document).on('click', '.academic-delete', function(){
    let data = common.getForm();
    data.append('id', common.getRowId(this, 'data-id'));

    alerting.fireSwal({
        text: 'Padam Akademik Ini? Semua Peserta Yang Menggunakan Akademik Akan Dipadam',
        icon: 'error',
        confirmButton: 'Padam',
        buttonColor: 'btn btn-warning',
        showCancelButton: true,
        callback: function(){
            http.fetch({
                url: `${common.getUrl()}${moduleUrl}delete-academic`,
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
