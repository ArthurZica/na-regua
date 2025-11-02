<?php

namespace App\Services;


use App\Models\Instance;
use Illuminate\Support\Facades\Http;

class WhatsappEventsService
{

    public function __construct()
    {
    }

    public function logoutInstance(string $instance_id){
        Instance::where('instance_id',$instance_id)->update(['connected' => false]);
        return response()->json(['status' => 'instância desconectada']);
    }


}
