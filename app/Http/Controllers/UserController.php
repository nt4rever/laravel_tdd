<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class UserController extends APIController
{
    public function me()
    {
        $user = auth()->user();

        return $this->respondOk(new UserResource($user));
    }
}
