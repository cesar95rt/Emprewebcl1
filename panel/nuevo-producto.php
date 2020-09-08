<?php

include('includes/header.php');

$configuracionStarken = obtenerConfiguracionStarken($idTienda);
$displayStarken = 'style=display:none;';
if($configuracionStarken == 0)
{
  $displayStarken = 'style=display:none;';
}
else
{
  if($configuracionStarken["estado"]==="activado")
  {
    $displayStarken = '';
  }
}



$arrayCategorias = arrayCategorias();
if($arrayCategorias==0)
{
  echo '<form action="categorias" method="POST" class="form-inline" role="form" id="return-form">
    <input type="hidden" name="debesAgregarCategorias" value="Para poder crear un producto, debes tener como mínimo una categoría">
  </form>
  <script>document.getElementById("return-form").submit();</script>';
}
else
{
  $opcionesCategorias = opcionesCategorias($arrayCategorias);
}

$respuestaRegistroProducto = '';

if(isset($_POST["respuestaRegistroProducto"]))
{
  $respuestaRegistroProducto = $_POST["respuestaRegistroProducto"];
}

?>

<script type="text/javascript" src="includes/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="js/nuevo-producto.js"></script>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Nuevo producto</h1>
    <button form="crearProducto" class="btn btn-success"><i
        class="fas fa-plus-circle"></i> Crear producto</button>
  </div>
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h6 class="h6 mb-0 text-gray-800"><?php echo $respuestaRegistroProducto; ?></h6>
    </div>

  <div class="container-fluid">
    <form class="" name="crearProducto" id="crearProducto" action="crear-producto.php" method="post" enctype="multipart/form-data">
      <div class="form-group row-sm-12">
      <label for="nombreProducto" class="form-label">Nombre del producto (obligatorio)</label>
      <input class="form-control" required type="text" name="nombreProducto" id="nombreProducto" value="" placeholder="Zapatillas de correr">
      </div>
      <div class="form-group row-sm-12">
      <label for="urlSeo" class="form-label">URL Seo - Con esto, podrás acceder a tu producto a través del link tutienda.empreweb.cl/producto/URLSeo - Puedes ingresar, por ejemplo: zapatillas-correr. Solo letras minúsculas, números y guiones para separar palabras. (obligatorio)</label>
      <input class="form-control" required type="text" name="urlSeo" id="urlSeo" value="" placeholder="zapatillas-correr">
      </div>
      <div class="form-group row">
        <div class="col-sm-6">
          <label for="filtroCategoria" class="form-label">Categoría del producto (obligatorio)</label>
          <select class="form-control" name="filtroCategoria" id="filtroCategoria" required onchange="update(this.value)">
            <option selected disabled hidden value="">Selecciona una categoría</option>
            <?php echo $opcionesCategorias; ?>
          </select>
        </div>
        <div class="col-sm-6">
          <label for="filtroSubcategoria" class="form-label">Subcategoría del producto (opcional)</label>
          <select class="form-control" name="filtroSubcategoria" id="filtroSubcategoria">
            <option selected disabled hidden>Selecciona una subcategoría (opcional)</option>
            <option disabled>Primero elige una categoría</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-6">
          <div class="row-sm-12">
            <label for="gridCheck1" class="form-label">¿El producto contará con stock? Si no es así, el inventario de este producto se considerará como <b>infinito</b>.</label>
          </div>
          <div class="row-sm-12">
            <label><input type="radio" onclick="changeRemember()" id="optradio1" value="1" name="optradio1" checked> Sí, ingresaré un stock inicial</label>
          </div>
          <div class="row-sm-12">
            <label><input type="radio" onclick="changeRemember()" id="optradio2" value="0" name="optradio1"> No, el stock será infinito</label>
          </div>
        </div>
        <div class="col-sm-6" id="stockProductoDiv" style="display:block;">
          <label for="stockProducto" class="form-label">Stock del producto</label>
          <input class="form-control" step="1" value="0" type="number" name="stockProducto" id="stockProducto" required>
        </div>
      </div>
      <div class="form group row-sm-12 mb-4">
        <label for="descripcionCorta" class="form-label">Descripción corta del producto</label>
        <textarea id="descripcionCorta" onkeypress="return validar(event)" maxlength="350" class="form-control" name="descripcionCorta" rows="3" cols="50"></textarea>
        <script>

        function validar(e) { // 1
            tecla = (document.all) ? e.keyCode : e.which; // 2
            if (tecla==8) return true;
            if (tecla==13) return true;
            if (tecla==32) return true; // 3
            patron =/[a-zA-Z0-9\á\é\í\ó\ú\Á\É\Í\Ó\Ú\?\¿\,\.]/; // 4
            te = String.fromCharCode(tecla); // 5
            return patron.test(te); // 6
        }

        </script>
      </div>
      <div class="form-group row-sm-12 mb-4">
        <label for="descripcionProducto" class="form-label">Descripción del producto</label>
        <textarea id="descripcionProducto" class="form-control" name="descripcionProducto"></textarea>
        <script type="text/javascript">
        CKEDITOR.replace('descripcionProducto',{
          removeButtons: ('Image,Source,About')
        })
      </script>
      </div>
      <div class="form-group row">
        <div class="col-sm-4">
          <label for="precioProducto" class="form-label">Precio (obligatorio)</label>
          <input class="form-control currency" step="1" pattern=".{2,}" title="Debes ingresar un precio (mínimo $10 CLP)" type="text" onkeypress="return onlyNumberKey(event)" name="precioProducto" id="precioProducto" value="$" required>
        </div>
