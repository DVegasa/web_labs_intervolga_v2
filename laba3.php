<?php

    class TocConfig {
        public $name, $hLevel;
    }

    function getTocByHtml($html, $tocConfig) {
        return "Hello, $tocConfig->name";
    }

?>