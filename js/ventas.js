$(document).ready(function () {
    $('#seccionVenta').hide();
    if( location.search){
        console.log(location.search.split("=")[1]);
        venta.id=location.search.split("=")[1];
        editando = true;
        $('#tipoOperacion').text('editar');
    }
    loadDatos();
    if(editando){
        loadVentaParaEditar(venta.id);
    }
    $("#subt").on('change', function(){ actualizaVenta(false, false);});
    $("#desc").on('change', function(){ actualizaVenta(false, false);});
    $("#bonGral").on('change', function(){ actualizaVenta(false, false);});
    $("#bonAd1").on('change', function(){ actualizaVenta(false, false);});
    $("#bonAd2").on('change', function(){ actualizaVenta(false, false);});
    $("#iva").on('change', function(){ actualizaVenta(false, false);});
    $("#total").on('change', function(){ actualizaVenta(false, false);});


});
var editando = false;
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
    idCliente:  0,
    estado:     ''
}
var _iva = 0.21;
var productos=[];
var lineasDeVenta=[];
var clientes=[];
var lastIdLinea = 0;

//Carga de datos
var loadDatos = function(){    

    $.ajax({
       url: "ajax/getDatos.php",
       data: "",
       dataType: "JSON",
       timeout: 300000,
       type: "POST",
       success: function(response){

           if(!response.error){
                var arregloProd = response.Productos;
               switch(Object.prototype.toString.call(arregloProd)) {
                   case '[object Object]':
                       productos.push(arregloProd);
                       break;
                   case '[object Array]':
                       arregloProd.forEach(function(entry) {
                           productos.push(entry);
                       });
                       break;
               }


                var arregloClientes = response.Clientes;
               switch(Object.prototype.toString.call(arregloClientes)) {
                   case '[object Object]':
                       clientes.push(arregloClientes);
                       break;
                   case '[object Array]':
                       arregloClientes.forEach(function(entry) {
                           clientes.push(entry);
                       });
                       break;
                }
                cargaComboClientes();
               if(!editando){
                   $('#seccionVenta').show();
               }
           } else {
               alert(response.msj);
               window.location="menu.php";
           }

       },
       error: function(xhr){
           alert("No se puede realizar la accion deseada en este momento");
           window.location="menu.php";
       },
       complete: function(){
       }
    });
}

var loadVentaParaEditar = function(idVta) {
    $.ajax({
        url: "ajax/getVentaParaEditar.php",
        data: {idVta: idVta},
        dataType: "JSON",
        timeout: 300000,
        type: "POST",
        success: function (response) {

            if (!response.error) {
                venta.subtotal = response.Venta.subtotal;
                venta.iva = response.Venta.iva;
                venta.desc = response.Venta.desc;
                venta.bonGral = response.Venta.bonGral;
                venta.bonAd1 = response.Venta.bonAd1;
                venta.bonAd2 = response.Venta.bonAd2;
                venta.total = response.Venta.total;
                venta.idCliente = response.Venta.idCliente;
                venta.estado = response.Venta.estado;

                response.Venta.lineas.forEach(function (linea) {
                    //actualizo el id de linea
                    lastIdLinea++;
                    //creo la linea
                    var line = {
                        idLinea: lastIdLinea,
                        producto: linea,
                        cantidad: linea.cantidad,
                        subtotal: 0
                    };
                    //buco y agrego el prod
                    productos.forEach(function (pr) {
                        if (pr.Id == linea.idProd) {
                            line.producto = pr;
                            line.subtotal = (parseFloat(line.cantidad) * parseFloat(linea.precioventafijo));
                        }
                    });

                    venta.lineas.push(line);

                });
                armarVentaParaEditar();

                $('#seccionVenta').show();
                switch(venta.estado){
                    case 'PENDIENTE WEB':
                    case 'SIN APROBAR WEB':
                        $('#botones').show();
                        break;
                    default:
                        $('#botones').hide();
                        break;
                }
                console.log(venta);
                /*
                 id'=>$respuesta->Id,
                 'idCliente'=>$respuesta->Value1,
                 'cliente'=>$respuesta->Value2,
                 'fecha'=>$respuesta->Value3,
                 'total'=>$respuesta->Value4,
                 'estado'=>$respuesta->Value5,
                 'lineas'=>$lineas,
                 'subtotal'=> explode ("=" , $datosAdic[0])[1],
                 'iva'=> explode ("=" , $datosAdic[1])[1],
                 'desc'=> explode ("=" , $datosAdic[2])[1],
                 'bonGral'=> explode ("=" , $datosAdic[3])[1],
                 'bonAd1'=> explode ("=" , $datosAdic[4])[1],
                 'bonAd2'=> explode ("=" , $datosAdic[5])[1]

                 bonAd1
                 bonAd2
                 bonGral
                 cliente
                 desc
                 estado
                 fecha
                 id
                 iva
                 lineas: Array[1]0: Object
                 cantidad: "1"
                 codigo: "15008"
                 idProd: 1431
                 nombre: "TACHO F-15 ENLOZADO"
                 precioventafijo: "178,00"
                 */
            } else {
                alert(response.msj);
                window.location="menu.php";
            }

        },
        error: function (xhr) {
            alert("No se puede realizar la accion deseada en este momento");
            window.location="menu.php";
        },
        complete: function () {
        }
    });
};

