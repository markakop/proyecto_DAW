<link rel='stylesheet' href='assets/admin/css/productos.min.css' type='text/css' />

<?php
function borradetalles($idP){
	global $SP;
	$result = Consultar("select * from products_lang WHERE producto_ce=".$idP);
	if(mysqli_num_rows($result)>0){ 
		while($row = mysqli_fetch_array($result)) { 
			borraFoto("producto".$SP."det".$SP.$row['foto_cp'].".jpg");
		}
	}
	$result = Borrar("DELETE FROM products_det Where producto_ce=".$idP);
	mysqli_free_result($result);
}

if (isset($_POST['acc'])) {
	$acc=$_POST['acc'];
	if($acc==1){
		$result = Insertar("INSERT INTO products VALUES (".$_POST["id"].",'".$_POST["reference"]."',".$_POST["active"].",".$_POST["orden"].",".$_POST["price"].",'".(isset($_POST["code_manufacturer"])?$_POST["code_manufacturer"]:"null")."','".(isset($_POST["sku"])?$_POST["sku"]:"null")."')");
	}
	if($acc==2){
		$result = Borrar("Delete From products Where id=".$_POST['id']."");
		if($result){
			/*borradetalles($_POST['id']);
			borraFoto("producto".$SP."peq".$SP.$_POST['id'].".jpg");
			borraFoto("producto".$SP."img".$SP.$_POST['id'].".pdf");
			borraFoto("producto".$SP."tec".$SP.$_POST['id']."_1".".pdf");
			borraFoto("producto".$SP."tec".$SP.$_POST['id']."_2".".pdf");
			borraFoto("producto".$SP."tec".$SP.$_POST['id']."_3".".pdf");
			*/
		}
	}
	if($acc==3){
		$result = Actualizar("UPDATE products SET price=".$_POST['price'].", reference='".$_POST['reference']."', orden=".$_POST['orden'].", active=".$_POST['active'].", sku='".$_POST['sku']."', code_manufacturer='".$_POST["code_manufacturer"]."' Where id=".$_POST['id']);
	}	
}
$orden=Ultimo("select MAX(orden) from products"); 
$ultimo=Ultimo("select MAX(id) from products"); 
?>

<script language="JavaScript">
function verifica(){
	frm=eval("document.nuevo");
    if(verificar(frm,1)){
		if(compruebaNumero(frm.orden.value)){
			if(compruebaNumero(frm.price.value)){
				frm.submit();
			}else{
				alert("El precio debe ser numérico");
			}
		}else alert (mensaje);
    }else {alert (mensaje)}
}


function modifica(idX,idP){
	frm=eval("document.acciones");
	frm.id.value=idP;
	frm.reference.value=eval("document.listado.reference"+idX).value;
    frm.active.value=eval("document.listado.active"+idX).checked?1:0;
	frm.orden.value=eval("document.listado.orden"+idX).value;
	frm.price.value=eval("document.listado.price"+idX).value;
    frm.sku.value=eval("document.listado.sku"+idX).value;
    frm.code_manufacturer.value=eval("document.listado.code_manufacturer"+idX).value;
    
    if(verificar(frm,3)){
		if(compruebaNumero(frm.orden.value)){
			if(compruebaNumero(frm.price.value)){
				frm.submit();
			}else{
				alert("El precio debe ser numérico");
			}
		}else alert (mensaje);
    }else {alert (mensaje)}
}

function verificar(formu,valAcc){
  mensaje="";
  reference=formu.reference.value;
  formu.acc.value=valAcc;
  if(reference.length==0){
   	mensaje="El campo [ reference ] no puede estar vacío.";
    return false;
  }else{
  	return true;
  }
}
function ver(id_prod,nombre){
	//alert("/admin/producto_lang/"+id_prod);
	open ("/admin/producto_lang/"+id_prod,"_self");
}
function verD(id_prod,nombre){
	open ("detalles.php?producto_ce="+id_prod+"&NOMBRE="+nombre,"_self");
}
function verH(id_prod,nombre){
	open ("/admin/jpgalta/"+id_prod,"_self");
}
function compruebaNumero(numero) {
   if (!hayDatos(numero)) {
		mensaje="Debe indicar algún NúMERO DE orden";
		return false;
   }else{
		esNumero=parseInt(numero)==numero ? true:false;
		esDecimal=parseFloat(numero)==numero?true:false;

		if (!esNumero && !esDecimal) {
			mensaje="El orden debe ser numérico";
			return false;
		}else{
			
			return true;
		}
   }
}
function borra(id){
  var aceptaEliminar = window.confirm("ATENCIÓN...Si elimina este ITEM, se borrarán TODOS los subitems asociados.");
  if (aceptaEliminar) {
	document.acciones.acc.value=2;
	document.acciones.id.value=id;
	document.acciones.submit();
	}	
}

function hayDatos(string) {
    var patron = /\w+/;
    return patron.test(string);
}
function recarga(){
	document.filtro.submit();
}


</script>