<script>
precioProducto = document.getElementById("precioProducto");
precioProducto.addEventListener("keydown", function (ev) {
var el = this;
var value = el.value;
setTimeout(function () {
if (el.value.indexOf("$") != 0) {
el.value = value;
}
}, 0);
});
</script>
        <div class="col-sm-4">
          <label for="precioOfertaProducto" class="form-label">Precio oferta (opcional) ($0 = desactivado)</label>
          <input class="form-control currency" step="1" title="El precio de oferta debe ser como mínimo de $10 CLP" type="text" onkeypress="return onlyNumberKey(event)" name="precioOfertaProducto" id="precioOfertaProducto" value="$">
        </div>
<script>
function onlyNumberKey(evt) {
var ASCIICode = (evt.which) ? evt.which : evt.keyCode
if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
return false;
return true;
}
precioOfertaProducto = document.getElementById("precioOfertaProducto");
precioOfertaProducto.addEventListener("keydown", function (ev) {
var el = this;
var value = el.value;
setTimeout(function () {
if (el.value.indexOf("$") != 0) {
el.value = value;
}
}, 0);
});
</script>
        <div class="col-sm-4">
          <label for="skuProducto" class="form-label">SKU (opcional)</label>
          <input class="form-control" type="text" name="skuProducto" id="skuProducto" value="" placeholder="ZC12345678">
        </div>
      </div>
      <div class="form-group row-sm-12 mb-4">
        <label for="diasPreparacion" class="form-label">Días de preparación del producto - Ingresa el número de días que tardarás en preparar el producto antes de poder realizar la entrega o envío.
        Ingresa <b>0</b> si la entrega o envío será realizado el mismo día en que se paga el producto.<br>
        Ingresa <b>1</b> si la entrega o envío será realizado el día siguiente.<br>
        Ingresa <b>2</b> si la entrega o envío será realizado el día subsiguiente y sigue así sucesivamente.</label>
        <input class="form-control" type="number" name="diasPreparacion" id="diasPreparacion" value="" placeholder="">
      </div>
      <div <?php echo $displayStarken; ?> class="form-group row">
      <div class="col-sm-6">
        <div class="row-sm-12">
          <label for="changeStarken1" class="form-label">¿Habilitar opción de envío por Starken para este producto?</label>
        </div>
        <div class="row-sm-12">
          <label><input type="radio" onclick="changeStarken()" id="changeStarken1" value="activado" name="changeStarken1" checked> Sí</label>
        </div>
        <div class="row-sm-12">
          <label><input type="radio" onclick="changeStarken()" id="changeStarken1" value="desactivado" name="changeStarken1"> No</label>
        </div>
      </div>
      </div>
      <div <?php echo $displayStarken;?> id="configuracionStarken" class="form-group row">
        <div class="col-sm-12">
          <label for="pesoProducto" class="form-label">Peso en KG - Decimales separados por comas. (obligatorio)</label>
          <input class="form-control currency" step="0.1" type="number" name="pesoProducto" id="pesoProducto" value="0" required>
        </div>
        <div class="col-sm-12">
          <label for="altoProducto" class="form-label">Alto en CMS - Solo números enteros (obligatorio)</label>
          <input class="form-control currency" step="1" type="number" name="altoProducto" id="altoProducto" value="0" required>
        </div>
        <div class="col-sm-12">
          <label for="anchoProducto" class="form-label">Ancho en CMS - Solo números enteros (obligatorio)</label>
          <input class="form-control currency" step="1" type="number" name="anchoProducto" id="anchoProducto" value="0" required>
        </div>
        <div class="col-sm-12">
          <label for="largoProducto" class="form-label">Largo en CMS - Solo números enteros (obligatorio)</label>
          <input class="form-control currency" step="1" type="number" name="largoProducto" id="largoProducto" value="0" required>
        </div>
      </div>
      <label for="tags" class="form-label">Tags (Mín: 1 - Máx: 10) - Permitirán a tus clientes encontrar con más facilidad el producto. Por ejemplo: zapatillas,correr,ropa deportiva. Separados por comas.</label>
      <input class="form-control" required data-role="tagsinput" type="text" name="tags" id="tags">
      <br></br>
      <div class="form-group row-sm-12 mb-4">
        <h4 style="text-align:center" class="form-label">Puedes agregar una imagen principal y cuatro secundarias a tu producto</h>
          <h6 style="text-align:center" class="form-label"> Es recomendable que las imágenes sean cuadradas para que se vean adecuadamente en el catálogo. Solo se admiten formatos JPG, JPEG y PNG.</h>
      </div>
      <div class="form-group row-sm-12 mb-4">
      <div class="center">
  <div class="form-input-1">
    <label for="file-ip"><img class="hover-1" id="file-ip-preview" src="../img/addImage.png" alt="Imagen principal"></label>
    <input type="file" id="file-ip" name="file-ip" accept="image/*" onchange="showPreview(event);">
    <div class="" id="file-ip-div">
    </div>
  </div>
