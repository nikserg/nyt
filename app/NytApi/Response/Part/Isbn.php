<?php

namespace App\NytApi\Response\Part;

use App\NytApi\Response\DTO;

class Isbn extends DTO
{
    public ?string $isbn10;
    public ?string $isbn13;
}
