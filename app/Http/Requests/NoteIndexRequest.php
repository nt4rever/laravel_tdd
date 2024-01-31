<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoteIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user();
    }

    public function rules(): array
    {
        return [];
    }
}
