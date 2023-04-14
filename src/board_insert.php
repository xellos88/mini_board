<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."mini_board/src/board_header.php" );
    include_once( URL_DB );

    $http_method = $_SERVER["REQUEST_METHOD"];
    
    if( $http_method === "POST" )
    {
        $arr_post = $_POST;
        $result_info = insert_board_info( $arr_post );
        
        header( "Location: board_list.php" );
        exit();
    }    
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/board_css.css">
	<title>board_insert</title>
</head>
<body>
    <?php include ( URL_HEADER ); ?>
    <form method="post" action="board_insert.php">
    <div class="container">
        <table class='table-striped'>
            <tr>
                <th class="radius-left">
                    <label for="title">제목</label>
                </th>
                <td class="radius-right">
                    <input type="text" name="board_title" id="title">
                </td>
            </tr>
            <tr>
                <th class="radius-left">
                    <label  for="contents">내용</label>
                </th>
                <td class="radius-right">
                <textarea rows="6" cols="10" name="board_contents" id="contents"></textarea>
                </td>
            </tr>
        </table>
        <div class="button">
            <button type="submit" class="button_a">작성</button>
            <a href="board_list.php" class="button_a">취소</a>
        </div>
        </form>
    </div> 
</body>
</html>