</div>
</div>
    <div class="form-group row mb-4">
      <div class="col-sm-3">
        <div class="center">
          <div class="form-input">
            <label for="file-ip-1"><img class="hover-1" id="file-ip-1-preview" src="../img/addImage.png" alt="Imagen secundaria 1"></label>
            <input type="file" id="file-ip-1" name="file-ip-1" accept="image/*" onchange="showPreview1(event);">
            <div class="" id="file-ip-1-div">
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="center">
          <div class="form-input">
            <label for="file-ip-2"><img id="file-ip-2-preview" src="../img/addImage.png" alt="Imagen secundaria 2"></label>
            <input type="file" id="file-ip-2" name="file-ip-2" accept="image/*" onchange="showPreview2(event);">
            <div class="" id="file-ip-2-div">
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="center">
          <div class="form-input">
            <label for="file-ip-3"><img id="file-ip-3-preview" src="../img/addImage.png" alt="Imagen secundaria 3"></label>
            <input type="file" id="file-ip-3" name="file-ip-3" accept="image/*" onchange="showPreview3(event);">
            <div class="" id="file-ip-3-div">
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-3">
        <div class="center">
          <div class="form-input">
            <label for="file-ip-4"><img id="file-ip-4-preview" src="../img/addImage.png" alt="Imagen secundaria 4"></label>
            <input type="file" id="file-ip-4" name="file-ip-4" accept="image/*" onchange="showPreview4(event);">
            <div class="" id="file-ip-4-div">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row-sm-4" style="display:flex; align-items:center; justify-content:center;">
      <button type="submit" form="crearProducto" id="submitCrearProducto" class="btn btn-success col-sm-2" name="submit"><i
          class="fas fa-plus-circle"></i> Crear producto</button>
    </div>
    </form>


</div>
<script>
document.querySelector('#file-ip-4').addEventListener('change', function(e) {
  var file = this.files[0];
  var fd = new FormData();
  fd.append("afile", file);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'includes/handle_file_upload.php', true);

  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      console.log(percentComplete + '% uploaded');
      document.getElementById("file-ip-4-div").innerHTML = Math.round(percentComplete) + '% del archivo cargado';
    }
  };

  xhr.onload = function() {
    if (this.status == 200) {
      var resp = JSON.parse(this.response);
      if(resp.respuesta == 0){
      alert(resp.type);
      $('#file-ip-4').val('');
    }else{alert(resp.type);}
    };
  };

  xhr.send(fd);
}, false);
</script>

