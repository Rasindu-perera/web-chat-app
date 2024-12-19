<?php

class WebSocketServer
{
    private $clients;
    private $socket;

    public function __construct($host, $port)
    {
        $this->clients = [];
        $this->socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        socket_bind($this->socket, $host, $port);
        socket_listen($this->socket);
    }

    public function run()
    {
        while (true) {
            $changedSockets = $this->clients;
            $changedSockets[] = $this->socket;
            socket_select($changedSockets, $null, $null, 0, 10);

            if (in_array($this->socket, $changedSockets)) {
                $newSocket = socket_accept($this->socket);
                $this->clients[] = $newSocket;
                $this->handshake($newSocket);
                $changedSockets = array_diff($changedSockets, [$this->socket]);
            }

            foreach ($changedSockets as $changedSocket) {
                $buffer = socket_read($changedSocket, 1024);
                if ($buffer === false) {
                    $this->removeClient($changedSocket);
                    continue;
                }
                $this->broadcast($buffer, $changedSocket);
            }
        }
    }

    private function handshake($socket)
    {
        $buffer = socket_read($socket, 1024);
        $headers = [];
        preg_match("/Sec-WebSocket-Key: (.*)\r\n/", $buffer, $headers);
        $key = trim($headers[1]);
        $acceptKey = base64_encode(pack('H*', sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
        $upgrade = "HTTP/1.1 101 Switching Protocols\r\n" .
                   "Upgrade: websocket\r\n" .
                   "Connection: Upgrade\r\n" .
                   "Sec-WebSocket-Accept: $acceptKey\r\n\r\n";
        socket_write($socket, $upgrade, strlen($upgrade));
    }

    private function broadcast($message, $senderSocket)
    {
        foreach ($this->clients as $client) {
            if ($client !== $senderSocket) {
                socket_write($client, $this->encodeMessage($message), strlen($this->encodeMessage($message)));
            }
        }
    }

    private function encodeMessage($message)
    {
        $length = strlen($message);
        if ($length <= 125) {
            return chr(129) . chr($length) . $message;
        } elseif ($length > 125 && $length < 65536) {
            return chr(129) . chr(126) . pack('n', $length) . $message;
        } else {
            return chr(129) . chr(127) . pack('P', $length) . $message;
        }
    }

    private function removeClient($socket)
    {
        $index = array_search($socket, $this->clients);
        if ($index !== false) {
            unset($this->clients[$index]);
        }
        socket_close($socket);
    }

    public function __destruct()
    {
        socket_close($this->socket);
    }
}