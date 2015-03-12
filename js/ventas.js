$(document).ready(function () {     
    loadDatos();
});
var venta={
    lineas:     [],
    subtotal:   0,
    iva:        0,
    desc:       0,
    bonGral:    0,
    bonAd1:     0,
    bonAd2:     0,
    total:      0,
    id:         0,
    idCliente:  0
}
var _iva = 0.21;
var productos=[];
var lineasDeVenta=[];
var clientes=[];
var lastIdLinea = 0;

function loadDatos(){

    var httpRequest = new XMLHttpRequest();
    var url = "ajax/getDatos.php";

    httpRequest.open("GET", url, true);

    httpRequest.onreadystatechange = function() {
        if(httpRequest.readyState == 4 && httpRequest.status == 200) {
            var return_data = JSON.parse(httpRequest.responseText);
            
            if(return_data['Result']=='OK'){

                var arregloProd = return_data['Productos'];

                arregloProd.forEach(function(entry) {
                    productos.push(entry);
                });

                var arregloClientes = return_data['Clientes'];

                arregloClientes.forEach(function(entry) {
                    clientes.push(entry);
                });
            }
            else{
                console.log("Error de carga:");
                console.log(return_data['Message']);
            }

            cargaComboClientes();
        }
    }
    httpRequest.send(); // Actually execute the request
}

function guardaVenta(){
    if(venta.lineas.length == 0){
        alert("La venta no tiene ningun item cargado");
        return;
    }
    var posicion=document.getElementById('cli_id').options.selectedIndex;                     
    if(document.getElementById('cli_id').options[posicion].value==0){
        alert("No selecciono ningun cliente");
        return;
    }
    venta.idCliente=document.getElementById('cli_id').options[posicion].value;
    //mando la venta al servidor
     // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "ajax/getProductos.php";
    var token = document.getElementById("first_name").value;
    hr.open("POST", url, true);
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/json;charset=UTF-8");
    // Access the onreadystatechange event for the XMLHttpRequest object
    hr.onreadystatechange = function() {
        if(hr.readyState == 4 && hr.status == 200) {
            var return_data = hr.responseText;
            document.getElementById("status").innerHTML = return_data;
        }
    }
    // Send the data to PHP now... and wait for response to update the status div
    hr.send(JSON.stringify(venta)); // Actually execute the request
}

function cargaComboClientes(){
    var stringSelect ="";
    stringSelect+="<select id='cli_id' name='cli_id' class='form-control'><option value='0' SELECTED>SELECCIONE UN CLIENTE</option>";
    clientes.forEach(function(valor){
        stringSelect+="<option value='" + valor.id + "'>" + valor.nombre + "</option>";
    });
    var elemento = document.getElementById("clientes_div");

    elemento.innerHTML=stringSelect;
}

function actualizaSubtotalVenta(){
    var subT=0;
    venta.lineas.forEach(function(line){
        subT+=line.subtotal;
    });
    venta.subtotal=subT;
}

function actualizarGrilla(linea){
    var element = document.getElementById("lineasVenta");
    var cadena = "";
    cadena+="<tr>";
    cadena+="<td>"+linea.producto.Nombre+"</td>";
    cadena+="<td>"+linea.producto.Codigo+"</td>";
    cadena+="<td>"+linea.producto.Precio+"</td>";
    cadena+="<td>"+linea.cantidad+"</td>";
    cadena+="<td>"+linea.subtotal+"</td>";
    cadena+="<td><button onclick='eliminaLinea("+linea.idLinea+")'>Eliminar</button></td>";
    cadena+="</tr>";

    element.innerHTML+=cadena;
}

