<?php
session_start();
$_SESSION['serveur'] = 'localhost';
$_SESSION['loginBDD'] = 'root';
$_SESSION['password'] = 'formation';
$_SESSION['database'] = 'search';
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Recherche des infos</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" 
              integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" 
              crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body onload="Id()">
        <div id="DivClignotante" style="color: grey"><center><h2>Version de demonstration</h2></center></div><br>
        <div class="center">
            <a href="index.php"><img src="logo/Network-Link.jpg" class="img-responsive" alt="Search"></a>
        </div>
        <script>
            function Id() {
                document.search_box.search.focus();
            }

        </script>

        <style>
            body{
                margin: 5%;
            }

        </style>

        <div style="margin-top: 9%"></div>
        <div class="center">
                <a href="createActivity.php"><input type='button' class='btn btn-primary btn-lg' name='search_complete' value='Créer une activité'></a><br><br>
                <a href="demo.php"><input type='button' class='btn btn-primary btn-lg' name='search_complete' value='Acces aux interactions et liens'></a>
        </div>

        <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" 
                integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" 
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" 
                integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" 
        crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" 
                integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" 
        crossorigin="anonymous"></script>
        
        <script type="text/javascript"> 
var clignotement = function(){ 
   if (document.getElementById('DivClignotante').style.visibility=='visible'){ 
      document.getElementById('DivClignotante').style.visibility='hidden'; 
   } 
   else{ 
   document.getElementById('DivClignotante').style.visibility='visible'; 
   } 
}; 

periode = setInterval(clignotement, 400); 
</script>
    </body>

</html>