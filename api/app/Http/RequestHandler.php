<?php


namespace App\Http;


class RequestHandler
{
    /*
     * Hieronder staan zogenaamde properties
     * Je kunt properties vergelijken met variabelen
     * maar dan variabelen die uitsluitend leven in een
     * object. Door private er voor te zetten zijn deze variabelen
     * niet bereikbaar voor de wereld buiten deze class.
     */
    private $routes;
    private $request_type;          // GET, POST, PUT

    /*
     *  http://forum-api-2021.test/{resource}/{id}
     */
    private $resource;
    private $id;
    private $classname = '';
    private $method_name = '';

    /*
     * Onderstaande code wordt uitgevoerd zodra ik met de opdracht new
     * van deze class een object maak in een variabele.
     * We construeren hiermee het object, en op basis van de code
     * in de method vullen we de properties gelijk met waarden
     */
    public function __construct($routes)
    {
        $this->routes = $routes;

        $this->request_type = strtoupper($_SERVER['REQUEST_METHOD']);

        // URL analyseert
        $this->parseURL();
    }

    /*
     * Voordat we echt de requests gaan afhandelen willen we eerst de URL geanalyseerd hebben
     * En de properties (= variabelen in een class) vullen met de gegevens uit de URL
     */
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

    private function getClassName()
    {
        return $this->routes[$this->request_type][$this->resource][0];
    }

    private function getMethodName()
    {
        return $this->routes[$this->request_type][$this->resource][1];
    }

    /*
     * In de onderstaande method bekijken eerst welk type request we ontvangen hebben van de client app
     * Als dat achterhaald is gaan we de juiste code uitvoeren
     */
    public function handleRequest()
    {
        // Kijken wat voor type request is het
        switch($this->request_type) {
            case 'GET':
                // Hier komt de code die een GET-request gaat afhandelen
                $this->handleGetRequest();
                break;

            case 'POST':
                // Hier komt de code die een POST-request gaat afhandelen
                $this->handlePostRequest();
                break;

            case 'PUT':
                // Hier komt de code die een PUT request gaat afhandelen
                $this->handlePutRequest();
                break;

            case 'PATCH':
                // Hier komt de code die een PATCH request gaat afhandelen
                $this->handlePatchRequest();
                break;

            case 'DELETE':
                // Hier komt de code die een DELETE request gaat afhandelen
                $this->handleDeleteRequest();
                break;

            case 'OPTION':
                // Dit is een request die te maken heeft met o.a. CORS
                $this->handleOptionsRequest();
                break;

            default:
                // In alle andere gevallen gaan we hier een standaard actie uitvoeren
                break;

        }
    }

    /*
     * Onderstaande method (= functie in een class) handelt de OPTIONS request af
     * Een browser stuurt een OPTIONS request i.v.m. de CORS beveiliging
     */
    private function handleOptionsRequest()
    {
        HttpResponse::sendCORSHeader();
    }

    private function handleGetRequest()
    {
        $classname = $this->getClassName();
        $method_name = $this->getMethodName();

        $controller = new $classname;       // new ThreadController
        if($this->id !== 0)
            $return_value = $controller->$method_name($this->id);           // ThreadController->index
        else
            $return_value = $controller->$method_name();

        HttpResponse::sendResponse($return_value);
        die();
    }

    /*
     * Handel een POST request af
     * --------------------------
     * Dus in feite voeg een record toe aan een bepaalde tabel in de database
     */
    private function handlePostRequest()
    {
        $classname = $this->getClassName();
        $method_name = $this->getMethodName();

        $request_data = $_POST;             // Data b.v. vanuit een formulier

        $controller = new $classname;       // new ThreadController
        $return_value = $controller->$method_name($request_data);

        HttpResponse::sendResponse($return_value);
        die();
    }

    /*
     *
     */
    private function handlePutRequest()
    {
        $classname = $this->getClassName();
        $method_name = $this->getMethodName();

        parse_str(file_get_contents('php://input'), $request_data);             // Data b.v. vanuit een formulier

        $controller = new $classname;       // new ThreadController
        $return_value = $controller->$method_name($request_data, $this->id);

        HttpResponse::sendResponse($return_value);
        die();
    }

    private function handlePatchRequest()
    {
        $classname = $this->getClassName();
        $method_name = $this->getMethodName();

        parse_str(file_get_contents('php://input'), $request_data);             // Data b.v. vanuit een formulier

        $controller = new $classname;       // new ThreadController
        $return_value = $controller->$method_name($request_data);

        HttpResponse::sendResponse($return_value);
        die();
    }

    private function handleDeleteRequest()
    {
        $classname = $this->getClassName();
        $method_name = $this->getMethodName();

        $controller = new $classname;
        $return_value = $controller->$method_name($this->id);

        HttpResponse::sendResponse($return_value);
        die();
    }
}