<?php
namespace Ratchet\Application\Server;
use Ratchet\RatchetTestCase;
use Ratchet\Server\IoConnection;

/**
 * @covers Ratchet\Server\IoConnection
 */
class IoConnectionTest extends RatchetTestCase {
    protected $sock;
    protected $conn;

    /**
     * @before
     */
    public function before() {
        $this->sock = $this->getMockBuilder('\\React\\Socket\\ConnectionInterface')->getMock();
        $this->conn = new IoConnection($this->sock);
    }

    public function testCloseBubbles() {
        $this->sock->expects($this->once())->method('end');
        $this->conn->close();
    }

    public function testSendBubbles() {
        $msg = '6 hour rides are productive';

        $this->sock->expects($this->once())->method('write')->with($msg);
        $this->conn->send($msg);
    }

    public function testSendReturnsSelf() {
        $this->assertSame($this->conn, $this->conn->send('fluent interface'));
    }
}
