<?php

//Example RSA SHA1 Hashing in PHP
function rsa_sha1_sign($policy, $private_key_filename) {
    $signature = "";

    // load the private key
    $fp = fopen($private_key_filename, "r");
    $priv_key = fread($fp, 8192);
    fclose($fp);
    $pkeyid = openssl_get_privatekey($priv_key);

    // compute signature
    openssl_sign($policy, $signature, $pkeyid);

    // free the key from memory
    openssl_free_key($pkeyid);

    return $signature;
 }

function url_safe_base64_encode($value) {
    $encoded = base64_encode($value);
    // replace unsafe characters +, = and / with 
    // the safe characters -, _ and ~
    return str_replace(
        array('+', '=', '/'),
        array('-', '_', '~'),
        $encoded);
 }
//Example Canned Signing Function in PHP
 function get_canned_policy_stream_name($video_path, $private_key_filename, $key_pair_id, $expires) {
    // this policy is well known by CloudFront, but you still need to sign it, 
    // since it contains your parameters
    $canned_policy = '{"Statement":[{"Resource":"' . $video_path . '","Condition":{"DateLessThan":{"AWS:EpochTime":'. $expires . '}}}]}';
    
    // sign the canned policy
    $signature = rsa_sha1_sign($canned_policy, $private_key_filename);
    // make the signature safe to be included in a url
    $encoded_signature = url_safe_base64_encode($signature);

    // combine the above into a stream name
    $stream_name = create_stream_name($video_path, null, $encoded_signature, $key_pair_id, $expires);
    // url-encode the query string characters to work around a flash player bug
    return encode_query_params($stream_name);
    }

//Example Custom Signing Function in PHP
    function get_custom_policy_stream_name($video_path, $private_key_filename, $key_pair_id, $policy) {
        // sign the policy
        $signature = rsa_sha1_sign($policy, $private_key_filename);
        // make the signature safe to be included in a url
        $encoded_signature = url_safe_base64_encode($signature);
    
        // combine the above into a stream name
        $stream_name = create_stream_name($video_path, $encoded_policy, $encoded_signature, $key_pair_id, null);
        // url-encode the query string characters to work around a flash player bug
        return encode_query_params($stream_name);
        }