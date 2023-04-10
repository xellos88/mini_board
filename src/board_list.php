<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    include_once( URL_DB );
    $arr_prepare = 
    array(
        "limit_num" => 5
        ,"offset"   => 0
    );
    $result = select_board_info_paging( $arr_prepare );
    print_r ( $result );
?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>게시판</title>
</head>
<body>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>게시글 번호</th>
                <th>게시글 제목</th>
                <th>작성일자</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>제목1</td>
                <td>2023-04-8</td>
            </tr>
            <tr>
                <td>2</td>
                <td>제목2</td>
                <td>2023-04-9</td>
            </tr>
            <tr>
                <td>3</td>
                <td>제목3</td>
                <td>2023-04-10</td>
            </tr>
        </tbody>
    </table>
</body>
</html>