<?php

namespace Layout;

include __DIR__.'/AbstractMain.php';
include __DIR__. '/../Classes/ReviewRepository.php';

use Classes\ReviewRepository;
use Layout\AbstractMain;

class Main extends AbstractMain
{
    protected function Layout() : void
    {
        $this->FormRegistration();
        $this->FormOrder();
        $this->ReviewList();
    }

    private function FormRegistration() : void 
    {
        include(__DIR__."/../HTML/form_registration.html");
    }

    private function FormOrder() : void 
    {
        include(__DIR__."/../HTML/form_order.html");
    }

    private function ReviewList() : void 
    {
        self::$model->GetReviews();
        echo
        '<div class="reviews-block">
            <div class="form-group margin-down mx-4">
                <h2 class="from-headline" id="FromHeadline">Отзвывы</h2>
                <div class="form-text from-subheadline">
                    Популярные отзывы наших клиентов😊
                </div>
            </div>
            <div id="ReviewList" class="row row-cols-1 row-cols-md-2 row-cols-lg-3">';
        for($i = 0; $i < 6; $i++)
        { 
            $this->ReviewListElement();
        }
        echo '</div>';
        $this->FormCreateReview();
        echo '</div>';
    }

    private function ReviewListElement() : void 
    {
        $review = ReviewRepository::GetNextReview();
        echo
        '<div class="col">
            <div class="review">
                <div class="review-info">ⓘ</div>
                <div>
                    <h3 class="from-headline review-title">';
        echo $review->getName();
        echo
                    '</h3>
                    <p class="form-text from-subheadline review-text">';
        echo $review->getComment();
        echo
                    '</p>
                </div>
            </div>
        </div>';
    }

    private function FormCreateReview() : void 
    {
        include(__DIR__."/../HTML/form_create_review.html");
    }
}

?>