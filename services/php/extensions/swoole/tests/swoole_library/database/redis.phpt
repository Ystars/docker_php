--TEST--
swoole_library/database: pdo
--SKIPIF--
<?php
require __DIR__ . '/../../include/skipif.inc';
skip_if_file_not_exist(__DIR__ . '/../../../library/example/redis/base.php');
?>
--FILE--
<?php
require __DIR__ . '/../../include/bootstrap.php';
require __DIR__ . '/../../../library/example/redis/base.php';
?>
--EXPECTF--
Use %fs for %d queries
