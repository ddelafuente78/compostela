var modal;

function getButtontoOpen(id){
  // Get the modal
  modal = document.getElementById("myModal" + id);
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
function cerrarModal(id) {
  modal = document.getElementById("myModal" + id);
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}