<?php

	// $startDate - дата оформления вклада
	// $summstart - начальная сумма
	// $period - 1|2|3|4|5 года
	// $popolnenie - yes no (пополнение)
	// $summadd - сумма пополнения
	// $percent - годовая процентная ставка 10%

	$startDate = $_POST['dateselector'];
	$summstart = $_POST['summstart'];
	$period = $_POST['period'];
	$popolnenie = $_POST['popolnenie'];
	$summadd = $_POST['summadd'];
	$percent = 0.1;

	if (!empty($_POST)) {
		
		$startDate = date("Y-m-d", strtotime($startDate)); // Преобразуем
		
		$endDate = date('Y-m-d', strtotime("+$period year", strtotime($startDate))); // Дата окончания вклада
		

		$start = date_create("$startDate");
		$end = date_create("$endDate");
		$diff   = date_diff( $start, $end );
		$summdays = $diff->days; // Получаем перод вклада в днях

		# Считаем процент по вкладу с ежедневной капитализацией процентов, без пополнения

		if ($popolnenie == 'no') {

			# Упрощенная формула
			$ic = 1 + ($percent / 365);
			$summn = $summstart * pow($ic, $summdays);
			$summn = round($summn, 2);
			echo "$summn" . ' р.';

		}

		# Считаем процент по вкладу с ежегодной капитализацией и пополнением в конце каждого года (последовательное изменение величины $summstart в течении $period - количество периодов)

		if ($popolnenie == 'yes') {
			// запускаю цикл по количеству лет, на которые оформлен вклад
			
			if ($period == 1) {
			// если период вклада равен одному году, то пополнение не считаем
				$summn = $summstart * (1 + $percent); // сумма с процентами, но без пополнения
				$summn = round($summn, 2);
				echo "$summn" . ' р.';

				}

			if ($period != 1) {

				for ($i=1; $i < $period+1; $i++) { 
				
					$summnarr = array();
					$summn = $summstart * (1 + $percent); // сумма с процентами
					$summstart = $summn + $summadd; // сумма с процентами + пополнение
					$summnarr[] = $summstart;
					
				}
				$summnresult = array_pop($summnarr);
				$summnresult = $summnresult - $summadd; // вычитаю лишнее пополнение из цикла (за последний год пополнение не считается)
				$summnresult = round($summnresult, 2);
				echo "$summnresult" . ' р.';
			}
			
		}
			
	}

?>