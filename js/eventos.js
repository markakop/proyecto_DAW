<link rel='stylesheet' href='assets/admin/css/productos.min.css' type='text/css' />

<?php
$id_product=-1;

$path=getcwd();
$path_products=$path."/contents/products/";
$path_p_originales=$path_products."origins/";
$path_products_url="/contents/products/";


if(isset($id) && $id!=""){
	$id_product=$id;
}
 if (isset($_POST['id_product'])){$id_product=$_POST['id_product'];}else{if (isset($_GET['id_product'])){$id_product=$_GET['id_product'];}} ?>
<?php
if (isset($_POST['acc'])) {
	$acc=$_POST['acc'];
	if($acc==1){
		$result = Insertar("INSERT INTO products_lang VALUES (".$id_product.",".$_POST["id_lang"].",'".$_POST["reference"]."','".$_POST["description_short"]."','".$_POST["description"]."','".$_POST["technical_specifications"]."')");
	}	
	if($acc==2){
		$result = Borrar("DELETE FROM img_products WHERE id=".$_POST['id']."");
	}
	if($acc==3){
		$result = Actualizar("UPDATE products_lang SET reference='".$_POST["reference"]."', description_short='".$_POST["description_short"]."', description='".$_POST["description"]."', technical_specifications='".$_POST["technical_specifications"]."' WHERE id_product=".$id_product." AND id_lang=".$_POST['id_lang']);
	}
	if($acc==33){
		$result = Actualizar("UPDATE `img_products` SET `orden`=".$_POST['orden']." WHERE `id`=".$_POST['id']);
	}		
  	if($acc==4){
		$result=Insertar("INSERT INTO img_products VALUES (".$_POST["id_img"].",".$id_product.",".$_POST["orden"].",'')");

		if(isset($_FILES['image_url'])){
			$extension=explode(".",$_FILES['image_url']['name'])[1];
			$name_img=$_POST["id_img"]."_".$id_product.".".$extension;
			move_uploaded_file($_FILES['image_url']['tmp_name'],$path_p_originales."/".$name_img);

			include "tools/toolImages.php";
			
			$tools_images=new TollImages($path_products,$path_p_originales,$name_img);
		}
  	}
}
?>



<script language="JavaScript">
function modifica(idX){
	frm=eval("document.trad"+idX);
    if(verificar(frm)){
		  frm.submit();
    }else {alert (mensaje)}
}

function verificar(formu){
  mensaje="";
  reference=formu.reference.value;
  description_short=formu.description_short.value;
  description=formu.description.value;

  if(reference.length==0 || !hayDatos(description_short) || !hayDatos(description)){
   	mensaje="Rellene los campos marcados con *.";
    return false;
  }else{
	return true;
  }
}

//----------------------
function modificaImg(idX){
	let frm=eval("document.acciones");
	frm.acc.value=33;
	let acc=frm.acc.value;
	document.acciones.id.value=idX;
    const verificar=verificarImg(frm, acc);
    if(verificar){
		//alert(verificar);
		if(compruebaNumero(verificar)){
			frm.orden.value=verificar;
			frm.submit();
		}else{
			alert (mensaje);
		} 
    }else {alert (mensaje)}
}

function verificarImg(formu,valAcc){
  mensaje="";
  let order_upd=document.getElementById('order_upd').value;

	if(order_upd == 0){
		mensaje="El campo [ orden ] no puede ser cero.";
		return false;
	}else{
		return order_upd;
	}
}

function compruebaNumero(numero) {
   if (!hayDatos(numero)) {
		mensaje="Debe indicar algún NúMERO DE orden";
		return false;
   }else{
		esNumero=(parseInt(numero)==numero ? true:false);
		if (!esNumero) {
			mensaje="El orden debe ser numérico";
			return false;
		}else{
			return true;
		}
   }
}

function hayDatos(string) {
	return true;
}

function sube(formu,ext){
  
    f=eval("document."+formu);
   
    if (!hayDatos(f.image_url.value)){
         alert("No ha seleccionado una imagen");
    }else{
      if(compruebaFotos(f.image_url.value,ext)){ 
        f.submit();	
      }
	}
}

