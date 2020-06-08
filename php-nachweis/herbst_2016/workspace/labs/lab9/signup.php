<!DOCTYPE html>
<html>
    <head>
        <title>Lab 9: Sign Up Form</title>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
        <script>
            function validateForm()
            {
            $("#firstNameError").html("");
            $("#lastNameError").html("");
            $("#emailError").html("");
            $("#phoneError").html("");
            $("#passwordError").html("");
            $("#repasswordError").html("");
                var isValid=true;
                if($("#firstName").val().trim().length==0)
                {
                    isValid=false;
                    $("#firstNameError").html("First Name must not be blank!");
                }
                if($("#lastName").val().trim().length==0)
                {
                    isValid=false;
                    $("#lastNameError").html("Last Name must not be blank!");
                }
                if((/^[a-z]+@[a-z]+\.[a-z]{3}$/i.test($("#email").val()))==false)
                {
                    isValid=false;
                    $("#emailError").html("Email has the wrong format!");
                }
                if((/^\([0-9]{3}\) [0-9]{3}\-[0-9]{4}$/.test(($("#phone").val())))==false)
                {
                    isValid=false;
                    $("#phoneError").html("Phone number has the wrong format!");
                }
                if((/[0-9]+/.test($("#password").val()))==false)
                {
                    isValid=false;
                    $("#passwordError").html("Password has no digit!");
                }
                if((/[A-Z]+/.test($("#password").val()))==false)
                {
                    isValid=false;
                    $("#passwordError").html("Password has no uppercase letter!");
                }
                if(($("#password").val())!=($("#rePassword").val()))
                {
                    isValid=false;
                    $("#repasswordError").html("Password is not the same!");
                }
                return isValid;
                
            }
            function validateUsername()
            {
            $("#usernameError").html("");
                if($("#username").val().trim().length<6)
                {
                    isValid=false;
                    $("#usernameError").html("Username must be at least 6 characters!");
                    $("#usernameError").css("color","red");
                }
                else
                {
                    $.ajax({
                      type: "get",
                      url: "verifyUsername.php", //PHP Skript wird im AJAX-Call benutzt, um Nutzernamen zu verifizieren
                      dataType: "json",
                      data: { "username": $("#username").val() },
                      success: function(data,status) {
                          if(data==false)
                          {
                              $("#usernameError").html("Username is available");
                               $("#usernameError").css("color","green");
                               isValid=true;
                          }
                          else
                          {
                            $("#usernameError").html("Username is already taken"); 
                            $("#usernameError").css("color","red");
                            isValid=false;
                          }
                   },
                   complete: function(data,status) { //optional, used for debugging purposes
               }
               });
                }
            }
            
            $(document).ready(function(){
                $("#zipcode").change(function()
                { 
                   $.ajax({
                      type: "get",
                      url: "https://cst336-lara4594.c9users.io/api/cityInfoByZip.php",
                      dataType: "json",
                      data: { "zip_code": $("#zipcode").val() },
                      success: function(data,status) {
                      $("#city").html(data.city);
                      $("#latitude").html(data.latitude);
                      $("#longitude").html(data.longitude);
                   },
                   complete: function(data,status) { //optional, used for debugging purposes
               }
               });
               });
               $("#state").change(function()
                { 
                    $("#counties").html("<option>- Select One - </option>"); //resets Counties dropdown menu
                   $.ajax({
                      type: "get",
                        url: "https://cst336-lara4594.c9users.io/api/countiesByState.php",
                        dataType: "json",
                        data: { "state":  $("#state").val() },
                        success: function(data,status) { 
                              
                              for (var i=0; i < data.length; i++ ) {
                                  
                                  $("#counties").append("<option>" + data[i].county + "</option>");
                                  
                              }
                              
                          },
                   complete: function(data,status) { //optional, used for debugging purposes
                }
                });
                });
                $("#username").change(function()
                { 
                   validateUsername();
                });
            });
        </script>
    </head>
    <style>
        .error
        {
            color:red;
        }
        body
        {
            text-align:center;
            background-color:#1cc3db;
            font-family:Verdana;
            color:#184e56;
        }
    </style>
    <body>
    <h2>Sign Up for an account!</h2>
    <form onsubmit="return validateForm()">
        <fieldset>
        <legend>Sign Up</legend>
        First name: <input type="text" id="firstName" name="firstName">
        <span id="firstNameError" class="error"></span><br>
        Last name: <input type="text" id="lastName" name="lastName">
        <span id="lastNameError" class="error"></span><br>
        Email:<input type="text" name="email" id="email">
        <span id="emailError" class="error"></span><br>
        Phone Number: <input type="text" name="phone" id="phone">
        <span id="phoneError" class="error"></span><br>
        Zip Code: <input type="text" name="zipcode" id="zipcode"><br>
        City: <span id="city"></span><br>
        Latitude: <span id="latitude"></span><br>
        Longitude: <span id="longitude"></span><br>
        State:<input type="text" name="state" id="state"><br>
        County:<select id="counties"></select><br><br>
        
        Username: <input type="text" id="username" name="username" onchange="validateUsername()">
        <span id="usernameError" class="error"></span><br>
        Password: <input type="password" name="password" id="password">
        <span id="passwordError" class="error"></span><br>
        Type Password Again: <br><input type="password" name="rePassword" id="rePassword">
        <span id="repasswordError" class="error"></span><br>
        <input type="submit" value="Submit">
        </fieldset>
    </form>
    </body>
</html>