<?
	$result = 0; // Переменная для суммы ответов
	
	if(isset($_SESSION['test'])){
		// Зачитываем ответы из ини-файла в масив
		$answers = parse_ini_file("answers.ini");
		// Проходим по ответам и смотрим, есть ли среди них правельные 
		foreach(){
			if(array_key_exists($value, $answers))
				//сумируе правелыные ответы
				$result += (int)$answers[$value];
		}
		// очищаем данные сессии
		session_destory();
	}	
?>

<table width="100%">
	<tr>
		<td align="left">
			<p>Ваш результат: <?= $result?> из 30</p>
		</td>
	</tr>
</table>