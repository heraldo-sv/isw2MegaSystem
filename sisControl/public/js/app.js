/* Carga de documento */
$(document).ready(function() {
    $('.carousel').carousel({ // Configuraciones para la clase carousel de Bootstrap
        interval: false // Detiene el slider de imagenes.
    });
});
/* Configuraciones estandar para Toastr */
toastr.options.closeButton   = true;
toastr.options.timeOut = 3000;
toastr.options.preventDuplicates = true;
toastr.options.positionClass = 'toast-bottom-right';