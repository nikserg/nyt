<?php

namespace App\NytApi\Response;

use App\NytApi\Response\Part\Isbn;
use App\NytApi\Response\Part\RankHistoryItem;
use App\NytApi\Response\Part\Review;

class Book extends DTO
{
    public ?string $title;
    public ?string $description;
    public ?string $contributor;
    public ?string $author;
    public ?string $contributor_note;
    public ?string $price;
    public ?string $age_group;
    public ?string $publisher;
    /**
     * @var Isbn[]
     */
    public ?array $isbns;

    /**
     * @var RankHistoryItem[]
     */
    public ?array $ranks_history;

    /**
     * @var Review[]
     */
    public ?array $reviews;

    public function __construct(array $data)
    {
        if (isset($data['isbns'])) {
            $data['isbns'] = array_map(fn(array $isbn) => new Isbn($isbn), $data['isbns']);
        }
        if (isset($data['ranks_history'])) {
            $data['ranks_history'] = array_map(fn(array $rankHistoryItem) => new RankHistoryItem($rankHistoryItem), $data['ranks_history']);
        }
        if (isset($data['reviews'])) {
            $data['reviews'] = array_map(fn(array $review) => new Review($review), $data['reviews']);
        }
        parent::__construct($data);
    }
}