//Manejo de pantalla

var cargaComboClientes = function(){
    var stringSelect ="";
    stringSelect+="<select id='cli_id' name='cli_id' class='form-control'><option value='0' SELECTED>SELECCIONE UN CLIENTE</option>";
    clientes.forEach(function(valor){
        stringSelect+="<option value='" + valor.id + "'>" + valor.nombre + "</option>";
    });
    var elemento = document.getElementById("clientes_div");

    elemento.innerHTML=stringSelect;
}

var actualizarGrilla = function(linea){
    var element = document.getElementById("lineasVenta");
    var cadena = "";
    cadena+="<tr>";
    cadena+="<td>"+linea.producto.Nombre+"</td>";
    cadena+="<td>"+linea.producto.Codigo+"</td>";
    cadena+="<td>"+linea.producto.Precio+"</td>";
    cadena+="<td>"+linea.cantidad+"</td>";
    cadena+="<td>"+linea.subtotal+"</td>";
    if(venta.estado == 'PENDIENTE WEB' || venta.estado=='SIN APROBAR WEB'){
        cadena+="<td><button onclick='eliminaLinea("+line.idLinea+")'>Eliminar</button></td>";
    }else{
        cadena+="<td></td>";
    }
    cadena+="</tr>";

    element.innerHTML+=cadena;
}

var open_container = function(){
    var content =actualizaGrillaProductos();    
    var title = 'My dynamic modal dialog form with bootstrap';
    var footer = '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
    setModalBox(title,content,footer,'standart');//size);
    $('#myModal').modal('show');
}

