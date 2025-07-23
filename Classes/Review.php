<?php

namespace Classes;

use Exception;

class Review
{
    private $name;
    private $comment;

    function __construct(string $name, string $comment)
    {
        if (empty($name) || empty($comment)) {
            throw new Exception("Имя и комментарий не могут быть пустыми");
        }
        $this->name = $name;
        $this->comment = $comment;
    }

    public function getName(): string 
    {
        return $this->name;
    }

    public function getComment(): string 
    {
        return $this->comment;
    }
}
?>