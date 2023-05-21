<?php
namespace App\Utils;
use Illuminate\Support\Facades\Http;

class WhatsApp{
    public $phone;
    public $name;

    public $code;

    public function __construct($phone , $name,$code)
    {
        $this->name = $name;
        $this->phone = $phone; 
        $this->code = $code;
    }

    public function startConversation()
    {
        $responce = Http::withHeaders([
            'Authorization'=> 'Bearer '.config('app.whatsapp-key'),
            'Content-Type'=> 'application/json'   
        ])
        ->post('https://graph.facebook.com/v16.0/111476201818585/messages',
        [
            "messaging_product"=> "whatsapp",
            'to' => $this->phone,
            "type"=> "template",
            "template"=> (object) [
            "name"=> "hello_world",
            "language"=> (object) [
                   "code"=> "en_US",
            ]
        ]          


        ]);

        return response()->json($responce->body());

    }

    
    public function sendingWhatsAppMessage()
    {
        $responce = Http::withHeaders([
            'Authorization'=> 'Bearer '.config('app.whatsapp-key'),
            'Content-Type'=> 'application/json' 
        ])
        ->post('https://graph.facebook.com/v16.0/111476201818585/messages',
        [
            "messaging_product" => "whatsapp",
            "recipient_type" => "individual",
            "to" => $this->phone,
            "type" => "text",
            "text" => (object) [
                "preview_url" => false,
                "body" => 'Hi '.$this->name.' your OTP are '.$this->code,
            ]

        ]);

        return response()->json($responce->body());
    }
}
