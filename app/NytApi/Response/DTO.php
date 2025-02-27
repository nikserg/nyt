<?php

namespace App\NytApi\Response;

abstract class DTO
{
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
