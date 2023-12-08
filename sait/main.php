<?php
session_start();

$downloadPath = 'test.txt';
$logDir = '\Applications\MAMP\htdocs\sait';
$logFile = $logDir . '\file.txt';

    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true);
    }

    if (!isset($_SESSION['download_count'])) {
        $_SESSION['download_count'] = 0;
    }

    $_SESSION['download_count']++;

    $file = 'test.txt';
    $ip = $_SERVER['REMOTE_ADDR'];
    date_default_timezone_set('Europe/Moscow');
    $timestamp = date('Y-m-d H:i:s');
    $downloadCount = $_SESSION['download_count'];
    $logData = $file . ' Date::' . $timestamp . ' IP::' . $ip . ' COUNT::' . $downloadCount;
    if(file_exists($downloadPath))
    {
        $logData = $logData . ' Статус загрузки: Успешно' . "\n";     
    }
    else
        $logData = $logData . ' Статус загрузки: Ошибка загрузки' . "\n";
    $fileHandle = fopen($logFile, 'a');
    if ($fileHandle) {
        fwrite($fileHandle, $logData);
        fclose($fileHandle);
    }
    if(file_exists($downloadPath))
    {
        header('Content-Disposition: attachment; filename="test.txt"');
        header('Content-Type: application/octet-stream');
        header('Content-Length: ' . filesize($downloadPath));
        readfile($downloadPath);
        exit;
    }
    else
    {
        echo 'Файл не найден';
    }
    
?>
