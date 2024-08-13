var contador = true;
function vista() {
    var texto = document.getElementById("verPassword");
    if (contador == true) {
        texto.className = "fas fa-eye-slash verPassword";
        document.getElementById("contrasena").type="text";
        contador=false;
    } else {
        texto.className = "fas fa-eye verPassword";
        document.getElementById("contrasena").type="password";
        contador = true;
    }
}