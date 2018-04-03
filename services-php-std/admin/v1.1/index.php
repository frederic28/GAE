<?php
    if (isset ($_GET['v']) && $_GET['v'] === "1_0") {
        setcookie("GOOGAPPUID", '300',  time()+3600, '/' );
    } elseif (isset ($_GET['v']) && $_GET['v'] === "1_1") {
        setcookie("GOOGAPPUID", '600',  time()+3600, '/' );
    } elseif (isset ($_GET['v']) && $_GET['v'] === "1_2") {
        setcookie("GOOGAPPUID", '900',  time()+3600, '/' );
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Service</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="#">Barre de navigation</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Page d'accueil <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">non actif</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="/admin/" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Menu</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="/admin/index.php?v=1_0">V 1_0</a>
                    <a class="dropdown-item" href="/admin/index.php?v=1_1">V 1_1</a>
                    <a class="dropdown-item" href="/admin/index.php?v=1_2">V 1_2</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="text" placeholder="non opérationel" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Chercher</button>
        </form>
    </div>
</nav>

<main role="main" class="container">

    <div class="starter-template">
        <h1>Tableau de bord</h1>
        <p class="lead">Divers informations sur les services performances, état ...</p>
    </div>

    <div class="py-5 bg-light">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-head">Test API POST /charge/send</div>
                        <div class="card-body">
                            <form action="/charge/send" method="post">
                                <label>Nombre de requettes : </label>
                                <input name="nbr_requests" type="number" required>
                                <button type="submit" class="btn btn-sm btn-outline-secondary">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-head">Run API POST /charge/send</div>
                        <div id="id_chart_div" ></div>
                        <div class="card-body">
                            <label>Nombre de version : </label><input id="nbr_version" type="number" required>
                            <label>Nombre de requettes : </label><input id="nbr_req" type="number" required>
                            <label>Nombre de paquets : </label><input id="nbr_paq" type="number" required>
                            <button onclick="Charge.api_send(document.getElementById('nbr_version').value, document.getElementById('nbr_req').value, document.getElementById('nbr_paq').value);" class="btn btn-sm btn-outline-secondary">Send</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <div class="card-body">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</main><!-- /.container -->
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="js/charge.js" </script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js" integrity="sha384-feJI7QwhOS+hwpX2zkaeJQjeiwlhOP+SdQDqhgvvo1DsjtiSQByFdThsxO669S2D" crossorigin="anonymous"></script>
</body>
</html>