<?php

namespace Classes;

include __DIR__.'/Review.php';

use Exception;
use mysqli;
use Classes\Review;
use Classes\ReviewRepository;

const ERROR = "Произошла ошибка при подключении к базе данных: ошибка выполнения запроса к базе данных";

class Model
{
    private ?object $connection;

    public function __construct()
    {
        $config = require __DIR__.'/../config/db.php';
        $this->connection = self::connectToDataBase($config['host'], $config['user'], $config['password'], $config['database'], $config['port']); //); "localhost", "root", "123456789"
    }

    private static function connectToDataBase(string $address, string $user, string $password, string $database, int $port = 3306) : ?object
    {
        try
        {
            $connection = new mysqli($address, $user, $password, $database, $port);
            if($connection->connect_error)
            {
        	    throw new Exception("Произошла ошибка при подключении к базе данных: " . $connection->connect_error);
            }
            $connection->set_charset('utf8mb4');
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
          	    throw new Exception(ERROR);
            }
	    }			
	    catch (Exception $e)
	    {
		    error_log($e->getMessage());
            throw $e;
	    }
        finally
        {
            if (isset($result)) {
                $result->close();
            }
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