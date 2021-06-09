<?php	
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'TheGreatCatsby');
	//define('DB_NAME', 'data_base');
	 
	/* Подключение к базе данных с указанными учетными данными */
	$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	 
	// Проверка подключения
	if($link === false) {
		die("ОШИБКА: Соединение не установлено. " . mysqli_connect_error());
	}
?>