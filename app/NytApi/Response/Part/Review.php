<?php

namespace App\NytApi\Response\Part;

use App\NytApi\Response\DTO;

class Review extends DTO
{
    public ?string $book_review_link;
    public ?string $first_chapter_link;
    public ?string $sunday_review_link;
    public ?string $article_chapter_link;
}
