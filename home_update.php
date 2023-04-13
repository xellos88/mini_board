<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."mini_board/src/board_header.php" );
    include_once( URL_DB );

//requst method 획득
$http_method = $_SERVER["REQUEST_METHOD"];    

//GET 체크
if( $http_method ==="GET"){
    $board_no = 1;
    if(array_key_exists( "board_no" , $_GET))
    {
        $board_no = $_GET["board_no"];
    }
    $result_info = select_board_info_no( $board_no );
}
//POST일때
else
{
    $arr_post=$_POST;
    $arr_info=
    array(
        "board_no"=>$arr_post["board_no"]
        ,"board_title"=>$arr_post["board_title"]
        ,"board_contents"=>$arr_post["board_contents"]
    );
    //update
    $result_cnt = update_board_info_no( $arr_info );
    // $result_i
    header( "Location: board_detail.php?board_no=".$arr_post["board_no"] );
    exit(); //   redirect 했기 때문에 이후의 소스코드는 실행할 필요가 없다.위에행에서 nfo = select_board_info_no( $arr_post["board_no"] ); // 0412 del
    }

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
    <style>

    a.btn{
        display:block;
        width:80px;
        line-height:30px;
        text-align:center;
        background-color:#222;
        color:#fff;
    }
    
    button.btn{
        width:80px;
        height:30px;
        border:none;
        background-color:#222;
        color:#fff;
    }
    
    </style>
</head>
<body>
<?php include ( URL_HEADER ); ?>
    <form method="post" action="board_update.php">
        <label for ="bno">게시글 번호 : </label>
        <input type="text" name="board_no" id="bno" value="<?php echo $result_info['board_no']?>" readonly>
        <br>
        <label for ="title">게시글 제목 : </label>
        <input type="text" name="board_title" id="title" value="<?php echo $result_info['board_title']?>" >
        <br>
        <label for="contents">게시글 내용 :</label>
        <input type="text" name="board_contents" id="contents"value="<?php echo $result_info['board_contents']?>" >
        <br>
        <button type='sumit' class="btn">수정</button>
        <button type='button' class="btn"><a href="board_detail.php?board_no=<?php echo $result_info["board_no"]; ?>">취소</a></button>
    </form>
    <button type='button' class="btn">리스트</a></button>    
</body>
</html>