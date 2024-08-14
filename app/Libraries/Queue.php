<?php

namespace App\Libraries;

use Predis\Client;

class Queue
{
    protected $redis;

    public function __construct()
    {
        $this->redis = new Client();
    }

    public function enqueue($queue, $data)
    {
        $this->redis->rpush($queue, json_encode($data));
    }

    public function dequeue($queue)
    {
        $data = $this->redis->lpop($queue);
        return json_decode($data, true);
    }
}
