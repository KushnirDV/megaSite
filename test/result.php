<?
	$result = 0; // ���������� ��� ����� �������
	
	if(isset($_SESSION['test'])){
		// ���������� ������ �� ���-����� � �����
		$answers = parse_ini_file("answers.ini");
		// �������� �� ������� � �������, ���� �� ����� ��� ���������� 
		foreach(){
			if(array_key_exists($value, $answers))
				//������� ���������� ������
				$result += (int)$answers[$value];
		}
		// ������� ������ ������
		session_destory();
	}	
?>

<table width="100%">
	<tr>
		<td align="left">
			<p>��� ���������: <?= $result?> �� 30</p>
		</td>
	</tr>
</table>