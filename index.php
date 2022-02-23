<?php
ob_start();
$token = "5128764021:AAHUKu_P2CzPZNC_snt21lJ2uWtoNrBl4eo"; // bot token
define("API_KEY",$token);
echo file_get_contents("https://api.telegram.org/bot" . API_KEY . "/setwebhook?url=" . $_SERVER['SERVER_NAME'] . "" . $_SERVER['SCRIPT_NAME']);
function bot($method,$datas=[]){
$JJJ22J = http_build_query($datas);
$url = "https://api.telegram.org/bot".API_KEY."/".$method."?$JJJ22J";
$JJJ22J = file_get_contents($url);
return json_decode($JJJ22J);
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$data = $update->callback_query->data;
$name = $up->from->first_name;
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$txt = $message->caption;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$new = $message->new_chat_members;
$mid = $message->message_id;
$type = $message->chat->type;
$name = $message->from->first_name;

$botuser = "@Video_Down_Bot";

if(isset($update->callback_query)){

$up = $update->callback_query;
$chat_id = $up->message->chat->id;
$from_id = $up->from->id;
$user = $up->from->username;
$name = $up->from->first_name;
$message_id = $up->message->message_id;
$data = $up->data;
}

if ($text == '/start') {
bot('sendMessage',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$mid,
'text'=>"Salom $botuser' Xush kelibsiz!

Instagram va TikTok video havolasini yuboring."
]);
}




if(mb_stripos($text,"https://")!==false){
$stm = round(microtime(true));
	$kuting = bot('sendMessage',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$mid,
'text'=>"Iltimos kuting. Yuklanmoqda!"
])->result->message_id;
$yt1= json_decode(file_get_contents("https://mr-abood.herokuapp.com/Get/Video/Insta?Link=".$text),1);
$tt1= json_decode(file_get_contents("https://mr-abood.herokuapp.com/Download/From/TikTok?Link=".$text),1);
$tdown= $tt1["MP4 Without Watermark"];
$vdown= $yt1["link"];
bot('deleteMessage',[
'chat_id'=>$chat_id,
'message_id'=>$kuting
]);
$okk = bot('sendvideo',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$mid,
'video'=>$vdown,
'caption'=>"🌐 Yuklash uchun: $botuser"
]);
$okk2 = bot('sendvideo',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$mid,
'video'=>$tdown,
'caption'=>"🌐 Yuklash uchun: $botuser"
]);
if($okk->ok or $okk2->ok){
$endt = round(microtime(true));
$tims = $endt - $stm;
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🧭 $tims sekundda yuklandi!"
]);
}else{
 bot('sendMessage',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$mid,
'text'=>"Xatolik yuz berdi!"
]);
}
}



if($text=="/tezlik"){
$start_time = round(microtime(true) * 1000);
$send=  bot('sendmessage', [
'chat_id' => $chat_id,
'text' =>"Kuting...",
])->result->message_id;

$end_time = round(microtime(true) * 1000);
$time = $end_time - $start_time;
  bot('editMessagetext',[
"chat_id" => $chat_id,
"message_id" => $send,
"text" => "Bot Tezliki: " . $time .  "Ms",
]);
}
