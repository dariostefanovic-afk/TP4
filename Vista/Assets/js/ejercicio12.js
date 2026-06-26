document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formCambioDuenio");

    form.addEventListener("submit", function(evento) {
        evento.preventDefault();

        const regexPatente = /^[A-Z]{3} [0-9]{3}$/;
        const regexDni = /^\d{8}$/;

        let dniValido = validarCampo(
            document.getElementById("nroDni"),
            regexDni,
            "El DNI debe contener exactamente 8 números.",
            "¡DNI correcto!"
        );

        let patenteValida = validarCampo(
            document.getElementById("patente"),
            regexPatente,
            "La patente solo puede contener 3 letras mayúsculas, espacio y 3 números.",
            "¡Patente válida!"
        );

        if (dniValido && patenteValida) {
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