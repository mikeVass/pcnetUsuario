<?php

    session_start(); //son variables de sesion donde se almacena el producto 
    $mensaje="";

    if(isset($_POST['btnAccion'])){
        switch($_POST['btnAccion'] ){
            //Productos--------------------------------------------------------------------------------------
            case 'agregar':
                    if(is_numeric( openssl_decrypt( $_POST['id'],COD,KEY))){ //desencripta los datos 
                        $ID=openssl_decrypt( $_POST['id'],COD,KEY);
                        $mensaje.="El id es correcto".$ID."<br/>";
                    }
                    else{
                        $mensaje.="id incorrecto".$ID."<br/>";
                    }

                    if(is_string( openssl_decrypt( $_POST['nombre'],COD,KEY))){ //desencripta los datos 
                        $NOMBRE=openssl_decrypt( $_POST['nombre'],COD,KEY);
                        $mensaje.="El nombre es correcto".$NOMBRE."<br/>";
                    }else{
                        $mensaje.="error"."<br/>";  
                        break;
                    } 

                    if(is_numeric( openssl_decrypt( $_POST['precio'],COD,KEY))){ //desencripta los datos 
                        $PRECIO=openssl_decrypt( $_POST['precio'],COD,KEY);
                        $mensaje.="El el precio es correcto".$PRECIO."<br/>";
                    }else{
                        $mensaje.="error"."<br/>"; 
                        break;

                    }
                    if(is_numeric( openssl_decrypt( $_POST['cantidad'],COD,KEY))){ //desencripta los datos 
                        $CANTIDAD=openssl_decrypt( $_POST['cantidad'],COD,KEY);
                        $mensaje.="la cantidad es correcta".$CANTIDAD."<br/>";
                    }else{
                        $mensaje.="error"."<br/>";
                        break;
                    }

                if(!isset($_SESSION['CARRITO'])){ //Condicion si esto no es correcto -> SE VALIDA LA VARIABLE DE SESION(contiene todos los producto que seleccionamos)
                    $producto=array( //Obtiene la informacion del producto 
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'PRECIO'=>$PRECIO,
                        'CANTIDAD'=>$CANTIDAD                  
                    );
                    $_SESSION['CARRITO'][0]=$producto;
                    $mensaje="Producto agregado al carrito ";
                }else{
                    $idProductos = array_column($_SESSION['CARRITO'],"ID"); // idProductos va a tener todos los id que esta en el carrito de compras 
                    if(in_array($ID,$idProductos)){ //condicion donde compara si el id que seleccionamos del producto ya lo habiamos seleccionado antes 
                        echo "<script>alert('El producto ya ha sido seleccionado..');</script>";
                    }else{

                    $NumeroProductos=count($_SESSION['CARRITO']);
                    $producto=array( //Obtiene la informacion real que el usario 
                        'ID'=>$ID,
                        'NOMBRE'=>$NOMBRE,
                        'PRECIO'=>$PRECIO,
                        'CANTIDAD'=>$CANTIDAD                  
                    );
                    $_SESSION['CARRITO'][$NumeroProductos]=$producto; // se incrementa n veces el producto que seleccionamos
                    $mensaje="Producto agregado al carrito ";
                    }
                }
                //$mensaje=print_r($_SESSION,true);
                
            break;
            //Accesorios-------------------------------------------------------------------------    
            case 'agregarAccesorio':
                if(is_numeric( openssl_decrypt( $_POST['Id'],COD,KEY))){ //desencripta los datos 
                    $idAccesorios=openssl_decrypt( $_POST['Id'],COD,KEY);
                    $mensaje.="El id es correcto".$idAccesorios."<br/>";
                }
                else{
                    $mensaje.="id incorrecto".$idAccesorios."<br/>";
                }

                if(is_string( openssl_decrypt( $_POST['Nombre'],COD,KEY))){ //desencripta los datos 
                    $Nombre=openssl_decrypt( $_POST['Nombre'],COD,KEY);
                    $mensaje.="El nombre es correcto".$Nombre."<br/>";
                }else{
                    $mensaje.="error"."<br/>";  
                    break;
                } 

                if(is_numeric( openssl_decrypt( $_POST['Precio'],COD,KEY))){ //desencripta los datos 
                    $Precio=openssl_decrypt( $_POST['Precio'],COD,KEY);
                    $mensaje.="El el precio es correcto".$Precio."<br/>";
                }else{
                    $mensaje.="error"."<br/>"; 
                    break;

                }
                if(is_numeric( openssl_decrypt( $_POST['Cantidad'],COD,KEY))){ //desencripta los datos 
                    $Cantidad=openssl_decrypt( $_POST['Cantidad'],COD,KEY);
                    $mensaje.="la cantidad es correcta".$Cantidad."<br/>";
                }else{
                    $mensaje.="error"."<br/>";
                    break;
                }

            if(!isset($_SESSION['CARRITOAC'])){ //Condicion si esto no es correcto -> SE VALIDA LA VARIABLE DE SESION(contiene todos los producto que seleccionamos)
                $accesorios=array( //Obtiene la informacion del producto 
                    'Id'=>$idAccesorios,
                    'Nombre'=>$Nombre,
                    'Precio'=>$Precio,
                    'Cantidad'=>$Cantidad                  
                );
                $_SESSION['CARRITOAC'][0]=$accesorios;
                $mensaje="Producto agregado al carrito ";
            }else{
                $idAces = array_column($_SESSION['CARRITOAC'],"Id"); // idProductos va a tener todos los id que esta en el carrito de compras 
                if(in_array($idAccesorios,$idAces)){ //condicion donde compara si el id que seleccionamos del producto ya lo habiamos seleccionado antes 
                    echo "<script>alert('El producto ya ha sido seleccionado..');</script>";
                }else{

                $NumeroAccesorios=count($_SESSION['CARRITOAC']);
                $accesorios=array( //Obtiene la informacion real que el usario 
                    'Id'=>$idAccesorios,
                    'Nombre'=>$Nombre,
                    'Precio'=>$Precio,
                    'Cantidad'=>$Cantidad                  
                );
                $_SESSION['CARRITOAC'][$NumeroAccesorios]=$accesorios; // se incrementa n veces el producto que seleccionamos
                $mensaje="Producto agregado al carrito ";
                }
            }
            //$mensaje=print_r($_SESSION,true);
            
        break;





            case "eliminar": //recepciona valores del boton eliminar, para luego evalual el id que se envio 
                if(is_numeric( openssl_decrypt( $_POST['id'],COD,KEY))){ //desencripta los datos 
                    $ID=openssl_decrypt( $_POST['id'],COD,KEY); 
                    
                    foreach($_SESSION['CARRITO'] as $indice=>$producto){ //lee todos los datos que se alojan en la variable sesion 'CARRITO'
                        if($producto['ID']==$ID){ //se compara el id que se envio con el id que esta almacenado 
                            unset($_SESSION['CARRITO'][$indice]);//unset=elimina un registro
                            echo "<script>alert('Elemento Borrado...')</script>";
                        }
                    }
                
                
                }else{
                    //echo "<script>alert('Error...')</script>";
                    $mensaje.="id incorrecto".$ID."<br/>";
                }
            break;
            case "eliminarAcs": //recepciona valores del boton eliminar, para luego evalual el id que se envio 
                if(is_numeric( openssl_decrypt( $_POST['Id'],COD,KEY))){ //desencripta los datos 
                    $idAccesorios=openssl_decrypt( $_POST['Id'],COD,KEY); 
                    
                    foreach($_SESSION['CARRITOAC'] as $indice=>$accesorios){ //lee todos los datos que se alojan en la variable sesion 'CARRITO'
                        if($accesorios['Id']==$idAccesorios){ //se compara el id que se envio con el id que esta almacenado 
                            unset($_SESSION['CARRITOAC'][$indice]);//unset=elimina un registro
                            echo "<script>alert('Elemento Borrado...')</script>";
                        }
                    }
                
                
                }else{
                    //echo "<script>alert('Error...')</script>";
                    $mensaje.="id incorrecto".$idAccesorios."<br/>";
                }
            break;






            case "guardar":
                $nombre =(isset($_POST['nombre']))?$_POST['nombre']:"";
                $apellido =(isset($_POST['apellido']))?$_POST['apellido']:"";
                $direccion =(isset($_POST['direccion']))?$_POST['direccion']:"";
                $telefono =(isset($_POST['telefono']))?$_POST['telefono']:"";
                $fecha =(isset($_POST['fecha']))?$_POST['fecha']:"";
                $correo =(isset($_POST['correo']))?$_POST['correo']:"";
                $contr =(isset($_POST['contr']))?$_POST['contr']:"";

                include 'global/conexion.php';

                $sentencia=$pdo->prepare("INSERT INTO cliente (Nombre,Apellido,Direccion,Telefono,Fecha,Correo,Pasword) VALUES(:Nombre,:Apellido,:Direccion,:Telefono,:Fecha,:Correo,:Pasword)" );
                
                $sentencia->bindParam(':Nombre',$nombre);
                $sentencia->bindParam(':Apellido',$apellido);
                $sentencia->bindParam(':Direccion',$direccion);
                $sentencia->bindParam(':Telefono',$telefono);
                $sentencia->bindParam(':Fecha',$fecha);
                $sentencia->bindParam(':Correo',$correo);
                $sentencia->bindParam(':Pasword',$contr);
                $sentencia->execute();
    
                
                break;

            
        }

        
    }


?>