function compruebaFotos(img,ext) {
  var pasa=true;
  nf1=img.split('\\');
  imagen1=nf1[nf1.length-1];
  im1=imagen1.toUpperCase();
  caracter1=im1.match("Û");
  if (caracter1!=null ) {
    pasa=false;alert("El nombre de la imagen NO DEBE CONTENER EL CARACTER: —");
  }
  caracter1=imagen1.split('.').length;
  if (caracter1>2 ) {
    pasa=false;
    alert("El nombre de la imagen NO DEBE CONTENER NINGÚN PUNTO");
  }
  if (caracter1<2) {
    pasa=false;
    alert("La imagen NO TIENE EXTENSIÓN");
  }
  extension1=imagen1.split('.')[1].toUpperCase();
  if (extension1!=ext && ext!="*") {
    pasa=false;
    alert("La imagen DEBE TENER EXTENSIÓN '."+ext+"'");
  }
  if (pasa) {
    return true;
  }else{
    return false;
  } 
}

function borra(id){
  var aceptaEliminar = window.confirm("ATENCIÓN... ¿quiere borrar la imagen?");
  if (aceptaEliminar) {
	document.acciones.acc.value=2;
	document.acciones.id.value=id;

	document.acciones.submit();
	}	
}

</script>


<?php
$result=Consultar("select * from products WHERE id=".$id_product); 
if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_array($result); 
?>
<table cellpadding="3" cellspacing="0" width="100%">
<tr >
	<td height="20" width="100%">
		<!-- <SPAN CLASS="txtsubtitu"> --> <!-- [<a class="menuE" href="admin/productos"> VOLVER A PRODUCTOS </a>] -->
			<a class="back" href="admin/productos" title="Volver a productos"> 
				<icon class="arrow-right">
					<img class="products-img" src="./assets/img/izq-my-account.svg" alt="">
				</icon>
				Volver a productos
			</a>
		<!-- </SPAN> -->
	</td>
</tr>

</table>
<?php
}
?>

<table class="table-img" cellpadding="3" cellspacing="0" width="100%">
<tr><td colspan="3" height="10"></td></tr>
<tr><td colspan="3"><span class="txtsubtitu subtit-lang">Imágenes Asociadas</span></td></tr>
<tr><td colspan="3" height="10"></td></tr>
<tr><td><span class="txtsubtitu subtit-lang">Imagen</span></td><td><span class="txtsubtitu subtit-lang">Orden</span></td><td></td></tr>

<?php 
$result=Consultar("SELECT * FROM img_products WHERE id_product=$id_product ORDER BY `orden` DESC"); 
if(mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_array($result)) { 
		$img=$path_products_url.$row["id"]."_".$id_product."-hight.webp";
		
		echo "<tr><td><span class='txtsubtitu subtit-lang'><a class='link-img' href=\"".$img."\">$img</a></span></td>";
	?>
		<td>
				<input type="number" name="orden" id="order_upd" value="<?php echo $row["orden"] ?>">
		</td>
		<td>
				<input class="btn-modify btn-padd" type="button" value="Modificar" onclick="modificaImg(<?php echo $row['id'] ?>)">
				<input class="btn-modify btn-padd" type="button" value="Borrar" onclick="borra(<?php echo $row['id'] ?>)">
			</form>
<?php		
			echo "</td></tr>";
	}
}
?>	
<tr><td colspan="3" height="10"></td></tr>

</table>
<?php
$ultimo=Ultimo("select MAX(id) from img_products"); 
$ultimo_orden=Ultimo("select MAX(orden) from img_products"); 
//echo $ultimo;
?>

<table cellpadding="3" cellspacing="0" width="100%">
	<tr><td colspan="1" height="10"></td></tr>
	<tr><td colspan="1" >
			<form name="formimg" class="drag-area" action="admin/producto_lang/<?php echo $id_product ?>" method="post" enctype="multipart/form-data">
			  <input type="hidden" name="acc" value="4">
			  <span class="tit-image">Selecciona o arrastra aquí la imagen</span>
			  <input type="file" name="image_url" id="image_url" accept="image/*">
			  <input type="hidden" name="id_img" value="<?php echo  $ultimo;?>">
			  <input type="hidden" name="orden" value="<?php echo $ultimo_orden ?>">
			  <input class="btn-modify btn-padd" type="button" value="Subir imagen" name="subir" onclick="sube('formimg','*')">
			</form>
	</td></tr>
	<tr><td colspan="1" height="10"></td></tr>

</table>

<?php
//$result=Consultar("SELECT * FROM img_products WHERE id_product=$id_product"); 
?> 


