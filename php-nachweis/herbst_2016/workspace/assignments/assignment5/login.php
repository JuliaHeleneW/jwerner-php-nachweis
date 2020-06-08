<!DOCTYPE html>
<html>
    <head>
        <title>Quiz Login Screen</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <!--user_1:1234 user_2:abcd-->
        <h1>Login Screen for the quiz</h1>
        <form action="loginProcess.php" method="post">
            Username:<input type="text" required name="username"><br><br>
            Password:<input type="password" required name="password">
            <br><br>
            <input type="submit" value="Login!">
        </form>
        
        <h3>User names</h3>
        <table border="1">
            <tr>
                <th>User name</th>
                <th>password</th>
            </tr>
            <tr>
                <td>user_1</td>
                <td>1234</td>
            </tr>
            <tr>
                <td>user_2</td>
                <td>abcd</td>
            </tr>
        </table>

    </body>
</html>