<?php
/**
 * Created by PhpStorm.
 * User: sangechen
 * Date: 14-4-25
 * Time: 上午11:26
 */

require_once dirname(__FILE__).'/RSAHelper.php';

$privKey = file_get_contents(dirname(__FILE__).'/../key/rsa_2048.key');
$pubKey = file_get_contents(dirname(__FILE__).'/../key/rsa_2048_pub.key');
$plaintext = "Hello,RSA!";


printf("=====> init <=====\n");
$cipher = new RSAHelper();
$cipher->initKey($privKey, $pubKey, 2048);
//System.exit(0);

//测试签名 和 验签
printf("=====> sign & verify <=====\n");

$signBase64Str = $cipher->sign($plaintext);
printf("sign: " . $signBase64Str . "\n");

$isValid = $cipher->verify($plaintext, $signBase64Str);
printf("isValid: ". $isValid . "\n");

//测试加密 和 解密
printf("=====> encrypt & decrypt <=====\n");

$encryptedBase64Str = $cipher->encrypt($plaintext);
printf("encrypted: " . $encryptedBase64Str . "\n");

$decryptedResult = $cipher->decrypt($encryptedBase64Str);
printf("decrypted: " . $decryptedResult . "\n");



//测试加密 和 解密
printf("=====> encrypt & decrypt <=====\n");

$str = $plaintext;
while (strlen($str) < 1000)
{
	$str .= $plaintext;
}

$encryptedBase64Str = $cipher->encrypt($str);
printf("encrypted: " . $encryptedBase64Str . "\n");

$decryptedResult = $cipher->decrypt($encryptedBase64Str);
printf("decrypted: " . $decryptedResult . "\n");

