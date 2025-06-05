/**
 * This script is for validation purposes
 * @param language
 * @constructor
 */
function Validscript(language = 'en'){
    this.language = language;
    this.pass = true;
    this.data = new FormData;
    this.data.append('_token', document.querySelector('input[name="_token"]').value);
}

//Provides the regular expression for validation purposes
Validscript.prototype.regExpList = {
    Mix: {
        regex: /^([a-zA-Z0-9"'.?,-`()!&/:\\-]+\s+)*[a-zA-Z0-9"'.?,-`()!&/:\\-]+$/,
        label: {
            ms: 'Simbol <> Tidak Dibenarkan',
            en: '<> Simbol Not Allowed'
        },
        override: false
    },
    EmptyOrInteger: {
        regex: /^\s*\d*\s*$/,
        label: {
            ms: 'Mesti Sama Ada Kosong Atau Integer Sahaja',
            en: 'Must Either Be Empty Or Integer Only'
        },
        override: false
    },
    EmailOrInteger: {
        regex: /^(?:\d+$|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/,
        label: {
            ms: 'Mesti Dalam Format E-Mel Atau Integer Sahaja',
            en: 'Must Be In E-Mail Format Or Integer Only'
        },
        override: false
    },
    String: {
        regex: /^([a-zA-Z]+\s)*[a-zA-Z]+$/,
        label: {
            ms: 'Mesti Hanya Mengandungi Aksara Dan Abjad Sahaja',
            en: 'Must Only Contain Characters And Alphabets Only'
        },
        override: false
    },
    Int: reObject = {
        regex: /^\d+$/,
        label: {
            ms: 'Mesti Hanya Mengandungi Digit',
            en: 'Must Only Contain Digits'
        },
        override: false
    },
    Double: {
        regex: /[^\.].+/,
        label: {
            ms: 'Mesti Hanya Dalam Format Berganda. Cth: 10.0',
            en: 'Must Only Be In Double Format. Ex: 10.0'
        },
        override: false
    },
    Email: {
        regex: /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/,
        label: {
            ms: 'Mesti Dalam Format E-mel Yang Benar. Cth: aaa@aaa.com',
            en: 'Must Be In Correct Email Format. Ex: aaa@aaa.com'
        },
        override: false
    },
    ReverseDate: {
        regex: /^\d{4}-\d{2}-\d{2}$/,
        label: {
            ms: 'Mesti Dalam Format Tarikh Yang Betul YYYY-MM-DD',
            en: 'Must Be In Correct Date Format YYYY-MM-DD'
        },
        override: false
    },
    RegularDate: {
        regex: /^\d{2}-\d{2}-\d{4}$/,
        label: {
            ms: 'Mesti Dalam Format Tarikh Yang Betul DD-MM-YYYY',
            en: 'Must Be In Correct Date Format DD-MM-YYYY'
        },
        override: false
    },
    EmptyOrRegularDate: {
        regex: /(\d{2}-\d{2}-\d{4})?/,
        label: {
            ms: 'Mesti Sama Ada Kosong Atau Format Tarikh Yang Betul DD-MM-YYYY',
            en: 'Must Either Be In Correct Date Format DD-MM-YYYY'
        },
        override: false
    },
    MixDoubleInt: {
        regex: /^[+-]?\d+(\.\d+)?$/,
        label: {
            ms: 'Mesti Hanya Dalam Format Berganda Atau Nombor',
            en: 'Must Only Be In Double Or Number Format'
        },
        override: false
    },
    DateAndTime: {
        regex: /^\d{2}-\d{2}-\d{4} (2[0-3]|[01][0-9]):[0-5][0-9]/,
        label: {
            ms: 'Mesti Dalam Format Tarikh Dan Masa',
            en: 'Must Be In Date And Time Format'
        },
        override: false
    },
    DropdownLabel: {
        label: {
            ms: 'Mesti Memilih Satu Pilihan',
            en: 'Option Must Be Selected'
        },
        override: false
    }
}

/**
 * Get the value from selector, if the given selector is invalid, an error is thrown
 * @param selector
 * @returns {{value: string | number, key: *}}
 */
Validscript.prototype.getValueAndKey = function(selector){
    try{
        let value = document.querySelector(selector).value;

        let key = selector.replace(/-+/g, '_').replace(/[.]+/g, '').replace(/#+/g, '').replace(/[]+/g, '');

        return {
            value: value,
            key: key
        }
    }catch(error){
        throw 'Please check your selector'
    }
}

/**
 * Test value against regex
 * @param selector
 * @param reg
 * @param keyVal
 * @param label
 * @param dropdown
 * @returns {boolean}
 */
Validscript.prototype.regTest = function(selector, reg, keyVal, label, dropdown = false, skipEmpty = false){
    if(!skipEmpty){
        if(keyVal.value === ''){
            this.setInValidStatus(this.language == 'ms' ? 'Medan Ini Diperlukan' : `Field Is Required`, selector);
            this.pass = false;
            return false;
        }
    }

    let match = reg.regex.test(keyVal.value);
    if(!match){
        let errorLabel = null;
        if(dropdown){
            errorLabel = this.regExpList.DropdownLabel.label[this.language];
        }else{
            errorLabel = reg.label[this.language];
        }
        this.pass = false;
        this.setInValidStatus(`${label} ${errorLabel}`, selector);
        return false;
    }
    this.setValidStatus(selector);
    this.data.append(keyVal.key, keyVal.value);
    return true;
}

/**
 * Validates input against special symbol regex
 * @param selector
 * @param label
 * @returns {Validscript}
 */
Validscript.prototype.validMix = function(selector, label){
    let reg = this.regExpList.Mix;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, false);
    return this;
}

/**
 * Validates input against string regex
 * @param selector
 * @param label
 * @param dropdown
 * @returns {Validscript}
 */
Validscript.prototype.validString = function(selector, label, dropdown = false){
    let reg = this.regExpList.String;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, dropdown);
    return this;
}

/**
 *
 * @param selector
 * @param label
 * @param dropdown
 * @returns {Validscript}
 */
Validscript.prototype.validRegularDate = function(selector, label, dropdown = false){
    let reg = this.regExpList.RegularDate;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, dropdown);
    return this;
}

Validscript.prototype.validEmptyOrRegularDate = function(selector, label, dropdown = false){
    let reg = this.regExpList.EmptyOrRegularDate;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, dropdown, true);
    return this;
}

