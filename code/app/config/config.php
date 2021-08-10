<?php
// Задание путей в виде констант
define('GET', ROOT . '/app/get/');
define('POST', ROOT . '/app/post/');
define('TEMPLATES', ROOT . '/app/templates/');
define('IMAGES', ROOT . '/public/images/');
define('LOGS', ROOT . '/logs/');

// PHP Data Objects
define('PDO_DBMS', 'mysql');
define('PDO_HOST', 'database:3306');
define('PDO_BASE', 'adTech');
define('PDO_USER', 'root');
define('PDO_PASS', '1234');
define('PDO_OPTION', [
	PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
	PDO::ATTR_EMULATE_PREPARES   => true,
	PDO::ATTR_PERSISTENT => true
]);

// Безопасность
define('SECURITY_SECRET', '|UsABm;M3<4Z#vs');
define('SECURITY_TOKEN_LIFETIME', 604800);
define('SECURITY_ADMIN_LOGIN', 'admin');
define('SECURITY_ADMIN_PASSWORD', '1234');

// Загрузка изображений
define('UPLOAD_IMAGE_SIZE', 3145728);
define('UPLOAD_IMAGE_TYPES', ['image/jpeg', 'image/png']);

// Доля оплаты за услуги приложения
define('ADTECH_SHARE', 0.2);
