<?php

    class TocConfig {
        public $name, $hLevel;
    }

    function getTocByHtml($html, $tocConfig) {
        $rawHtml = @file_get_contents("$html.html");  
        if (!empty($rawHtml)) {
            return getToc($rawHtml);
        } else {
            return "Ошибка: такой файл не найден";
        }
    }

    class H {
        public $level, $name;
    }

    function getToc($html) {
        $headerPattern = "/<h([1-6]).?(.*?)<\/h.?>/";
        preg_match_all($headerPattern, $html, $matches, PREG_OFFSET_CAPTURE);
        print_r($matches);
        print_r("\n\n\n");
        print_r($html);
    }
?>