<?php
$logFolder = __DIR__ . '/logs/';

if (!file_exists($logFolder)) {
    mkdir($logFolder, 0755, true);
}

// Жизнь лога
$files = glob($logFolder . '*.log');
foreach ($files as $file) {
    if (filemtime($file) < strtotime('-5 days')) {
        unlink($file);
    }
}

$logFileName = $logFolder . date('Y-m-d') . '.log';

$dateTime = date('Y-m-d H:i:s');

$requestInfo = [
    'DateTime' => $dateTime,
    'RequestMethod' => $_SERVER['REQUEST_METHOD'],
    'RequestURI' => $_SERVER['REQUEST_URI'],
    'Headers' => getallheaders(),
    'Body' => file_get_contents('php://input'),
    'QueryParams' => $_GET,
    'PostParams' => $_POST,
];

$logMessage = json_encode($requestInfo, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) . "\n";
file_put_contents($logFileName, $logMessage, FILE_APPEND);

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$config = json_decode(file_get_contents('api.json'), true);

$headers = getallheaders();
$providedToken = isset($headers['Token']) ? $headers['Token'] : null;

$route = isset($config[0]['routes'][$method . ' ' . $path]) ? $config[0]['routes'][$method . ' ' . $path] : null;

if ($route && (isset($route['token']) && $providedToken === $route['token'] || !isset($route['token']))) {
    if (isset($route['responseFile'])) {
        $filePath = __DIR__ . $route['responseFile'];
        if (file_exists($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            readfile($filePath);
            die();
        } else {
            http_response_code(404);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => 'Файл не найден'], JSON_UNESCAPED_UNICODE);
            die();
        }
    } else {
        // Возвращаем JSON
        http_response_code($route['responseCode']);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($route['responseData'], JSON_UNESCAPED_UNICODE);
        die();
    }
} else {
    if (isset($route['token'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Несанкционированный доступ'], JSON_UNESCAPED_UNICODE);
    } else {
        if (isset($config[0]['routes'][$method . ' ' . $path])) {
            $route = $config[0]['routes'][$method . ' ' . $path];

            http_response_code($route['responseCode']);

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($route['responseData'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            header('Content-Type: application/json; charset=utf-8');
            echo json_encode(['error' => 'Маршрут не найден'], JSON_UNESCAPED_UNICODE);
        }
    }
}