var abreContainterAgregarProducto = function(id){
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
        content+="Producto: "+prod.Nombre+"<br/>";
        content+="Cantidad: <input type='number' scale='1' value=1  id='cantidad'  min=0 max=9999/>";
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

var setModalBox = function(title,content,footer,$size){
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

var actualizaGrillaProductos = function(){
    var filtro='';
    try{
        filtro=document.getElementById("filtroProd").value;
    }catch(ex){
        filtro='';
    }
   var content="";
    content +='<div class="input-group input-group-sm">';
    content +='<tr><td colspan="12"><input type="text" class="form-control" id="filtroProd" value="'+filtro+'">';
    content +='<span class="input-group-btn">';
    content +='<button type="button" class="btn btn-default" onclick="filtraGrillaProductos()">FILTRAR</button>';
    content +='</span></td></tr></div>';
    content +='<div class="form-group input-group-sm" style="height:40px; overflow-y:auto">';    
    content+='<table class="table table-hover">';
    return content;
}

var filtraGrillaProductos = function(){
    var filtro='';
    try{
        filtro=document.getElementById("filtroProd").value;
    }catch(ex){
        filtro='';
    }
    var content="";
    content +='<div class="input-group input-group-sm">';
    content +='<tr><td colspan="12"><input type="text" class="form-control" id="filtroProd" value="'+filtro+'">';
    content +='<span class="input-group-btn">';
    content +='<button type="button" class="btn btn-default" onclick="filtraGrillaProductos()">FILTRAR</button>';
    content +='</span></td></tr></div>';
    content +='<div class="form-group input-group-sm" style="height:400px; overflow-y:auto">';    
    content+='<table class="table table-hover">';
    
    try{
        productos.forEach(function(prod){
                if((prod.Nombre.toUpperCase().indexOf(filtro.toUpperCase())>-1) ||  (prod.Codigo.toUpperCase().indexOf(filtro.toUpperCase())>-1)){
                    var ls="<tr>";
                    ls+="<td>"+prod.Codigo+"</td>";
                    ls+="<td>"+prod.Nombre+"</td>";
                    ls+="<td><button class='btn btn-default button-circluar' onclick='abreContainterAgregarProducto("+prod.Id+")'><i class='fa fa-plus-circle'></i></button>"+"</td>\n";
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

var reescribirLineas = function(){
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
        if(venta.estado == 'PENDIENTE WEB' || venta.estado=='SIN APROBAR WEB'){
            cadena+="<td><button onclick='eliminaLinea("+line.idLinea+")'>Eliminar</button></td>";
        }else{
            cadena+="<td></td>";
        }
        cadena+="</tr>";
        element.innerHTML+=cadena;
    });
}

//VENTAS
var guardaVenta = function(){
    if(venta.lineas.length == 0){
        alert("La venta no tiene ningun item cargado");
        return;
    }
    actualizaVenta(false, false);
    var posicion=document.getElementById('cli_id').options.selectedIndex;                     
    if(document.getElementById('cli_id').options[posicion].value==0){
        alert("No selecciono ningun cliente");
        return;
    }
    venta.idCliente=document.getElementById('cli_id').options[posicion].value;
    //mando la venta al servidor
    var dataObj = { venta: JSON.stringify(venta) };

    $.ajax({
       url: "ajax/crearVenta.php",
       data: dataObj,
       dataType: "JSON",
       timeout: 300000,
       type: "POST",
       success: function(response) {

           if (!response.error) {
               alert("La venta fue guardada con exito");
               lineasDeVenta = [];
               lastIdLinea = 0;
               reescribirLineas();
               $("#subt").val(0);
               $("#desc").val(0);
               $("#bonGral").val(0);
               $("#bonAd1").val(0);
               $("#bonAd2").val(0);
               $("#iva").val(0);
               $("#total").val(0);
               $("#lineasVenta").html('');
               $('#cli_id').val(0);
           } else {
               alert(response.msj);
           }

       },
       error: function(xhr){
           alert("No se puede realizar la accion deseada en este momento");
       },
       complete: function(){
       }
    });
}

var actualizaSubtotalVenta = function(){
    var subT=0;
    venta.lineas.forEach(function(line){
        subT+=line.subtotal;
    });
    venta.subtotal=subT;
}

var actualizaVenta = function(vieneDeEliminar, vieneDeAgregar) {
    //actualizo el SubTotal
    if (vieneDeEliminar) {
        actualizaSubtotalVenta();
    }

    if (vieneDeAgregar) {
    }

    if (!vieneDeAgregar && !vieneDeEliminar) {
        venta.subtotal = document.getElementById("subt").value;
    }

    //Actualizo los demas campos:
    //actualizo los divs con los datos
    if (parseFloat(document.getElementById("desc").value) > 0) {
        venta.desc = parseFloat(document.getElementById("desc").value);
    } else {
        venta.desc = 0;
        document.getElementById("desc").value = 0;
    }
    if (parseFloat(document.getElementById("bonGral").value) > 0) {
        venta.bonGral = parseFloat(document.getElementById("bonGral").value);
    } else {
        venta.bonGral = 0;
        document.getElementById("bonGral").value = 0;
    }
    if (parseFloat(document.getElementById("bonAd1").value) > 0) {
        venta.bonAd1 = parseFloat(document.getElementById("bonAd1").value);
    } else {
        venta.bonAd1 = 0;
        document.getElementById("bonAd1").value = 0;
    }
    if (parseFloat(document.getElementById("bonAd2").value) > 0) {
        venta.bonAd2 = parseFloat(document.getElementById("bonAd2").value);
    } else {
        venta.bonAd2 = 0;
        document.getElementById("bonAd2").value = 0;
    }
    if (parseFloat(document.getElementById("iva").value) > 0) {
        venta.iva = parseFloat(document.getElementById("iva").value);
    } else {
        venta.iva = 0;
        document.getElementById("iva").value = 0;
    }
    var tot = parseFloat(venta.subtotal) > 0 ? parseFloat(venta.subtotal) : 0;

    if (venta.desc) {
        tot -= parseFloat(venta.desc);
    }
    if (venta.bonGral) {
        tot = tot * (100 - parseFloat(venta.bonGral)) / 100;
    }
    if (venta.bonAd1) {
        tot = tot * (100 - parseFloat(venta.bonAd1)) / 100;
    }
    if (venta.bonAd2) {
        tot = tot * (100 - parseFloat(venta.bonAd2)) / 100;
    }
    //VER COMO CALCULAR LAS BONIFICACIONES
    venta.total = tot + parseFloat(venta.iva);
    document.getElementById("subt").value = venta.subtotal;
    document.getElementById("total").value = venta.total;
}

//LINEAS
var addLinea = function(id, codigo){
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
        //actualizo el total de la venta
        venta.subtotal=parseFloat(document.getElementById("subt").value)+parseFloat(linea.subtotal);
        
        actualizaVenta(false, true);


        actualizarGrilla(linea);    

        console.log(venta);    
    };
}

var eliminaLinea = function(id_linea){
    try{
        venta.lineas.forEach(function(line){
            if(line.idLinea==id_linea){
                var indiceLineaAEliminar= venta.lineas.indexOf(line);
                venta.lineas.splice(indiceLineaAEliminar, 1);
            }
        });
    }catch(ex){

    }

    actualizaVenta(true, false);

    reescribirLineas();    
}

var armarVentaParaEditar = function(){
    //Cliente
    $('#cli_id').val(venta.idCliente);
    //Cuerpo

    $("#desc").val(parseFloat(venta.desc));
    $("#bonGral").val(parseFloat(venta.bonGral));
    $("#bonAd1").val(parseFloat(venta.bonAd1 ));
    $("#bonAd2").val(parseFloat(venta.bonAd2));
    $("#iva").val(parseFloat(venta.iva));
    var tot = parseFloat(venta.subtotal);
    if(venta.desc){ tot-=parseFloat(venta.desc);}
    if(venta.bonGral){tot=tot*(100 - parseFloat(venta.bonGral))/100; }
    if(venta.bonAd1){tot=tot*(100 - parseFloat(venta.bonAd1))/100;}
    if(venta.bonAd2){tot=tot*(100 - parseFloat(venta.bonAd2))/100; }
    venta.total=tot+parseFloat(venta.iva);
    $("#subt").val(venta.subtotal);
    $("#total").val(venta.total);

    actualizaVenta(false, false);
    //Lineas
    reescribirLineas();
}
