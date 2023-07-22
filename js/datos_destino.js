let btnFinalizar = document.getElementById("btnfinalizar");
btnFinalizar.addEventListener("click", function() {


    let ok = true;
    if(document.getElementById("nombre").value==''){
        document.getElementById("nombre").style.border="2px dashed red";
        ok = false;
      }
    
      if(document.getElementById("dni").value==''){
        document.getElementById("dni").style.border="2px dashed red";
        ok = false;
      }

      if(document.getElementById("telefono").value==''){
        document.getElementById("telefono").style.border="2px dashed red";
        ok = false;
      }

      if(document.getElementById("direccion").value==''){
        document.getElementById("direccion").style.border="2px dashed red";
        ok = false;
      }

      if(document.getElementById("cp").value==''){
        document.getElementById("cp").style.border="2px dashed red";
        ok = false;
      }

      if(ok == true){
        //enviar form.
      }else{
        //mostrar modal.
      }

});