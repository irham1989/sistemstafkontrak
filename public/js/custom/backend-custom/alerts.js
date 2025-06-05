function Alerts(language){
    this.language = language;
}

Alerts.prototype.formRequired = function(){
    this.fireSwal({
        text: this.language == 'ms' ? 'Sila Isi Semua Maklumat' : 'Please Fill In Required Details',
        icon: 'error',
        confirmButton: this.language == 'ms' ? 'Tutup' : 'Close',
        buttonColor: 'btn btn-danger'
    });
}

Alerts.prototype.fireSwal = function(
    {
        text,
        icon,
        confirmButton,
        buttonColor = 'btn btn-primary',
        callback = function(){},
        showCancelButton = false,
    }){
    Swal.fire({
        text: text,
        icon: icon,
        buttonsStyling: true,
        confirmButtonText: confirmButton,
        customClass: {
            confirmButton: buttonColor,
            cancelButton: 'btn btn-danger'
        },
        showCancelButton: showCancelButton,
    }).then((result) => {
        if (result.value) {
            callback();
        }else if (result.dismiss === Swal.DismissReason.cancel) {

        }
    });
}

Alerts.prototype.error = function(message){
    this.fireSwal({
        text: message,
        icon: 'error',
        confirmButton: this.language == 'ms' ? 'Tutup' : 'Close',
        buttonColor: 'btn btn-danger'
    });
}
