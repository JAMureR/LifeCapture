var script = document.createElement('script');
script.src = "https://code.jquery.com/jquery-3.6.0.min.js";
document.head.appendChild(script);
var url = "http://localhost:8000";

script.onload = function () {
    window.addEventListener("load", function () {

        // Establecer el cursor
        $(document).on('mouseover', '.btn-like, .btn-dislike', function () {
            $(this).css('cursor', 'pointer');
        });

        function like() {
            $(document).on('click', '.btn-like', function () {
                console.log('like');
                $(this).addClass('btn-dislike').removeClass('btn-like');
                $(this).attr('src', url +'/img/heart-red.png');

                
                $.ajax({
                    url: '/like/' + $(this).data('id'), // (ruta relativa),
                    type: 'GET',
                    success: function (response) {
                        if(response.like){
                            console.log('Has dado like a la publicacion');
                        }else{
                            console.log('Error al dar like');
                        }
                        
                    }
                });
            });
        }

        function dislike() {
            $(document).on('click', '.btn-dislike', function () {
                console.log('dislike');
                $(this).addClass('btn-like').removeClass('btn-dislike');
                $(this).attr('src', url +'/img/heart-gray.png');

                $.ajax({
                    url: '/dislike/' + $(this).data('id'), // (ruta relativa),
                    type: 'GET',
                    success: function (response) {
                        if(response.like){
                            console.log('Has dado dislike a la publicacion');
                        }else{
                            console.log('Error al dar dislike');
                        }
                        
                    }
                });

            });
        }

        like();
        dislike();
    });
};
