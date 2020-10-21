<?php

    class TocConfig {
        public $name, $hLevel, $idPreffix;
    }

    class TocResult {
        public $tocHtml, $modifiedHtml;
    }

    class ErrorResult {
        public $msg;
    }
    
    /**
     * @return HTML вёрстка оглавления
     */
    $tocCfg;
    function getTocByResourceName($html, $tocConfig) {
        $rawHtml = @file_get_contents("$html.html");  
        global $tocCfg;
        $tocCfg = $tocConfig;

        if (!empty($rawHtml)) {
            return getTocByHtmlSource($rawHtml, $tocConfig);
        } else {
            $er = new ErrorResult;
            $er->msg = "Файл не найден";
            return $er;
        }
    }

    function getTocByHtmlSource($htmlSrc, $tocConfig) {
        $rawHtml = $htmlSrc;
        global $tocCfg;
        $tocCfg = $tocConfig;

        if (!empty($rawHtml)) {
            $result = new TocResult;
            $result->tocHtml = getToc($rawHtml);
            $result->modifiedHtml = $rawHtml;
            return $result;
        }
    }

    $errCode_invalidParam = 1;
    $errCode_noFileSent = 2;
    $errCode_filesizeLimit = 3;
    $errCode_unknownError = 4;
    $errCode_invalidParam = 5;
    $errCode_invalidMime = 6;

    function getTocByHtmlFile($userFile, $tocConfig) {
        $errCode = fileCheck($userFile);
        if ($errCode !== 0) { // Значит файл не прошёл проверку
            $errorResult = new ErrorResult();
            $errorResult->msg = getErrMsgByCode($errCode);
            return $errorResult;
            
        } else {
            $srcHtml = file_get_contents($userFile['tmp_name']); 
            return getTocByHtmlSource($srcHtml, $tocConfig);
        }
    }

    function getErrMsgByCode($errCode) {
        global $errCode_invalidParam;
        global $errCode_noFileSent;
        global $errCode_filesizeLimit;
        global $errCode_unknownError;
        global $errCode_invalidParam;
        global $errCode_invalidMime;

        switch ($errCode) {
            case 0:
                return "";

            case $errCode_invalidParam:
                return "Некорректная загрузка";

            case $errCode_noFileSent:
                return "Файл не был отправлен";

            case $errCode_filesizeLimit:
                return "Превышен размер файла";

            case $errCode_unknownError:
                return "Неизвестная ошибка";

            case $errCode_invalidParam:
                return "Некорректная загрузка (некорректный параметр)";

            case $errCode_invalidMime:
                return "Недопустимый тип";
        }
    }

    function fileCheck($userFile) {
        global $errCode_invalidParam;
        global $errCode_noFileSent;
        global $errCode_filesizeLimit;
        global $errCode_unknownError;
        global $errCode_invalidParam;
        global $errCode_invalidMime;

        if (!isset($userFile['error']) || is_array($userFile['error'])) {
            return ($errCode_phpError);
        }

        switch ($userFile['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return ($errCode_noFileSent);
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return ($errCode_filesizeLimit);
            default:
                return ($errCode_unknownError);
        }

        if ($userFile['size'] > 1000000) {
            return ($errCode_filesizeLimit);
        }

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $userFile['tmp_name']);
        if ($mime != 'text/html') {
            finfo_close($finfo);
            return ($errCode_invalidMime);
        } else {
            finfo_close($finfo);
        }

        return 0;
    }


    function getToc(&$html) {
        $headerPattern = "/<h([1-6]).?(.*?)<\/h.?>/";
        preg_match_all($headerPattern, $html, $matches, PREG_OFFSET_CAPTURE + PREG_SET_ORDER);
        
        openTocHtml();
        global $tocCfg;
        foreach ($matches as $hTag) {
            $fullTag = $hTag[0][0];
            $pos = $hTag[0][1];
            $hLevel = $hTag[1][0];
            $possibleName = $hTag[2][0];
            
            if ($hLevel <= $tocCfg->hLevel) {
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
            $line .= "&nbsp;&nbsp;&nbsp;&nbsp;";
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

    function getGeneratedHTagId() {
        static $idIndex = 1;
        global $tocCfg;
        $id = $tocCfg->idPreffix . $idIndex++;
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