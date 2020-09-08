<?php

include('includes/header.php');

$filtro = 0;
$tipoFiltro = 0;

$navegador = '<a href="productos.php">Productos</a>';

if(isset($_GET["filtroCategoria"]))
{
  if(isset($_GET["filtroSubcategoria"]))
  {
    $tipoFiltro = 2;
    $filtro = $_GET["filtroSubcategoria"];
    $navegador = obtenerNombreSubcategoria($_GET["filtroSubcategoria"]);
  }
  else
  {
    $tipoFiltro = 1;
    $filtro = $_GET["filtroCategoria"];
    $navegador = obtenerNombreCategoria($_GET["filtroCategoria"]);
  }
}

$arrayProductos = arrayProductos($filtro, $tipoFiltro);
$tablaMostrarProductos = tablaMostrarProductos($arrayProductos);
$arrayCategorias = arrayCategorias();
$opcionesCategorias = opcionesCategorias($arrayCategorias);

?>

<!-- Begin Page Content -->



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
         alert(xmlhttp.status);
         document.getElementById("filtroSubcategoria").innerHTML = xmlhttp.responseText;
       }
     }

     xmlhttp.open("GET","./includes/actualizarListaSubcategorias.php?filtroCategoria="+str, true);
     xmlhttp.send();
 }
</script>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Mis productos</h1>
    <a href="nuevo-producto.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-plus-circle fa-sm text-white-50"></i> Nuevo producto</a>
  </div>
  <p class="mb-4">Ingresa el nombre y correo del cliente al que le deseas cobrar, mencionándole la razón, producto o servicio que deseas cobrar, junto a su valor y agregando también tu nombre o el de tu empresa.</p>
    <form class="" action="productos.php" method="GET">
      <div class="row mb-4">
      <div class="col-sm-4">
        <select class="form-control" name="filtroCategoria" id="filtroCategoria" required onchange="update(this.value)">
          <option selected disabled hidden value="">Selecciona una categoría</option>
          <?php echo $opcionesCategorias; ?>
        </select>
      </div>
      <div class="col-sm-4">
        <select class="form-control" name="filtroSubcategoria" id="filtroSubcategoria">
          <option selected disabled hidden>Selecciona una subcategoría (opcional)</option>
          <option disabled>Primero elige una categoría</option>
        </select>
      </div>
      <div class="col-md-1">
        <button type="submit" class="btn btn-primary">Filtrar</button>
      </div>
      <div class="col-sm-2">
        <a href="productos.php" class="btn btn-primary">Mostrar todos</a>
      </div>
    </form>
  </div>
  <input class="form-control mb-4" type="text" id="buscadorProductos" onkeyup="buscadorProductos()" placeholder="Busca un producto..." title="Ingresa el nombre de un producto">
  <!-- Content Row -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"><?php echo $navegador; ?></h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTableProductos" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>SKU</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Categoría</th>
              <th>Subcategoría</th>
              <th>Stock</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>SKU</th>
              <th>Nombre</th>
              <th>Precio</th>
              <th>Categoría</th>
              <th>Subcategoría</th>
              <th>Stock</th>
              <th>Editar</th>
              <th>Eliminar</th>
            </tr>
          </tfoot>
          <tbody id="tablaMostrarProductos">
            <?php echo $tablaMostrarProductos; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

  <script>
  function buscadorProductos() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("buscadorProductos");
    filter = input.value.toUpperCase();
    table = document.getElementById("tablaMostrarProductos");
    tr = table.getElementsByTagName("tr");
    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[0];
      if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";
        } else {
          tr[i].style.display = "none";
        }
      }
    }
  }
  </script>







<?php

include('includes/footer.php');

?>
