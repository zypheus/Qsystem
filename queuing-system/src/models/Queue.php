<?php

class Queue {
    private $queue = [];

    public function enqueue($item) {
        array_push($this->queue, $item);
    }

    public function dequeue() {
        if (!$this->isEmpty()) {
            return array_shift($this->queue);
        }
        return null;
    }

    public function isEmpty() {
        return empty($this->queue);
    }

    public function size() {
        return count($this->queue);
    }

    public function getQueue() {
        return $this->queue;
    }
}