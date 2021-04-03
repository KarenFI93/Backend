<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/customColors.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" media="screen,projection" />
    <link type="text/css" rel="stylesheet" href="css/index.css" media="screen,projection" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Formulario</title>
</head>
 

<body>
    <?php
    $data = file_get_contents("./data-1.json");
    $base = json_decode($data, true);
    

    $aux = [];
    foreach ($base as $arrayTemporal) {
        if (!in_array($arrayTemporal['Ciudad'], $aux)) {
            $aux[] = $arrayTemporal['Ciudad'];
        }
    }

    $aux1 = [];
    foreach ($base as $arrayTemporal) {
        if (!in_array($arrayTemporal['Tipo'], $aux1)) {
            $aux1[] = $arrayTemporal['Tipo'];
        }
    }

    extract($_REQUEST);

    if (!isset($ciudad)) {
        $ciudad = "";
    }

    if (!isset($tipo)) {
        $tipo = "";
    }

   if (!isset($precio)) {
        $precio = Array(0,0);
    } else {
        $precio= explode(";", $precio);
		echo "la edad recibida es: " .$_GET['precio'];
    }

    $filter = [];
    foreach ($base as $arrayTemporal) {
	   $priceTemporal = preg_replace("/[^0-9]/", "", $arrayTemporal["Precio"]);
	    switch (true){
		case ( $ciudad != "" && $tipo != "") :
			if ($arrayTemporal["Ciudad"] == $ciudad &&
				$arrayTemporal["Tipo"] == $tipo &&
			    $priceTemporal >= $precio[0] && $priceTemporal <= $precio[1]){
				$filter[] = $arrayTemporal;
			}
			break;
			case ( (empty($ciudad))  && $tipo != "") :
			if ($arrayTemporal["Tipo"] == $tipo &&
				$priceTemporal >= $precio[0] && $priceTemporal <= $precio[1]){
				$filter[] = $arrayTemporal;
			}
			break;
			case ( $ciudad != "" && (empty($tipo)) ) :
			if ($arrayTemporal["Ciudad"] == $ciudad &&
				$priceTemporal >= $precio[0] && $priceTemporal <= $precio[1]){
				$filter[] = $arrayTemporal;
			}
			break;
			case ( (empty($ciudad)) && (empty($tipo)) ) :
			if ($priceTemporal >= $precio[0] && $priceTemporal <= $precio[1]){
				$filter[] = $arrayTemporal;
			}
			break;
		}	
    }
	 
		if (count($filter) > 0) {
			$products = $filter;
		} else {
			$products = $base;
		}
    ?>

    <div class="contenedor">
        <div class="card rowTitulo">
            <h1>Buscador</h1>
        </div>
        <div class="colFiltros">
            <form action="buscador.php" method="get" id="formulario" onsubmit= "">
                <div class="filtrosContenido">
                    <div class="tituloFiltros">
                        <h5>Realiza una búsqueda personalizada</h5>
                    </div>
                    <div class="filtroCiudad input-field">
                        <label for="selectCiudad">Ciudad:</label>
                        </br></br>
                        <select name="ciudad" id="selectCiudad">
						   <option value="" selected> Elige una ciudad</option>
                            <?php for ($i = 0; $i < count($aux); $i++) { ?>
                            <option value="<?php echo $aux[
                                $i
                            ]; ?>"><?php echo $aux[$i]; 
							?> </option>
                            <?php } ?>
							
							
                        </select>
                    </div>
                    <div class="filtroTipo input-field">
                        <label for="selecTipo">Tipo:</label>
                        <br></br>
                        <select name="tipo" id="selectTipo">
                            <option value="" selected>Elige un tipo</option>
                            <?php for ($i = 0; $i < count($aux1); $i++) { ?>
                            <option value="<?php echo $aux1[
                                $i
                            ]; ?>"><?php echo $aux1[$i]; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="filtroPrecio">
                        <label for="rangoPrecio">Precio:</label>
                        <input type="text" id="rangoPrecio" name="precio" value="" />
                    </div>
                    <div class="botonField">
                        <input type="submit" class="btn white" value="Buscar" id="submitButton">
						<?php
						?>
                    </div>
                </div>
            </form>
        </div>
        <div class="colContenido">
            <div class="tituloContenido card">
                <h5>Resultados de la búsqueda:</h5>
                <div class="divider"></div>
                <button type="button" name="todos" class="btn-flat waves-effect" id="mostrarTodos">Mostrar
                    Todos</button>
            </div>
            <div id="contenido" style="display:none">
                <?php for ($i = 0; $i < count($products); $i++) { ?>
                <div class="row">
                    <div class="example-1 card">
                        <div class="data">
                            <div class="content" style="display:flex">
							   <img class="" src="img/home.jpg"  style="width:40%" />
							   <div id="book-image">
									</br>
									<h6> <strong>Dirección:</strong> <?php echo $products[
										$i
									]["Direccion"]; ?> </h6>
									<h6> <strong>Ciudad:</strong> <?php echo $products[
										$i
									]["Ciudad"]; ?> </h6>
									<h6> <strong>Teléfono:</strong> <?php echo $products[
										$i
									]["Telefono"]; ?> </h6>
									<h6> <strong>Código Postal:</strong> <?php echo $products[
										$i
									]["Codigo_Postal"]; ?> </h6>
									<h6> <strong>Tipo:</strong> <?php echo $products[
										$i
									]["Tipo"]; ?> </h6>
									<h6 id="precio"> <strong>Precio:</strong> </h6>
									<h5 id="precio_php"><?php echo $products[$i][
										"Precio"
									]; ?> </h5>
									</br></br>
									<a style="color:#666666; float:right; padding-right:40px">VER MAS</a>.
									</br></br>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery-3.0.0.js"></script>
        <script type="text/javascript" src="js/ion.rangeSlider.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <script type="text/javascript" src="js/index.js"></script>
        <script type="text/javascript">

		  $(document).ready(function resultado() {
				$("#mostrarTodos").on('click', function() {
					$("#contenido").show();
				});
				
		
		  })
	  </script>
       
</body>

</html>