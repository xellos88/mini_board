<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."mini_board/src/board_header.php" );
    include_once( URL_DB );

// Request Method를 획득
$http_method = $_SERVER["REQUEST_METHOD"];

// GET 일때
if( $http_method === "GET" )
{
    $board_no = 1;
    if( array_key_exists( "board_no", $_GET ) )
    {
        $board_no = $_GET["board_no"];
    }
    $result_info = select_board_info_no( $board_no );
}
// POST 일때
else
{
    $arr_post = $_POST;
    $arr_info =
        array(
            "board_no" => $arr_post["board_no"]
            ,"board_title" => $arr_post["board_title"]
            ,"board_contents" => $arr_post["board_contents"]
        );
    
    // update
    $result_cnt = update_board_info_no( $arr_info );

    // select
    //$result_info = select_board_info_no( $arr_post["board_no"] ); // 0412 del

    header( "Location: board_detail.php?board_no=".$arr_post["board_no"] );
    exit(); // 36행에서 redirect 했기 때문에 이후의 소스코드는 실행할 필요가 없다.
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./common/board_css.css">
<title>board_update</title>
</head>
<body>
<?php include_once( URL_HEADER ) ?>
<form method="post" action="board_update.php">
		<div class="container">
			<table class='table-striped'>
				<tr>
					<th class="radius-left">게시글 번호</th>
					<td class="radius-right"><?php echo $result_info["board_no"] ?></td>
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
			<br>
			<br>
            <div class="button">
                <a href="board_list.php" class="button_a">목록</a>
                <button type="submit" class="button_a">수정</button>
				<a href="board_detail.php?board_no=<?php echo $result_info["board_no"] ?>" class="button_a">취소</a>
			</div>
		</div>
		<input type="hidden" name="board_no" value="<?php echo $result_info["board_no"] ?>">
</form>
</body>
</html>s