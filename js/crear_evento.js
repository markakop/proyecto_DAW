<<<<<<< HEAD
document.addEventListener("DOMContentLoaded", function() {
    const imgEventoInput = document.getElementById("img-evento");
    const imgCartelInput = document.getElementById("img-cartel");
    const imgEventoDiv = document.getElementById("img-evento-img");
    const imgCartelDiv = document.getElementById("img-cartel-img");
    const imgEventoImg = imgEventoDiv.querySelector("img"); // Selecciona la imagen dentro del div
    const imgCartelImg = imgCartelDiv.querySelector("img"); // Selecciona la imagen dentro del div
    const buttonEnvio = document.getElementById("button-envio");
    const envioButton = document.getElementById("envio");

    // Crear mensajes de error
    const imgEventoError = document.createElement("p");
    imgEventoError.textContent = "URL de la imagen del evento no válida.";
    imgEventoError.style.color = "red";
    imgEventoError.style.display = "none";
    imgEventoDiv.appendChild(imgEventoError);

    const imgCartelError = document.createElement("p");
    imgCartelError.textContent = "URL de la imagen del cartel no válida.";
    imgCartelError.style.color = "red";
    imgCartelError.style.display = "none";
    imgCartelDiv.appendChild(imgCartelError);

    // Función para comprobar si una imagen se puede cargar
    function canLoadImage(url, callback) {
        const img = new Image();
        img.onload = function() { callback(true); };
        img.onerror = function() { callback(false); };
        img.src = url;
    }

    // Se comprueba que no haya ya alguna imagen insertada
    if (imgEventoInput.value !== "") {
        canLoadImage(imgEventoInput.value, function(isValid) {
            if (isValid) {
                imgEventoImg.style.display = "block";
                imgEventoImg.src = imgEventoInput.value;
                imgEventoError.style.display = "none";
            } else {
                imgEventoImg.style.display = "none";
                imgEventoImg.src = "";
                imgEventoError.style.display = "block";
            }
        });
    } 
    if (imgCartelInput.value !== "") {
        canLoadImage(imgCartelInput.value, function(isValid) {
            if (isValid) {
                imgCartelImg.style.display = "block";
                imgCartelImg.src = imgCartelInput.value;
                imgCartelError.style.display = "none";
            } else {
                imgCartelImg.style.display = "none";
                imgCartelImg.src = "";
                imgCartelError.style.display = "block";
            }
        });
    }

    // Se añaden los eventos de cambio de imagen
    imgEventoInput.addEventListener("input", (e) => {
        let url = e.target.value;
        if (url === "") {
            imgEventoImg.style.display = "none";
            imgEventoImg.src = "";
            imgEventoError.style.display = "none";
        } else {
            canLoadImage(url, function(isValid) {
                if (isValid) {
                    imgEventoImg.style.display = "block";
                    imgEventoImg.src = url;
                    imgEventoError.style.display = "none";
                } else {
                    imgEventoImg.style.display = "none";
                    imgEventoImg.src = "";
                    imgEventoError.style.display = "block";
                }
            });
        }
    });

    imgCartelInput.addEventListener("input", (e) => {
        let url = e.target.value;
        if (url === "") {
            imgCartelImg.style.display = "none";
            imgCartelImg.src = "";
            imgCartelError.style.display = "none";
        } else {
            canLoadImage(url, function(isValid) {
                if (isValid) {
                    imgCartelImg.style.display = "block";
                    imgCartelImg.src = url;
                    imgCartelError.style.display = "none";
                } else {
                    imgCartelImg.style.display = "none";
                    imgCartelImg.src = "";
                    imgCartelError.style.display = "block";
                }
            });
        }
    });

    // Se añade el evento de envío de formulario, comprobando que las imágenes están bien puestas
    buttonEnvio.addEventListener("click", function() {
        let imgEventoUrl = imgEventoInput.value;
        let imgCartelUrl = imgCartelInput.value;

        canLoadImage(imgEventoUrl, function(validEvento) {

            // Comprobar ambas imágenes después de validar imgEvento
            canLoadImage(imgCartelUrl, function(validCartel) {

                // Alertar si alguna imagen no es válida
                if (validEvento && validCartel) {
                    envioButton.click();
                } else {
                    alert("Las URL de las imágenes no son válidas Vuelva a probar.");
                }
            });
        });
    });
=======
document.addEventListener("DOMContentLoaded", function() {
    const imgEventoInput = document.getElementById("img-evento");
    const imgCartelInput = document.getElementById("img-cartel");
    const imgEventoDiv = document.getElementById("img-evento-img");
    const imgCartelDiv = document.getElementById("img-cartel-img");
    const imgEventoImg = imgEventoDiv.querySelector("img"); // Selecciona la imagen dentro del div
    const imgCartelImg = imgCartelDiv.querySelector("img"); // Selecciona la imagen dentro del div
    const buttonEnvio = document.getElementById("button-envio");
    const envioButton = document.getElementById("envio");

    // Crear mensajes de error
    const imgEventoError = document.createElement("p");
    imgEventoError.textContent = "URL de la imagen del evento no válida.";
    imgEventoError.style.color = "red";
    imgEventoError.style.display = "none";
    imgEventoDiv.appendChild(imgEventoError);

    const imgCartelError = document.createElement("p");
    imgCartelError.textContent = "URL de la imagen del cartel no válida.";
    imgCartelError.style.color = "red";
    imgCartelError.style.display = "none";
    imgCartelDiv.appendChild(imgCartelError);

    // Función para comprobar si una imagen se puede cargar
    function canLoadImage(url, callback) {
        const img = new Image();
        img.onload = function() { callback(true); };
        img.onerror = function() { callback(false); };
        img.src = url;
    }

    // Se comprueba que no haya ya alguna imagen insertada
    if (imgEventoInput.value !== "") {
        canLoadImage(imgEventoInput.value, function(isValid) {
            if (isValid) {
                imgEventoImg.style.display = "block";
                imgEventoImg.src = imgEventoInput.value;
                imgEventoError.style.display = "none";
            } else {
                imgEventoImg.style.display = "none";
                imgEventoImg.src = "";
                imgEventoError.style.display = "block";
            }
        });
    } 
    if (imgCartelInput.value !== "") {
        canLoadImage(imgCartelInput.value, function(isValid) {
            if (isValid) {
                imgCartelImg.style.display = "block";
                imgCartelImg.src = imgCartelInput.value;
                imgCartelError.style.display = "none";
            } else {
                imgCartelImg.style.display = "none";
                imgCartelImg.src = "";
                imgCartelError.style.display = "block";
            }
        });
    }

    // Se añaden los eventos de cambio de imagen
    imgEventoInput.addEventListener("input", (e) => {
        let url = e.target.value;
        if (url === "") {
            imgEventoImg.style.display = "none";
            imgEventoImg.src = "";
            imgEventoError.style.display = "none";
        } else {
            canLoadImage(url, function(isValid) {
                if (isValid) {
                    imgEventoImg.style.display = "block";
                    imgEventoImg.src = url;
                    imgEventoError.style.display = "none";
                } else {
                    imgEventoImg.style.display = "none";
                    imgEventoImg.src = "";
                    imgEventoError.style.display = "block";
                }
            });
        }
    });

    imgCartelInput.addEventListener("input", (e) => {
        let url = e.target.value;
        if (url === "") {
            imgCartelImg.style.display = "none";
            imgCartelImg.src = "";
            imgCartelError.style.display = "none";
        } else {
            canLoadImage(url, function(isValid) {
                if (isValid) {
                    imgCartelImg.style.display = "block";
                    imgCartelImg.src = url;
                    imgCartelError.style.display = "none";
                } else {
                    imgCartelImg.style.display = "none";
                    imgCartelImg.src = "";
                    imgCartelError.style.display = "block";
                }
            });
        }
    });

    // Se añade el evento de envío de formulario, comprobando que las imágenes están bien puestas
    buttonEnvio.addEventListener("click", function() {
        let imgEventoUrl = imgEventoInput.value;
        let imgCartelUrl = imgCartelInput.value;

        canLoadImage(imgEventoUrl, function(validEvento) {

            // Comprobar ambas imágenes después de validar imgEvento
            canLoadImage(imgCartelUrl, function(validCartel) {

                // Alertar si alguna imagen no es válida
                if (validEvento && validCartel) {
                    envioButton.click();
                } else {
                    alert("Las URL de las imágenes no son válidas Vuelva a probar.");
                }
            });
        });
    });
>>>>>>> 203a8b5acb70eaa7d66b5a3b2524c0860c4abe40
});