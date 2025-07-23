<?php

header('Content-Type: application/json; charset=utf-8');

include __DIR__.'/../Classes/Model.php';

use Classes\Model;

try
{
    $input = json_decode(file_get_contents('php://input'), true);

    if (empty($input['name']) || empty($input['comment'])) 
    {
        throw new Exception("Все поля обязательны для заполнения");
    }

    $model = new Model();
    $model->AddReviewToDataBase($input['name'], $input['comment']);
    
    echo json_encode([
        'success' => true,
        'message' => 'Отзыв успешно добавлен'
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