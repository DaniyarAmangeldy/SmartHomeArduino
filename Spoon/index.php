<html>

<head>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<div class="col-md-12 text-center grey lighten-3">
<nav class=" deep-purple">
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Smart Home</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="#">#There is no Spoon</a></li>
        
      </ul>
    </div>
  </nav>



 <div class="row">
        <div class="col s12 m12">
          <div class="card large amber lighten-1" id="light">
            <div class="card-content white-text">
              <span class="card-title"><img src="lamp.svg"  class="img-circle"></img> Light</span>
              <h4>Press a button to ON/OFF LED</h4>
            </div>
            <div class="card-action">
              <a class="waves-effect waves-light btn orange darkhen-1" onclick="changeDb()" id="ledButton"><i class="material-icons">power_settings_new</i></a>
            </div>
          </div>
        </div>
        </div>
    <div class="row">
    <div class="col s12 m12">
          <div class="card light-blue">
            <div class="card-content white-text">
              <span class="card-title"><img src="sun.svg"  class="img-circle"></img> Temp</span>
              <h2 id="temp"></h2>
            </div>
            <div class="card-action">

            </div>
          </div>
        </div>
        </div>
      <div class="row">
    <div class="col s12 m12">
          <div class="card green darken-1" id="secureColor">
            <div class="card-content white-text">
              <span class="card-title"><img src="security.svg"  class="img-circle"></img> Distance</span>
              <h2 id="distance"></h2>
            </div>
            <div class="card-action">

            </div>
          </div>
        </div> 
      </div>
</div>
     <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

<script>
//Обновляем VALUE каждый раз когда заходим в SMART HOME
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Spoon";
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
        $sql = "SELECT * FROM table_inputs WHERE `ID` = 0;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "var x = ". $row["VALUE"];
            }
        }
            
        
    
     $conn->close();
?>

if(x==0){
    
    document.getElementById("light").className="card amber lighten-1"
    document.getElementById("ledButton").className="waves-effect waves-light btn orange darkhen-1"
    x=1
}else{document.getElementById("light").className="card green"
      document.getElementById("ledButton").className="waves-effect waves-light btn green darken-3" 
      x=0

        
}
//Функция изменения VALUE в Database
function changeDb() {
$.post(
  "submit.php",
  {
    ID: "0",
    VALUE: x
  },
  onAjaxSuccess
);
 
function onAjaxSuccess(data)
{
  //Перезагружаем страницу
  location.reload();
  
}
   }
$(document).ready(function() {
    setInterval("checkTemp()",600);
    setInterval("checkDistance()",10);
});
function checkTemp(){
$.ajax({ type: "GET",   
         url: "submit.php",
         data:{
          'ID': 1
         },
         success : function(text)
                   {
                    text = text.substring(text.indexOf('{') + 1, text.indexOf('}'));
                    var y = document.getElementById("temp")
                    text=text.concat(" C")
                    y.innerHTML=text
                   }
            });
}
function checkDistance(){
$.ajax({ type: "GET",   
         url: "submit.php",
         data:{
          'ID': 2
         },
         success : function(text)
                   {
                    text = text.substring(text.indexOf('{') + 1, text.indexOf('}'));
                    var y = document.getElementById("distance")
                    text=text.concat(" cm")
                    y.innerHTML=text
                    var z = document.getElementById("secureColor")
                    if(parseInt(text)<50){
                     z.className="card deep-orange"
                     
                       
                      <?php
                          require 'Twilio.php';

                          $account_sid = 'AC68513ea0607fb9e2266cc3d9fd102a4c'; 
                          $auth_token = '83fface7c02471e8b27228be79d3687d'; 
                          $client = new Services_Twilio($account_sid, $auth_token); 
 
                          $client->account->messages->create(array( 
                          'To' => "+19204826538", 
                          'From' => "+19204826538",
                          'Body' => "There is no Spoon!",    
                          ));
                            ?>

                      }
                      if(parseInt(text)<80 && parseInt(text)>50){
                     z.className="card amber accent-2"
                      }
                      if(parseInt(text)>100){
                     z.className="card green darken-1"
                      }

                  }
                   
            });
}



</script>
</body>
</html>