/**
 *
 * @param selector
 * @param label
 * @param dropdown
 * @returns {Validscript}
 */
Validscript.prototype.validEmptyOrInteger = function(selector, label, dropdown = false){
    let reg = this.regExpList.EmptyOrInteger;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, dropdown, true);
    return this;
}

/**
 *
 * @param selector
 * @param label
 * @param dropdown
 * @returns {Validscript}
 */
Validscript.prototype.validEmailOrInteger = function(selector, label, dropdown = false){
    let reg = this.regExpList.EmailOrInteger;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, dropdown);
    return this;
}

/**
 *
 * @param selector
 * @param label
 * @param dropdown
 * @returns {Validscript}
 */
Validscript.prototype.validEmail = function(selector, label, dropdown = false){
    let reg = this.regExpList.Email;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, dropdown);
    return this;
}

/**
 * Validates input against integer regex, set dropdown = true for label purposes
 * @param selector
 * @param label
 * @param dropdown
 * @returns {Validscript}
 */
Validscript.prototype.validInt = function(selector, label, dropdown = false){
    let reg = this.regExpList.Int;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, dropdown);
    return this;
}

Validscript.prototype.validDoubleInt = function(selector, label, dropdown = false){
    let reg = this.regExpList.MixDoubleInt;
    let keyVal = this.getValueAndKey(selector);
    this.regTest(selector, reg, keyVal, label, dropdown);
    return this;
}

Validscript.prototype.validUpload = function(selector, label, extensions = [], key, optional = false){
    let getVal = document.querySelector(selector).files[0];
    if(!optional){
        if(!getVal){
            this.setInValidStatus(`Field Is Required`, selector);
            this.pass = false;
            return this;
        }
    }

    if(getVal){
        if(extensions.length > 0){
            let fileName = getVal.name;
            let extension = fileName.split('.').pop();
            if(extensions.includes(extension)){
                this.setValidStatus(selector);
                this.data.append(key, getVal);
            }else{
                this.setInValidStatus(this.language == 'ms' ? ' Format Fail Tidak Betul' : ' File Format Is Incorrect', selector);
                this.pass = false;
            }
        }else{
            this.setValue(selector, key, true);
        }
    }

    return this;
}

/**
 * Set Input As Invalid
 * @param fullLabel
 * @param selector
 */
Validscript.prototype.setInValidStatus = function(fullLabel, selector){
    let select = document.querySelector(selector);
    let classList = select.classList;
    classList.add('is-invalid');
    classList.remove('is-valid');
    select.closest('.vals-row').querySelector('.invalid-feedback').innerHTML = fullLabel;
}

/**
 * Set Input As Valid
 * @param selector
 */
Validscript.prototype.setValidStatus = function(selector){
    let classList = document.querySelector(selector).classList;
    classList.add('is-valid');
    classList.remove('is-invalid');
}

/**
 *
 * @param selector
 */
Validscript.prototype.resetInput = function(selector, inputType){
    let select = document.querySelector(selector);
    let classList = select.classList;
    if(inputType == 'string'){
        select.value = '';
        classList.remove('is-valid', 'is-invalid');
        select.closest('.vals-row').querySelector('.invalid-feedback').innerHTML = '';
    }else if(inputType == 'dropdown'){

        let dropdown;

        if (selector.startsWith('#')) {
            dropdown = document.getElementById(selector.slice(1));
        } else if (selector.startsWith('.')) {
            dropdown = document.querySelector(selector);
        }

        if (dropdown) {
            dropdown.selectedIndex = 0;
            const event = new Event('change');
            dropdown.dispatchEvent(event);
            dropdown.closest('.vals-row').querySelector('.invalid-feedback').innerHTML = '';
        } else {
            console.error('Dropdown not found');
        }
    }
}

Validscript.prototype.getAllFormData = function(){
    for (let pair of this.data.entries()) {
        console.log(pair[0]+ ', ' + pair[1]);
    }
}

Validscript.prototype.getFormDataByKey = function(key){
    return this.data.get(key);
}

Validscript.prototype.setNewEntry = function(key, value){
    this.data.append(key, value);
}

Validscript.prototype.checkFail = function(){
    return !this.pass;
}

