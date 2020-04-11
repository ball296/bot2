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
if (strpos($text,'Jarvis P')!==false){
##$text = $event['message']['text'];
        ##$text=join(', ', $event);
    $text='https://www.google.co.th/url?sa=i&url=https%3A%2F%2Fwww.gamespot.com%2Farticles%2Fresident-evil-3-remake-walkthrough-downtown-raccoo%2F1100-6475395%2F&psig=AOvVaw1B7co3Z2rPBJ6Hz8WmyiuL&ust=1586696428760000&source=images&cd=vfe&ved=0CAIQjRxqFwoTCIC90fu24OgCFQAAAAAdAAAAABAD';
        ##else{
        ##$text="it not ok";
    ##}
        $data = [
            'replyToken' => $reply_token,
            'messages' => [['type' => 'image', 'originalContentUrl' => $text,'previewImageUrl'=>$text ]]
            ##'messages' => [['type' => 'text', 'text' => $text ]]
            ##'messages' => [['type' => 'image', 'originalContentUrl'=>$text]]
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
