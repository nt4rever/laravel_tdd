<?php

namespace App\Http\Controllers;

use App\Http\Requests\TemplateCreateRequest;
use App\Models\Template;
use App\Services\PushNotification;
use Illuminate\Http\Request;

class TemplateController extends APIController
{
    /**
     * Create a new group.
     *
     * @param TemplateCreateRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(TemplateCreateRequest $request)
    {
        $template = Template::create($request->validated());

        return $this->respondOk($template);
    }

    public function notify(Request $request)
    {
        $notification = new PushNotification();
        $message = $notification->notify($request->input('token'), '', '');

        return $this->respondOk([
            'message' => $message,
        ]);
    }
}
