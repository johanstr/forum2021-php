<?php
@include('vendor/autoload.php');

// We halen alle routes binnen in een variabele
$routes = @include('app/Routes/routes.php');

// We maken nu een object aan van de class RequestHandler zodat we de functionaliteit
// in deze class ook kunnen gaan gebruiken
$requestHandler = new App\Http\RequestHandler($routes);

// We maken nu gebruik van de method handleRequest in de class RequestHandler
// We doen dit om onze API nu ook echt op te starten en het juiste werk te laten
// doen.
$requestHandler->handleRequest();
