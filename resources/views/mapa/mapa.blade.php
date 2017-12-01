@extends('admin.main')

@section('content')
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<div class="text-center" style="margin: 20px;">
	<h2>Geolocalización</h2>
	<div class="row">
		<div class="col-sm-12 col-xs-12">
	        <div class="alert alert-info alert-dismissible text-left" role="alert">
		        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
		        <strong>Nota: </strong><br>
		        - La ubicación de los repartidores puede tener un margen de error de 10 a 100 metros.<br>
		        - Cada 10 segundos se actualizan las posiciones de los repartidores de forma automática.<br>
		    </div>
		</div>
	</div>
	
	<div id="map" style="width: 100%; height: 500px;"></div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCxbaPS8cnkknQo3eZtf9pTumDze0LI01s" type="text/javascript"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		setInterval(function() {
			refreshMap();
		}, 10000);
	});

	var marcadores_array = [];
	marcadores_array = <?php echo $coordenadas;?>;

	//Configuración del mapa
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 13,
		scrollwheel: false,
		center: new google.maps.LatLng(20.660802, -103.349551),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});

	//Define la variable que contendrá el contenido del label del marcador
	var infowindow = new google.maps.InfoWindow();

	//Define las varibales del marcador y del ciclo for
	var marker, i, markers = [];

	//Objeto que trae el ícono
	var icon = {
		url: 'http://cocoinbox.bsmx.tech/public/img/pin-moto.png',
		scaledSize: new google.maps.Size(30, 30), // scaled size
		origin: new google.maps.Point(0,0), // origin
		anchor: new google.maps.Point(0,0), // anchor
	};

	//Llama la función encargada de dibujar los marcadores en el mapa
	setMarkers(marcadores_array);


	/**
	 *====================================================================================================================================================================================
	 *=                                                          Empiezan las funciones que se encargan de personalizar el mapa                                                          =
	 *====================================================================================================================================================================================
	 */

	//Función que se encarga de cargar las coordenadas de los repartidores
	function refreshMap() {
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			method: "POST",
			url: "{{url('geolocalizacion/cargar_coordenadas')}}",
			success: function(data) {
				deleteMarkers();
				setMarkers(data);
			},
			error: function(xhr, status, error) {
				console.warn("Se encontró un problema trayendo las coordenadas de os repartidores, por favor espere 20segundos o trate nuevamente recargando la página. \nError: " + xhr.status + " (" + error + ") ");
			}
		});
	}

	//Función que se encarga de dibujar los marcadores en el mapa
	function setMarkers(marcadores) {
		for (i = 0; i < marcadores.length; i++) {  
			marker = new google.maps.Marker({
				position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
				map: map,
				icon : icon,
			});
			markers.push(marker);

			google.maps.event.addListener(marker, 'click', (function(marker, i) {
				return function() {
					var html = "<img src=" + marcadores[i][3] + " style='border-radius: 50%;' width='40' height='40' >" + "<br>" + marcadores[i][0];
					infowindow.setContent(html);
					infowindow.open(map, marker);
				}
			})(marker, i));
		}
	}

	//Elimina los marcadores quitando sus referencias en el mapa
	function deleteMarkers() {
        for (var i = 0; i < markers.length; i++) {
        	markers[i].setMap(null);
        }
		markers = [];
	}
</script>
@endsection