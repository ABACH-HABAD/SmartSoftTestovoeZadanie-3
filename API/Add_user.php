<?php

header('Content-Type: application/json; charset=utf-8');

include __DIR__.'/../Classes/Model.php';

use Classes\Model;

try
{
    $input = json_decode(file_get_contents('php://input'), true);

    if (empty($input['name']) || empty($input['surname']) || empty($input['email']) || empty($input['message'])) 
    {
        throw new Exception("Все поля обязательны для заполнения");
    }

    if (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) 
    {
        throw new Exception("Некорректный email");
    }

    $model = new Model();
    $model->AddUserToDataBase($input['name'], $input['surname'], $input['email'], $input['message']);
    
    echo json_encode([
        'success' => true,
        'message' => 'Пользователь успешно зарегестрирован'
    ], JSON_UNESCAPED_UNICODE);
}
catch(Exception $e)
{
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}

?>