var script = document.createElement('script');  // Necesario para hacer funcionar jQuery si no está incluido
script.src = "https://code.jquery.com/jquery-3.6.0.min.js";
document.head.appendChild(script);

window.addEventListener("load", function() {

    // Establecer el cursor
    $(document).on('mouseover', '.btn-like, .btn-dislike', function(){
        $(this).css('cursor', 'pointer');
    });

    // Botón like
    $(document).on('click', '.btn-like', function() {
        console.log('like');
        $(this).addClass('btn-dislike').removeClass('btn-like');
        $(this).attr('src', 'img/heart-red.png'); // Revisa esta ruta
        // Llama a la función dislike si es necesario
    });

    // Botón dislike
    $(document).on('click', '.btn-dislike', function() {
        console.log('dislike');
        $(this).addClass('btn-like').removeClass('btn-dislike');
        $(this).attr('src', 'img/heart-gray.png'); // Revisa esta ruta
        // Llama a la función like si es necesario
    });

});
