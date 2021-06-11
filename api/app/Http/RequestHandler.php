<?php


namespace App\Http;


class RequestHandler
{
    private $routes;
    private $request_type;          // GET, POST, PUT

    /*
     *  http://forum-api-2021.test/{resource}/{id}
     */
    private $resource;
    private $id;

    public function __construct($routes)
    {
        $this->routes = $routes;

        $this->request_type = strtoupper($_SERVER['REQUEST_METHOD']);

        // URL analyseert
        $this->parseURL();
    }

    private function parseURL()
    {
        if(isset($_GET['resource'])) {
            $this->resource = strtolower($_GET['resource']);

            if(isset($_GET['id'])) {
                $this->id = intval($_GET['id']);
            }
        } else {
            $this->resource = '/';
        }
    }

    public function handleRequest()
    {
        // Kijken wat voor type request is het
        switch($this->request_type) {
            case 'GET':
                //
                break;

            case 'POST':
                //
                break;

            case 'PUT':
                //
                break;

            case 'PATCH':
                //
                break;

            case 'DELETE':
                //
                break;

            case 'OPTION':
                $this->handleOptionsRequest();
                break;

            default:
                //
                break;

        }
    }

    private function handleOptionsRequest()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
            header('Access-Control-Allow-Headers: token, Content-Type, Accept, Access-Control-Allow-Origin');
            header('Access-Control-Max-Age: 1728000');
            header('Content-Length: 0');
            header('Content-Type: text/plain');
            die();
        }
    }
}