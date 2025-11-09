<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        return MessageResource::collection(Message::all());
    }

    public function store(MessageRequest $request)
    {
        return new MessageResource(Message::create($request->validated()));
    }

    public function show(Message $message)
    {
        return new MessageResource($message);
    }

    public function update(MessageRequest $request, Message $message)
    {
        $message->update($request->validated());

        return new MessageResource($message);
    }

    public function destroy(Message $message)
    {
        $message->delete();

        return response()->json();
    }
}
