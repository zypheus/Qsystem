<?php

class QueueController {
    private $queueModel;

    public function __construct($queueModel) {
        $this->queueModel = $queueModel;
    }

    public function addToQueue($userId) {
        // Logic to add a user to the queue
        $this->queueModel->enqueue($userId);
    }

    public function removeFromQueue($userId) {
        // Logic to remove a user from the queue
        $this->queueModel->dequeue($userId);
    }

    public function getQueue() {
        // Logic to retrieve the current queue
        return $this->queueModel->getQueue();
    }
}