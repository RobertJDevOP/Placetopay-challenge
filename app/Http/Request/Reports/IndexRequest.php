<?php

namespace App\Http\Request\Reports;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'typeReport' => ['bail','required', 'string', 'max:100'],
            'dates'=> ['bail','filled', 'array'],
        ];
    }
}
