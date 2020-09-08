<?php

include('includes/header.php');

$configuracionStarken = obtenerConfiguracionStarken($idTienda);

$origen = '0';
$selected1 = '';
$selected2 = 'selected';

if($configuracionStarken==0)
{
  $origen = '0';
  $selected1 = '';
  $selected2 = 'selected';
}
else
{
  $origen = $configuracionStarken["origen"];
  $estado = $configuracionStarken["estado"];
  if($estado==='activado')
  {
    $selected1 = 'selected';
    $selected2 = '';
  }
  else
  {
    $selected2 = 'selected';
    $selected1 = '';
  }
}

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Métodos de envío: Starken</h1>
  </div>
  <?php if(isset($_POST["respuestaRedesSociales"])){ ?><div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h5 class="h5 mb-0 text-success"><?php if(isset($_POST["respuestaRedesSociales"])){echo $_POST["respuestaRedesSociales"];} ?></h5>
  </div><?php } ?>
  <p>Para configurar Starken como método de envío, deberás elegir tu comuna o ciudad más cercana.<br></br>
  Por ejemplo, si vives en Providencia, Las Condes o <b>cualquier comuna de Santiago</b>, deberás elegir la opción <b>SANTIAGO</b>, ya que el precio de envío es el mismo para cada comuna de Santiago.<br>
  En cambio, si vives en alguna región y no la encuentras en la lista, deberás elegir la opción más cercana, para posteriormente acercarte a esa sucursal a dejar los productos a enviar.<br></br>
  Puedes encontrar una lista completa de las sucursales de Starken y sus respectivas direcciones <a href="https://www.starken.cl/sucursales/listado">haciendo clic aquí</a><br></br>
  Además, puedes realizar una cotización de prueba desde <a href="https://www.starken.cl/personas/cotiza-tu-envio">esta página</a></p><br>
  <!-- Content Row -->
  <input id="preseleccionado" hidden style="display:none;" name="preseleccionado" value="<?php echo $origen; ?>">
  <form id="formularioStarken" action="starkenAction" method="POST">
  <div class="form-group row">
    <label for="estado" class="col-sm-12 col-form-label"><b>Estado del método de envío</b></label>
    <p class="col-sm-12">(Activado - Desactivado)</p>
    <div class="col-sm-4">
      <select class="form-control mb-4" onchange="divOrigen()" id="estado" name="estado">
        <option <?php echo $selected1; ?> value="activado">Activado</option>
        <option <?php echo $selected2; ?> value="desactivado">Desactivado</option>
      </select>
    </div>
  </div>
  <div id="divOrigen" style="display:none;" class="form-group row">
    <label for="origen" class="col-sm-12 col-form-lab"><b>Ciudad de origen</b></label>
    <div class="col-sm-4">
      <select required class="form-control mb-4" id="origen" name="origen">
        <option selected value="0">-SELECCIONAR-</option>
        <option value="588">ALGARROBO</option>
        <option value="523">ALTO HOSPICIO</option>
        <option value="389">ANCUD</option>
        <option value="88">ANGOL</option>
        <option value="84">ANTOFAGASTA</option>
        <option value="89">ARAUCO</option>
        <option value="39">ARICA</option>
        <option value="437">BUIN</option>
        <option value="604">BULNES</option>
        <option value="7">CABILDO</option>
        <option value="8">CABRERO</option>
        <option value="10">CALAMA</option>
        <option value="11">CALBUCO</option>
        <option value="12">CALDERA</option>
        <option value="14">CANETE</option>
        <option value="15">CARAHUE</option>
        <option value="233">CASABLANCA</option>
        <option value="388">CASTRO</option>
        <option value="293">CAUQUENES</option>
        <option value="17">CHANARAL</option>
        <option value="2474">CHICUREO</option>
        <option value="18">CHIGUAYANTE</option>
        <option value="19">CHILLAN</option>
        <option value="23">COELEMU</option>
        <option value="440">COLINA</option>
        <option value="24">COLLIPULLI</option>
        <option value="1092">CONARIPE</option>
        <option value="2">CONCEPCION</option>
        <option value="223">CONCON</option>
        <option value="26">COPIAPO</option>
        <option value="27">COQUIMBO</option>
        <option value="28">CORONEL</option>
        <option value="6">COYHAIQUE</option>
        <option value="30">CURACAUTIN</option>
        <option value="441">CURACAVI</option>
        <option value="31">CURANILAHUE</option>
        <option value="32">CURICO</option>
        <option value="166">DIEGO DE ALMAGRO</option>
        <option value="234">EL CARMEN CHILLAN</option>
        <option value="589">EL QUISCO</option>
        <option value="165">EL SALVADOR</option>
        <option value="33">ERCILLA</option>
        <option value="34">FREIRE</option>
        <option value="35">FRESIA</option>
        <option value="36">FRUTILLAR</option>
        <option value="605">FUTRONO</option>
        <option value="154">GALVARINO</option>
        <option value="38">GORBEA</option>
        <option value="235">GRANEROS</option>
        <option value="171">HUASCO</option>
        <option value="196">ILLAPEL</option>
        <option value="5">IQUIQUE</option>
        <option value="40">LA CALERA</option>
        <option value="42">LA LIGUA</option>
        <option value="4">LA SERENA</option>
        <option value="43">LA UNION</option>
        <option value="1239">LABRANZA</option>
        <option value="606">LAGO RANCO</option>
        <option value="41">LAJA</option>
        <option value="44">LANCO</option>
        <option value="45">LAUTARO</option>
        <option value="46">LEBU</option>
        <option value="1093">LICANRAY</option>
        <option value="216">LIMACHE</option>
        <option value="508">LINARES</option>
        <option value="2634">LOGISTICA REVERSA</option>
        <option value="50">LONCOCHE</option>
        <option value="1060">LONQUIMAY</option>
        <option value="52">LOS ALAMOS</option>
        <option value="214">LOS ANDES</option>
        <option value="53">LOS ANGELES</option>
        <option value="54">LOS LAGOS</option>
        <option value="195">LOS VILOS</option>
        <option value="56">LOTA</option>
        <option value="57">MACHALI</option>
        <option value="58">MARIA ELENA</option>
        <option value="59">MEJILLONES</option>
        <option value="449">MELIPILLA</option>
        <option value="294">MOLINA</option>
        <option value="60">MULCHEN</option>
        <option value="61">NACIMIENTO</option>
        <option value="62">NUEVA IMPERIAL</option>
        <option value="63">OSORNO</option>
        <option value="64">OVALLE</option>
        <option value="450">PADRE HURTADO</option>
        <option value="344">PADRE LAS CASAS</option>
        <option value="65">PAILLACO</option>
        <option value="66">PANGUIPULLI</option>
        <option value="67">PAPUDO</option>
        <option value="292">PARRAL</option>
        <option value="452">PENAFLOR</option>
        <option value="69">PENCO</option>
        <option value="71">PITRUFQUEN</option>
        <option value="72">POZO ALMONTE</option>
        <option value="73">PUCON</option>
        <option value="593">PUERTO AYSEN</option>
        <option value="74">PUERTO MONTT</option>
        <option value="1319">PUERTO NATALES</option>
        <option value="345">PUERTO SAAVEDRA</option>
        <option value="75">PUERTO VARAS</option>
        <option value="121">PUNTA ARENAS</option>
        <option value="1061">PUREN</option>
        <option value="77">PURRANQUE</option>
        <option value="1063">QUELLON</option>
        <option value="48">QUILLON</option>
        <option value="210">QUILLOTA</option>
        <option value="78">QUILPUE</option>
        <option value="79">QUIRIHUE</option>
        <option value="80">RANCAGUA</option>
        <option value="82">RENGO</option>
        <option value="83">RIO BUENO</option>
        <option value="198">SALAMANCA</option>
        <option value="227">SAN ANTONIO</option>
        <option value="3">SAN CARLOS</option>
        <option value="213">SAN FELIPE</option>
        <option value="85">SAN FERNANDO</option>
        <option value="86">SAN JOSE DE LA MARIQUINA</option>
        <option value="266">SAN VICENTE DE TAGUATAGUA</option>
        <option value="87">SANTA BARBARA</option>
        <option value="25">SANTA CRUZ</option>
        <option value="1">SANTIAGO</option>
        <option value="118">SIERRA GORDA</option>
        <option value="456">TALAGANTE</option>
        <option value="91">TALCA</option>
        <option value="92">TALCAHUANO</option>
        <option value="93">TALTAL</option>
        <option value="94">TEMUCO</option>
        <option value="95">TOCOPILLA</option>
        <option value="96">TOME</option>
        <option value="97">TRAIGUEN</option>
        <option value="98">VALDIVIA</option>
        <option value="99">VALLENAR</option>
        <option value="100">VALPARAISO</option>
        <option value="101">VICTORIA</option>
        <option value="177">VICUNA</option>
        <option value="208">VILLA ALEMANA</option>
        <option value="103">VILLARRICA</option>
        <option value="104">VINA DEL MAR</option>
        <option value="105">YUMBEL</option>
        <option value="333">YUNGAY</option>
        <option value="106">ZAPALLAR</option>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="col-sm-4">
      <button type="submit" name="botonStarken" style="text-align:center" class="btn btn-primary col mb-2">Guardar</button>
    </div>
  </div>
</form>

<script type="text/javascript">
  window.addEventListener('load', function() {
    var estado = document.getElementById("estado").value;
    if(estado=="activado")
    {
      document.getElementById("divOrigen").style.display = 'block';
    }
    document.getElementById("origen").value = document.getElementById("preseleccionado").value;
  });

  function divOrigen()
  {
    var estado = document.getElementById("estado").value;
    if(estado=="activado")
    {
      document.getElementById("divOrigen").style.display = 'block';
    }
    else
    {
      document.getElementById("divOrigen").style.display = 'none';
    }
  }
</script>
<?php

include('includes/footer.php');

?>
