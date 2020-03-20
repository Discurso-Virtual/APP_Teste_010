
<?php
$currentPage="Documentos Fiscais";
session_start();
include_once '../common/cabecalho.php';
include_once '../common/connectDB.php';


$database = new Connection();
$db = $database->openConnection();
$sql = "SELECT * FROM tiposdoc " ;


if(isset($_SESSION['codTipoDoc']) && isset($_SESSION['tipoDoc'])){

    $codTipo=$_SESSION['codTipoDoc'];
    $tipo=$_SESSION['tipoDoc'];


    unset($_SESSION['codTipoDoc']);
    unset($_SESSION['tipoDoc']);
}

?>


<main role="main" id="main" class="col-md-12 container main">

            <div class="card col-md-12 formDocs" >
            <article class="card-body">
                <h4 class="card-title mb-4 mt-1">Novo Documento Fiscal</h4>
                <label for="fiscCriar"> Tipo de Documento Fiscal a criar </label>                   

                <div class="row ">
                    <select class="form-control col-md-3" id="fiscCriar" name="fiscCriar" >
                        <option value="" selected>Escolher Tipo Documento...</option>
                    <?php
                        foreach ($db->query($sql) as $row){?>
                            <option value="<?php echo $row['codTiposDoc']?>"><?php echo $row['nomeTiposDoc'] ?></option>
                    <?php 
                        }
                    ?>
                    </select>
                    <div class="col-md-1">
                    <button class="btn btn-primary" onclick="fetchInfo()" >Fetch </button>
                    </div>
                    <div class="col-md-4"></div>
                    <div class="col-md-4 rightSideCab">
                        <div class="row">
                                <div class="form-group form-inline col-md-12">
                                    <label class="col-md-3" for="idDocFisc"> CódDoc</label>
                                    <input class="form-control col-md-4" type="text" id="idDocFisc" name="idDocFisc" form="form_docFiscais" value="<?php
                                        $sql="SELECT max(idCab)+1 as idCab FROM doccab "; 
                                        foreach($db->query($sql) as $row){
                                            if($row['idCab']==null){
                                                echo 1;
                                            } else{
                                            echo $row['idCab'];

                                            }
                                        }
                                        ?>"disabled >

                                    <div class="form-group date col-md-4">
                                        <label class="sr-only" for="dataDoc">Data</label>
                                        <input class="form-control" type="date" id="dataDoc" name="dataDoc" style="border:0;float:right;" value="<?php echo date('Y-m-d');?>" >
                                    </div>
                                </div>
                                <div class="form-group form-inline col-md-12">
                                    <label class="col-md-3" for="codTipoDoc">CódTipo</label>
                                    <input class="form-control col-md-4" type="text" id="codTipoDoc" form="form_docFiscais" value="<?php if(isset($codTipo)){ echo $codTipo;} ?>" name="codTipoDoc" disabled>
                                </div>
                                <div class="form-group form-inline col-md-12">
                                    <label class="col-md-3" for="tipoDoc">TipoDoc</label>
                                    <input class="form-control col-md-4" type="text" id="tipoDoc"  form="form_docFiscais" value="<?php if(isset($tipo)){ echo $tipo;} ?>"  name="tipoDoc" disabled>
                                </div>
                                <div class="form-group form-inline col-md-12">
                                    <label class="col-md-3" for="numTipoDoc">DocNo</label>
                                    <input class="form-control col-md-4" type="text" id="numTipoDoc" form="form_docFiscais" name="numTipoDoc" value="<?php 
                                        if(isset($tipo)){
                                            $sql="SELECT max(docNo)+1 as numDoc FROM doccab where tipoDoc='$tipo'  "; 
                                            foreach($db->query($sql) as $row){
                                                if($row['numDoc']==null){
                                                    echo 1;
                                                }else{
                                                    echo $row['numDoc'];

                                                }
                                            }
                                        }
                                    ?>" disabled>
                                </div>
                        </div>
                    </div>
                </div>
               
                <form action="<?php echo $path?>/inserts/insertDocFiscais.php" method="POST" id="form_docFiscais" autocomplete="off"></form>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="codCliente">Cod Cliente</label>
                            <input class="form-control" type="text" id="codCliente" form="form_docFiscais" name="codCliente" value="">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="nomeCli">Nome Cliente</label>
                            <input class="form-control" type="text" id="nomeCli" form="form_docFiscais" name="nomeCli">
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="list-group" id="show-list" style="margin-top:-17px">
                            </div>    
                        </div>
                        <div class ="col-md-12" style="border-bottom:solid 1px black; margin:15px 15px 50px 15px"></div>
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th>Id Linha</th>
                                    <th>Id Cabeçalho</th>
                                    <th>Ref Produto</th>
                                    <th>Desc Prod</th>
                                    <th>Quantidade</th>
                                    <th>Preço Uni</th>
                                    <th>Preço Tot</th>
                                </tr>
                                <tr>
                                    <td>
                                        <input class="form-control" type="text" name="idLin" id="idLin" form="form_docFiscais" value=""disabled></input>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="idCab" id="idCab" form="form_docFiscais" value="<?php
                                        $sql="SELECT max(idCab)+1 as idCab FROM doccab "; 
                                        foreach($db->query($sql) as $row){
                                            if($row['idCab']==null){
                                                echo 1;
                                            } else{
                                            echo $row['idCab'];

                                            }
                                        }
                                        ?>"disabled ></input>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="refProdLin" id="refProdLin" form="form_docFiscais"></input>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="descProdLin" id="descProdLin" form="form_docFiscais"></input>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="Quantidade" id="Quantidade" form="form_docFiscais"></input>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="precUni" id="precUni" form="form_docFiscais"></input>
                                    </td>
                                    <td>
                                        <input class="form-control" type="text" name="precTot" id="precTot" form="form_docFiscais"></input>
                                    </td>
                                </tr>
                            </table>




                        </div>
                        
                    
                    <div class="form-group col-md-12">
                        <button class="btn btn-primary btn-block col-md-3 " style="float:right" type="submit" name="submit">Criar</button>
                    </div>
                    </div>
            </article>
        </div>
    
</main>
<?php
     include_once '../common/rodape.php'; 
?>
</body>
</html>