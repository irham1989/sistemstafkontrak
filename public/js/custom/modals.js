function Modals({selector}){
    this.selector = selector;
    this.bsInstance = new bootstrap.Modal(selector);
}

Modals.prototype.show = function ({title = 'Add Modal', buttons = [], callback = function(){}}){
    let modalSelect = document.querySelector(this.selector);
    modalSelect.querySelector('.modal-title').innerHTML = title;

    if(buttons.length > 0){
        buttons.forEach(function(v){
            let selector = v.selector;
            let show = v.show;
            document.querySelector(selector).setAttribute('style', show ? '' : 'display:none !important');
        });
    }

    callback();

    this.bsInstance.show();
}

Modals.prototype.hide = function(){
    this.bsInstance.hide();
}