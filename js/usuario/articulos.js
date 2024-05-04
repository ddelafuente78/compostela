/*Modal*/
  // Get the modal
var modal = document.getElementById("modalCarrito");
var modal2 = document.getElementById("modalDetalle");
// Get the button that opens the modal
var open1 = document.getElementById("carrito");
var img = document.getElementById("detalle");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var span2 = document.getElementsByClassName("close")[1];
// When the user clicks on the button, open the modal
open1.onclick = function() {
    modal.style.display = "block";
}

img.onclick = function(){
    modal2.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

span2.onclick = function() {
    modal2.style.display = "none";
}
    
// When the user clicks anywhere outside of the modal, close it
/* window.onclick = function(event) {
if (event.target == modal) {
    modal.style.display = "none";
}
} */
/* document.getElementById("seccion").innerHTML="<H1>Destinatario</H1>"; */

document.addEventListener("DOMContentLoaded", function() {
    
    var span = document.getElementById("carrito");  

    // Obtener el valor numérico del span
    var valorNumerico = parseInt(span.textContent);

    // Verificar si el valor es mayor que cero y cambiar el color
    if (valorNumerico > 0) {
        span.classList.add("positivo"); // Agregar la clase "positive"
    }

    var spanCant = document.getElementById("cant-art"); 
    var cantidad = parseInt(spanCant.textContent); //Obtengo el valor de span de la col 3

    var myInput=document.getElementById("cantidad-1"); //Obtengo el input
    myInput.max = cantidad

    minval = 10
    if(spanCant<=minval) {

    }

    myInput.addEventListener("input", function() {
        var valor = parseInt(myInput.value); // Obtener el valor actual del input como un número
        var max = parseInt(myInput.getAttribute("max")); // Obtener el valor máximo del atributo max
        // Verificar si el valor ingresado es mayor que el valor máximo
        if (valor > max) {
            alert("No se puede ingresar un valor mayor al stock actual")
            // Si es mayor, establecer el valor del input como el valor máximo
            myInput.value = max;
        };
    });
});

