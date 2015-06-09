<?php

class Message
{
    public $title;
    public $content;

    function __construct($content, $title)
    {
        $this->content = $content;
        $this->title = $title;
    }
}