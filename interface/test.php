<?php
include_once './common.php';
include_once './RSAHelper.php';


testRSAHelper();


function testRSAHelper() {
	$pubKey = file_get_contents(dirname(__FILE__).'/rsa_public_key.pem');
	$privKey = null;
	$cipher1 = new RSAHelper();
	$cipher1->initKey($privKey, $pubKey, 2048);

	$plaintext = "这是一段稍微有点长的文字;这是一段稍微有点长的文字;这是一段稍微有点长的文字;这是一段稍微有点长的文字;这是一段稍微有点长的文字;这是一段稍微有点长的文字;这是一段稍微有点长的文字;";

	$encryptedBase64Str = $cipher1->encrypt($plaintext);
	echo "encrypted: " . $encryptedBase64Str . "<br/>";


	$privKey = file_get_contents(dirname(__FILE__).'/rsa_private_key.pem');
	$pubKey = null;
	$cipher2 = new RSAHelper();
	$cipher2->initKey($privKey, $pubKey, 2048);


	$decryptedResult = $cipher2->decrypt($encryptedBase64Str);
	printf("decrypted: " . $decryptedResult . "\n");
}


function testRSA() {
	$testWord1 = "这是一段稍微";
	$testWord2 = "有点长的文字";
	$pu_key_str = file_get_contents(dirname(__FILE__).'/rsa_public_key.pem');
	$pu_key = openssl_pkey_get_public($pu_key_str);
	$encryptedText1 = null;
	openssl_public_encrypt($testWord1,$encryptedText1,$pu_key);
	$encryptedText1 = base64_encode($encryptedText1);
	echo "encryptedText1:".$encryptedText1;

	$encryptedText2 = null;
	openssl_public_encrypt($testWord2,$encryptedText2,$pu_key);
	// $tmp = $tmp.$encryptedText;
	echo "<Br/>";
	echo "encryptedText2:".base64_encode($encryptedText2);

	$tmp = base64_decode($encryptedText1.$encryptedText2);
	echo "<br/>";
	echo $tmp;
	$pri_key_str = file_get_contents(dirname(__FILE__).'/rsa_private_key.pem');
	$pri_key = openssl_pkey_get_private($pri_key_str);
	$decryptedText = null;
	openssl_private_decrypt($tmp, $decryptedText, $pri_key);
	echo "<br/>";

	echo "decryptedText:".$decryptedText;

}


?>