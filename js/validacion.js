// Función de validación para agregar usuario
function validateAddUserForm() {
    let nombre = document.querySelector('input[name="nombre"]').value;
    let email = document.querySelector('input[name="email"]').value;
    let contrasena = document.querySelector('input[name="contrasena"]').value;

    if (!nombre || !email || !contrasena) {
        alert('Todos los campos son obligatorios.');
        return false;
    }

    if (!validateEmail(email)) {
        alert('Por favor, ingrese un correo electrónico válido.');
        return false;
    }

    return true;
}

// Función de validación para editar usuario
function validateEditUserForm() {
    let nombre = document.querySelector('input[name="nombre"]').value;
    let email = document.querySelector('input[name="email"]').value;

    if (!nombre || !email) {
        alert('Todos los campos son obligatorios.');
        return false;
    }

    if (!validateEmail(email)) {
        alert('Por favor, ingrese un correo electrónico válido.');
        return false;
    }

    return true;
}

// Función para validar correo electrónico
function validateEmail(email) {
    const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return re.test(email);
}
