<?
$title = '�����-���� ����';
$header = "����� ���������� �� ��� ����!";
$id = strtolower(strip_tags(trim($_GET['id'])));
// ������������� ���������� ��������
switch($id){
	case 'contact': 
		$title = '��������';
		$header = '�������� �����';
		break;
	case 'about': 
		$title = '� ���';
		$header = '� ����� �����';
		break;
	case 'info': 
		$title = '����������';
		$header = '����������';
		break;
	case 'log': 
		$title = '������ ���������';
		$header = '������ ���������';
		break;
	case 'gbook': 
		$title = '�������� �����';
		$header = '���� �������� �����';
		break;		
}