<?php session_start();

if ($_SESSION['username'] != "adm1n" || !isset($_POST['json'])) {
    exit;
}

if (!is_writable('data.conf')) {
	echo 'Can not write data.json, not updated.';
	exit;
}

try {
	file_put_contents('data.conf', $_POST['json']);
	echo shell_exec("python parse.py");
	//echo 'Data persisted.';
} catch (Exception $e) {
	echo 'Error: ' . $e;
}

