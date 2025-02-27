<?php

namespace App\NytApi\Response\Part;

use App\NytApi\Response\DTO;

class RankHistoryItem extends DTO
{
    public ?string $primary_isbn10;
    public ?string $primary_isbn13;
    public ?int $rank;
    public ?string $list_name;
    public ?string $display_name;
    public ?string $published_date;
    public ?string $bestsellers_date;
    public ?int $weeks_on_list;
    public ?int $rank_last_week;
    public ?int $asterisk;
    public ?int $dagger;
}