<script>
document.querySelector('#file-ip-3').addEventListener('change', function(e) {
  var file = this.files[0];
  var fd = new FormData();
  fd.append("afile", file);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'includes/handle_file_upload.php', true);

  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      console.log(percentComplete + '% uploaded');
      document.getElementById("file-ip-3-div").innerHTML = Math.round(percentComplete) + '% del archivo cargado';
    }
  };

  xhr.onload = function() {
    if (this.status == 200) {
      var resp = JSON.parse(this.response);
      if(resp.respuesta == 0){
      alert(resp.type);
      $('#file-ip-3').val('');
    }else{alert(resp.type);}
    };
  };

  xhr.send(fd);
}, false);
</script>

<script>
document.querySelector('#file-ip-2').addEventListener('change', function(e) {
  var file = this.files[0];
  var fd = new FormData();
  fd.append("afile", file);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'includes/handle_file_upload.php', true);

  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      console.log(percentComplete + '% uploaded');
      document.getElementById("file-ip-2-div").innerHTML = Math.round(percentComplete) + '% del archivo cargado';
    }
  };

  xhr.onload = function() {
    if (this.status == 200) {
      var resp = JSON.parse(this.response);
      if(resp.respuesta == 0){
      alert(resp.type);
      $('#file-ip-2').val('');
    }else{alert(resp.type);}
    };
  };

  xhr.send(fd);
}, false);
</script>

<script>
document.querySelector('#file-ip-1').addEventListener('change', function(e) {
  var file = this.files[0];
  var fd = new FormData();
  fd.append("afile", file);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'includes/handle_file_upload.php', true);

  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      console.log(percentComplete + '% uploaded');
      document.getElementById("file-ip-1-div").innerHTML = Math.round(percentComplete) + '% del archivo cargado';
    }
  };

  xhr.onload = function() {
    if (this.status == 200) {
      var resp = JSON.parse(this.response);
      if(resp.respuesta == 0){
      alert(resp.type);
      $('#file-ip-1').val('');
    }else{alert(resp.type);}
    };
  };

  xhr.send(fd);
}, false);
</script>

<script>
document.querySelector('#file-ip').addEventListener('change', function(e) {
  var file = this.files[0];
  var fd = new FormData();
  fd.append("afile", file);
  var xhr = new XMLHttpRequest();
  xhr.open('POST', 'includes/handle_file_upload.php', true);

  xhr.upload.onprogress = function(e) {
    if (e.lengthComputable) {
      var percentComplete = (e.loaded / e.total) * 100;
      console.log(percentComplete + '% uploaded');
      document.getElementById("file-ip-div").innerHTML = Math.round(percentComplete) + '% del archivo cargado';
    }
  };

  xhr.onload = function() {
    if (this.status == 200) {
      var resp = JSON.parse(this.response);
      if(resp.respuesta == 0){
      alert(resp.type);
      $('#file-ip').val('');
    }else{alert(resp.type);}
    };
  };

  xhr.send(fd);
}, false);
</script>

<script type="text/javascript">
  function update(str)
  {
     var xmlhttp;

     if (window.XMLHttpRequest)
     {// code for IE7+, Firefox, Chrome, Opera, Safari
       xmlhttp=new XMLHttpRequest();
     }
     else
     {// code for IE6, IE5
       xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
     }

     xmlhttp.onreadystatechange = function() {
       if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
       {
         document.getElementById("filtroSubcategoria").innerHTML = xmlhttp.responseText;
       }
     }

     xmlhttp.open("GET","./includes/actualizarListaSubcategorias.php?filtroCategoria="+str, true);
     xmlhttp.send();
 }
</script>

<script>
function changeRemember(){
  var x = document.getElementById("stockProductoDiv");
  var y = document.getElementById("stockProducto");
  var z = document.getElementById("optradio1");
  if (z.checked == false) {
    x.style.display = 'none';
    y.value = 0;
  } else {
    x.style.display = 'block';
    y.value = '';
  }
}
</script>

<script>
function changeStarken(){
  var x = document.getElementById("configuracionStarken");
  var z = document.getElementById("changeStarken1");
  if (z.checked == false) {
    x.style.display = 'none';
  } else {
    x.style.display = 'block';
  }
}
</script>


<?php

include('includes/footer.php');

?>
