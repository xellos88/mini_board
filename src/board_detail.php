<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."mini_board/src/board_header.php" );
    include_once( URL_DB );


    //Request Parameter 획득
    $arr_get=$_GET;
    
    //db에서 게시글 정보 획득
    $result_info = select_board_info_no( $arr_get["board_no"]);

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/board_css.css">
    <title>board_detail</title>
    <style>

    </style>
</head>
<body>
    <?php include ( URL_HEADER ); ?>
    <div class="container">
        <table class='table-striped'>
            <tr>
                <th class="radius-left">게시글 번호</th>
                <td class="radius-right"><?php echo $result_info["board_no"] ?></td>
            </tr>
            <tr>
            <th class="radius-left">게시글 작성일 : </th>
                <td class="radius-right"><?php echo $result_info["board_write_date"]?></td>
            </tr>
            <tr>
                <th class="radius-left">
                    <label for="title">제목</label>
                </th>
                <td class="radius-right">
                    <input type="text" name="board_title" id="title" value="<?php echo $result_info["board_title"] ?>">
                </td>
            </tr>
            <tr>
                <th class="radius-left">
                    <label  for="contents">내용</label>
                </th>
                <td class="radius-right">
                <textarea rows="6" cols="10" name="board_contents" id="contents"><?php echo $result_info["board_contents"] ?></textarea>
                </td>
            </tr>
        </table> 
        <div class="button">
            <a href="board_list.php" class="button_a">목록</a>
            <a href="board_update.php?board_no=<?php echo $result_info["board_no"] ?>" class="button_a">수정</a>
		    <a href="board_delete.php?board_no=<?php echo $result_info["board_no"] ?>" class="button_a">삭제</a>
        </div>
    </div>
</body>
</html>