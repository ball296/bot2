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
    $text='https://previews.dropbox.com/p/thumb/AAyoAsvShPL5m9AWJE-8CC9dp4FkucpdNEytKUyoH1k7J3tinEoOQauNVuSn2Li5Y0dVqAgvxclxY7lFQ7Jq50nmtBGUvKKf9V3kKtnMf5G_jXxO0eUahVYAJB5FPkjjOAL4ABZYQ0OfDPAbtT1SGWUC1elx1TjX4zcREX6n3ZY5Fyf7aGLPHJDa-ARv4Lm8oyNcoKWmFcV6uyjsokCSSkyCJsdeUiaBdUkPz9xRkcYMPn9yFfHyAPHsV0ugIlZLUjDB_uacIcYkfAG1G2j9e8gfTCgNtKJLtAGuncg8J9RJGIpUHt-uXQYMiJzUkHKg5XmSENrhEoJk4MlgmQVIelJ2/p.jpeg';
        ##else{
        ##$text="it not ok";
    ##}
        $data = [
            'replyToken' => $reply_token,
            ##'messages' => [['type' => 'image', 'originalContentUrl' => $text,'previewImageUrl'=>$text ]]
            ##'messages' => [['type' => 'text', 'text' => $text ]]
            'messages' => [['type' => 'image', 'originalContentUrl'=>$text]]
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
