//checar que acepte acentos y tildes
const onlyLetters = /[A-Za-z]/;

function validarClientes(){
    let nombre, apellidoP, apellidoM, email, cp, curp, calle, numero, colonia, municipio;

    nombre = document.getElementById("nombre").value;
    apellidoP = document.getElementById("apellidoP").value;
    apellidoM = document.getElementById("apellidoM").value;
    email = document.getElementById("email").value;
    curp = document.getElementById("curp").value;
    calle = document.getElementById("calle").value;
    numero = document.getElementById("numero").value;
    colonia = document.getElementById("colonia").value;
    cp = document.getElementById("cp").value;
    municipio = document.getElementById("municipio").value;

    //expresiones
    const emailExpres =/\w+@\w+\.+[a-z]/;
    //checar que acepte acentos y tildes
    const onlyLetters = /[A-Za-z]/;

    if (nombre==="" || nombre.length <= 1 || nombre.length > 25 || !onlyLetters.test(nombre)) {
        alert("Favor de agregar un nombre mayor a 1 caracter y menor a 25 caracteres y sin números");
        return false;
    } else if (apellidoP==="" || apellidoP.length <= 1 || apellidoP.length > 50 || !onlyLetters.test(apellidoP)){
        alert("Favor de agregar un apellido paterno mayor a 1 caracter y menor a 50 caracteres, sin números");
        return false;
    } else if (apellidoM==="" || apellidoM.length <= 1 || apellidoM.length > 50 || !onlyLetters.test(apellidoM)){
        alert("Favor de agregar un apellido materno mayor a 1 caracter y menor a 50 caracteres, sin números");
        return false;
    } else if (email==="" || email.length <= 3 || email.length > 50 || !emailExpres.test(email)){
        alert("Favor de agregar un email válido y menor a 50 caracteres");
        return false;
    }else if (curp.length < 9 || curp.length > 25){
        alert("Favor de agregar un CURP válido");
        return false;
    }else if (calle.length > 50){
        alert("El domicilio debe ser menor a 50 caracteres");
        return false;
    }else if (numero.length > 11){
        alert("El número debe ser menor a 11 caracteres");
        return false;
    }else if(colonia.length > 20){
        alert("La colonia debe ser menor a 20 caracteres");
        return false;
    }else if(cp.length > 20){
        alert("El cp debe ser menor a 20 caracteres");
        return false;
    }else if(municipio.length > 50){
        alert("El municipio debe ser menor a 50 caracteres");
        return false;
    }
}

function validarActualizacionClientes(){
    let nombre, apellidoP, apellidoM, email, curp, telefono;

    nombre = document.getElementById("updatingNombre").value;
    apellidoP = document.getElementById("updatinApellidoP").value;
    apellidoM = document.getElementById("updatingApellidoM").value;
    email = document.getElementById("updatingEmail").value;
    curp = document.getElementById("updatingRfc").value;
    telefono = document.getElementById("updatingTel").value;

    //expresiones
    const emailExpres =/\w+@\w+\.+[a-z]/;
    //checar que acepte acentos y tildes
    const onlyLetters = /[A-Za-z]/;

    if (nombre==="" || nombre.length <= 1 || nombre.length > 25 || !onlyLetters.test(nombre)) {
        alert("Favor de agregar un nombre mayor a 1 caracter y menor a 25 caracteres y sin números");
        return false;
    } else if (apellidoP==="" || apellidoP.length <= 1 || apellidoP.length > 50 || !onlyLetters.test(apellidoP)){
        alert("Favor de agregar un apellido paterno mayor a 1 caracter y menor a 50 caracteres, sin números");
        return false;
    } else if (apellidoM==="" || apellidoM.length <= 1 || apellidoM.length > 50 || !onlyLetters.test(apellidoM)){
        alert("Favor de agregar un apellido materno mayor a 1 caracter y menor a 50 caracteres, sin números");
        return false;
    } else if (email==="" || email.length <= 3 || email.length > 50 || !emailExpres.test(email)){
        alert("Favor de agregar un email válido y menor a 50 caracteres");
        return false;
    }else if (curp.length < 9 || curp.length > 25){
        alert("Favor de agregar un CURP válido");
        return false;
    }else if(telefono.length > 10){
        alert("El telefono debe ser menor a 10 caracteres");
        return false;
    }
}

