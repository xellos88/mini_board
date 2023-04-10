<?php
    define( "DOC_ROOT", $_SERVER["DOCUMENT_ROOT"]."/" );
    define( "URL_DB", DOC_ROOT."mini_board/src/common/db_common.php" );
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
?>



<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>게시판</title>

    <style>
    .pagination-link {
        display: inline-block;
        padding: 6px 12px;
        margin-bottom: 0;
        font-size: 15px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        background-color: #fff;
        border: 1px solid #808080;
        border-radius: 4px;
    }
    .pagination-link:hover {
        background-color: #eee;
    }
</style>

</head>
<body>
    <table class='table table-hover'>
        <thead>
            <tr>
                <th>게시글 번호</th>
                <th>게시글 제목</th>
                <th>작성일자</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach( $result_paging as $recode)
                {
            ?>
                <tr>
                <td><?php echo $recode["board_no"]?></td>
                <td><?php echo $recode["board_title"]?></td>
                <td><?php echo $recode["board_write_date"]?></td>
                </tr>
            <?php        
                }
            ?>    
        </tbody>
    </table>
    <?php
        for ( $i = 1; $i <=$max_page_num; $i++) 
        {
        ?>
            <a href='board_list.php?page_num=<?php echo $i?>' class='pagination-link'><?php echo $i ?></a>

        <?php
        }
        ?>

</body>
</html>