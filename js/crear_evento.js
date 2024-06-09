document.addEventListener("DOMContentLoaded", function() {
    const imgEventoInput = document.getElementById("img-evento");
    const imgCartelInput = document.getElementById("img-cartel");
    const imgEventoDiv = document.getElementById("img-evento-img");
    const imgCartelDiv = document.getElementById("img-cartel-img");
    const imgEventoImg = imgEventoDiv.querySelector("img"); // Selecciona la imagen dentro del div
    const imgCartelImg = imgCartelDiv.querySelector("img"); // Selecciona la imagen dentro del div

    //Se comprueba que no haya ya alguna imagen insertada
    if (imgEventoInput.value !== "") {
        imgEventoImg.style.display = "block";
        imgEventoImg.src = imgEventoInput.value;
    } 
    if (imgCartelInput.value !== "") {
        imgCartelImg.style.display = "block";
        imgCartelImg.src = imgCartelInput.value;
    }
    
    imgEventoInput.addEventListener("input", (e) => {
        
        if (imgEventoInput.value === "") {
            imgEventoImg.style.display = "none";
        } else {
            imgEventoImg.style.display = "block";
            imgEventoImg.src = e.target.value;
        }
    });

    imgCartelInput.addEventListener("input", (e) => {

        if (imgCartelInput.value === "") {
            imgCartelImg.style.display = "none";
        } else {
            imgCartelImg.style.display = "block";
            imgCartelImg.src = e.target.value;
        }
    });
});
