document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("formEdicionAuto");

    form.addEventListener("submit", function(evento) {
        evento.preventDefault();

        const regexMarca = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/;
        const regexModelo = /^\d{4}$/;
        const regexDni = /^\d{8}$/;

        let dniValido = validarCampo(
            document.getElementById("dniDuenio"),
            regexDni,
            "El DNI debe contener exactamente 8 números.",
            "¡DNI correcto!"
        );

        let modeloValido = validarCampo(
            document.getElementById("modelo"),
            regexModelo,
            "El modelo debe contener exactamente 4 números.",
            "¡Modelo válido!"
        );

        let marcaValida = validarCampo(
            document.getElementById("marca"),
            regexMarca,
            "La marca solo debe contener letras.",
            "¡Marca válida!"
        );

        if (dniValido && modeloValido && marcaValida) {
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