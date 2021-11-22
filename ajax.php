<?
require 'class.php';
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (isset($_POST['id'])) {
    $item = new FormController();
    echo $item::delete($_POST['id']);
}

if (isset($_POST['name'])) {

    $uploaddir = __DIR__ .'/uploads';
	if( ! is_dir( $uploaddir ) ) mkdir( $uploaddir, 0777 );
	$files      = $_FILES; 
	$done_files = array();
	foreach( $files as $file ){
		$file_name = $file['name'];
		if( move_uploaded_file( $file['tmp_name'], "$uploaddir/$file_name" ) ){
			$done_files[] = realpath( "$uploaddir/$file_name" );
		}
	}

    $item = new FormController();
    $item::add($_POST, $done_files);

	$data = $done_files ? array('files' => $done_files ) : array('error' => 'Ошибка загрузки файлов.');
	die( json_encode( $data ) );
}