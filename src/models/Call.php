<?php

class Call {
    private $id;
    private $caller_id;
    private $receiver_id;
    private $type;
    private $status;
    private $start_time;
    private $end_time;

    public function __construct($caller_id, $receiver_id, $type) {
        $this->caller_id = $caller_id;
        $this->receiver_id = $receiver_id;
        $this->type = $type;
        $this->status = 'active';
        $this->start_time = date('Y-m-d H:i:s');
    }

    public function endCall() {
        $this->status = 'ended';
        $this->end_time = date('Y-m-d H:i:s');
    }

    public function save() {
        // Code to save call record to the database
    }

    public function getCallDetails() {
        return [
            'id' => $this->id,
            'caller_id' => $this->caller_id,
            'receiver_id' => $this->receiver_id,
            'type' => $this->type,
            'status' => $this->status,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ];
    }
}