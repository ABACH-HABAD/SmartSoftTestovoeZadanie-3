<?php

namespace Models;

include __DIR__.'/Review.php';

use Exception;
use mysqli;
use Reviews\Review;
use Reviews\ReviewRepository;

const ERROR = "Произошла ошибка при подключении к базе данных: ошибка выполнения запроса к базе данных";

class Model
{
    private ?object $connection;

    public function __construct()
    {
        $this->connection = self::connectToDataBase("localhost", "root", "123456789");
    }

    private static function connectToDataBase(string $address, string $user, string $password) : ?object
    {
        try
        {
        $connection = new mysqli($address, $user, $password);
        if($connection->connect_error)
        {
        	throw new Exception("Произошла ошибка при подключении к базе данных: " . $connection->connect_error);
        }
        return $connection;
    }
    catch(Exception $e) { return null; }
    }

    public function GetReviews() : void
    {
        if ($this->connection == null) return;
	    try
	    {
            $command = "SELECT * FROM smartsoft.reviews ORDER BY RAND() LIMIT 6;";
            if ($result = $this->connection->query($command))
            {
                ReviewRepository::Clear();
        	    foreach($result as $row)
        	    {
				    ReviewRepository::AddReview(new Review($row["name"], $row["comment"]));
        	    }
            }
            else
		    {
          	    die(ERROR);
            }
	    }			
	    catch (Exception $e)
	    {
		    die(ERROR);
	    }
    }

    public function AddReviewToDataBase(string $name, string $comment) : void
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        $name = $this->connection->real_escape_string($name);
        $comment = $this->connection->real_escape_string($comment);

        $command = "INSERT INTO smartsoft.reviews (name, comment) VALUES ('$name', '$comment');";

        if (!$this->connection->query($command))
        {
            throw new Exception(ERROR);
        }
    }

    public function AddUserToDataBase(string $name, string $surname, string $email, string $message) : void
    {
        if ($this->connection == null) throw new Exception("Отсутствует подключение к базе данных");

        $name = $this->connection->real_escape_string($name);
        $surname = $this->connection->real_escape_string($surname);
        $email = $this->connection->real_escape_string($email);
        $message = $this->connection->real_escape_string($message);

        $command = "INSERT INTO smartsoft.users (name, surname, email, message) VALUES ('$name', '$surname', '$email', '$message');";

        if (!$this->connection->query($command))
        {
            throw new Exception(ERROR);
        }
    }
}

?>