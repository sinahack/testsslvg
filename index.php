<?php
mkdir("data");
error_reporting(0);
define('API_KEY', '649765324:AAFTvFIawAfTK7csbkIM-CKkGwQQEpKdOzI');
function bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}

function SendMessage($chatid,$text,$parsmde,$disable_web_page_preview,$keyboard){
 bot('sendMessage',[
 'chat_id'=>$chatid,
 'text'=>$text,
 'parse_mode'=>$parsmde,
 'disable_web_page_preview'=>$disable_web_page_preview,
 'reply_markup'=>$keyboard
 ]);
 } 
 function sendphoto($chat_id, $photo, $caption){
 bot('sendphoto',[
 'chat_id'=>$chat_id,
 'photo'=>$photo,
 'caption'=>$caption,
 ]);
 }
function senddocument($chat_id,$document,$caption){
    bot('senddocument',[
        'chat_id'=>$chat_id,
        'document'=>$document,
        'caption'=>$caption
    ]);
}
 function sendvideo($chat_id, $video, $caption){
 bot('sendvideo',[
 'chat_id'=>$chat_id,
 'photo'=>$video,
 'caption'=>$caption,
 ]);
 }
 function sendaudio($chat_id, $audio, $caption){
 bot('sendaudio',[
 'chat_id'=>$chat_id,
 'audio'=>$audio,
 'caption'=>$caption,
 ]);
 }
function clock($time){
       $tehran = new DateTimeZone("Asia/Tehran");
    $london = new DateTimeZone("Europe/London");
    $dateDiff = new DateTime("now", $london);
    $timeOffset = $tehran->getOffset($dateDiff);
    $newtime = time() + $timeOffset;
return Date("$time",$newtime);
}
function ForwardMessage($chatid,$from_chat,$message_id){
  bot('ForwardMessage',[
  'chat_id'=>$chatid,
  'from_chat_id'=>$from_chat,
  'message_id'=>$message_id
  ]);
  }
