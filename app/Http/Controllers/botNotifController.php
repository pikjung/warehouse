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
    
    public function sendMessagePOGSC($pogsc, $user,$note,$disti)
    {
        $text = "Barang Dari : $disti\n"
            . "dengan No PO : <b>$pogsc</b>\n"
            . "<i>Status diterima </i>\n"
            . "Diterima oleh: <b>$user</b>\n"
            . "Pesan dari $user:<b>$note</b>\n";
 
        Telegram::sendMessage([
            'chat_id' => env('TELEGRAM_CHANNEL_ID', '-1001451687642'),
            'parse_mode' => 'HTML',
            'text' => $text
        ]);

        return response()->json(array('res' => 'berhasil'));
    }
}
