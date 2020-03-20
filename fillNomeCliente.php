<?php 
    include_once './common/connectDB.php';
    $database = new Connection();
    $db = $database->openConnection();

    if(isset($_POST['query'])){
        $id=$_POST['query'];
        $sql="SELECT nomeCliente FROM cliente WHERE codCliente LIKE '%$id%'";
        $result =$db->query($sql);

        if($result->rowCount()>0){
            while($row=$result->fetch(PDO::FETCH_ASSOC)){
                echo $row['nomeCliente'];                
            }
        }
        else {
            echo "";
        }
    }

?>