<form method="post" name="acciones" action="admin/producto_lang/<?php echo $id_product ?>">
	<input type="hidden" name="acc" value="2">
	<input type="hidden" id="id_img" name="id" value="">
	<!-- <input type="hidden" name="id_product" value=""> -->
	<input type="hidden" name="orden" id="orden_form" value="">
	<input type="hidden" name="image_url" value="">
</form>



<?php 
$result=Consultar("SELECT * FROM langs WHERE active=1 ORDER BY `order` ASC"); 
if(mysqli_num_rows($result)>0){
	while($row = mysqli_fetch_array($result)) { 
	?>

		<table cellpadding="3" cellspacing="0" width="100%">
		<tr><td colspan="2" height="10"></td></tr>
		<tr><td bgcolor="D9D9D9" height="25" colspan="2"><SPAN CLASS="txtsubtitu"><?php echo $row["reference"] ?></SPAN></td></tr>
		<tr><td colspan="2" height="24"></td></tr>
		<form name="trad<?php echo $row["id"] ?>" action="admin/producto_lang/<?php echo $id_product ?>" method="post">
		<input type="hidden" name="id_lang" value="<?php echo $row["id"] ?>">
		

<?php 
		//echo '<input type="hidden" name="id_product" value="'.$id_product.'">'."\n";

	$result2=Consultar("SELECT * FROM products_lang WHERE id_product=$id_product AND id_lang=".$row["id"]); 
    	if(mysqli_num_rows($result2)>0){

			echo '<input type="hidden" name="acc" value="3">'."\n";
			$row2 = mysqli_fetch_array($result2);
			echo '<tr><td><SPAN CLASS="txtsubtitu subtit-lang">*Referencia:</SPAN></td><td><input class="no-margin" type="Text" name="reference" value="'.$row2["reference"].'" size="128"></td></tr>'."\n";
			echo '<tr height="8"></tr>'."\n";
			echo '<tr><td valign="top"><SPAN CLASS="txtsubtitu subtit-lang">*Descripción corta:</SPAN></td><td><textarea name="description_short" cols="130" rows="7">'.$row2["description_short"].'</textarea></td></tr>'."\n";
			echo '<tr height="8"></tr>'."\n";
			echo '<tr><td valign="top"><SPAN CLASS="txtsubtitu subtit-lang">*Información general:</SPAN></td><td><textarea name="description" cols="130" rows="7">'.$row2["description"].'</textarea></td></tr>'."\n";
			echo '<tr height="8"></tr>'."\n";
			echo '<tr><td valign="top"><SPAN CLASS="txtsubtitu subtit-lang">Especificaciones Técnicas:</SPAN></td><td><textarea name="technical_specifications" cols="130" rows="7">'.$row2["technical_specifications"].'</textarea></td></tr>'."\n";
		}else{

			echo '<input type="hidden" name="acc" value="1">'."\n";
			echo '<tr><td><SPAN CLASS="txtsubtitu subtit-lang">*Referencia:</SPAN></td><td><input type="Text" name="reference"  value="" size="50"></td></tr>'."\n";
			echo '<tr height="8"></tr>'."\n";
			echo '<tr><td><SPAN CLASS="txtsubtitu subtit-lang">*Descripción corta:</SPAN></td><td><textarea name="description_short" cols="130" rows="2"></textarea></td></tr>'."\n";
			echo '<tr height="8"></tr>'."\n";
			echo '<tr><td valign="top"><SPAN CLASS="txtsubtitu subtit-lang">*Información general:</SPAN></td><td><textarea name="description" cols="130" rows="2"></textarea></td></tr>'."\n";
			echo '<tr height="8"></tr>'."\n";
			echo '<tr><td valign="top"><SPAN CLASS="txtsubtitu subtit-lang">Especificaciones Técnicas:</SPAN></td><td><textarea name="technical_specifications" cols="130" rows="2"></textarea></td></tr>'."\n";
		}

	 	echo '<tr><td><SPAN CLASS="txtsubtitu"></SPAN></td><td><input class="btn-modify btn-padd" type="button" value="GUARDAR" onclick="modifica('.$row["id"].')"></td><td><SPAN CLASS="txtsubtitu"></SPAN></td></tr>'."\n";
	 	echo '</form>'."\n";
		echo '</table>'."\n";
	}
}


?>
