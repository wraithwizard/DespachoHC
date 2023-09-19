document.getElementById("loginRegistro").style.display="none";

//desaparece el login si el usuario se quiere registrar
btnRegistrar.addEventListener("click", function () {    
    //document.getElementById("btnRegistrar");
    document.getElementById("loginID").style.display="none";
    document.getElementById("loginRegistro").style.display="block";
  
});

//regresa al formulario login
btnVolver.addEventListener("click", function() {
    //document.getElementById("btnVolver");
    document.getElementById("loginID").style.display="block";
    document.getElementById("loginRegistro").style.display="none";
});

function validar(){
    let email, usuario, password;
    //guarda su valor en la variable  
    email = document.getElementById("email").value;
    usuario = document.getElementById("usuario").value;
    password = document.getElementById("password").value;

    //expresion regular
    const emailExpres =/\w+@\w+\.+[a-z]/;
    const userExpres = /^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{8,}$/;

    if (email==="" || usuario==="" || password==="") {
        alert("Favor de llenar todos los campos");
        //si se cumple la condicion, detiene el script
        return false;    
        //validacion del email
    }else if (email.length > 40 || !emailExpres.test(email)) {     
        alert("Introducir un email válido y menor a 40 caracteres");
        return false;
    }else if (usuario.length > 20 || usuario.length <=2) {     
        alert("Introducir un usuario menor a 20 y/o mayor a 2 caracteres");
        return false;
    }else if(password.length > 20 || password.length <= 7 || !userExpres.test(password)){
        alert("La contraseña debe tener al menos 8 caracteres y al menos un numero");
        return false;
    }
}

var recaptcha_response = '';

function submitUserForm() {
    if(recaptcha_response.length == 0) {
        //crea un span
        document.getElementById('g-recaptcha-error').innerHTML = '<span style="color:yellow;">Se requiere validar la casilla.</span>';
        return false;
    }
    return true;
}
 
function verifyCaptcha(token) {
    recaptcha_response = token;
    document.getElementById('g-recaptcha-error').innerHTML = '';
}
