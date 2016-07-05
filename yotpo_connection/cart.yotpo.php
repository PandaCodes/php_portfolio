<?php
//���� ������ ������������� � 'modules/cart/yotpo/cart.yotpo.php'
if (! defined('DIAFAN'))
{
	include dirname(dirname(dirname(dirname(__FILE__)))).'/includes/404.php';
}

/*
// �������� yotpo-������:
Customization::inc('modules/cart/yotpo/cart.yotpo.php');
$yotpo_client = new Yotpo_client($this->diafan);
$yotpo_client->post_order(orer-id, username, email);
*/

class Yotpo_client extends Diafan 
{
	private $YOTPO_APP_KEY = "BgUxfOgGBsIh8dU8r2CxDmSvs8JI9ZQrAzrymJWn";
	private $YOTPO_SECRET = "oGDVCgelFIZSilz5pzWmLh53cuyZmwvt47FtcSyw";

	//������ "�����" �������
	public function post_order($order_id, $username, $email)
	{
		$url = "https://api.yotpo.com/apps/" . $this->YOTPO_APP_KEY . "/purchases";
		$postdata = array(
			"validate_data" => false,
			"platform" => "general", 
			"utoken" => $this->utoken(),
			"email" => $email,//$this->diafan->_session->read("mail"),
			"customer_name" => $username,//$this->diafan->_session->read("name"),
			"order_id" => $order_id, 
			//"order_date" => date("Y-m-d"),  //TODO:����������� � ����� DB::query_result ();
			"currency_iso" => "RUB",
			"products" => $this->get_products($order_id)
		);	
		//var_dump($postdata); var_dump($_SESSION);
		curl_post($url, json_encode($postdata), true);
	}

	/**
	* ��������� ������ ������� �� id ������
	* @return
	*/
	private function get_products($order_id)
	{
		$goods_in_order = DB::query_fetch_all("SELECT good_id, price FROM {shop_order_goods} WHERE order_id = %d", $order_id, "good_id", "price");
		foreach($goods_in_order as $good)
		{
			$id = $good["good_id"];
			$product["price"] = $good["price"];
			$good =  DB::query_fetch_array("SELECT [name], cat_id, [keywords], [descr] FROM {shop} WHERE id=%d", $id);
			$product["name"] = $good["name"];
			$product["url"] = BASE_PATH_HREF . $this->diafan->_route->link(8, "shop", $good["cat_id"], $id);
			$product["image"] = ""; //img url
			$product["description"] = $good["descr"];
			$product["specs"] =	array();		
			$product["product_tags"] = $good["keywords"];
			
			$products["$id"] = $product; 
		}
		return $products;
	} 
	/**
	* ���������� ���������� ������������� utoken ����� � ������� yotpo
	*/
	private function utoken()
	{
		//"����������" �� ����� utoken
		$filename = dirname(__FILE__) . "/yotpo.utoken";
		if (file_exists($filename))
		{
			$f = fopen($filename, "r+");
			$last = intval(fgets($f));
			if ((time() - $last) < 10 * 24 * 60 * 60)
			{
				$utoken = fgets($f);
				fclose($f);
				return $utoken;
			}	
		} else {
			$f = fopen($filename, "w"); 
		}
		//���� utoken �� ����������/�������, �������� �� ������� ����� (��������������)
		$url = "https://api.yotpo.com/oauth/token";
		$postdata = array(
			"client_id" => $this->YOTPO_APP_KEY,
			"client_secret" => $this->YOTPO_SECRET,
			"grant_type" => "client_credentials"
		);
		$response = $this->curl_post($url, $postdata);
		$utoken = json_decode($response)->{'access_token'};
		fwrite($f, strval(time()) . "\n" . $utoken);
		fclose($f);
		return $utoken;
	}

	/**
	* ���������� post-������ � ������� $postdata �� ������ $url
	* $json = true, ���� ������ � ������� json
	*/
	private function curl_post($url, $postdata, $json = false) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ���������� ����� � ���������� ������ ������ � �������
		curl_setopt($ch, CURLOPT_HEADER, 0);  // �� ���������� ���������
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		if (ereg("^https", $url))
		{
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //������ �������� SSL
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}
		if ($json)
		{
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
					'Content-Type: application/json',     
					'accept-encoding: gzip',
					'Content-Length: ' . strlen($postdata)));  //������ ������: json
		}
		$responce = curl_exec($ch);
		curl_close($ch);
		return $responce;	
	}
}