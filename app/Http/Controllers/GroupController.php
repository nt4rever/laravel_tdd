<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupCreateRequest;
use App\Models\Group;

class GroupController extends APIController
{
    /**
     * Create a new group.
     *
     * @param GroupCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(GroupCreateRequest $request)
    {
        Group::create($request->validated());

        return $this->respondOk([]);
    }
}
