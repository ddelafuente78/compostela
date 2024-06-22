function openPage(pageName,elmnt,color) {
    let i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");

    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }

    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;
}
    // Get the element with id="defaultOpen" and click on it
    var panelgral;
    document.getElementById("defaultOpen").click();
    let acc = document.getElementsByClassName("accordion");
    for (let i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.maxHeight) {
            panel.style.maxHeight = null;
        } 
        else {
        panelgral=parseInt(panel.scrollHeight);
        panel.style.maxHeight = panel.scrollHeight + "px";
        }
        });
    }

    //Accordion
let acc2 = document.getElementsByClassName("accordion2");
var panelsup = document.getElementsByClassName("panel");
for (i = 0; i < acc2.length; i++) {
    acc2[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel2 = this.nextElementSibling;
    if (panel2.style.maxHeight) {
        panel2.style.maxHeight = null;
    } 
    else {
        panelgral += parseInt(panel2.scrollHeight);
        panel2.style.maxHeight = panel2.scrollHeight + "px";
        panelsup[1].style.maxHeight = panelgral + "px"; 
    }
    }); 
}
function generar(){
    var myInput = document.getElementById("cant-b");
    var panel2 = document.getElementsByClassName("panel2");
    var cantr = myInput.value; 
    const table = document.getElementById('dataTable');
    const tbody = table.querySelector('tbody');
    var rowCount = tbody.rows.length;  
    var difrow = cantr - rowCount
    if (difrow > 0){
        let subi = rowCount
    // Agregar las nuevas filas
        for (let i = 0; i < difrow; i++) {
            const row = document.createElement('tr');

            for (let j = 0; j < 3; j++) {
                const cell = document.createElement('td');
                if(j== 0){
                    subi += i
                    cell.innerHTML = '<select name="embalaje'+subi+'" id="embalaje'+subi+'" class="input input1">'+
                    '<optgroup label="Caja">'+
                        '<option value="1">Caja Pequeña</option>'+
                        '<option value="2">Caja Mediana</option>'+
                        '<option value="3">Caja Grande</option>'+
                    '</optgroup>'+
                    "<optgroup label='Bolsa'>"+
                        "<option value='4'>Bolsa Pequeña</option>"+
                        "<opsubition value='5'>Bolsa Mediana</opsubition>"+
                        "<option value='6'>Bolsa Grande</option>"+
                    "<optgroup label='Otro'>"+
                        "<option value='7'>Otro</option>"+
                    "</optgroup>"+
                '</select>';
                }
                else if(j==1){
                    cell.innerHTML = '<input type="checkbox" id="especial'+subi+'" name="especial'+subi+'" value="especial">'
                }
                else{
                    cell.innerHTML = '<input type="number" id="peso'+subi+'" class="input" name="peso'+subi+'" value=0 maxlength=6>Kg.';
                }
                row.appendChild(cell);
            }
            tbody.appendChild(row);
            
                
        }
    } else if(difrow < 0){
        difrow *= -1
        for(let i= 0; i<difrow; i++){
            rowCount =- 1
            tbody.deleteRow(rowCount)
        }
        
    }
    panel = acc[1].nextElementSibling;
    panelgral=panel.scrollHeight
    panel.style.maxHeight = panel.scrollHeight + "px";
};

let tabs = document.tablinks
console.log(tabs)
let botones = document.getElementsByClassName('btn')
console.log(botones)