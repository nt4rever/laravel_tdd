<?php

namespace App\Http\Requests;

use App\Models\Group;
use App\Rules\RequiredAmount;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GroupCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['required', 'integer', Rule::in(Group::TYPES)],
            'users' => ['present', 'array', 'min:1'],
            'users.*' => ['present', 'integer'],
            'required_amount' => ['required', 'integer', new RequiredAmount],
        ];
    }
}