<table cellpadding="3" cellspacing="0" class="products-table">
<form name="filtro" action="admin/productos" method="post">
<tr class="tit-prod"><td colspan="10" height="25"><SPAN CLASS="txtsubtitu">Productos</SPAN></td></tr>
<tr bgcolor="BDAC7C">
</tr>
</form>
	<tr><td colspan="3" height="10"></td></tr>
	<form name="nuevo" action="admin/productos" method="post">
	<input type="hidden" name="acc" value="1">
	<input type="hidden" name="id" value="<?php echo  $ultimo;?>">
	<input type="hidden" name="active" value="0">
	<tr class="tit-prod"><td colspan="10" height="25"><SPAN CLASS="txtsubtitu">Nuevos productos</SPAN></td></tr>
	<tr class="tr-titles">
	<td class="td-background" height="25"><SPAN CLASS="txtsubtitu">Referencia<BR></SPAN><input class="margin-top-inpt" type="Text" size="30" name="reference" value=""></td>
	<td class="td-background" height="25"><SPAN CLASS="txtsubtitu">Precio<BR></SPAN><input class="margin-top-inpt" type="Text" size="5" name="price" value=""></td>
	<td class="td-background" height="25"><SPAN CLASS="txtsubtitu">Código del fabricante<BR></SPAN><input class="margin-top-inpt" type="Text" size="5" name="code_manufacturer" value=""></td>
	<td class="td-background" height="25"><SPAN CLASS="txtsubtitu">SKU<BR></SPAN><input class="margin-top-inpt" type="Text" size="5" name="sku" value=""></td>
	<td class="td-background" height="25"><SPAN CLASS="txtsubtitu">Orden<BR></SPAN><input class="margin-top-inpt" type="Text" size="3" name="orden" value="<?php echo $orden; ?>" maxlength="3"></td>
	<td class="btn-center"><input class="btn-orange" type="button" value="Guardar producto" onclick="verifica()"></td>
	</tr>
</form>
</table>
<?php 

$result=Consultar("select * from products  ORDER BY orden DESC"); 
if(mysqli_num_rows($result)>0){ ?>
<table cellpadding="2" cellspacing="0" width="100%">
<form name="listado">
<tr><td colspan="6" height="10"></td></tr>
<tr bgcolor="D9D9D9" class="fixed-row"><td height="25"><SPAN CLASS="txtsubtitu">Referencia</SPAN></td><td height="25"><SPAN CLASS="txtsubtitu">Precio</SPAN></td><td height="25"><SPAN CLASS="txtsubtitu">Código fabricante</SPAN></td><td height="25"><SPAN CLASS="txtsubtitu">SKU</SPAN></td><td height="25"><SPAN CLASS="txtsubtitu">Activo</SPAN></td><td><SPAN CLASS="txtsubtitu">Orden</SPAN></td><td></td><td></td><td></td></tr>
<tr><td colspan="6" height="5"></td></tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) { 
	$idP=$row["id"];
	echo '<tr class="lines-colors" bgcolor="BDAC7C">';
	echo '<td valign="top"><input type="Text" name="reference'.$i.'"  value="'.$row["reference"].'" size="30"></td>';
	echo '<td valign="top"><input type="Text" name="price'.$i.'"  value="'.$row["price"].'" size="5"></td>';
	echo '<td valign="top"><input type="Text" name="code_manufacturer'.$i.'"  value="'.$row["code_manufacturer"].'" size="5"></td>';
	echo '<td valign="top"><input type="Text" name="sku'.$i.'"  value="'.$row["sku"].'" size="5"></td>';
	echo '<td valign="top" class="align-active"><input  type="CHECKBOX" NAME="active'.$i.'" '.($row["active"]==1?"checked":"").'></td>'; 
	echo '<td valign="top"><input type="Text" size="6" name="orden'.$i.'" value="'.$row["orden"].'"></td>';
	
	echo '<td class="td-button" valign="top">';
	echo '<input class="btn-modify" type="button" value="Modificar" onclick="modifica('.$i.','.$idP.')">&nbsp;';
	echo '</td>';
	
	echo '<td class="td-button" valign="top">';
	echo '<input class="btn-modify" type="button" value="Borrar" onclick="borra('.$idP.')"><br>';
	echo '</td>';

	echo '<td class="td-button" valign="top">';
	echo '<input class="btn-modify" type="button" value="+ Info" onclick="ver('.$idP.",'".$row["reference"]."'".')">&nbsp;';
	echo '</td>';
	
	/* echo '<input type="button" value="+ DETALLES" onclick="verD('.$idP.",'".$row["reference"]."'".')">&nbsp;'; */
	/* echo '<input type="button" value="JPG ALTA" onclick="verH('.$idP.",'".$row["reference"]."'".')">'; */
	
	echo '</tr>'; 
	echo "\n";
	$i++;
} ?>
</form>
</table>
<form method="post" name="acciones" action="admin/productos">
	<input type="hidden" name="acc" value="2">
	<input type="hidden" name="id" value="">
	<input type="hidden" name="reference" value="">
	<input type="hidden" name="active" value="">
	<input type="hidden" name="orden" value="">
	<input type="hidden" name="price" value="">
	<input type="hidden" name="sku" value="">
	<input type="hidden" name="code_manufacturer" value="">
</form>
<?php } 
mysqli_free_result($result);
?>
