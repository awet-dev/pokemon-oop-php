<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="index.php" method="POST">
        <input type="text" name="pokemon" placeholder="Enter Name Or Id">
        <input type="submit" value="Search">
    </form>
    <p><?php  echo (isset($name))? "Pokemon Name: ".ucfirst($name): ""?></p>
    <p><?php echo (isset($id))? "Pokemon Id: ".ucfirst($id): ""?></p>
    <img src="<?php echo (isset($imgSrc))? $imgSrc: ""?>" alt="">
    <p><?php echo (isset($moves))? "Pokemon Moves: ".$moves: ""?></p>
    <p><?php echo (isset($flavorText))? "Pokemon flavor text: ".$flavorText: ""?></p>
    <p><?php echo (isset($flavorLanguage))? "flavor language: ".$flavorLanguage: ""?></p>
<div class="flex">
    <?php if (isset($evolutionImg)) :?>
        <?php foreach ($evolutionImg as $imgSrc):?>
            <img src="<?php echo (isset($imgSrc))? $imgSrc: ""?>" alt="">
        <?php endforeach;?>
    <?php endif;?>
</div>

</body>
</html>