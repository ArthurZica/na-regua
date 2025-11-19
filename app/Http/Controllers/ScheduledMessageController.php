<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduledMessageRequest;
use App\Http\Resources\ScheduledMessageResource;
use App\Models\ScheduledMessage;

class ScheduledMessageController extends Controller
{
    public function index()
    {
        return ScheduledMessageResource::collection(ScheduledMessage::all());
    }

    public function store(ScheduledMessageRequest $request)
    {
        return new ScheduledMessageResource(ScheduledMessage::create($request->validated()));
    }

    public function show(ScheduledMessage $scheduledMessage)
    {
        return new ScheduledMessageResource($scheduledMessage);
    }

    public function update(ScheduledMessageRequest $request, ScheduledMessage $scheduledMessage)
    {
        $scheduledMessage->update($request->validated());

        return new ScheduledMessageResource($scheduledMessage);
    }

    public function destroy(ScheduledMessage $scheduledMessage)
    {
        $scheduledMessage->delete();

        return response()->json();
    }
}
