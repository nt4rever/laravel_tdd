<?php

namespace App\Http\Requests;

use App\Models\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class TemplateCreateRequest extends FormRequest
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
            'groups' => ['present', 'array', 'min:1'],
            'groups.*' => ['present', 'integer', 'distinct'],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function (Validator $validator) {
            if ($validator->errors()->count() > 0) {
                return;
            }
            $groupIds = $validator->safe()->toArray()['groups'];
            $groups = Group::whereIn('id', $groupIds)->get();
            $groupsExist = $groups->count() === count($groupIds);

            if (!$groupsExist) {
                $validator->errors()->add('groups', 'Group does not exists');
            }

            $checkExistOneDecisionGroup = $groups->filter(fn(Group $group) => $group->type === Group::DECISION)->count() === 1;
            if (!$checkExistOneDecisionGroup) {
                $validator->errors()->add('groups', 'Must be have only 1 decision group');
            }
        });
    }
}