function addLinea(id, codigo){
    var cant = document.getElementById("cantidad").value;
    if(cant){

        var prod;
        productos.forEach(function(p){
            if(p.Id==id){
                prod=p;
                //break;
            }
        });
        //actualizo el id de linea
        lastIdLinea++;
        //creo la linea
        var linea = {
            idLinea: lastIdLinea,
            producto: prod,
            cantidad: cant,
            subtotal: parseFloat(prod.Precio) * parseFloat(cant)
        };

        //agrego la linea a la venta
        venta.lineas.push(linea);
        
        actualizaVenta();

        actualizarGrilla(linea);        
    };
}
function open_container(){
    //var size=document.getElementById('mysize').value;
    var content =actualizaGrillaProductos();
    
    var title = 'My dynamic modal dialog form with bootstrap';
    var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
    setModalBox(title,content,footer,'small');//size);
    $('#myModal').modal('show');
}

function abreContainterAgregarProducto(id){
    //var size=document.getElementById('mysize').value;
    var filtro=document.getElementById("filtroProd").value;
    var content = "";   
    var footer = document.getElementById('modal-footerq').innerHTML;
    try{
        var prod;
        productos.forEach(function(p){
            if(p.Id==id){
                prod=p;
                //break;
            }
        });
        content+="Producto: "+prod.Nombre+"\n";
        content+="Cantidad: <input type='number' scale='1' id='cantidad'  min=0 max=9999/>";
       // content+="<br><button onclick='addLinea("+prod.Id+","+'"'+prod.Codigo+'"'+")'>Agregar</button>";'addLinea("+prod.Id+","+'"'+prod.Codigo+'"'+")'
       // content+="<br><button onclick='cargaProductos()'>Cancelar</button>"; 
        footer='<button type="button" class="btn btn-default" data-dismiss="modal">Close</button><button onclick="addLinea('+prod.Id+','+"'"+prod.Codigo+"'"+')" type="button" class="btn btn-primary" data-dismiss="modal">Agregar Producto</button>';                  
    }catch(ex){
        console.log(ex);
    }  

    document.getElementById('modal-bodyku').innerHTML=content;
    document.getElementById('modal-footerq').innerHTML=footer;
    //
}

function setModalBox(title,content,footer,$size){
    document.getElementById('modal-bodyku').innerHTML=content;
    document.getElementById('myModalLabel').innerHTML=title;
    document.getElementById('modal-footerq').innerHTML=footer;
    if($size == 'large')
    {
        $('#myModal').attr('class', 'modal fade bs-example-modal-lg')
                     .attr('aria-labelledby','myLargeModalLabel');
        $('.modal-dialog').attr('class','modal-dialog modal-lg');
    }
    if($size == 'standart')
    {
        $('#myModal').attr('class', 'modal fade')
                     .attr('aria-labelledby','myModalLabel');
        $('.modal-dialog').attr('class','modal-dialog');
    }
    if($size == 'small')
    {
        $('#myModal').attr('class', 'modal fade bs-example-modal-sm')
                     .attr('aria-labelledby','mySmallModalLabel');
        $('.modal-dialog').attr('class','modal-dialog modal-sm');
    }
}

function actualizaGrillaProductos(){
    var filtro='';
    try{
        filtro=document.getElementById("filtroProd").value;
    }catch(ex){
        filtro='';
    }
    var content="";
    content +='<div class="input-group input-group-sm">';
    content+='<table><tr>';
    content +='<td><input type="text" class="form-control" id="filtroProd">';
    content +='<span class="input-group-btn">';
    content +='<button type="button" class="btn btn-default" onclick="filtraGrillaProductos()">FILTRAR</button>';
    content +='</span></td></tr>';
    try{
        productos.forEach(function(prod){
                if((prod.Nombre.toUpperCase().indexOf(filtro.toUpperCase())>-1) ||  (prod.Codigo.toUpperCase().indexOf(filtro.toUpperCase())>-1)){
                    var ls="<tr>";
                    ls+="<td>"+prod.Codigo+"</td>";
                    ls+="<td>"+prod.Nombre+"</td>";
                    ls+="<td><button onclick='abreContainterAgregarProducto("+prod.Id+")'>Agregar</button>"+"</td>\n";
                    ls+="</tr>\n";
                    content+=ls;
                }
        });
    }catch(ex){
        console.log(ex);
    }    
    content+='<table>';
    content +='</div>';
    return content;
}

