<!--Skript zum Hochladen von Bildern-->
<?php

    //Bild wird bei Button-Klick hochgeladen
    if(isset($_POST['submitForm']))
    {
        $isvalid=true;
        //Größe und Typ werden gefunden
        $size=$_FILES["myfile"]["size"];
        $type=$_FILES["myfile"]["type"];

        //wenn Größe oder Typ falsch sind, wird Fehlermeldung angezeigt
        if($size>1048576)
        {
            $isValid=false;
            echo "<span>Image is too big.</span><br>";
        }
        if($type!="image/jpeg"&&$type!="image/png")
        {
            $isValid=false;
            echo "<span>Image has the wrong type.</span><br>";
        }

        //Größe und Typ werden dem Nutzer angezeigt
        echo "file size: ".$size."<br>";
        echo "file type: " . $type."<br>";

        //wenn das Bild gültig ist, wird es in den gallery Ordner hochgeladen
        if($isValid==true&&!($size>1048576)&&!($type!="image/jpeg"&&$type!="image/png"))
        {
            move_uploaded_file($_FILES["myfile"]["tmp_name"],"gallery/". $_FILES["myfile"]["name"]);
            echo "Image uploaded:<br>";
            echo "<img src='gallery/".$_FILES["myfile"]["name"]."' width='250' height='200'>";
        }
    }
     
    //Funktion, um alle hochgeladenen Bilder anzuzeigen
    function displayImage()
    {
        static $id=0;
        $dir="gallery/";
        $images=glob($dir."*.*");
        //modales Display aller Bilder
        foreach($images as $image)
        {
            
                echo "<button type='button' class='img-thumbnail'  data-toggle='modal' data-target='#myModal".$id."' data-whatever='".$image."'><img src='".$image."' class='thumbmg'></button>

                <!-- Modal -->
                <div class='modal fade' id='myModal".$id."' role='dialog'>
                <div class='modal-dialog'>
                
                    <!-- Modal content-->
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                    </div>
                    <div class='modal-body'>
                        <img src='".$image."' class='img'>
                    </div>
                    <div class='modal-footer'>
                        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
                    </div>
                    </div>
                    
                </div>
                </div>";
                $id++;
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 10: Image upload</title>
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <style>
    span
{
    color:red;
    font-family:Verdana;
    font-size:15px;
}
body
{
    padding:10px;
    background-color:#e7a4f9;
    color:#560231;
    font-family:Helvetica;
    font-size:20px;
}
.img-thumbnail
{
    width:130px;
    height:110px;
    float:left;
    margin:10px;
}
.thumbmg
{
    width:120px;
    height:100px;
}
.img
{
    width:400px;
    height:300px;
}
    </style>
    <body>
        <h1>File Upload</h1>
    <form method="post" enctype="multipart/form-data">
        Select file:<br>
        <input type="file" name="myfile" ><br><br>
        <input type="submit" value="Upload!" name="submitForm">
    </form>
    <div>
        <?=displayImage()?>
         </div>
    </body>
</html>