<?php

    class TocConfig {
        public $name, $hLevel;
    }

    class TocResult {
        public $tocHtml, $modifiedHtml;
    }
    
    /**
     * @return HTML вёрстка оглавления
     */
    function getTocByHtml($html, $tocConfig) {
        $rawHtml = @file_get_contents("$html.html");  
        if (!empty($rawHtml)) {
            $result = new TocResult;
            $result->tocHtml = getToc($rawHtml);
            $result->modifiedHtml = $rawHtml;
            return $result;
        } else {
            return "Ошибка: такой файл не найден";
        }
    }

    function getToc(&$html) {
        $headerPattern = "/<h([1-6]).?(.*?)<\/h.?>/";
        preg_match_all($headerPattern, $html, $matches, PREG_OFFSET_CAPTURE + PREG_SET_ORDER);
        
        openTocHtml();
        foreach ($matches as $hTag) {
            $fullTag = $hTag[0][0];
            $pos = $hTag[0][1];
            $hLevel = $hTag[1][0];
            $possibleName = $hTag[2][0];

            $hTagId;
            if (hasHTagId($fullTag)) {
                $hTagId = getHTagId($fullTag);
            } else {
                $hTagId = getGeneratedHTagId();
                addIdToHtml($html, $hTagId, $pos);
            }
            $name = getHTagName($possibleName);
            addToToc($hTagId, $name, $hLevel);
        }
        return closeTocHtml();
    }

    $offset = 0;
    function addIdToHtml(&$html, $id, $hTagPos) {
        global $offset;
        $insertPos = $hTagPos + $offset + strlen("<h0");
        $insertText = ' id="' . $id . '" ';
        $html = substr_replace($html, $insertText, $insertPos, 0);
        $offset += strlen($insertText);
    }

    function getHTagName($possibleName) {
        $bracketPos = strpos($possibleName, ">");
        if ($bracketPos === false) {
            $bracketPos = -1;
        }
        return substr($possibleName, ++$bracketPos);
    }

    $tocHtml = "";
    function openTocHtml() {
        global $tocHtml;
        $tocHtml = '<div id="toc_container">';
    }

    function addToToc($id, $name, $hLevel) {
        $line = "";
        for ($i = 0; $i < $hLevel; $i++) {
            $line .= "&nbsp;&nbsp;";
        }
        $line .= '<a href="#'.$id.'">'.$name.'</a> </br>';
        global $tocHtml;
        $tocHtml .= $line;
    }

    function closeTocHtml() {
        global $tocHtml;
        $tocHtml .= '</div>';
        return $tocHtml;
    }

    $generatedHTagIdPreffix = "toc";
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