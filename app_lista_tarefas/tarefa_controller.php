<?php

error_reporting(0);
require "../../app_lista_tarefas/tarefa.model.php";
require "../../app_lista_tarefas/tarefa.service.php";
require "../../app_lista_tarefas/conexao.php";
require "../../app_lista_tarefas/ConeDbusuer.php";
require "../../app_lista_tarefas/validarLogin.php";



$emailLogin = $_POST['emailLogin'];
$senhaLogin = $_POST['passwordLogin'];
$email = $_POST['email'];
$senha = $_POST['password'];

if (empty($emailLogin) && empty($senhaLogin)) {
} else {
	$cone = new Conexao();
	$ValidarLogin = new ValidarLogin();
	$ValidarLogin->Validar($cone, $emailLogin, $senhaLogin);
	session_start();
	 $_SESSION['emailLogin'] = $emailLogin;

	 
	echo $_SESSION['emailLogin'];

}
//Chamar crud Banco para user


if (!empty($email) && !empty($senha)) {
	$conexao = new Conexao();
	$UserDb = new ConeDbuser($conexao, $email, $senha);
	$UserDb->inserir();
	header('location:todas_tarefas.php');
} else {;
}




$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

if ($acao == 'inserir') {
	$tarefa = new Tarefa();
	$tarefa->__set('tarefa', $_POST['tarefa']);

	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefaService->inserir();

	header('Location: nova_tarefa.php?inclusao=1');
} else if ($acao == 'recuperar') {

	$tarefa = new Tarefa();
	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefas = $tarefaService->recuperar();
} else if ($acao == 'atualizar') {

	$tarefa = new Tarefa();
	$tarefa->__set('id', $_POST['id'])
		->__set('tarefa', $_POST['tarefa']);

	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	if ($tarefaService->atualizar()) {

		if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
			header('location: index.php');
		} else {
			header('location: todas_tarefas.php');
		}
	}
} else if ($acao == 'remover') {

	$tarefa = new Tarefa();
	$tarefa->__set('id', $_GET['id']);

	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefaService->remover();

	if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
		header('location: index.php');
	} else {
		header('location: todas_tarefas.php');
	}
} else if ($acao == 'marcarRealizada') {

	$tarefa = new Tarefa();
	$tarefa->__set('id', $_GET['id'])->__set('id_status', 2);

	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefaService->marcarRealizada();

	if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
		header('location: index.php');
	} else {
		header('location: todas_tarefas.php');
	}
} else if ($acao == 'recuperarTarefasPendentes') {
	$tarefa = new Tarefa();
	$tarefa->__set('id_status', 1);

	$conexao = new Conexao();

	$tarefaService = new TarefaService($conexao, $tarefa);
	$tarefas = $tarefaService->recuperarTarefasPendentes();
}
