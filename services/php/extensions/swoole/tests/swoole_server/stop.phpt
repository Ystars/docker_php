--TEST--
swoole_server: stop
--SKIPIF--
<?php
require __DIR__ . '/../include/skipif.inc';
skip_if_in_valgrind();
?>
--FILE--
<?php
require __DIR__ . '/../include/bootstrap.php';

use Swoole\Coroutine\Client;
use Swoole\Timer;
use Swoole\Event;

$simple_tcp_server = __DIR__ . "/../include/api/swoole_server/opcode_server.php";
$port = get_one_free_port();

start_server($simple_tcp_server, TCP_SERVER_HOST, $port);

$timer = suicide(2000);
usleep(500 * 1000);

makeCoTcpClient(TCP_SERVER_HOST, $port, function(Client $cli) {
    $r = $cli->send(opcode_encode("stop", [2]));
    Assert::assert($r !== false);
}, function(Client $cli, $recv) {
    list($op, $data) = opcode_decode($recv);
    Assert::true($data);
    $cli->close();
    global $timer;
    Timer::clear($timer);
    echo "SUCCESS\n";
});
Event::wait();
?>
--EXPECT--
SUCCESS
