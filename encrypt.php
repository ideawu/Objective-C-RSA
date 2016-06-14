<?php
$config = array(
		"digest_alg" => "sha512",
		"private_key_bits" => 1024,
		"private_key_type" => OPENSSL_KEYTYPE_RSA,
		);
$res = openssl_pkey_new($config);
$private_key = '';
openssl_pkey_export($res, $private_key);
$details = openssl_pkey_get_details($res);
$public_key = $details["key"];

echo "=====================\n";
echo "create private key and public key:\n";
echo "# PRIVATE:\n";
echo str_replace("\n", "\\n", $private_key) . "\n";
echo "# PUBLIC:\n";
echo str_replace("\n", "\\n", $public_key) . "\n";
#var_dump($private_key, $public_key);
echo "=====================\n";
echo "\n\n\n";

$public_key = "-----BEGIN PUBLIC KEY-----\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDDI2bvVLVYrb4B0raZgFP60VXY\ncvRmk9q56QiTmEm9HXlSPq1zyhyPQHGti5FokYJMzNcKm0bwL1q6ioJuD4EFI56D\na+70XdRz1CjQPQE3yXrXXVvOsmq9LsdxTFWsVBTehdCmrapKZVVx6PKl7myh0cfX\nQmyveT/eqyZK1gYjvQIDAQAB\n-----END PUBLIC KEY-----";
$private_key = "-----BEGIN PRIVATE KEY-----\nMIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMMjZu9UtVitvgHS\ntpmAU/rRVdhy9GaT2rnpCJOYSb0deVI+rXPKHI9Aca2LkWiRgkzM1wqbRvAvWrqK\ngm4PgQUjnoNr7vRd1HPUKNA9ATfJetddW86yar0ux3FMVaxUFN6F0KatqkplVXHo\n8qXubKHRx9dCbK95P96rJkrWBiO9AgMBAAECgYBO1UKEdYg9pxMX0XSLVtiWf3Na\n2jX6Ksk2Sfp5BhDkIcAdhcy09nXLOZGzNqsrv30QYcCOPGTQK5FPwx0mMYVBRAdo\nOLYp7NzxW/File//169O3ZFpkZ7MF0I2oQcNGTpMCUpaY6xMmxqN22INgi8SHp3w\nVU+2bRMLDXEc/MOmAQJBAP+Sv6JdkrY+7WGuQN5O5PjsB15lOGcr4vcfz4vAQ/uy\nEGYZh6IO2Eu0lW6sw2x6uRg0c6hMiFEJcO89qlH/B10CQQDDdtGrzXWVG457vA27\nkpduDpM6BQWTX6wYV9zRlcYYMFHwAQkE0BTvIYde2il6DKGyzokgI6zQyhgtRJ1x\nL6fhAkB9NvvW4/uWeLw7CHHVuVersZBmqjb5LWJU62v3L2rfbT1lmIqAVr+YT9CK\n2fAhPPtkpYYo5d4/vd1sCY1iAQ4tAkEAm2yPrJzjMn2G/ry57rzRzKGqUChOFrGs\nlm7HF6CQtAs4HC+2jC0peDyg97th37rLmPLB9txnPl50ewpkZuwOAQJBAM/eJnFw\nF5QAcL4CYDbfBKocx82VX/pFXng50T7FODiWbbL4UnxICE0UBFInNNiWJxNEb6jL\n5xd0pcy9O2DOeso=\n-----END PRIVATE KEY-----";


$data = 'hello world';
$data = str_repeat($data, 20);

$crypted = '';
for($i=0; $i<strlen($data); $i+=117){
	$src = substr($data, $i, 117);
	$ret = openssl_public_encrypt($src, $out, $public_key);
	$crypted .= $out;
}
echo "# enc by public:\n" . base64_encode($crypted) . "\n";

$out_plain = '';
for($i=0; $i<strlen($crypted); $i+=128){
	$src = substr($crypted, $i, 128);
	$ret = openssl_private_decrypt($src, $out, $private_key);
	$out_plain .= $out;
}
echo "#dec by private:\n" . $out_plain. "\n";
echo "==========\n\n";

$crypted = '';
for($i=0; $i<strlen($data); $i+=117){
	$src = substr($data, $i, 117);
	$ret = openssl_private_encrypt($src, $out, $private_key);
	$crypted .= $out;
}
echo "#enc by private:\n" . base64_encode($crypted) . "\n";
$out_plain = '';
for($i=0; $i<strlen($crypted); $i+=128){
	$src = substr($crypted, $i, 128);
	$ret = openssl_public_decrypt($src, $out, $public_key);
	$out_plain .= $out;
}
echo "#dec by public:\n" . $out_plain. "\n";
echo "==========\n\n";

$enc_pub = "";
$enc_pub = "Cd2u145czWA/1tY/Lmvo7cZDfO4yjxlfN++LQfasHLsEV2LNrdjX+GK6A//D5wrkP67KA4LtJmzmUCCoGqV9e5Mwz3vc4eblYkz/LdoGpIuj6Lid931ylloeulqHOVzJaGCefZ28kGl4mHndavdQUr8LPz0aowF6PC8rZFIFsx8TZQxFBDDddQ2n1zEzOjxfkDX2L05REoW4pGM4rFhpMHloaDKOgVkU26jEEawAksJnZ31w+O1oNq1/02l1kxZjQsAx5YZRvilzQ4gOgOIvoXxntwOyEk3EEJNl20FlX7I34i+GT7Dqyw0llo29thqfTPE8sujDPMpCHTATkQGBsg==";
$crypted = base64_decode($enc_pub);
$out_plain = '';
for($i=0; $i<strlen($crypted); $i+=128){
	$src = substr($crypted, $i, 128);
	$ret = openssl_private_decrypt($src, $out, $private_key);
	$out_plain .= $out;
}
echo "dec by private:\n" . $out_plain . "\n";


$enc_priv = "";
$enc_priv = "";
$crypted = base64_decode($enc_priv);
$out_plain = '';
for($i=0; $i<strlen($crypted); $i+=128){
	$src = substr($crypted, $i, 128);
	$ret = openssl_public_decrypt($src, $out, $public_key);
	$out_plain .= $out;
}
echo "#dec by public:\n" . $out_plain. "\n";

