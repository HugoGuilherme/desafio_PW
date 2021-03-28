<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem Vindo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<?php

function _group_by($array, $key) {
    $return = array();
    foreach($array as $val) {
        $return[$val->$key][] = $val;
    }
    return $return;
}

$url = "https://thiago.app/api/posts.php";
 
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$produtos = json_decode(curl_exec($ch));
$produtosPorCategorias = _group_by($produtos, 'category');

?>
<body>
    <?php
        foreach($produtosPorCategorias as $key => $value){
            ?>
            <br>
            <?php
                print_r($key);
            ?>
            <section class="container">
        <div class="bg-dark p-5 my-5">
            <div id="carouselExampleIndicators_<?= $key ?>" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators pt-5">
                    <?php 
                        $totalIndicadores = count($value) / 3;                        
                        for($i=0; $i < $totalIndicadores; $i++){
                    ?>
                    <li data-target="#carouselExampleIndicators_<?= $key ?>" data-slide-to="<?= $i ?>" class="<?php if($i == 0) { echo ' active'; }?>"></li>
                  <?php } ?>
                </ol>
                <div class="carousel-inner">
                    <?php                        
                        for($i=0; $i < count($value);){ ?>
                            <div class="carousel-item <?php if($i == 0) { echo ' active'; }?>">
                                <div class="row">
                                    <?php for($j=0; $j < 3  && $i < count($value); $j++){ ?>
                                        <div class="col-md-4 my-5">
                                        <div class="card" style="width: 18rem">
                                            <img src="<?= $value[$i]->imagem ?>"
                                                class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <p class="card-text"><?= $value[$i]->body ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php $i++; } ?>
                                </div>
                            </div>
                        
                        <?php 
                        } 
                        ?>

                </div>   
                  <a class="carousel-control-prev" href="#carouselExampleIndicators_<?= $key ?>" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators_<?= $key ?>" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>             
            </div>     
        </div>
    </section>
    <?php
        }

    ?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
</body>
</html>