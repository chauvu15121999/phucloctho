<?php	if(!defined('_source')) die("Error");
	
	$template = "onesignal";
	function sendMessage($heading,$content,$url='https://sofavietphat.net/'){
		$contents = array(
		"en" => $content
		);
		$headings = array(
		"en" => $heading
		);
		
		$fields = array(
		'app_id' => "3ab06d2c-fd44-4649-b558-9de8bb828967", //thay đổi OneSignal App ID
		'included_segments' => array('All'),
		'contents' => $contents,
		'headings' => $headings,
		'url' => $url
		);
		
		$fields = json_encode($fields);

		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
		'Authorization: Basic N2U0ZDRiN2YtZjcyMS00YjdiLTlmM2YtN2U3ODcwNmY3NzZi'));// thay đổi REST API Key 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	if(!empty($_POST))
	{
		$heading=$_POST['heading'];
		$content=$_POST['content'];
		$url=$_POST['url'];
		if($heading!='' && $content!='')
		{
			sendMessage($heading,$content,$url);
			//die($result);
			transfer('Tin nhắn đã được gửi','index.php?com=onesignal');
		}
	}
	
?>