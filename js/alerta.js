const formulario = document.querySelector(".formulario");

formulario.addEventListener("submit", function name(evento) {
    //previene que se ejecute
    evento.preventDefault();   
    //enviar formulario
    mostrarAlerta("Mensaje enviado correctamente");
});


// muestra alerta de envio de formulario
function mostrarAlerta(mensaje, error = null) {
    //creo un parrafo para el html
    const alerta = document.createElement("P");
    alerta.textContent = mensaje;
    // //le agrego una clase
    // if (error) {
    //     alerta.classList.add("error");
    // } else {
    //     alerta.classList.add("correcto");
    // }
    alerta.classList.add("exito");
   
    //agregar al html
    formulario.append(alerta);
    
    //desaparecer anuncio de error
    setTimeout(() => {
        alerta.remove();
    }, 5000);
}
