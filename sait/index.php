<?php
session_start();

if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $db = new mysqli("127.0.0.1", "root", "root", "site_fry");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $content = $_POST["content"];
    $userId = $_SESSION["id"];

    $query = "INSERT INTO my_content (content, id) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("si", $content, $userId);

    if ($stmt->execute()) {
        echo "Материал успешно добавлен.";
    } else {
        echo "Ошибка при добавлении материала.";
    }

    $stmt->close();
    $db->close();
}

$contentList = [];
if (isset($_SESSION["id"])) {
    $db = new mysqli("127.0.0.1", "root", "root", "site_fry");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $userId = $_SESSION["id"];

    $query = "SELECT id, content FROM my_content WHERE id = ?";

    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($contentId, $content);

    while ($stmt->fetch()) {
        $contentList[] = ["id" => $contentId, "content" => $content];
    }

    $stmt->close();
    $db->close();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
	<link rel="stylesheet" href="main1.css" media="print">
	<script defer src="JS/main.js"></script>
    <title>Начальная страница</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="link">
                <a href="">СМСиСО</a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="main-content">
            <div class="bnav">
            <div class="navigation">
                <div class="sub_nav">
                    <button class="btn">GitHub</button>
                    <button class="btn">Скачать</button>
                    <button class="btn">Возможная ссылка</button>
                    <button class="btn">Возможная ссылка</button>
                    <button class="btn">Возможная ссылка</button>
                    <button class="btn">Возможная ссылка</button>
                    <button class="btn">Возможная ссылка</button>
                </div>
            </div>
            </div>
            <div class="topic-con">
                <div class="name">О ПРОГРАММЕ</div>
                <div class="element-t">
                    &nbsp;&nbsp;&nbsp;&nbsp;СМСиСО - это высокопроизводительное программное решение, разработанное для надежного и эффективного мониторинга серверов и сетевого оборудования с использованием протокола SNMP. Наше решение обеспечивает полный контроль и управление вашей IT-инфраструктурой, позволяя оперативно выявлять и устранять потенциальные проблемы, обеспечивая бесперебойную работу вашей организации.
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;Основные функции и возможности СМСиСО:
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.	Мониторинг серверов и устройств: Программа позволяет в реальном времени отслеживать состояние серверов, коммутаторов, маршрутизаторов и другого сетевого оборудования, собирая данные о производительности и доступности.
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.	Сбор данных по SNMP: СМСиСО полностью совместима с протоколом SNMP, что позволяет получать информацию о ресурсах и состоянии оборудования из различных источников. Вы можете настроить сбор данных, анализировать их и создавать информативные отчеты.
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.	Тревожный сигнал на мониторе: Программа предоставляет функциональность для немедленного отображения тревожных событий и аномалий на мониторе системного администратора или оператора.
                    <br />&nbsp;&nbsp;&nbsp;&nbsp;СМСиСО - это ваш надежный партнер в области мониторинга серверов и сетевого оборудования по протоколу SNMP.
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
            </div>
            <div class="topic"">
                <div class="name">CHANGELOG</div>
                <div class="element">
                    <a href="">*Исправление №1</a>
                    <span style="color: white; font-weight: bold; font-size: 20px;">[15.08.23]</span>
                    <span style="color: grey; font-size: 20px;">[Ruslan]</span>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
                <div class="element">
                    <a href=""></a>
                </div>
            </div>
        </div>
    </div>
	<form id="comment-form">
	<textarea id="comment-text" placeholder="Введите ваш комментарий"></textarea>
	<div id="capch-form"></div>
	<input id="captcha-code" type="text" placeholder="Введите код защиты">
	<button type="submit">Отправить</button>
	</form>
	<div id="comment-result"></div>
	<div class="load"> 
    <div class="text-load"> 
        <p class="paragraph-load">Для скачивания файла, пожалуйста, кликните на ссылку ниже:</p> 
    </div> 
    <div class="href-load"> 
        <a href="main.php" target="blank" class="download-button">Скачать</a> 
    </div> 
	</div>
	<h1 align="center">Добавление записей</h1>
    <?php
    if (isset($_SESSION["id"])) {
        // Если пользователь авторизован, отобразите форму для добавления записей
        echo '<form method="POST" action="">
                <div class="col-md-5 col-sm-12" style="display: flex; flex-direction: column; align-items: center;">
    <div style="width: 80%; text-align: right;">
        <textarea style="height: 100px; width: 100%;" id="content" name="content" required></textarea>
    </div>
    <div style="width: 80%; text-align: right; margin-top: 10px;">
        <button >Добавить</button>
    </div>
</div>


</form>';
    }
    ?>
    <p><h2>Список записей</h2>
    <ul>
	<?php
        foreach ($contentList as $contentItem) {
            echo '<li>' . $contentItem["content"] . '</li>';
        }
        ?>
    </ul>
    </p>
	<form method="POST" action="logout.php" id="logout-form">
	<button type="submit">Выйти</button>
    </form>
<script>
        function logout() {
            document.getElementById('logout-form').submit();
        }
    </script>
    <div class="container">
        <div class="footer">
            <div class="text-content">
                © Стиль Downgrade, палитра и стиль контейнеров позаимствованы у Norton Comander
                <br>
                Ruslan Fomin
                <br>
                2023 г. 220602
            </div>
        </div>
    </div>
</body>
</html>