<?php


$API_URL = 'https://api.line.me/v2/bot/message';
$ACCESS_TOKEN = 'P5CC+GBgVNSc48oKsMHztwy2LCn6+vq2Y6z3EaCVrL9sssYRrq12TZoWep5QNjvy81hUxVJH1UlszUGGsUqa0pk1jAIz01byK/VzzHkxol8n48PShgI+1y3fqalBBDBt1XEikmfA9m4S3m3O30T/4gdB04t89/1O/w1cDnyilFU='; 
$channelSecret = 'c2e8ba6b19f1b5dcf59cf1fb7fbbe339';


$POST_HEADER = array('Content-Type: application/json', 'Authorization: Bearer ' . $ACCESS_TOKEN);

$request = file_get_contents('php://input');   // Get request content
$request_array = json_decode($request, true);   // Decode JSON to Array

$jsonFlex = [
    "type"=> "bubble",
    "body"=> [
      "type"=>"box",
      "layout"=> "vertical",
      "spacing"=> "sm",
      "backgroundColor"=> "#F8EEEEFF",
      "borderColor"=> "#DA2A14EA",
      "contents"=> [
        [
          "type"=> "button",
          "action"=> [
            "type"=> "uri",
            "label"=> "ข้อเสนอแนะฯ",
            "uri"=> "https://liff.line.me/1655423177-8dMEraKE"
        ],
          "color"=> "#7A0CADFF",
          "style"=> "primary"
        ],
        [
          "type"=> "button",
          "action"=> [
            "type"=> "uri",
            "label"=> "ข้อร้องเรียน",
            "uri"=> "https://liff.line.me/1655423177-nKP1zdX1"
        ],
          "color"=> "#7A0CADFF",
          "style"=> "primary"
          ]
      ]
    ],
    "footer"=> [
      "type"=> "box",
      "layout"=> "vertical",
      "spacing"=> "sm",
      "contents"=> [
        [
          "type"=> "text",
          "text"=> "แผนกลูกค้าสัมพันธ์",
          "contents"=> []
          ]
      ]
      ]
];

if (sizeof($request_array['events']) > 0) {

    foreach ($request_array['events'] as $event) {
##echo $event ."<br>";
        $reply_message = '';
        $reply_token = $event['replyToken'];
        
       $text = $event['message']['text']; 
if (strpos($text,'v list')!==false){
##$text = $event['message']['text'];
        ##$text=join(', ', $event);
        $data = [
            'replyToken' => $reply_token,
            'messages' => [$jsonFlex]
        ];

        print_r($data);

        $post_body = json_encode($data, JSON_UNESCAPED_UNICODE);

        $send_result = send_reply_message($API_URL.'/reply', $POST_HEADER, $post_body);

        echo "Result: ".$send_result."\r\n";
        
    }
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