function filtraGrillaProductos(){
    var filtro='';
    try{
        filtro=document.getElementById("filtroProd").value;
    }catch(ex){
        filtro='';
    }
    var content="";
    content +='<div class="input-group input-group-sm">';
    content+='<table><tr>';
    content +='<td><input type="text" class="form-control" id="filtroProd" value="'+filtro+'">';
    content +='<span class="input-group-btn">';
    content +='<button type="button" class="btn btn-default" onclick="filtraGrillaProductos()">FILTRAR</button>';
    content +='</span></td></tr>';
    try{
        productos.forEach(function(prod){
                if((prod.Nombre.toUpperCase().indexOf(filtro.toUpperCase())>-1) ||  (prod.Codigo.toUpperCase().indexOf(filtro.toUpperCase())>-1)){
                    var ls="<tr>";
                    ls+="<td>"+prod.Codigo+"</td>";
                    ls+="<td>"+prod.Nombre+"</td>";
                    ls+="<td><button onclick='abreContainterAgregarProducto("+prod.Id+")'>Agregar</button>"+"</td>\n";
                    ls+="</tr>\n";
                    content+=ls;
                }
        });
    }catch(ex){
        console.log(ex);
    }    
    content+='<table>';
    content +='</div>';
    document.getElementById('modal-bodyku').innerHTML=content;
}

function eliminaLinea(id_linea){
    try{
        venta.lineas.forEach(function(line){
            if(line.idLinea==id_linea){
                var indiceLineaAEliminar= venta.lineas.indexOf(line);
                venta.lineas.splice(indiceLineaAEliminar, 1);
            }
        });
    }catch(ex){

    }

    actualizaVenta();

    reescribirLineas();    
}

function actualizaVenta(){
    //actualizo el SubTotal
        actualizaSubtotalVenta();
        //Actualizo los demas campos: 
        //actualizo los divs con los datos
        venta.desc= parseFloat(document.getElementById("desc").value);
        venta.bonGral= parseFloat(document.getElementById("bonGral").value);
        venta.bonAd1 = parseFloat(document.getElementById("bonAd1").value);
        venta.bonAd2= parseFloat(document.getElementById("bonAd2").value);
        var tot = venta.subtotal;
        /*
        if(venta.desc){ tot*=(100 - parseFloat(venta.desc));}
        if(venta.bonGral){tot*=(100 - parseFloat(venta.bonGral)); }
        if(venta.bonAd1){tot*=(100 - parseFloat(venta.bonAd1));}
        if(venta.bonAd2){tot*=(100 - parseFloat(venta.bonAd2)); }
        */ //VER COMO CALCULAR LAS BONIFICACIONES
        venta.iva=tot*_iva;
        venta.total=tot*(1+_iva);
        document.getElementById("subt").value=venta.subtotal;
        document.getElementById("iva").value=venta.iva;
        document.getElementById("total").value=venta.total;
}

function reescribirLineas(){
    var element = document.getElementById("lineasVenta");
    element.innerHTML="";
    venta.lineas.forEach(function(line){
        var cadena = "";
        cadena+="<tr>";
        cadena+="<td>"+line.producto.Nombre+"</td>";
        cadena+="<td>"+line.producto.Codigo+"</td>";
        cadena+="<td>"+line.producto.Precio+"</td>";
        cadena+="<td>"+line.cantidad+"</td>";
        cadena+="<td>"+line.subtotal+"</td>";
        cadena+="<td><button onclick='eliminaLinea("+line.idLinea+")'>Eliminar</button></td>";
        cadena+="</tr>";
        element.innerHTML+=cadena;
    });
}