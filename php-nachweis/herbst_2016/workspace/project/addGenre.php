<!DOCTYPE html>
<html>
    <head>
        <title>Add Genre</title>
        <link rel="stylesheet" href="css/style.css">
        <script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
        <script>
        var isValid=true;
        function addGenre()
        {
            $.ajax({
                      type: "get",
                      url: "getData.php?name="+$('#name').val(),//AJAX Call zu getData.php, um Genre hinzuzufügen
                      dataType: "json",
                      data: {
                          name : $('#name').val(),
                      },
                      success: function(data,status) {
                          $("#album").html("Genre was added!");
                   },
                   complete: function(data,status) { //optional, used for debugging purposes
                   alert("Genre was added!");
                   $(location).attr('href', 'adminScreen.php');
               }
               });
               return isValid;
        }
            
        </script>
    </head>
    <body>
        <form action="adminScreen.php">
            <input type="submit" value="Admin Page">
        </form>
        <span id="album"></span>
        <h1>Add a new Genre</h1>
        <form method="get">
            Genre name: <input type="text" name="name" id="name"><br>
            <input type="button" value="Submit" onclick="return addGenre()">
        </form>
    </body>
</html>

