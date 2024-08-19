<?php

function encrypt($value)
{
    try {
        $enc = \Config\Services::encrypter();
        return bin2hex($enc->encrypt($value));
    } catch (\Throwable $th) {
        return false;
    }
    
    
}

function decrypt($value) 
{
    try {
        $enc = \Config\Services::encrypter();
        return $enc->decrypt(hex2bin($value));
    } catch (\Throwable $th) {
        return false;
    }
    
    
}