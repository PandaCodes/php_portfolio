<?


// Send POST-request with attachment and hidden 'is_file'=true value   to this file
if ($_POST['is_file']) {
    echo "file";
	$file = $_FILES['attachment'];
	$error = true;
	if (!empty($file)){
		$error = $file['error'];
	}
	if (!$error) {
		// tmp dir?
		$temp_file =  dirname($file['tmp_name']) . "\\" . md5(time());
		$error = !move_uploaded_file($file['tmp_name'], $temp_file);
	}
	if ($error) {
		$temp_file = '';
	}	
	echo ($temp_file);
    die();
} elseif ($_POST['phone_number'] || $_POST['email']) {
    // carriage return type (we use a PHP end of line constant)
    $eol = PHP_EOL;
    
    $mailto = "tenereltenor@gmail.com";
    $message = $_POST['message'] . $eol . 
            "phone: " . $_POST['phone_number'] . $eol . 
            "email: " . $_POST['email'];	
  
    // a random hash will be necessary to send mixed content
    $separator = md5(time());
      
    // main header (multipart mandatory)
    $headers = "From: <{$_POST['email']}>" . $eol;
    $headers .= "MIME-Version: 1.0" . $eol;
    $headers .= "X-Mailer: PHP" . $eol;
    $headers .= "Reply-To: <{$_POST['email']}>" . $eol;
    $headers .= "Content-Type: multipart/mixed; boundary=\"" . $separator . "\"" . $eol . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol;
    $headers .= "This is a MIME encoded message." . $eol;

    // message
    $headers .= "--" . $separator . $eol;
    $headers .= "Content-Type: text/plain; charset=\"iso-8859-1\"" . $eol;
    $headers .= "Content-Transfer-Encoding: 7bit" . $eol . $eol;
    $headers .= $message . $eol . $eol;
    $file = $_POST['temp_file_name'];
    if (!empty($file)) {
        $filename = $_POST['file_name'];
        $file_size = filesize($file);
        $handle = fopen($file, "r");
        $content = fread($handle, $file_size);
        fclose($handle);
        unlink($file);
        $content = chunk_split(base64_encode($content));

        // attachment
        $headers .= "--" . $separator . $eol;
        $headers .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"" . $eol;
        $headers .= "Content-Transfer-Encoding: base64" . $eol;
        $headers .= "Content-Disposition: attachment; filename=\"" . $filename . "\"" . $eol . $eol;
        $headers .= $content . $eol . $eol;
    }
    $headers .= "--" . $separator . "--";
    //SEND Mail
    echo mail($mailto, "niceguyz request", "", $headers);
    die();
}
