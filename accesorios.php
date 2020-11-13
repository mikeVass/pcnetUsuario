<?php
    include 'global/config.php';
    include 'global/conexion.php';
    include 'carrito.php';
    include 'templates/cabecera.php'
?>
<?php
    //session_start();
    if(isset($_SESSION['userName'])){
        header('Location: pagar.php');
    }
?>
        <br>
        <?php if($mensaje!=""){   //condicion si mensaje no esta vacio?>
        <div class="alert alert-success" role="alert">
                <?php   echo $mensaje; ?>
             
            <a href="mostrarCarrito.php " class="badge badge-success">Ver Carrito</a>
        </div>
        <?php }?>
        <div class="row">
            <?php
            $sentencia=$pdo->prepare("SELECT * FROM `accesorios`");//en esta pagina se muestra todos los productos almacenados en db
            $sentencia->execute();
            $listaAccesorios=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listaProductos);
            ?>
            <?php foreach($listaAccesorios as $accesorio){  ?> 
                
                <div class="col-3">
                <div class="card">
                 <img title="<?php echo $accesorio['Nombre'];?>" 
                     alt="<?php echo $accesorio['Nombre'];?>" 
                     class="card-img-top" 
                     src="/proyectoFin/uploadsAcs/<?php echo $accesorio['Imagen'];?>"
                     data-toggle="popover"
                     data-trigger="hover"
                     data-content="<?php echo $accesorio['Descripcion']; ?>" 
                     height="317px"             >

                 <div class="card-body">
                     <span> <?php echo $accesorio['Nombre'];?> </span>
                     <h5 class="card-title">Q<?php echo $accesorio['Precio'];?></h5>
                     <p class="card-text">Descripcion</p>
                     
                      <form action="" method="post">
                            <input type="hidden" name="Id" id="Id" value="<?php echo openssl_encrypt ($accesorio['idAccesorios'],COD,KEY);?>">
                            <input type="hidden" name="Nombre" id="Nombre" value="<?php echo openssl_encrypt ($accesorio['Nombre'],COD,KEY);?>">
                            <input type="hidden" name="Precio" id="Precio" value="<?php echo openssl_encrypt ($accesorio['Precio'],COD,KEY);?>">
                            <input type="hidden" name="Cantidad" id="Cantidad" value="<?php echo openssl_encrypt (1,COD,KEY);?>">

                        <button class="btn btn-primary" 
                                name="btnAccion" 
                                value="agregarAccesorio" 
                                type="submit" >Agregar al carrito
                        </button>
                    </form>
                 </div>
             </div>
             <br>
         </div>
            <?php }?>

            
    <script>
        $(function () {
        $('[data-toggle="popover"]').popover()
        })
    </script>
<?php include 'templates/pie.php'?>