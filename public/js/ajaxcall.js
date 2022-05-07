
/* Se obtienen los valores del selector y el id del usuario 
 * usando jQuery. Como se podrian obtener usando js?
 * Es importante usar las herramientas para desarrolladores 
 * integradas en los navegadores para depurar en especial, las peticiones ajax */

$('body').on('click', '.change-rol', function () { 
    var idRol = $(this).closest('tr').find('select option:selected').val();
    var idUser = $(this).attr('userId');
    /* console.log(idRol);
    console.log(idUser); */

    $.ajax({
        type: 'POST',
        url: roleUrl,
        data: {
                iduser: idUser,
                rol: idRol
               },
        async: true,
        dataType: "json",
        success: function (data) {
            alert('Rol modificado');
        }
    });
});