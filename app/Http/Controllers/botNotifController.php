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

    public function bot(Request $request)
    {
        $update = json_decode(file_get_contents("php://input"), TRUE);
        $chatID = $update["message"]["chat"]["id"];
        $message = $update["message"]["text"];

        Telegram::sendMessage([
            'chat_id' => $chatID,
            'text' => $text
        ]);
        
    }

    public function setWebhook(Request $request)
    {
        $response = Telegram::setWebhook(['url' => 'https:///gosyen.id/whgsc_bot/bot']);
        dd($response);
    }

    public function removeWebHook(Request $request)
    {
        $response = Telegram::removeWebhook();
        dd($response);
    }
}
