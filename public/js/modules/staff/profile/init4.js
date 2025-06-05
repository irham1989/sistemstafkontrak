$("#dob").flatpickr({
    dateFormat: "d-m-Y",
});

$('#race').on('change', function(){
    $('#race-other').attr('disabled', $(this).find(':selected').attr('data-other') == 1 ? false : true).val('');

    common.resetForm([
        ['#race-other', 'string'],
    ])
})

$('#bumiputera').on('change', function(){
    $('#bumiputera-other').attr('disabled', $(this).find(':selected').attr('data-other') == 1 ? false : true).val('');

    common.resetForm([
        ['#bumiputera-other', 'string'],
    ])
})

