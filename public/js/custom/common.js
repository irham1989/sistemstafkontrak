/**
 * This class is mainly for common things needed during development.
 * You may extend functionality by adding a prototype
 * @constructor
 */
function Common(){
    this.rootUrl = null;
    return this;
}

/**
 * Initialize with a default url
 * @param url
 * @returns {Common}
 */
Common.prototype.init = function(url){
    this.rootUrl = `${url}/`;
    return this;
}

/**
 * Retrieves the url set during initialization
 * @returns {null}
 */
Common.prototype.getUrl = function(){
    return this.rootUrl;
}

/**
 *
 * @param selector
 */
Common.prototype.getDropdownSelectedLabel = function(selector){
    return document.querySelector(selector).options[document.querySelector(selector).selectedIndex].text;
}

/**
 * Turn On Button Loader
 * @param selector
 */
Common.prototype.buttonLoadOnPress = function(selector){
    document.querySelector(selector).setAttribute("data-kt-indicator", "on");
}

/**
 * Turn Off Button Loader
 * @param selector
 */
Common.prototype.buttonLoadOff = function(selector){
    document.querySelector(selector).removeAttribute("data-kt-indicator");
}

Common.prototype.getRowId = function(selector, attr){
    return selector.closest('tr').getAttribute(attr);
}

Common.prototype.getForm = function(array = false){
    let formdata;
    if(array){
        formdata = [];
        formdata.push({'_token': document.querySelector('input[name="_token"]').value});
    }
    formdata = new FormData();
    formdata.append('_token', document.querySelector('input[name="_token"]').value);

    return formdata;
}

Common.prototype.setFormValue = function(selector, value, inputType){
    if(inputType == 'string'){
        document.querySelector(selector).value = value;
    }else if(inputType == 'dropdown'){
        let element = document.querySelector(selector);
        element.value = value;
        const event = new Event('change', { bubbles: true });
        element.dispatchEvent(event);
    }
}

Common.prototype.resetForm = function(dArray){
    let validScript = new Validscript();
    if(dArray.length > 0){
        dArray.forEach(function(d){
            validScript.resetInput(d[0], d[1]);
        })
    }
}


