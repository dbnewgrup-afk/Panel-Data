<?php
/**
 * Curl.php
 * Wrapper CURL sederhana untuk request outbound (Tokoku)
 */

class Curl
{
    public static function request($url, $method = 'GET', $headers = [], $body = null, $timeout = 30)
    {
        $ch = curl_init();

        $opts = [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => strtoupper($method),
            CURLOPT_TIMEOUT        => $timeout,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HTTPHEADER     => $headers
        ];

        if ($body !== null) {
            // Jika array → form-urlencoded
            if (is_array($body)) {
                $opts[CURLOPT_POSTFIELDS] = http_build_query($body);
            } else {
                $opts[CURLOPT_POSTFIELDS] = $body;
            }
        }

        curl_setopt_array($ch, $opts);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        $info     = curl_getinfo($ch);

        curl_close($ch);

        return [
            'status'  => $info['http_code'] ?? 0,
            'body'    => $response,
            'error'   => $error,
            'info'    => $info
        ];
    }
}
