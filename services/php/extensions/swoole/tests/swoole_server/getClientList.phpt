--TEST--
swoole_server: get client list
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
use Swoole\Server;

$simple_tcp_server = __DIR__ . "/../include/api/swoole_server/opcode_server.php";
$port = get_one_free_port();

start_server($simple_tcp_server, TCP_SERVER_HOST, $port);

$timer = suicide(2000);
usleep(500 * 1000);

makeCoTcpClient(TCP_SERVER_HOST, $port, function(Client $cli) {
    $r = $cli->send(opcode_encode("getClientList", []));
    Assert::assert($r !== false);
}, function(Client $cli, $recv) use ($timer) {
    list($op, $data) = opcode_decode($recv);
    Assert::assert(is_array($data) && count($data) === 1);
    echo "SUCCESS\n";
    $cli->close();
    Timer::clear($timer);
});
Event::wait();
?>
--EXPECT--
SUCCESS
