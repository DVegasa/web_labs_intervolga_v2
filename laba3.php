<?php

    class TocConfig {
        public $name, $hLevel;
    }
    
    /**
     * @return HTML вёрстка оглавления
     */
    function getTocByHtml($html, $tocConfig) {
        $rawHtml = @file_get_contents("$html.html");  
        if (!empty($rawHtml)) {
            return getToc($rawHtml);
        } else {
            return "Ошибка: такой файл не найден";
        }
    }

    $offset = 0;
    function getToc($html) {
        $headerPattern = "/<h([1-6]).?(.*?)<\/h.?>/";
        preg_match_all($headerPattern, $html, $matches, PREG_OFFSET_CAPTURE + PREG_SET_ORDER);

        foreach ($matches as $hTag) {
            $fullTag = $hTag[0][0];
            $pos = $hTag[0][1];
            $hLevel = $hTag[1][0];
            
            $hTagId;
            if (hasHTagId($fullTag)) {
                $hTagId = getHTagId($fullTag);
            } else {
                $hTagId = getGeneratedHTagId();
                
                global $offset;

            }
        }
    }

    function addToToc($id, $name, $hLevel) {

    }

    $generatedHTagIdPreffix = "tag";
    function getGeneratedHTagId() {
        static $idIndex = 1;
        global $generatedHTagIdPreffix;
        $id = $generatedHTagIdPreffix . $idIndex++;
        return $id;
    }

    function hasHTagId($hTag) {
        return getHTagId($hTag) === NULL ? 0 : 1;
    }

    function getHTagId($hTag) {
        $hTagWithIdPattern = "/<h[1-6].*id=\"(\w*)\".*/";
        preg_match($hTagWithIdPattern, $hTag, $matches);
        return isset($matches[1]) ? $matches[1] : NULL;
    }
?>