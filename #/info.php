<?php 
function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'This is my secret key1';
    $secret_iv = 'This is my secret iv1';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'e' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'd' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}
$plain_txt = "26";
echo "Plain Text =" .$plain_txt. "\n";
$encrypted_txt = encrypt_decrypt('e', $plain_txt);
echo "Encrypted Text = " .$encrypted_txt. "\n";
$decrypted_txt = encrypt_decrypt('d', $encrypted_txt);
echo "Decrypted Text =" .$decrypted_txt. "\n";
if ( $plain_txt === $decrypted_txt ) echo "SUCCESS";
else echo "FAILED";
echo "\n";
phpinfo();