<?php
$rootDirectory = $_SERVER['DOCUMENT_ROOT'];
include_once($rootDirectory . "/php/consts/url.php");
class MyJwt
{
    public static function getToken($username)
    {
        $payload = array(
            "iss" => "miMail",
            "username" => $username,
            "iat" => time(),
            "exp" => time() + 3600
        );
        $jwt = self::encode($payload, SECRET_KEY, 'HS256');
        return $jwt;
    }

    public static function isTokenValid($jwt)
    {
        try {
            $decodedJwt = self::decode($jwt, SECRET_KEY);
            if ($decodedJwt["exp"]<time()) {
                // Token is valid
                return true;
            } else {
                // Token is invalid
                return false;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    private static function decode($token, $key)
    {
        $tokenParts = explode('.', $token);

        if (count($tokenParts) !== 3) {
            throw new Exception("Nepodržan format");
        }

        if (!isset($tokenParts[0]) || !isset($tokenParts[1]) || !isset($tokenParts[2])) {
            throw new Exception("Nepodržan format");
        }

        $header = json_decode(base64_decode($tokenParts[0]), true);
        $payload = json_decode(base64_decode($tokenParts[1]), true);
        $signature = $tokenParts[2];

        if (!isset($header['alg']) || $header['alg'] !== 'HS256') {
            throw new Exception("Nepodržan algoritam");
        }

        $signatureInput = $tokenParts[0] . '.' . $tokenParts[1];
        $expectedSignature = hash_hmac('sha256', $signatureInput, $key, true);

        $decodedSignature = self::base64UrlDecode($signature);
        if (!hash_equals($decodedSignature, $expectedSignature)) {
            throw new Exception("Nepodžan potpis");
        }

        return $payload;
    }

    private static function base64UrlDecode($data)
    {
        $base64 = str_replace(['-', '_'], ['+', '/'], $data);
        $padding = strlen($base64) % 4;

        if ($padding !== 0) {
            $base64 .= str_repeat('=', 4 - $padding);
        }

        return base64_decode($base64);
    }

    private static function encode($payload, $key, $algorithm)
    {
        $header = self::base64UrlEncode(json_encode(['alg' => $algorithm, 'typ' => 'JWT']));
        $payload = self::base64UrlEncode(json_encode($payload));
        $signatureInput = $header . '.' . $payload;
        $signature = hash_hmac('sha256', $signatureInput, $key, true);
        $signature = self::base64UrlEncode($signature);

        return $header . '.' . $payload . '.' . $signature;
    }

    private static function base64UrlEncode($data)
    {
        $base64 = base64_encode($data);
        $base64Url = str_replace(['+', '/', '='], ['-', '_', ''], $base64);
        return $base64Url;
    }
}
