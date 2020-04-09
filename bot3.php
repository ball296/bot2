<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'P5CC+GBgVNSc48oKsMHztwy2LCn6+vq2Y6z3EaCVrL9sssYRrq12TZoWep5QNjvy81hUxVJH1UlszUGGsUqa0pk1jAIz01byK/VzzHkxol8n48PShgI+1y3fqalBBDBt1XEikmfA9m4S3m3O30T/4gdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'c2e8ba6b19f1b5dcf59cf1fb7fbbe339';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array



if (sizeof($request_array['events']) > 0) {

    foreach ($request_array['events'] as $event) {
##echo $event ."<br>";
        $reply_message = '';
        $reply_token = $event['replyToken'];
        
       $text = $event['message']['text']; 
if (strpos($text,'Jarvis แสดงตัวอย่างรายงานเสาล้ม ผวก')!==false){
##$text = $event['message']['text'];
        ##$text=join(', ', $event);
    $text='เรียน ท่าน ผวก.,ผู้บริหาร

 อข.น.2 ขอสรุปรายงานเหตุการณ์เสาแรงสูงล้ม วันที่ 2 เม.ย. 63 เนื่องจากเกิดภัยพิบัติ พายุฤดูร้อน
 บริเวณ บ้านโค้งไผ่ ต.โค้งไผ่ อ.ขาณุวรลักษบุรี จ.กำแพงเพชร  ดังนี้
       เหตุการณ์ เกิด เวลา 20:07 น. ความเสียหาย เสาแรงสูงระบบ 115 เควี.  ล้มจำนวน 19 ต้น และเสาแรงสูงระบบ 22 เควี  ล้มจำนวน 10 ต้น มีผู้ใช้ไฟได้รับผลกระทบทั้งหมดจำนวน  39,943 ราย ปัจจุบันมีการย้ายโหลด 115 KV. และระบบ 22kV. และตัดจ่ายไฟได้เกือบทั้งหมด เหลือผู้ใช้ไฟที่ยังจ่ายไฟไม่ได้ 25 ราย บริเวณที่เกิดเหตุไม่มีผู้ใช้ไฟรายสำคัญ เช่นโรงพยาบาล  และ ผู้ใช้ไฟรายสำคัญ 
มูลค่าความเสียหาย ระบบ 115 เควี  ประมาณ 4 ล้านบาท  ระบบ 22 เควี ประมาณ 6 แสนบาท
การไฟฟ้าส่วนภูมิภาค อำเภอขาณุวรลักษบุรี กำลังเร่งรัดดำเนินการแก้ไข ซ่อมแซมระบบไฟฟ้า ย้ายเสาออกจากแนวถนน ในวันที่ 3 เมษายน 2563 ทีมงาน กฟน.2 และ กฟอ.ขาณุวรลักษบุรี  จะเข้าดำเนินการแก้ไข  โดยด่วนต่อไป ครับ

ขอรายงานข่าวนี้ เวลา 22:40 น. ครับ';
        ##else{
        ##$text="it not ok";
    ##}
        $data = [
            'replyToken' => $reply_token,
            ##'messages' => [['type' => 'image', 'originalContentUrl' => $text,'previewImageUrl'=>$text ]]
            'messages' => [['type' => 'text', 'text' => $text ]]
      ];
        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";}
        
    }
}

echo "OK";




function send_reply_message($url, $post_header, $post_body)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $post_header);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_body);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

?>
