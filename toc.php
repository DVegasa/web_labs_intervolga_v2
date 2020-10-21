<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>volsu_bootstrapp</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/css/swiper.min.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Button.css">
    <link rel="stylesheet" href="assets/css/Simple-Slider.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>



<body>
    <div class="begin">
        <h2>Автогенератор оглавления</h2>
        <form enctype="multipart/form-data" method="POST">
            <p>Тип ввода<br> 
                <label> <input required type="radio" name="inputType" value="onSite" />Имя файла на сервере </label> </br>
                <label> <input required type="radio" name="inputType" value="source" />Исходный код </label> </br>
                <label> <input required type="radio" name="inputType" value="htmlFile" />Загрузка файла с ПК </label> </br>

            <p>Имя файла на сервере, без расширения файла<br> 
            <input type="text" name="html" /></p>

            <p>Исходный код<br> 
            <input type="text" name="src" /></p>

            <p>Загрузка файла с ПК <br> 
            <input type="hidden" name="MAX_FILE_SIZE" value="1500000" />
            <input name="userfile" type="file" />

            <p>Максимальная вложенность: <br> 
                <label> <input required type="radio" name="hLevel" value="1" />h1 </label> &nbsp;
                <label> <input required type="radio" name="hLevel" value="2" />h2 </label> &nbsp;
                <label> <input required type="radio" name="hLevel" value="3" />h3 </label> &nbsp;
                <label> <input required type="radio" name="hLevel" value="4" />h4 </label> &nbsp;
                <label> <input required type="radio" name="hLevel" value="5" />h5 </label> &nbsp;
                <label> <input required checked type="radio" name="hLevel" value="6" />h6 </label> &nbsp;

            <p>Префикс для сгенерированных id. По умолчанию, toc<br> 
            <input required type="text" value="toc" name="idPreffix" /></p>

            <input type="submit" class="btn btn-primary" value="Выполнить">
        </form>
        &nbsp;
        <?php
            if (isset($_POST['hLevel'])) {
                echo '<form method="POST">
                <input class="btn btn-secondary" type="submit" value="Очистить"> </form>
                </br>';
            }
        ?>

        <?php
            if (isset($_POST['hLevel'])) {
                    
                require_once "laba3.php";
                $tocConfig = new TocConfig;
                $tocConfig->hLevel = $_POST['hLevel'];
                if (!isset($_POST['idPreffix']) || $_POST['idPreffix'] === "") {
                    $_POST['idPreffix'] = 'toc';
                }
                $tocConfig->idPreffix = $_POST['idPreffix'];

                $tocResult;
                if ($_POST['inputType'] === 'source') {
                    $tocResult = getTocByHtmlSource($_POST['src'], $tocConfig);

                } else if ($_POST['inputType'] === 'onSite'){
                    $tocConfig->name = $_POST['html'];
                    $tocResult = getTocByResourceName($_POST['html'], $tocConfig);

                } else {
                    $tocResult = getTocByHtmlFile($_FILES['userfile'], $tocConfig);
                }

                
                if ($tocResult instanceof TocResult) {
                    echo "<h3> Как будет выглядеть оглавление </h3> ";
                    echo $tocResult->tocHtml;

                    echo "</br></br> <h3> HTML-код оглавления </br> </h3>";
                    echo htmlentities($tocResult->tocHtml);

                    echo "</br></br> <h3> Модифицированный HTML </h3> ";
                    echo htmlentities($tocResult->modifiedHtml);
                    
                } else if ($tocResult instanceof ErrorResult) {
                    echo "Ошибка: " . $tocResult->msg;
                }
            }
        ?>
</body>