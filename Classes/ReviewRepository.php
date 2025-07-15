<?php

namespace Reviews;

class ReviewRepository 
{
    private static array $allReviews = [];

    public static function Clear() : void 
    {
        self::$allReviews[] = [];
    }

    public static function AddReview(Review $review) : void 
    {
        self::$allReviews[] = $review;
    }

    public static function GetNextReview() : Review 
    {
        if (count(self::$allReviews) > 0) return array_pop(self::$allReviews);
        else return new Review("Ошибка", "Не удалось загрузить отзыв");
    }
}

?>