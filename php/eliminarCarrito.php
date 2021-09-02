<?php 
session_start();
$arreglo=$_SESSION['carrito'];
for($i=0;$i<count($arreglo);$i++){
    if($arreglo[$i]['Id']!=$POST['id']){
        $arregloNuevo[]=array(
            'Id'=>$arreglo[$i]['Id'],
            'Nombre'=>$arreglo[$i]['Nombre'],
            'Precio'=>$arreglo[$i]['Precio'],
            'Imagen'=>$arreglo[$i]['Imagen'],
            'Cantidad'=>$arreglo[$i]['Cantidad'],
        );
    }
}
if(isset($arregloNuevo)){
    $_SESSION['carrito']=$arregloNuevo;
}else{
    //el registro a eliminar es el único que había
    unset($_SESSION['carrito']);
}
echo "listo";
