<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

class botNotifController extends Controller
{

    public function updatedActivity()
    {
        $activity = Telegram::getUpdates();
        dd($activity);
    }
    
    public function sendMessage($text)
    {
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001451687642'),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return response()->json(array('res' => 'berhasil'));
    }
}
