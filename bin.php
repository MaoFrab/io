<?php
	$array = getData();
	$k = rand(1, 1000);

	//Binary search
	//Записываем время выполнения
	$binary_time_start = microtime(true);

	$result_binary = findDigitBinary($array, $k);

	$binary_time_finish = microtime(true);
	$binary_time = $binary_time_finish - $binary_time_start;


	//Simple search
	//Записываем время выполнения
	$simple_time_start = microtime(true);

	$result_simple = findDigitSimple($array, $k);

	$simple_time_finish = microtime(true);
	$simple_time = $simple_time_finish - $simple_time_start;


	printf("Element: %d".PHP_EOL, $k);

	if($result_binary >= 0)
		printf("Method: Binary. Element has been found! Index: %d".PHP_EOL, $result_binary);
	else printf("Method: Binary. Sorry, elenemt not found".PHP_EOL);

	if($result_simple >= 0)
		printf("Method: Simple. Element has been found! Index: %d".PHP_EOL, $result_simple);
	else printf("Method: Simple. Sorry, elenemt not found".PHP_EOL);

	printf("Time. Method: Binary. %e".PHP_EOL, $binary_time);
	printf("Time. Method: Simple. %e".PHP_EOL, $simple_time);
	

	function getData() {
		$array = file_get_contents('d.txt');
		//Разделяем по окончанию строки
		$array = explode(PHP_EOL, $array);
		//Удаляем последний элемент, он получается пустым. Сортируем по возрастанию
		array_pop($array);
		sort($array);
		return $array;
	}
	
	function findDigitBinary($a, $k) {
		//Обозначаем границы поиска
		$left = 0;
		$right = count($a)-1;

		//Не выходит ли чисо за пределы массива
		if($k < $a[$left] || $k > $a[$right])
			return -1;

		//Сам алгоритм.
		// while (round($left, 2) < round($right, 2)) {
		while ($left < $right) {
			//Находим среднее
			$middle = ($left + $right) / 2;

			//Если среднее меньше искомого - сдвигаем границы поиска
			if ($a[$middle] < $k) 
				$left = $middle+1;
			else $right = $middle;
		}
		if ($a[$right] == $k)
			return $right;
		else return -1;

	}

	function findDigitSimple($a, $k) {
		$count = count($a)-1;
		for($i = 0; $i <= $count; $i++) {
			if($a[$i] == $k){
				return $i;
				break;
			}
		}
		return -1;
	}
	
	

	

	