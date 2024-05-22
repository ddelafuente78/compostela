// Funcionalidad del slideshow
var slideIndex = 1;

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
  }

function mostrarModalImagenes(imagen1, imagen2){
    // Obtener el modal
    var modal = document.getElementById("imagenesModal");
    var img1 = document.getElementById("imgModal1");
    var img2 = document.getElementById("imgModal2");

    img1.src = '../../imagenes/productos/' + imagen1
    img2.src = '../../imagenes/productos/' + imagen2

    showSlides(slideIndex);
    modal.style.display = "block";
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex-1].style.display = "block";
}

function mostrarModalCarrito(){
    var modal = document.getElementById("modalCarrito");
    modal.style.display = "block";
}
function ocultarModalImagenes(){
    var modal = document.getElementById("imagenesModal");
    modal.style.display = "none";
}
function ocultarModalCarrito(){
    var modal = document.getElementById("modalCarrito");
    modal.style.display = "none";
}

function controlaLimiteStock(stockActual, idCantidad){
    console.log("stockActual" + stockActual)
    var cantidad = document.getElementById("cantidad"+idCantidad)
    console.log("pedido: " + cantidad.value)

    if(cantidad.value > stockActual){
        cantidad.style.backgroundColor = "#FFCCCC";
        cantidad.focus();
    }else{
        cantidad.style.backgroundColor = "white";
    }
}

function checkMax(event, maxLength) {

    // Obtener el valor actual del campo de entrada
    let valor = event.target.value;
    event.target.style.backgroundColor = "white"
    
    // Verificar si la longitud del valor supera el límite
    if (valor > maxLength) {
        // Evitar que el evento predeterminado (pérdida de foco) se propague
        event.preventDefault();
        event.target.focus();
        event.target.style.backgroundColor = "#FADBD8"
        showSnackbar("La cantidad supera al stock")
        // Puedes mostrar un mensaje de advertencia o realizar otra acción aquí si lo deseas
    }
}

function showSnackbar(mensaje) {
    var snackbar = document.getElementById("snackbar");
    snackbar.innerText = mensaje;
    snackbar.className = "show";
    setTimeout(function() { snackbar.className = snackbar.className.replace("show", ""); }, 3000);
}



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

});