//botones
let btn = document.querySelector(".dashboard");

//on click...
btn.addEventListener("click", function(evento){
    //evento.preventDefault(); //impide redireccionar
    btn.classList.add("active");
    console.log("deberia cambiar color");
    location.href = "dashboard.php";
    console.log("deberia rederigir");

});

//ejemplo para colorear y descolorear un fondo de texto
//utilizo jquery
// $(document).ready(function(){
//     // indica que pestana es activa
//     $('ul.tabs li a:first').addClass('active');
//     //esconder todo el texto
//     $('.secciones article').hide();
//     //solo muestra el contenido de la primer pestana
//     $('secciones article:first').show();

//     //al hacer click
//     $('ul.tabs li a').click(function(){
//         // quitar el color active
// 		$('ul.tabs li a').removeClass('active');
//         // agregar a la pestana activa el color active
// 		$(this).addClass('active');
//         // esconde la pestana desactivada
// 		$('.secciones article').hide();

// 		var activeTab = $(this).attr('href');
//         //muestra el contenido de la pestana activada
// 		$(activeTab).show();
// 		return false;
//     });
// });

