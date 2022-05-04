<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    define("PAGES_PATH", __DIR__."/_core/pages/");

    function showPage($page){

        global $CONFIG;

        $fp = isset($CONFIG['directories'][$page]) ? PAGES_PATH."{$CONFIG['directories'][$page]}" : PAGES_PATH."{$CONFIG['directories']['404']}";

        include $fp;
    }

    include_once __DIR__."/_core/inc/functions.php";

    $p = isset($_GET['p']) ? $_GET['p'] : "home";
    if($p == 'logof'){
        $_SESSION['logado'] = false;
        header("Location: index.php?p=login");
        exit;
    }
    if($p != 'login'){
        include_once __DIR__."/_core/inc/checaLogado.php";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css" /> -->
    <link rel="shortcut icon" href="favicon.png" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

    <link rel="stylesheet" href="style.css">

      <!-- Latest compiled and minified CSS -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <title><?= $CONFIG['title'] ?></title>
    
</head>
<body>
    <?php
        if(!($p=='login')) include __DIR__."/_core/inc/header.php";

        showPage($p);

    ?>
</body>
</html>