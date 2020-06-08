<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Online Quiz</title>
        <script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
        <script>
        var isValid=true;
        function calcScore()
        {
            var score=0;
            if($("#q1").val()=="Greenwich"||$("#q1").val()=="greenwich")
                 {
                     score++;
                     $("#spanq1").html("Answer correct.");
                     $("#spanq1").css("color","green");
                 }
            else
            {
                     $("#spanq1").html("Answer incorrect.");
                     $("#spanq1").css("color","red");
            }
            if($('input:radio[name=q2]:checked').val() == 'true')
            {
                     score++;
                     $("#spanq2").html("Answer correct.");
                     $("#spanq2").css("color","green");
            }
            else
            {
                     $("#spanq2").html("Answer incorrect.");
                     $("#spanq2").css("color","red");
            }
            if($("#q3").val()=="false")
            {
                     score++;
                     $("#spanq3").html("Answer correct.");
                     $("#spanq3").css("color","green");
            }
            else
            {
                      $("#spanq3").html("Answer incorrect.");
                       $("#spanq3").css("color","red");
            }
            if($("#q4").val()==118)
            {
                     score++;
                    $("#spanq4").html("Answer correct.");
                     $("#spanq4").css("color","green");
            }
            else
            {
                     $("#spanq4").html("Answer incorrect.");
                     $("#spanq4").css("color","red");
            }
            if(($("#q5a1").is(":checked"))&&!($("#q5a2").is(":checked"))&&($("#q5a3").is(":checked"))&&($("#q5a4").is(":checked"))&&!($("#q5a5").is(":checked")))
            {
                     score++;
                     $("#spanq5").html("Answer correct.");
                     $("#spanq5").css("color","green");
            }
            else
            {
                     $("#spanq5").html("Answer incorrect.");
                     $("#spanq5").css("color","red");
            }
            $("#score").html("Score: "+score);
            return score;
        }
        
         function validateForm()
         {
             $("#spanq1").html("");
             $("#spanq2").html("");
             $("#spanq3").html("");
             $("#spanq4").html("");
             $("#spanq5").html("");
             $("#times").html("");
             $("#score").html("");
             $("#average").html("");

             //Validierung der Formelemente
             if($("#q1").val().trim().length==0)
             {
                 isValid=false;
                 $("#spanq1").html("Enter an answer before submitting the quiz!");
             }
             else if($('input[name="q2"]:checked').length == 0)
             {
                 $("#spanq2").html("Enter an answer before submitting the quiz!");
                 isValid=false;
             }
             else if($("#q3").val()=="select")
             {
                 $("#spanq3").html("Enter an answer before submitting the quiz!");
                 isValid=false;
             }
             else if($("#q4").val().trim().length==0)
             {
                 $("#spanq4").html("Enter an answer before submitting the quiz!");
                 isValid=false;
             }
             else if(!($("#q5a1").is(":checked"))&&!($("#q5a2").is(":checked"))&&!($("#q5a3").is(":checked"))&&!($("#q5a4").is(":checked"))&&!($("#q5a5").is(":checked")))
             {
                 $("#spanq5").html("Enter an answer before submitting the quiz!");
                 isValid=false;
             }
             if(isValid==true)
             {
                 var username = '<?php echo $_SESSION["username"];?>';
                 //calculate and print the score
                 var score=calcScore();
                 $("#score").html("Score: "+score);
                //insert values into table
                $.ajax({
                      type: "get",
                      url: "insertData.php?username="+username+"&score="+score,
                      data: {"username":username,"score":score},
                      success: function(data,status) {
                   },
                   complete: function(data,status) { //optional, used for debugging purposes
               }
               });
                //print times quiz taken and average score
                $.ajax({
                      type: "get",
                      url: "getData.php?username="+username,
                      dataType: "json",
                      data: {"username":username},
                      success: function(data,status) {
                          $("#times").html("Number of times the quiz was taken: "+data.times);
                          $("#average").html("Average score: "+data.average);
                   },
                   complete: function(data,status) { //optional, used for debugging purposes
               }
               });
               //grade the quiz with JavaScript/jQuery
             }
             //return isValid;
         }
        </script>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form action="logout.php">
            <input type="submit" value="Logout">
        </form><br>
        <span id="score" class="error"></span><br>
        <span id="times" class="error"></span><br>
        <span id="average" class="error"></span><br>
        <h1>Test your general knowledge!</h1>
        <form method="get">
        <fieldset>
        <legend>Test your knowledge</legend>
        <h3>Question 1: In which town is the prime meridian located?</h3>
        <img src="img/worldmap.jpg" style="width:250px;height:127px;"><br>
        Answer: <input type="text" name="q1" id="q1"> <span id="spanq1" class="error"></span><br>
        <h3>Question 2: What is the result of 9 - 3 / (1/3) + 1?</h3>
            <input type="radio" name="q2" value="true" id="q2Yes">
            <label for="q2Yes">1</label><br>
            <input type="radio" name="q2" value="false" id="q2No">
            <label for="q2No">3</label><br>
            <input type="radio" name="q2" value="false" id="q2No">
            <label for="q2No">9</label><br>
            <input type="radio" name="q2" value="false" id="q2No">
            <label for="q2No">12</label><span id="spanq2" class="error"></span><br>
        <h3>Question 3: Hitler was born in Germany. True or false?</h3>
        <select id="q3" name="q3">
            <option value="select">Select one</option>
            <option value="true" id="q3True">True</option>
            <option value="false" id="q3False">False</option>
        </select> <span id="spanq3" class="error"></span><br>
        <h3>Question 4: How many elements are in the periodic table?</h3>
        <form> <input type="number" name="q4" id="q4"> <span id="spanq4" class="error"></span><br>
        <h3>Question 5: Which of the following are types of democracy?</h3>
        <input type="checkbox" name="boxes"  id="q5a1" value="one">direct democracy<br>
         <input type="checkbox" name="boxes" id="q5a2" value="one">constitutional democracy<br>
         <input type="checkbox" name="boxes" id="q5a3" value="one">presidential democracy<br>
         <input type="checkbox" name="boxes" id="q5a4" value="one">parliamentary democracy<br>
         <input type="checkbox" name="boxes" id="q5a5" value="one">totalitary democracy <span id="spanq5" class="error"></span><br><br><br>
        <input type="button" value="Submit quiz" onclick="return validateForm()">
        </fieldset>
        </form><br>
    </body>
</html>