<?php

namespace App\Http\Requests;

use App\Rules\Isbn;
use Illuminate\Foundation\Http\FormRequest;

class BestsellersIndexRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'age-group' => 'string',
            'author' => 'string',
            'contributor' => 'string',
            'isbn' => [new Isbn()],
            'offset' => 'integer|multiple_of:20',
            'price' => 'string|numeric',
            'publisher' => 'string',
            'title' => 'string',
        ];
    }
}
