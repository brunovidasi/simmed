<?php
/**
 * One-off CLI script to create the first admin user.
 * Run once, locally, after the schema has been loaded:
 *
 *   php seed_admin.php <login> <password>
 */

if (php_sapi_name() !== 'cli') {
	exit("This script is CLI-only.\n");
}

$login = $argv[1] ?? null;
$password = $argv[2] ?? null;

if (!$login || !$password) {
	exit("Usage: php seed_admin.php <login> <password>\n");
}

$env = array();
foreach (file(__DIR__.'/.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
	$line = trim($line);
	if ($line === '' || $line[0] === '#' || strpos($line, '=') === FALSE) continue;
	list($key, $value) = explode('=', $line, 2);
	$env[trim($key)] = trim($value, " \t\n\r\0\x0B\"'");
}

$mysqli = new mysqli(
	$env['DB_HOSTNAME'] ?? 'localhost',
	$env['DB_USERNAME'] ?? 'root',
	$env['DB_PASSWORD'] ?? '',
	$env['DB_DATABASE'] ?? 'simmed'
);

if ($mysqli->connect_errno) {
	exit("DB connection failed: {$mysqli->connect_error}\n");
}

$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = $mysqli->prepare(
	"INSERT INTO usuario (login, senha, ativo, administrador, data_cadastro)
	 VALUES (?, ?, 1, 1, NOW())
	 ON DUPLICATE KEY UPDATE senha = VALUES(senha), administrador = 1, ativo = 1"
);
$stmt->bind_param('ss', $login, $hash);
$stmt->execute();

echo "Admin user '{$login}' created/updated.\n";
