<?php
require_once 'conexao.php';

if (isset($_GET['codigo'])){

	$codigo = $_GET['codigo'];
    
	$sql = "UPDATE cliente SET excluir='sim' WHERE id='$codigo'";
	mysqli_query($conexao, $sql) or die('Error: ' . mysqli_error($conexao));
    header('Location:index.php');
};