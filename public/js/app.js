$(document).on('change', '#appbundle_city_department', function () {
    let $field = $(this)
    let $departmentField = $('#appbundle_city_department')
    let $form = $field.closest('form')
    let target = '#' + $field.attr('id').replace('department','city')

    // Les données à envoyer en Ajax
    let data = {}
    data[$departmentField.attr('name')] = $departmentField.val()
    data[$field.attr('name')] = $field.val()
    debugger

    //On soumet les données
    $.post($form.attr('action'), data).then(function(data){
        // On récupère le nouveau <select>
        let $input = $(data).find(target)
        // On remplace notre <select> actuel
        $(target).replaceWith($input)
    })
})