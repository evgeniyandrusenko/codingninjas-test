<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'codingninjas_test');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8mb4');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'sut:9Z0KW1$!hxKzEz6iHB@fVNWlW&=}gW9/O5A}@i0xf{s{85h4c7|X/<73R-DK');
define('SECURE_AUTH_KEY',  '8BkD$;/bb3sT+%HQLeg@-sNV~E2UZABmW!cg3(&lp}KLC!U7/iKy*ezoeWaJrzYa');
define('LOGGED_IN_KEY',    'pTxZ<x_YET9]N_wVoC^b^pmn=x+;V$E3{#^[#kGmd_nAw&$jqkM[F#?XQ(A,g/-p');
define('NONCE_KEY',        '[|EJ6&A&_P1MgoO>%FMWNxQxGUAJFbk#.HbQkHV BwufRN:k[mx4(T2v!+1O|S,:');
define('AUTH_SALT',        '+lCWe^wZLh?)vI060:q7xOJ~3pYFPZ@2^z>+W.P1U>4uy+NAKv7-JzH>7QokS:h&');
define('SECURE_AUTH_SALT', '=q~=sWw8oR0@v,kO=s%o^cY^:Z$Ii/J-HS5Ito]SPh(Z>c%1#CO!M*!bE sFZ7BN');
define('LOGGED_IN_SALT',   'L?ptufox8?dQ~J/I>t,YS*p(Q`H_T2OtsibGE/;<a.vp!*`8dSYn;F6g)P.e8JOn');
define('NONCE_SALT',       'OG&VM-iA4U=<?-1.-Ov!]_lX3W%/C|+b(y|fbY^K%z=x&%hEY3(Q:}WbW|0Wm{4@');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 * 
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
