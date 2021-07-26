<?php
$return = Array('ok'=>TRUE);

$tmp_archivo = $_FILES['archivo']['tmp_name'];
$name_save = $_REQUEST['name_save'];
$name_archivo = $_REQUEST['name_archivo'];
$abre = $_REQUEST['abre'];
$id_user = $_REQUEST['id_user'];

$upload_folder ='../alumno/img/Alumno'.$id_user;
$checar = $upload_folder.'/'.$name_archivo;

if(file_exists($checar.'.jpg')){
    unlink($checar.'.jpg');
}
if(file_exists($checar.'.png')){
    unlink($checar.'.png');
}
if(file_exists($checar.'.pdf')){
    unlink($checar.'.pdf');
}
if(file_exists($checar.'.doc')){
    unlink($checar.'.doc');
}
if(file_exists($checar.'.docx')){
    unlink($checar.'.docx');
}


if (!file_exists($upload_folder)) {
    mkdir($upload_folder, 0777, true);
}

$archivador = $upload_folder . '/' . $name_save;

if (!move_uploaded_file($tmp_archivo, $archivador)) {

    $return = Array('title' => 'ERROR AL SUBIR ARCHIVO', 'text' => 'NO PUDO GUARDARSE SU ARCHIVO EN EL SERVIDOR', 'icon' => 'error');   

}else{
    $return = Array('title' => 'ARCHIVO SUBIDO', 'text' => 'SU ARCHIVO PUDO GUARDARSE EN EL SERVIDOR', 'icon' => 'success');

    include('conexion.php');

    $db->query("DELETE FROM documentos_entregados WHERE folio = '$name_archivo'");

    $db->query("INSERT INTO documentos_entregados(id_usuarios, id_catalogo_documentos, folio, fecha_subido) VALUES ($id_user, (SELECT id  FROM catalogo_documentos WHERE abreviatura = '$abre'), '$name_archivo', NOW())");
}

echo json_encode($return);
?>