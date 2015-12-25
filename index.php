<?php
	include 'inc/headers.inc.php';
	include 'inc/cookie.inc.php';
	ob_start();
	/* session_start();
	header('Content-Type: text/html; charset=utf-8');
	if(!isset($_SESSION['test']) and !isset($_POST['q'])){
		//���� ������ ������ �����, �� �������������� ����������
		$q = 0; //����� �������� �������
		$title = '�������� ����';
	}else{
		//
		if($_POST['q']!='1')
			$_SESSION['test'][]=$_POST['answer'];
		$q = $_POST['q'];
		$title = $_POST['title'];
	} */
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
	<head>
		<title><?= $title?></title>
		<meta http-equiv="content-type"
			content="text/html;charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="inc/style.css" />
	</head>
	<body>

		<div id="header">
			<!-- ������� ����� �������� -->
			<h1><?= $title?></h1>
			<img src="logo.gif" width="187" height="29" alt="��� �������" class="logo" />
			<span class="slogan">��� ��� �����</span>
			<!-- ������� ����� �������� -->
		</div>

		<div id="content">
			<!-- ��������� -->
			<h1><?= $header?></h1>
			<!-- ��������� -->
			<blockqute>
				<?
					if($visitCounter == 1){
						echo"������� ��� �����.";
					}
					else{
						echo"�� ����� � ��� $visitCounter ��� <br>";
						echo"��������� ��������� $lastVisit";
					}
				?>
			</blockqute>
			<!-- ������� ��������� �������� -->
			<?php
				/* switch($q){
					case 0: include 'start.php'; break;
					case 1: include 'q1.php'; break;
					case 2: include 'q2.php'; break;
					case 3: include 'q3.php'; break;
					default: include 'result.php';
				}
			 */
				include 'inc/routing.inc.php';
			?>	
			<!-- ������� ��������� �������� -->
		</div>
		<div id="nav">
			<!-- ��������� -->
			<h2>��������� �� �����</h2>
			<ul>
				<li><a href='index.php'>�����</a></li>
				<li><a href='index.php?id=contact'>��������</a></li>
				<li><a href='index.php?id=about'>� ���</a></li>
				<li><a href='index.php?id=info'>����������</a></li>
				<li><a href='test/index.php'>��-���� ����</a></li>
				<li><a href='index.php?id=gbook'>�������� �����</a></li>
				<li><a href='eshop/catalog.php'>�������</a></li>
			</ul>
			<!-- ��������� -->
		</div>
		<div id="footer">
			<!-- ������ ����� �������� -->
			&copy; �����-���� ����, 2000 - <?= date('Y')?>
			<!-- ������ ����� �������� -->
		</div>
	</body>
</html>