<?php

class Task {

    public $id = "";
    public $account_id = "";
    public $title = "";
    public $description = "";
    public $status = "";
    public $created_at = "";

    function __construct(
        $account_id,
        $title,
        $description,
        $status = "Pending",
        $created_at = "",
        $id = ""
    ) {
        $this->id = $id;
        $this->account_id = $account_id;
        $this->title = $title;
        $this->description = $description;
        $this->status = $status;
        $this->created_at = $created_at;
    }
}