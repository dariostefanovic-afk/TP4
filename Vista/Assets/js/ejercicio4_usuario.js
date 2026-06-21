document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formEdicionUsuario");

    form.addEventListener("submit", function(evento) {
        evento.preventDefault();

        const regexDni = /^\d{8}$/;
        const regexNombres = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        const regexTelefono = /^\d{10}$/;

        let dniValido = validarCampo(
            document.getElementById("nroDni"),
            regexDni,
            "El DNI debe contener exactamente 8 números.",
            "¡DNI correcto!"
        );

        let nombreValido = validarCampo(
            document.getElementById("nombre"),
            regexNombres,
            "El nombre solo puede contener letras y espacios.",
            "¡Nombre válido!"
        );

        let apellidoValido = validarCampo(
            document.getElementById("apellido"),
            regexNombres,
            "El apellido solo puede contener letras y espacios.",
            "¡Apellido válido!"
        );

        let telefonoValido = validarCampo(
            document.getElementById("telefono"),
            regexTelefono,
            "El teléfono debe contener exactamente 10 números.",
            "¡Teléfono correcto!"
        );

        if (dniValido && nombreValido && apellidoValido && telefonoValido) {
            form.submit();
        }
    });

    function validarCampo(input, regex, msjError, msjExito) {
        const valor = input.value.trim();
        let esValido = true;
        let mensaje = "";

        if (valor === "") {
            esValido = false;
            mensaje = "Este campo no puede estar vacío.";
        } else if (!regex.test(valor)) {
            esValido = false;
            mensaje = msjError;
        } else {
            esValido = true;
            mensaje = msjExito;
        }

        mostrarFeedback(input, esValido, mensaje);
        return esValido;
    }

    function mostrarFeedback(input, esValido, mensaje) {
        input.classList.remove("is-valid", "is-invalid");

        let feedbackDiv = input.nextElementSibling;
        
        if (!feedbackDiv || (!feedbackDiv.classList.contains("valid-feedback") && !feedbackDiv.classList.contains("invalid-feedback"))) {
            feedbackDiv = document.createElement("div");
            input.parentNode.insertBefore(feedbackDiv, input.nextSibling);
        }

        if (esValido) {
            input.classList.add("is-valid");
            feedbackDiv.className = "valid-feedback";
            feedbackDiv.textContent = mensaje;
        } else {
            input.classList.add("is-invalid");
            feedbackDiv.className = "invalid-feedback";
            feedbackDiv.textContent = mensaje;
        }
    }
});