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
        $TOKEN = "1713523929:AAEXiqg1c3G7T-DFxE7sXtQ3qQq1xX17G0A";
        $apiURL = "https://api.telegram.org/bot$TOKEN";
        $update = json_decode(file_get_contents("php://input"), TRUE);
        $chatID = $update["message"]["chat"]["id"];
        $message = $update["message"]["text"];
        
        if (strpos($message, "/start") === 0) {
        
        file_get_contents($apiURL."/sendmessage?chat_id=".$chatID."&text=Haloo, test webhooks <code>dicoffeean.com</code>.&parse_mode=HTML");
        }
    }
}
