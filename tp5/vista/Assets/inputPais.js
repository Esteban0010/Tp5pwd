
// Función de validación
function validarSoloLetras(event) {
    const input = event.target;
    const regex = /^[a-zA-Z\s]*$/;  // Solo letras y espacios
    const valorActual = input.value;

    // Si el valor no coincide con la expresión regular, eliminamos el último carácter
    if (!regex.test(valorActual)) {
        input.value = valorActual.slice(0, -1);
    }
}

// Añadir el evento de validación cuando la página cargue
window.onload = function () {
    const campoPais = document.getElementById('paises');
    campoPais.addEventListener('input', validarSoloLetras);
};
