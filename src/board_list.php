<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
    define( "URL_HEADER", DOC_ROOT."mini_board/src/board_header.php" );
    include_once( URL_DB );

    if(array_key_exists("page_num",$_GET))
    {
        $page_num = $_GET["page_num"];
    }
    else
    {
        $page_num = 1;
    }

    $limit_num = 5;

    // $page_num = $arr_get["page_num"];
    //게시판 정보 테이블 전체 카운트 획득
    $result_cnt = select_board_info_cnt();

    //max page number
    $max_page_num =ceil((int)$result_cnt[0]["cnt"]/$limit_num );

    //offset
    $offset =($page_num*$limit_num)-$limit_num;


    $arr_prepare = 
    array(
        "limit_num" => $limit_num
        ,"offset"   => $offset
    );
    $result_paging = select_board_info_paging( $arr_prepare );
    $result_cnt = select_board_info_cnt();
    // print_r ( $result_cnt );
    // print_r( $max_page_num );

    $last_page_num=6;
?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/common/board_css.css">
    <title>게시판</title>
    <style>
</style>

</head>
<body>
<?php include ( URL_HEADER ); ?>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성일</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach( $result_paging as $recode)
                {
            ?>
                <tr>
                    <td><?php echo $recode["board_no"]?></td>
                    <td><a href="board_detail.php?board_no=<?php echo $recode["board_no"]?> "><?php echo $recode["board_title"]?></a></td>
                    <td><?php echo $recode["board_write_date"]?></td>
                </tr>
            <?php        
                }
            ?>    
        </tbody>

    </table>
    <button type="button"><a href="board_insert.php">게시글 작성</button>

        <nav aria-label="Page navigation example">
        <ul class="pagination">
        <li class="page-item">
        <a class="page-link" href="board_list.php?page_num=1" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <?php
        for ($i = 1; $i <= $max_page_num; $i++) {
        ?>
        <li class="page-item"><a class="page-link" href="board_list.php?page_num=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php
        }
        ?>
        <li class="page-item">
        <a class="page-link" href="board_list.php?page_num=<?php echo $last_page_num ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
    </nav>

</html>