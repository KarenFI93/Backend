<?php
	include('./index.php');
	$Ciudad=  $_GET['ciudad'];
	$Tipo = $_GET['tipo'];
	$Precio = $_GET['precio'];
?>

<html>


<body onload= "Mostrar();">
		
</body>
</html>

	 
   <script type="text/javascript">
        function Mostrar(){
		document.getElementById("contenido").style.display = "block";
		}
		
		$(document).ready(function(){
			var ciudad = "<?php echo $Ciudad?>";
			$("#selectCiudad option[value='"+ ciudad +"']").attr("selected",true);
			
			var tipo = "<?php echo $Tipo?>";
			$("#selectTipo option[value='"+ tipo +"']").attr("selected",true);
			
			
			var precio = "<?php echo $Precio?>";
		});

		$("#mostrarTodos").on('click', function() {
			window.location.href =  window.location.href.split("?")[0]; 
		})


</script>




		
	

		
		

