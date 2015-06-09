<?php

class alertPrimaryMessage extends Message{
    public function showMessage()
    {
        $content = $this->content;
        if (!empty($this->title)) {
            $title = $this->title;
            echo
            "<div class=\"am-alert am-alert-primary\" data-am-alert>
                <button type=\"button\" class=\"am-close\">&times;</button>
                <h3>$title</h3>
                <p>$content</p>
            </div>";
        } else {
            echo
            "<div class=\"am-alert am-alert-primary\" data-am-alert>
                <button type=\"button\" class=\"am-close\">&times;</button>
                <p>$content</p>
            </div>";
        }
    }
}