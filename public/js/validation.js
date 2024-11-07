document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("forme");

    form.addEventListener("submit", function(event) {
        let isValid = true;
        const nom = document.getElementById("nom").value.trim();
        const prenom = document.getElementById("prenom").value.trim();
        const email = document.getElementById("email").value.trim();
        const message = document.getElementById("message").value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // Réinitialiser les messages d'erreur
        document.querySelectorAll(".error-message").forEach((el) => el.textContent = "");
        document.querySelectorAll(".form-control").forEach((el) => el.classList.remove("error"));
        document.querySelectorAll(".form-control").forEach((el) => el.classList.remove("success"));

        if (nom === "") {
            setError("nom", "Le nom est requis.");
            isValid = false;
        } else if (!/^[a-zA-Z]/.test(nom)) {
            setError("nom", "Le nom doit commencer par une lettre.");
            isValid = false;
        } else if (nom.length < 5 || nom.length > 15) {
            setError("nom", "Le nom doit contenir entre 5 et 15 lettres.");
            isValid = false;
        } else {
            setSuccess("nom");
        }

        if (prenom === "") {
            setError("prenom", "Le prénom est requis.");
            isValid = false;
        } else {
            setSuccess("prenom");
        }

        if (email === "") {
            setError("email", "L'email est requis.");
            isValid = false;
        } else if (!emailPattern.test(email)) {
            setError("email", "L'email n'est pas valide.");
            isValid = false;
        } else {
            setSuccess("email");
        }

        if (message === "") {
            setError("message", "Le message est requis.");
            isValid = false;
        } else {
            setSuccess("message");
        }

        if (!isValid) {
            event.preventDefault(); // Empêche l'envoi du formulaire
        }
    });

    function setError(id, message) {
        const element = document.getElementById(id);
        const errorElement = element.parentElement.querySelector(".error-message");
        const parentElement = element.parentElement;
        errorElement.textContent = message;
        parentElement.classList.add("error");
        parentElement.classList.remove("success");
    }

    function setSuccess(id) {
        const element = document.getElementById(id);
        const parentElement = element.parentElement;
        const errorElement = element.parentElement.querySelector(".error-message");
        errorElement.textContent = "";
        parentElement.classList.add("success");
        parentElement.classList.remove("error");
    }
});
