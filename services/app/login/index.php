<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body style="background-color:pink">

<div class="container-fluid">
    <h1 style="text-align:center">Login Page</h1>
</div>

<div class="col-md12">
    <form action="/charge/send" type="post">
        <p>Nombre de requettes : <input type="text" name="requete" /></p>
    </form>
</div>
<?php
//$datastore = new DatastoreClient([
//    'projectId' => $projectId
//]);
//
//$key = $datastore->key('visit');
//$entity = $datastore->entity($key, [
//'user_ip' => $user_ip,
//'timestamp' => new DateTime(),
//]);
//$datastore->insert($entity);
//?>

<footer>
    Footer admin
</footer>

</body>
</html>