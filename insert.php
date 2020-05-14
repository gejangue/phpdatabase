<!doctype html>
<html>
     <head>
          <title>Bücher erfassen</title>
          <meta charset="UTF-8">
     </head>

     <body>

     <?php
     
       $dbhost = getenv("MYSQL_SERVICE_HOST");
       $dbport = getenv("MYSQL_SERVICE_PORT");
       $dbuser = getenv("databaseuser");
       $dbpwd = getenv("databasepassword");
       $dbname = getenv("databasename");
       //$connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $$dbpwd);

        if(count($_POST) > 0):
            if( !strlen($_POST['titel']) > 0
                || !strlen($_POST['autor']) > 0
                || !strlen($_POST['seiten']) > 0
                || !strlen($_POST['isbn']) > 0
            ){
                echo "Nicht alle Werte eingegeben! <br>";
                echo "NICHT GESPEICHERT!";
            }else{
                $sql = "INSERT INTO buecher "
                    ."(titel, autor, seiten, isbn) VALUES "
                    ."(:titel, :autor, :seiten, :isbn)";
                
                $query = $pdo->prepare($sql);
                $query->bindParam(':titel', $_POST['titel'], PDO::PARAM_STR);
                $query->bindParam(':autor', $_POST['autor'], PDO::PARAM_STR);
                $query->bindParam(':seiten', $_POST['seiten'], PDO::PARAM_INT);
                $query->bindParam(':isbn', $_POST['isbn'], PDO::PARAM_STR);
                $query->execute();
                
                if($pdo->lastInsertId()){
                    echo "Gespeichert!";
                }
            }

        endif;

     ?>
       <h1>Ein Buch erfassen:</h1>

        <form method="POST">
        <p>
             <input type="text" name="titel" size="50" placeholder="Buchtitel">
        </p>

        <p>
             <input type="text" name="autor" size="50" placeholder="Autor">
        </p>

        <p>
             <input type="text" name="seiten" size="5" placeholder="Seitenanzahl">
        </p>

        <p>
             <input type="text" name="isbn" size="20" placeholder="ISBN">
        </p>

        <p>
            <input type="submit" value="Speichern">
        </p>
        </form>
        <footer>
            <p><a href="insert.php">Neues Buch</a> <a href="mysqlconnect.php">Buchliste</a></p>
        </footer>
     </body>
</html>