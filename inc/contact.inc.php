<?php
 	$result='';
	if($_SERVER['REQUEST_METHOD']=='POST'){
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$subj = trim(strip_tags($_POST['subject']));
		$body = trim(strip_tags($_POST['body']));
		if(mail('admin@mysite.local', $subj, $body))
			$result = '������ �������� ��������� �������';
	}else{
			$result = '��������� ������ �������� ������';	
	}
}	
?>
<h3>�����</h3>
<p>123456 ������, ����� ������������ �������� 21</p>
<h3>������� ������</h3>
<p><?= $result?></p>
<form action='<?= $_SERVER['REQUEST_URI']?>' method='post'>
	<label>���� ������: </label><br />
	<input name='subject' type='text' size="50"/><br />
	<label>����������: </label><br />
	<textarea name='body' cols="50" rows="10"></textarea><br /><br />
	<input type='submit' value='���������' />
</form>	

