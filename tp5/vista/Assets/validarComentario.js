function validarFormulario() {
   
    let validar = true;


    const autor = document.getElementById('autor');
    const msj = document.getElementById('msj');

   
    const regexAutor = /^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/;
    const regexMsj = /^[a-zA-ZÁÉÍÓÚáéíóúñÑ]+[a-zA-ZÁÉÍÓÚáéíóúñÑ\s\d,.!?¿¡]*\s[a-zA-ZÁÉÍÓÚáéíóúñÑ\s\d,.!?¿¡]*$/;
    const tieneEspacio = /\s/; // Para verificar que haya al menos un espacio

   
    if (!regexAutor.test(autor.value)) {
        autor.classList.remove('is-valid');
        autor.classList.add('is-invalid');
        validar = false;
    } else {
        autor.classList.remove('is-invalid');
        autor.classList.add('is-valid');
    }

    
    if (!regexMsj.test(msj.value) || !tieneEspacio.test(msj.value)) {
        msj.classList.remove('is-valid');
        msj.classList.add('is-invalid');
        validar = false;
    } else {
        msj.classList.remove('is-invalid');
        msj.classList.add('is-valid');
    }

   
    return validar;
}