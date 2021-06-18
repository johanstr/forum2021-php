<?php


namespace App\Http;


class HttpResponse
{
    // Properties
    // NON CODE
    public const HTTP_NO_STATUS = 0;
    // SUCCESS CODES
    public const HTTP_STATUS_OK = 200;
    public const HTTP_STATUS_CREATED = 201;
    public const HTTP_STATUS_NO_CONTENT = 204;
    // NOT OFFICIAL SUCCESS CODES
    public const HTTP_STATUS_UPDATED = 210;
    public const HTTP_STATUS_DELETED = 211;

    // ERROR CODES
    public const HTTP_STATUS_BAD_REQUEST = 400;
    public const HTTP_STATUS_UNAUTHORIZED = 401;
    public const HTTP_STATUS_FORBIDDEN = 403;
    public const HTTP_STATUS_NOT_FOUND = 404;
    public const HTTP_STATUS_METHOD_NOT_ALLOWED = 405;

    // SERVER ERROR CODES
    public const HTTP_STATUS_SERVER_ERROR = 500;
    public const HTTP_STATUS_NOT_IMPLEMENTED = 501;
    public const HTTP_STATUS_SERVICE_NOT_AVAIL = 503;

    // Methods

    /*
     * Send default CORS header to client
     */
    public static function sendCORSHeader($stop_execution = true)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: token, Content-Type, Accept, Access-Control-Allow-Origin');
            header('Access-Control-Max-Age: 1728000');
            header('Content-Length: 0');
            header('Content-Type: text/plain');

            if($stop_execution)
                die();
        }
    }

    /*
     * Default header deel
     *      Access-Control-Allow-Origin: *
     *      Content-Type: application/json
     *      HTTP/1.1 code msg
     */
    public static function sendDefaultHeaders($code = self::HTTP_STATUS_OK, $msg = 'Ok')
    {
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header("HTTP/1.1 $code $msg");
    }

    public static function prepareResponse($data, $code = self::HTTP_NO_STATUS, $msg = '')
    {
        $response = [
            'api_version' => '1.0.0',
            'api_name' => 'forum_api',
            'count' => count($data)
        ];

        if($code !== 0)
            $response['status'] = $code;

        if(!empty($msg))
            $response['status_message'] = $msg;

        $response['data'] = $data;

        return json_encode($response);
    }

    public static function sendResponse($data, $code = self::HTTP_STATUS_OK, $msg = 'Ok')
    {
        self::sendDefaultHeaders($code, $msg);
        echo self::prepareResponse($data, $code, $msg);
    }
}
