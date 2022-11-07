<?php

	// Global com o nome do diretório da instalação do MILES
	$_folder_miles = 'miles-framework/';

	define('FOLDER_MILES_LIBRARY','vendor/theusdido/miles-library/');

	// Raiz do servidor web, corresponde ao documentRoot
	define('PATH_ROOT','/var/www/');

	// Onde está o Miles Framework, index.php
	define('PATH_MILES',PATH_ROOT . $_folder_miles);
	//define('PATH_MILES',dirname(__DIR__) . '/miles-library/');

	// Define o diretório da biblioteca dentro do vendor
	define ('PATH_MILES_LIBRARY',PATH_MILES . FOLDER_MILES_LIBRARY);

	// Tratamento de Erros
	include PATH_MILES_LIBRARY . 'system/exception.php';
	
	// Seta as constantes
	require PATH_MILES_LIBRARY . 'system/constantes.php';

	// Diretório de sistema para carregar as principais funcionaliades
	$_path_system				= PATH_MILES_LIBRARY . FOLDER_SYSTEM . '/';
	$_path_config				= PATH_MILES_LIBRARY . FOLDER_CONFIG . '/';
	$_path_class				= PATH_MILES_LIBRARY . FOLDER_CLASSES . '/';
	$_path_controller			= PATH_MILES_LIBRARY . FOLDER_CONTROLLER . '/';
	$_path_controller_install	= $_path_controller . FOLDER_INSTALL . '/';

	// Carrega biblioteca de funções independentes
	require $_path_system . 'functions.php';

	// Carrega as configurações do arquivo miles.json
	require PATH_MILES_LIBRARY . 'system/miles.json.php';

	// Carrega os arquivos de configuração do sistema	
	require $_path_system . 'config.php';

	// Arquivo de compatibilidade entre versões
	include $_path_system . 'compatibilidade.php';

	// Conexão com banco de dados
	require $_path_system . 'connection.php';

	// Rotas
	require $_path_system . 'rota.php';

	if (AMBIENTE == 'SISTEMA'){
		// Fecha a transação com o banco de dados
		Transacao::Commit();
	}