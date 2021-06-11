<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Client Test</title>
</head>
<body>
<pre>
<?php
    @include('app/Test.php');
    $route = ['/test', Test::class ];

    $myclass = new $route[1];

    print_r($route);
    print_r($myclass);
?>
</pre>
    <script src="js/index.js"></script>
</body>
</html>