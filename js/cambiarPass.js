let nuevaspass = document.getElementById('nueva')
let confirmapass = document.getElementById('confirmar')
let avisopassdiferentes = document.getElementById("passdiferentes")
let boton = document.getElementById("cargar")


nuevaspass.addEventListener('blur', function(event) {
    mostrarAviso()
})

confirmapass.addEventListener('blur', function(event) {
    mostrarAviso()
})

function mostrarAviso() {
    if (nuevaspass.value != confirmapass.value){
        avisopassdiferentes.style.display = 'block'
        boton.disabled = true
    } else {
        avisopassdiferentes.style.display = 'none'
        boton.disabled = false
    }
}