//valida formulario de usuario
function validarUsers(){
    let nombre, pw, email;

    nombre = document.getElementById("usuario").value;
    pw = document.getElementById("pw").value;
    email = document.getElementById("email").value; 

    //expresiones
    const emailExpres =/\w+@\w+\.+[a-z]/;
  
    //validacion pw
    const userExpres = /^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{8,}$/;


    if (nombre==="" || nombre.length <= 1 || nombre.length > 25 || !onlyLetters.test(nombre)) {
        alert("Favor de agregar un nombre mayor a 1 caracter y menor a 25 caracteres y sin números");
        return false;
    } else if (email==="" || email.length <= 3 || email.length > 50 || !emailExpres.test(email)){
        alert("Favor de agregar un email válido y menor a 50 caracteres");
        return false;
    }else if(pw.length > 20 || pw.length <= 7 || !userExpres.test(pw)){
        alert("La contraseña debe tener al menos 8 caracteres y al menos un numero");
        return false;
    }    
}

function validacionCobranzaUpdate(){
    let prima, tipo, subtipo;

    prima = document.getElementById("prima").value;
    tipo = document.getElementById("tipo").value;
    subtipo = document.getElementById("subtipo").value;

    if(prima === ""){
        alert("La prima neta no puede quedar vacía");
        return false;
    }else if(tipo.length > 25 || subtipo.length > 25){
        alert("Favor de agregar un valor menor a 25 caracteres")
        return false;
    }else if(!onlyLetters.test(tipo) ||  !onlyLetters.test(subtipo)){
        alert("Favor de escribir solo números en tipo de cobro y subtipo")
        return false;
    }
}

function validarCrearSiniestro(){
    let estado, folio, lugar, nombre;

    nombre = document.getElementById("nombre").value;
    estado = document.getElementById("estado").value;
    folio = document.getElementById("folio").value;
    lugar = document.getElementById("lugar").value;

    if(nombre === "" || nombre.length <= 1){
        alert("El nombre no puede quedar vacío o ser menor a 2 caracteres");
        return false;
    }else if(estado.length > 50){
        alert("El estado no puede ser mayor a 50 caracteres");
        return false;
    }else if(folio.length > 20){
        alert("El folio no puede ser mayor a 20 caracteres");
        return false;
    }else if(lugar.length > 100 ){
        alert("El lugar no puede ser mayor a 100 caracteres");
        return false;
    }
}

//valida datos en creacion de poliza
function validarPoliza(){
    let cliente, sumaA, deducible, coaseguro, numPoliza, asegurados, prima;
   
    cliente = document.getElementById("cliente").value;
    sumaA = document.getElementById("sumaA").value;
    deducible = document.getElementById("deducible").value;
    coaseguro = document.getElementById("coaseguro").value;
    numPoliza = document.getElementById("numPoliza").value;
    asegurados = document.getElementById("asegurados").value;
    prima = document.getElementById("prima").value;
   
    if(cliente===""){
        alert("Favor de seleccionar un cliente");
        return false;
    }else if(sumaA.length > 10 || sumaA < 0){
        alert("La suma asegurada no puede ser mayor a 10 caracteres o negativa");
        return false;
    }else if(deducible.length > 10 || deducible < 0){
        alert("El deducible no puede ser mayor a 10 caracteres o negativo");
        return false;
    }else if(coaseguro.length > 10 || coaseguro < 0){
        alert("El coaseguro no puede ser mayor a 10 caracteres o negativo");
        return false;
    }else if(numPoliza.length > 20 ){
        alert("El número de poliza no puede ser mayor a 20 caracteres");
        return false;
    }else if(asegurados < 0 ){
        alert("El número de asegurados no puede ser negativo");
        return false;
    }else if(prima < 0 || prima.length > 10){
        alert("La prima no puede ser negativa o mayor de 10 dígitos");
        return false;
    }
}