function editmessagetext($chat_id,$message_id,$text){
bot('editmessagetext',[
'chat_id'=>$chat_id,
'message_id'=>$message_id,
'text'=>$text
]);
}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message; 
$chat_id = $message->chat->id;
$text = $message->text;
mkdir("data/$chat_id");
@$rezaphp = file_get_contents("data/$chat_id/reza.txt");
$admin = 422994420;
$from_id = $message->from->id;
$mar = file_get_contents("data/$from_id/mar.txt");
$mo = file_get_contents("data/$from_id/mo.txt");
$mom = file_get_contents("data/$from_id/معما.txt");
$jv = file_get_contents("data/$from_id/جواب معما.txt");
$shop = file_get_contents("data/shop.txt");
$name = $message->from->first_name;
$lastname = $message->from->last_name;
$username = $message->from->username;
$member = file_get_contents("users.txt");
$message_id = $update->message->message_id;
$chatid = $update->callback_query->message->chat->id;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$channel = file_get_contents("data/ch.txt");
$date = clock("Y/m/d");
$wach = clock("h:i:s");
$document = $message->document;
$file_id = $document->file_id;
$video = $message->video;
$video_id = $video->file_id;
$audio = $message->audio;
$audio_id = $audio->file_id;
$voice = $message->voice;
$voice_id = $voice->file_id;
$sticker = $message->sticker;
$sticker_id = $sticker->file_id;
$photo = $message->photo;
$photo1_id = $photo[count($photo)-1]->file_id;
$photo2_id = $photo[count($photo)-2]->file_id;
$photo0_id = $photo[count($photo)-0]->file_id;
$music_id = $message->audio->file_id;
$caption = $update->message->caption;
$sdtime = time();
//=========ŝšş™=========//
$keyboard = json_encode([
'keyboard'=>[
[
['text'=>"بازی کردن"],['text'=>"ارسال معما"]
],
[
['text'=>"زیر مجموعه گیری"],['text'=>"راهنما"]
],
[
['text'=>"کد هدیه🎁"],['text'=>"💳فروشگاه"]
],
[
['text'=>"حساب کاربری😃"],['text'=>"👥سازنده👥"]
],
]
]);
$sadmin = json_encode([
'keyboard'=>[
[
['text'=>"بازی کردن"],['text'=>"ارسال معما"]
],
[
['text'=>"زیر مجموعه گیری"],['text'=>"راهنما"]
],
[
['text'=>"کد هدیه🎁"],['text'=>"💳فروشگاه"]
],
[
['text'=>"حساب کاربری😃"],['text'=>"👥سازنده👥"]
],
[
['text'=>"مدیریت"]
],
]
]);
if($text == '/start'){
$sff = file_get_contents("data/$from_id/ok.txt");
if($sff == ""){
file_put_contents("data/$from_id/mo.txt","5");
file_put_contents("data/$from_id/mar.txt","1");
file_put_contents("data/$from_id/ok.txt","ok");
sendmessage($chat_id,"با موفقیت ثبت نام شدید مجددا /start را ارسال نمایید");
}
if($from_id == $admin){
sendmessage($chat_id,"خوش امدید ادمین گرامی به رباتتون خودتون در ساعت 
$wach و تاریخ : 
$date یک گزینه رو انتخاب نمایید","markDown",'',$sadmin);
}else{
$user = file_get_contents('users.txt');
$members = explode("\n",$user);
if (!in_array($chat_id,$members)){
$add_user = file_get_contents('users.txt');
$add_user .= $chat_id."\n";
file_put_contents('users.txt',$add_user);
}
bot('sendMessage', [
'chat_id' => $chat_id,
'text'=>"سلام خوش امدید به بازی هندونه

بازی پر از سرگرمی و فکر📄😆😂",
'parse_mode'=>'MarkDown',
'reply_markup'=>$keyboard
]);
}
}
elseif(preg_match('/^\/([Ss]tart)(.*)/',$text)){
$m_x = str_replace("/start ", "", $text);
if($chat_id == $m_x){
sendmessage($chat_id,"شما نمیتوانید با لینک خود موجودی دریافت نمایید");
}
elseif(strpos($member,"$from_id") !== false){
sendmessage($chat_id,"دوست عزیز شما قبلا در این ربات عضو بوده اید و قادر به گرفتن موجودی نیستید");
}
else{
$user = file_get_contents('users.txt');
$members = explode("\n",$user);
if (!in_array($chat_id,$members)){
$add_user = file_get_contents('users.txt');
$add_user .= $chat_id."\n";
file_put_contents('users.txt',$add_user);
}
$mj = file_get_contents("data/$m_x/mo.txt");
$mo_y = $mj + 3;
file_put_contents("data/$m_x/mo.txt","$mo_y");
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"خوش امدید به بازی هندونه بازی جذاب و فکری برای کاربران عزیز
 
 شما توسط $m_x عضو شدید",
 'parse_mode'=>"markDown",
 'reply_markup'=>$keyboard
]);
bot('sendmessage',[
'chat_id'=>$m_x,
'text'=>"یک نفر با لینک شما وارد شد و ۳ امتیاز دریافت کردید",
]);
}
}
elseif($text == "حساب کاربری😃"){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"اسم شما : $name
 تعداد موجودی شما : $mo
 مرحله بازی شما : $mar",
]);
}
if($text == "برگشت"){
unlink("data/$from_id/reza.txt");
sendmessage($chat_id,"به منوی اصلی برگشتید.....","html",$message_id,$keyboard);
return false;
}
if($text == "💳فروشگاه"){
sendmessage($chat_id,$shop);
}
if($text == "راهنما"){
sendmessage($chat_id,"سلام دوست عزیز

کار با این ربات سادس
به راحتی دکمه شروع بازی را زده و پاسخ معما را بصورت صیحیح وارد نمایید و موجودی کسب کنید
اگر اشتباه جواب دهید ۴ موجودی از شما کسر خواهد شد


همینطور جهت کسب رایگان موجودی رو دکمه زیر مجموعه گیری زده و با استفاده از لینک مخصوص خود افراد دعوت کنید و ۳ سکه دریافت کنید

و یا در کانال $channel رفته و کد که گذاشته میشود را روی دکمه کد هدیه زده و کد را وارد نمایید و موجودی دریافت کنید

بازی جذاب فکری هندونه ");
}
$back = json_encode([
'keyboard'=>[
[
['text'=>"برگشت"]
],
]
]);
if($text == "ارسال معما"){
file_put_contents("data/$from_id/reza.txt","smm");
sendmessage($chat_id,"معما را ارسال نمایید","html","",$back);
}
elseif($rezaphp == "smm"){
file_put_contents("data/$from_id/معما.txt","$text");
file_put_contents("data/$from_id/reza.txt","ssm");
sendMessage($chat_id,"حالا جواب معما را ارسال نمایید ");
}
elseif($rezaphp == "ssm"){
file_put_contents("data/$from_id/جواب معما.txt","$text");
file_put_contents("data/$from_id/reza.txt","none");
sendmessage($chat_id,"ارسال شد بعد از تایید ادمین قرار میگیرد");
$taad = json_encode([
'inline_keyboard'=>[
[
['text'=>"تایید",'callback_data'=>"ok$from_id"],['text'=>"خیر",'callback_data'=>"no"]
],
[
]
],
]);
$jv = file_get_contents("data/$from_id/جواب معما.txt");
$mom = file_get_contents("data/$from_id/معما.txt");
sendmessage($admin,"سلام ادمین گرامی معما جدید ارسال شد
معما : $mom
جواب : $jv
ارسال شده از $from_id
آیا قرار بگیرد یا خیر؟؟","",'',$taad);
}
elseif(strpos($data,"ok") !== false){
$ta = str_replace("ok", "", $data);
$dfd = file_get_contents("m/sm.txt");
$dsx = $dfd + 1;
mkdir("m");
mkdir("m/$dsx");
file_put_contents("m/sm.txt","$dsx");
$moma = file_get_contents("data/$ta/معما.txt");
$mjm = file_get_contents("data/$ta/جواب معما.txt");
$hel = strlen($moma);
file_put_contents("m/$dsx/m.txt","$moma");
file_put_contents("m/$dsx/jm.txt","$mjm");
file_put_contents("m/$dsx/h.txt","$hel");
sendMessage($ta,"معما شما تایید شد مرسی از ارسال معما");
sendMessage($chatid,"معما تایید و در مرحله ی $dsx قرار گرفت");
}
elseif($data == "no"){ 
sendmessage($chatid,"معما رد شد");
}
elseif($text == "بازی کردن"){
if($mo > 4){
$sd = $mo - 4;
file_put_contents("data/$from_id/mo.txt","$sd");
$tex_m = file_get_contents("m/$mar/m.txt");
file_put_contents("data/$from_id/reza.txt","sgame");
sendmessage($chat_id,"معما را پاسخ دهید و امتیاز دریافت کنید :
`$tex_m`","markDown",'',$back);
}else{
sendmessage($chat_id,"موجودی شما کمتر از 4 است و نمیتوانید این مرحله را انجام دهید میتوانید روی دکمه زیرمجموعه زده و موجودی دریافت کنید");
}
}
elseif($rezaphp == "sgame"){
$tex_jm = file_get_contents("m/$mar/jm.txt");
if($text == $tex_jm){
$cxc = $mo + 8;
file_put_contents("data/$from_id/mo.txt","$cxc");
$ccg = $mar + 1;
file_put_contents("data/$from_id/mar.txt","$ccg");
file_put_contents("data/$from_id/reza.txt","none");
sendmessage($chat_id,"تبریک معما درست جواب داده شد به مرحله بعد میتوانید بروید");
}
else{
file_put_contents("data/$from_id/reza.txt","none");
sendmessage($chat_id,"معما اشتباه جواب داده شد و از شما موجودی کسر شد");
}
}
elseif($text == "کد هدیه🎁"){
file_put_contents("data/$from_id/reza.txt","code");
sendmessage($chat_id,"کدی که از $channel  دریافت کردید ارسال نمایید","markDown",'',$back);
}
$getme = json_decode(file_get_contents("http://api.telegram.org/bot".API_KEY."/getme"));
$usernamebot = $getme->result->username;
if($rezaphp == "code"){
$code = file_get_contents("data/code.txt");
if($text == $code){
$codes = file_get_contents("data/codes.txt");
$ser = $mo + $codes;
file_put_contents("data/$from_id/mo.txt","$ser");
file_put_contents("data/codes.txt","");
file_put_contents("data/code.txt","");
file_put_contents("data/$from_id/reza.txt","none");
sendmessage($channel,"کد با موفقیت استفاده شد.🎁

🎁 کد استفاده شده : `$code` 🎁
🎁 تعداد موجودی : $codes 🎁
⏰ ساعت استفاده : $wach
📆 تاریخ استفاده : $date
👤 فرد استفاده کننده : $from_id 👤

موفق و پیروز باشید❤
@$usernamebot
$channel","markDown");
}
else{
file_put_contents("data/$from_id/reza.txt","none");
sendmessage($chat_id,"کد قبلا استفاده شده یا وجود ندارد❌");
}
}
if($text == "زیر مجموعه گیری"){
$cvg = "بازی هندونه هم اکنون در تلگرام منتشر شد
بازی بسیار سرگرم کننده و فکری❤️🍉
لحظه هایی پر از شادی و سرگرمی برای خودتان پدید اورید
لینک رفتن به ربات بازی :
http://telegram.me/$usernamebot?start=$from_id";
sendphoto($chat_id,new CURLFile("photo.jpeg"),$cvg);
sendMessage($chat_id,"با بنر بالا هرکس با لینک مخصوص بنر عضو ربات شود  ۳ سکه به شما تعلق میگیرد");
}
if($text == "👥سازنده👥"){
sendmessage($chat_id,"ساخته شده توسط @Rezaphp و متعلق به کانال @sssteam");
}
//-------
if($text == "مدیریت" && $from_id == $admin){
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"وارد پنل مدیریت شدید",
 'parse_mode'=>"markdown",
  'reply_markup'=>json_encode([
'keyboard'=>[
[
['text'=>"آمار ربات"],['text'=>"ارسال به همه"]
],
[
['text'=>"فروارد همگانی"],['text'=>"🎁ساخت کد هدیه🎁"]
],
[
['text'=>"✅تنظیم چنل"],['text'=>"تنظیم متن فروشگاه"]
],
[
['text'=>"دادن موجودی"]
],
[
]
],
"resize_keyboard"=>true,
])
]);
}
if($text == "🎁ساخت کد هدیه🎁" && $from_id && $admin){
file_put_contents("data/$from_id/reza.txt","setcode");
sendmessage($chat_id,"کد را ارسال نمایید","markDown","",$back);
}
if($rezaphp == "setcode"){
file_put_contents("data/code.txt","$text");
file_put_contents("data/$from_id/reza.txt","setcodes");
sendmessage($chat_id,"تعداد و مقدار موجودی را ارسال نمایید");
}
if($rezaphp == "setcodes"){
file_put_contents("data/codes.txt","$text");
$codee = file_get_contents("data/code.txt");
$codess = file_get_contents("data/codes.txt");
file_put_contents("data/$from_id/reza.txt","none");
sendMessage($chat_id,"ساخته شد.");
sendmessage($channel,"کد جدید ساخته شد🎁🙌😍

🎁 کد قابل استفاده : `$codee` 🎁

🎁تعداد موجودی : $codess 🎁

⏰ ساعت ساخت شده : $wach ⏰

📆 تاریخ ساخت شده : $date 📆

➖➖➖➖➖➖➖
همین حالا به ربات @$usernamebot رفته و دکمه کد هدیه را زده و کد بالا را وارد نمایید.

$channel
@$usernamebot","markDown");
}
if($text == "دادن موجودی" && $from_id && $admin){
file_put_contents("data/$from_id/reza.txt","addm");
sendmessage($chat_id,"تعداد موجودی را ارسال کنید","markDown","",$back);
}
if($rezaphp == "addm"){
file_put_contents("data/mg.txt","$text");
file_put_contents("data/$from_id/reza.txt","setaddm");
sendmessage($chat_id,"ایدی عددی کاربر را لرسال نمایید.");
}
if($rezaphp == "setaddm"){
$sdd = file_get_contents("data/mg.txt");
$sddg = file_get_contents("data/$text/mo.txt");
$cvcb = $sddg + $sdd;
file_put_contents("data/$text/mo.txt","$cvcb");
file_put_contents("data/$from_id/reza.txt","none");
sendMessage($chat_id,"اضافه شد");
sendmessage($text,"کاربر عزیز از طرف مدیریت به تعداد $sdd به موجودی شما اضافه شد","markDown");
}
if($text == "فروارد همگانی" && $from_id && $admin){
file_put_contents("data/$from_id/reza.txt","forward");
sendmessage($chat_id,"مطلب خود را فروارد نمایید","markDown","",$back);
}
if($rezaphp == "forward"){
file_put_contents("data/$from_id/reza.txt","none");
sendmessage($chat_id,"در صف ارسال...");
$all_member = fopen( "users.txt", "r");
while( !feof( $all_member)) {
$user = fgets( $all_member);
forwardmessage($user,$from_id,$message_id);
sendmessage($chat_id,"با موفقیت فوروارد شد.");
}
}
if($text == "تنظیم متن فروشگاه" && $from_id == $admin){
file_put_contents("data/$from_id/reza.txt","settextshop");
sendMessage($chat_id,"متن فروشگاه را ارسال نمایید","html",'',$back);
}
if($rezaphp == "settextshop"){
file_put_contents("data/shop.txt","$text");
file_put_contents("data/$from_id/reza.txt","none");
sendmessage($chat_id,"تنظیم شد.");
}
if($text == "✅تنظیم چنل" && $from_id == $admin){
file_put_contents("data/$from_id/reza.txt","setch");
sendMessage($chat_id,"ایدی چنل را همراه با @ بفرستید
برای مثال @sssteam","html",'',$back);
}
if($rezaphp == "setch"){
file_put_contents("data/ch.txt","$text");
file_put_contents("data/$from_id/reza.txt","none");
sendmessage($chat_id,"تنظیم شد.");
}
if($text == 'آمار ربات' && $from_id == $admin){
$users = file_get_contents("users.txt");
$member_id = explode("\n",$users);
$member_count = count($member_id) - 1;
bot('sendMessage',[
 'chat_id'=>$chat_id,
 'text'=>"تعداد اعضای ربات : $member_count",
 'parse_mode'=>"markdown",
 ]);
}
elseif($text == "ارسال به همه" && $from_id == $admin && $text != "برگشت"){
file_put_contents("data/$from_id/reza.txt","Send");
bot('sendMessage',[
'chat_id' => $chat_id,
'text' => "پیام مورد نظرتونو بفرستید تا برای همه ی کاربرا ارسالش کنم",
'parse_mode'=>'html',
'reply_markup'=>json_encode([
'keyboard'=>[
[
['text'=>"برگشت"]
],
]
])
]);
}
elseif($rezaphp == "Send" && $from_id == $admin){
file_put_contents("data/$from_id/reza.txt","none");
Bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>" پیام همگانی فرستاده شد.",
'parse_mode' => 'html'
]);
$all_member = fopen( "users.txt", "r");
while( !feof( $all_member)) {
$user = fgets( $all_member);
   if($sticker_id != null){
   SendSticker($user,$sticker_id);
   }
   elseif($video_id != null){
   SendVideo($user,$video_id,$caption);
   }
   elseif($voice_id != null){
   SendVoice($user,$voice_id,$caption);
   }
   elseif($file_id != null){
   SendDocument($user,$file_id,$caption);
   }
   elseif($music_id != null){
   SendAudio($user,$music_id,$caption);
   }
   elseif($photo2_id != null){
   SendPhoto($user,$photo2_id,$caption);
   }
   elseif($photo1_id != null){
   SendPhoto($user,$photo1_id,$caption);
   }
   elseif($photo0_id != null){
   SendPhoto($user,$photo0_id,$caption);
   }
   elseif($text != null){
   SendMessage($user,$text,"html");
   }
}
}
?>