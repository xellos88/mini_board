<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."mini_board/src/board_header.php" );
    include_once( URL_DB );

$arr_get = $_GET;
$result_cnt = delete_board_info_no( $arr_get["board_no"] );

header( "Location: board_list.php" );
exit();


?>