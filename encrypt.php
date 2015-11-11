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

#var_dump($private_key, $public_key);

$public_key = "-----BEGIN PUBLIC KEY-----\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDEChqe80lJLTTkJD3X3Lyd7Fj+\nzuOhDZkjuLNPog3YR20e5JcrdqI9IFzNbACY/GQVhbnbvBqYgyql8DfPCGXpn0+X\nNSxELIUw9Vh32QuhGNr3/TBpechrVeVpFPLwyaYNEk1CawgHCeQqf5uaqiaoBDOT\nqeox88Lc1ld7MsfggQIDAQAB\n-----END PUBLIC KEY-----";
$private_key = "-----BEGIN RSA PRIVATE KEY-----\nMIICdwIBADANBgkqhkiG9w0BAQEFAASCAmEwggJdAgEAAoGBAMQKGp7zSUktNOQk\nPdfcvJ3sWP7O46ENmSO4s0+iDdhHbR7klyt2oj0gXM1sAJj8ZBWFudu8GpiDKqXw\nN88IZemfT5c1LEQshTD1WHfZC6EY2vf9MGl5yGtV5WkU8vDJpg0STUJrCAcJ5Cp/\nm5qqJqgEM5Op6jHzwtzWV3syx+CBAgMBAAECgYEApSzqPzE3d3uqi+tpXB71oY5J\ncfB55PIjLPDrzFX7mlacP6JVKN7dVemVp9OvMTe/UE8LSXRVaFlkLsqXC07FJjhu\nwFXHPdnUf5sanLLdnzt3Mc8vMgUamGJl+er0wdzxM1kPTh0Tmq+DSlu5TlopAHd5\nIqF3DYiORIen3xIwp0ECQQDj6GFaXWzWAu5oUq6j1msTRV3mRZnx8Amxt1ssYM0+\nJLf6QYmpkGFqiQOhHkMgVUwRFqJC8A9EVR1eqabcBXbpAkEA3DQfLVr94vsIWL6+\nVrFcPJW9Xk28CNY6Xnvkin815o2Q0JUHIIIod1eVKCiYDUzZAYAsW0gefJ49sJ4Y\niRJN2QJAKuxeQX2s/NWKfz1rRNIiUnvTBoZ/SvCxcrYcxsvoe9bAi7KCMdxObJkn\nhNXFQLav39wKbV73ESCSqnx7P58L2QJABmhR2+0A5EDvvj1WpokkqPKmfv7+ELfD\nHQq33LvU4q+N3jPn8C85ZDedNHzx57kru1pyb/mKQZANNX10M1DgCQJBAMKn0lEx\nQH2GrkjeWgGVpPZkp0YC+ztNjaUMJmY5g0INUlDgqTWFNftxe8ROvt7JtUvlgtKC\nXdXQrKaEnpebeUQ=\n-----END RSA PRIVATE KEY-----";


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

