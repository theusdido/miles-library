<?php
	// Setando variáveis
	$entidadeNome = "funcaopermissoes";
	$entidadeDescricao = "Função Permissões";

	// Criando Entidade
	$entidadeID = criarEntidade(
		$conn,
		$entidadeNome,
		$entidadeDescricao,
		$ncolunas=3,
		$exibirmenuadministracao = 1,
		$exibircabecalho = 1,
		$campodescchave = "",
		$atributogeneralizacao = 0,
		$exibirlegenda = 1,
		$criarprojeto = 1,
		$criarempresa = 1,
		$criarauth = 0,
		$registrounico = 0
	);

	// Criando Atributos
	$funcao = criarAtributo($conn,$entidadeID,"funcao","Função","int",0,0,4,0,getEntidadeId("funcao",$conn),0,"");
	$usuario = criarAtributo($conn,$entidadeID,"usuario","Usuário","int",0,0,4,0,getEntidadeId("usuario",$conn),0,"");
	$permissao = criarAtributo($conn,$entidadeID,"permissao","Permissão","tinyint",0,0,7,0,0,0,"");