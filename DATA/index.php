<style>


.App{
  background-color: #282c34;
  min-height: 100vh;
  
  margin: 0px;
  font-size: calc(10px + 2vmin);
  color: white;
}
Link{
  text-decoration: none;
}
.App-header{
  column-count: 2;
  background-color: #17191d;
  padding: 10px;
  padding-left:50px;
}
h1{
  font-size: 20px;
  padding:5px;
  margin: 0px;
}
.App-header>div{
  text-align: center;
  flex-flow: column wrap;
  align-content: flex-end;
  column-gap: 10px;
  display: flex;
}
p{
  margin:0px;
  font-size: 15px;
}
.Content{
  padding: 2%;
}

body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen',
    'Ubuntu', 'Cantarell', 'Fira Sans', 'Droid Sans', 'Helvetica Neue',
    sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

code {
  font-family: source-code-pro, Menlo, Monaco, Consolas, 'Courier New',
    monospace;
}


.grid-card{
    display: flex;
    flex-flow: row wrap;
    column-gap: 20px;
    row-gap:20px;
}

.card2{
    cursor: pointer;
    text-align: center;
    background-color: rgb(79, 79, 77);
    border-radius: 20px;    
    height: 160px;
    padding-top: 15px;
    width: 250px;
}
.card{
    cursor: pointer;
    text-align: center;
    background-color: rgb(79, 79, 77);
    border-radius: 20px;
    height: 275px;
    width: 250px;
}
.card2>div {
    display: flex;
    flex-flow: row wrap;
    
    padding-left: 70px;
    column-gap: 50px;
}
.card2>p{
    font-size: 30px;
    padding: 10px;
}
.option{
    margin-top: 10px;
    display: flex;
    flex-flow: row wrap;
    
    padding-left: 70px;
    column-gap: 50px;
}
.card>div{
    display: flex;
    flex-flow: row wrap;
    
    padding-left: 70px;
    column-gap: 50px;
}
.toque{
    height:30px;
}
.photo{
    border-top-left-radius: 50px;
    
    border-bottom-right-radius: 10px;
}
.card>p{
    font-size: 20px;
    padding: 5px;
}
.search{
    
    margin-bottom: 20px;
  width: 100%;
  border: 3px solid #646464;
  border-right: none;
  padding: 5px;
  height: 20px;
  border-radius: 5px 5px 5px 5px;
  outline: none;
  color: #c2c2c2;



}
.search:focus{
    color: #646464;
  }
  .little{
    width: 25px;
  }
  .ajustement{
    
    padding-left: 40px !important;
  }
</style>
<?php
$servername = 'bdd';
$username = 'root';
$password = 'root1234';
$dbname='login';
function allDb(){
    try{
        $dbco = new PDO("mysql:host=$servername", $username, $password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "CREATE DATABASE login";
        $dbco->exec($sql);
        
        echo '<p>Base de données créée bien créée !</p>';
        
        callSQL("CREATE TABLE Clients(Id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,Nom VARCHAR(30) NOT NULL)");
        echo '<p>Table Clients bien créée !</p>';
        postClients('pierre');
        postClients('mark');
        postClients('jack');
        postClients('edouard');
        echo '<p>Données Table Clients bien créée !</p>';
    }

    catch(PDOException $e){
        echo "<p>Tout existe déjà (Base De Données, Table, Données)</p>";
    //echo "Erreur : " . $e->getMessage();
    }
}
function callSql($sql){
    $servername = 'bdd';
    $username = 'root';
    $password = 'root1234';
    $dbname='login';
    try{
            $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
            $sth =$dbco->prepare($sql);
            $sth->execute();
            $resultat = $sth->fetchAll(PDO::FETCH_ASSOC);
           // print_r($resultat);
            return  $resultat;
        }
        catch(PDOException $e){
            //echo "Erreur : " . $e->getMessage();
            return  [];
             
        }
}

//callSQL("INSERT INTO Clients( Nom)VALUES ('test')");
//delClients('pierre');
?>
<?php
function getClients(){
    return callSql("Select Nom from Clients");
}
function delClients($nom){
    return callSql("delete from Clients where Nom LIKE '".$nom."'");
}
function postClients(){
    $list_nom=["mark","pierre","jack","edouard"];
    callSql("INSERT INTO Clients( Nom)VALUES ('".$list_nom[rand(0, 3)]."')");
}
function CallAPI($method, $url, $data = false)
{
    $token = "#£kc+[¨uuayeizrrtui&/&mdf4£@¤a&-";
    $curl = curl_init();
    $authorization = 'Authorization: Bearer '.$token;
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json' , $authorization ));
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    if (curl_errno($curl)) {
        $error_msg = curl_error($curl);
        //var_dump($error_msg);
    }
    curl_close($curl);
    return $result;
    
}
//var_dump();
?>
<html>
<div class="App">
    <div class="Content">
        <?php allDb() ?>
        <div>
            <h1>Clients: </h1>
                <div class="grid-card">
                    <?php 
                            $data=getClients();
                            
                            foreach( $data as $key => $value)
                                {
                                     
                                   echo" 
                                        <div class='card2' > 
                                            
                                            <img class='photo' src='./contact.png' height='100' width='100'/>
                                            <p>".$value["Nom"] ."</p>
                                        </div>
                                    ";
                                } 
                    ?>
                </div>
        </div>
        <h1>Plats: </h1>

        <div class="grid-card">
                <?php 
                $data2=json_decode(CallAPI("GET","http://api:3000/api/recette/client"))->data;
                //print_r($data2);
                        foreach( $data2 as $key => $value)
                            {
                                echo "  
                                    <div class='card' >
                                        <p>".$value->name ."</p> 
                                        <img class='photo' src='".$value->url_image."' height='150' width='150'/>
                                        <div>
                                            <div class='right'> 
                                                <img src='./chronometre.png' height='30'/>
                                                <p style='margin-top:-5px'>".$value->prepare." min</p>
                                            </div>
                                            <div class='left'> 
                                                <img src='./toque.png' height='30'/>
                                            <p style='margin-top:-5px'>".$value->dificulty."</p>
                                            </div>
                                        </div>
                                    </div>
                                ";
                            } 
                ?>
        </div>
    </div>
</div>
</html>