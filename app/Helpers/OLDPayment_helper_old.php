<?php
namespace App\Helpers;

error_reporting(0);
function encryptOld($plainText, $key)
{
    $secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
    $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
    $plainPad = pkcs5_pad($plainText, $blockSize);
    if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) {
        $encryptedText = mcrypt_generic($openMode, $plainPad);
        mcrypt_generic_deinit($openMode);

    }
    return bin2hex($encryptedText);
}

function decryptOld($encryptedText, $key)
{
    $secretKey = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText = hextobin($encryptedText);
    $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
    mcrypt_generic_init($openMode, $secretKey, $initVector);
    $decryptedText = mdecrypt_generic($openMode, $encryptedText);
    $decryptedText = rtrim($decryptedText, "\0");
    mcrypt_generic_deinit($openMode);
    return $decryptedText;

}
//*********** Padding Function *********************

function pkcs5_pad($plainText, $blockSize)
{
    $pad = $blockSize - (strlen($plainText) % $blockSize);
    return $plainText . str_repeat(chr($pad), $pad);
}

function encrypt($plainText, $key)
{
    $key = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $openMode = openssl_encrypt($plainText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    $encryptedText = hextobin($openMode);
    return $encryptedText;
}

function decrypt($encryptedText, $key)
{
    $key = hextobin(md5($key));
    $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
    $encryptedText = hextobin($encryptedText);
    $decryptedText = openssl_decrypt($encryptedText, 'AES-128-CBC', $key, OPENSSL_RAW_DATA, $initVector);
    return $decryptedText;

}

//********** Hexadecimal to Binary function for php 4.0 version ********

function hextobin($hexString)
{
    $length = strlen($hexString);
    $binString = "";
    $count = 0;
    while ($count < $length) {
        $subString = substr($hexString, $count, 2);
        $packedString = pack("H*", $subString);
        if ($count == 0) {
            $binString = $packedString;
        } else {
            $binString .= $packedString;
        }

        $count += 2;
    }
    return $binString;
}
