function showSnackbar(mensaje) {
  var snackbar = document.getElementById("snackbar");
  snackbar.innerText = mensaje;
  snackbar.className = "show";
  setTimeout(function() { snackbar.className = snackbar.className.replace("show", ""); }, 3000);
}