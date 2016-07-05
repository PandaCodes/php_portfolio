<?php 

function get_web_page($url, $cookiefile = 'cookie.txt')
	{
		$uagent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36";
		$ch = curl_init( $url );

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // возвращает веб-страницу
		curl_setopt($ch, CURLOPT_HEADER, 0); // не возвращает заголовки
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // переходит по редиректам
		curl_setopt($ch, CURLOPT_ENCODING, ""); // обрабатывает все кодировки
		curl_setopt($ch, CURLOPT_USERAGENT, $uagent); // useragent
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120); // таймаут соединения
		curl_setopt($ch, CURLOPT_TIMEOUT, 120); // таймаут ответа
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10); // останавливаться после 10-ого редиректа
		curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'\\'.$cookiefile);
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'\\'.$cookiefile);
		
		$content = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		$header = curl_getinfo($ch);
		curl_close($ch);
		
		$header['errno'] = $err;
		$header['errmsg'] = $errmsg;
		$header['content'] = $content;
		return $header;
	}
	
function post_content($url, $postdata, $cookiefile = 'cookie.txt') 
	{
		$uagent = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.107 Safari/537.36";
		$ch = curl_init( $url );
		//curl_setopt($ch, CURLINFO_HEADER_OUT, true); 
		
        curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //можно будет убрать
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_ENCODING, "");
		curl_setopt($ch, CURLOPT_USERAGENT, $uagent);
		curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_COOKIEJAR, dirname(__FILE__).'\\'.$cookiefile); 
		curl_setopt($ch, CURLOPT_COOKIEFILE, dirname(__FILE__).'\\'.$cookiefile);
		
		
		$content = curl_exec($ch);
		$err = curl_errno($ch);
		$errmsg = curl_error($ch);
		$header = curl_getinfo($ch);
		curl_close($ch);
		
		$header['errno'] = $err;
		$header['errmsg'] = $errmsg;
		$header['content'] = $content;
		return $header;
	}
