$('#faq-add').on('click', function(){
    resetFaqForm();
    faqModal.show({
        title: 'Tambah FAQ',
        buttons: [
            {
                selector: '#faq-store-add',
                show: true
            },
            {
                selector: '#faq-store-update',
                show: false
            }
        ]
    });
})

$(document).on('click','.faq-edit', function(){
    resetFaqForm();
    let id = common.getRowId(this, 'data-id');
    let data = common.getForm();
    data.append('id', id);

    faqModal.show({
        title: 'Kemaskini FAQ',
        buttons: [
            {
                selector: '#faq-store-add',
                show: false
            },
            {
                selector: '#faq-store-update',
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
                        common.setFormValue('#question', r.data.question, 'string');
                        common.setFormValue('#answer', r.data.answer, 'string');
                        common.setFormValue('#faq-id', r.data.id, 'string');
                    }else{
                        alerting.error(r.data);
                    }
                }
            });
        }
    });
})

$('#faq-store-add').on('click', () => faqStoreUpdate('#faq-store-add'));
$('#faq-store-update').on('click', () => faqStoreUpdate('#faq-store-update'));

function faqStoreUpdate(selector){
    common.buttonLoadOnPress(selector);
    let v = new Validscript();

    v.validMix('#question', 'Soalan')
    v.validMix('#answer', 'Jawapan')

    if(v.checkFail()){
        alerting.formRequired();
        common.buttonLoadOff(selector);
        return false;
    }

    v.setNewEntry('id', $('#faq-id').val());

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
                        faqModal.hide();
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

$(document).on('click', '.faq-delete', function(){
    let data = common.getForm();
    data.append('id', common.getRowId(this, 'data-id'));

    alerting.fireSwal({
        text: 'Padam FAQ Ini?',
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
