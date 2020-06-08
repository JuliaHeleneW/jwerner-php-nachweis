<?php
//Funktion, um den Pfad für ein zufälliges Bild aus einem vordefinierten Array zu bekommen
function getImage(){
    $images=array("img/coffee.jpg","img/ferriswheel.jpg","img/mountain.jpg","img/roses.jpg","img/space.jpg");
    $randomImageIndex=rand(0,4);
    $randomImage=$images[$randomImageIndex];
    echo $randomImage;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
        <!--zufälliges Bild wird als Hintergrund festgelegt-->
        <style>body{background-image:url(<?=getImage()?>)}</style>
    </head>
    <body>
        
    </body>
</html>