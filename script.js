$(document).ready(function () {

/* ============ Скрипт Ajax запроса на обработку данных формы ============ */

	$("#forma").submit(function(){
		var formData = $( this ).serialize();

		$.post("calc.php", formData, function(data) {
			$("#resultat").html(data);
		});
		return false;
	});

/* ============ Первый ползунок ============ */

	$("#slider-1").slider({
		value:1000,
		min: 1000,
		max: 3000000,
		step: 10,
		slide: function( event, ui ) {
			$( "#amount-1" ).val( ui.value );
		}
	});
	$( "#amount-1" ).val( $( "#slider-1" ).slider( "value" ) );

/* ============ Второй ползунок ============ */

	$("#slider-2").slider({
		value: 1000,
		min: 1000,
		max: 3000000,
		step: 10,
		slide: function( event, ui ) {
			$( "#amount-2" ).val( ui.value );
		}
	});
	$( "#amount-2" ).val( $( "#slider-2" ).slider( "value" ) );

/* ============ Скрипт календаря ============ */

	$( function() {
		$( "#datepicker" ).datepicker();
	} );

});






