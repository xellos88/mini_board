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

    $last_page_num=6;
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

    .h1{
        font-size: 60px;
        text-align: center;
        vertical-align: middle;   
    }

    .menu-bar {
    background-color: #000000;
    display: flex;
    justify-content: space-between;
    box-sizing: border-box;
    }
    .item {
    color: white;
    background-color: transparent;
    font-size: 18px;
    display: inline-block;
    box-sizing: border-box;
    padding: 14px 20px;
    }
    .item.title {
    font-weight: 600;
    }
    .item:hover {
    background-color: rgba(0, 0, 0, 0.1);
    }
    .pagination{
        text-align: center;
        vertical-align: middle;
    }

    table {
    border-collapse: collapse;
    border-spacing: 0;
    text-align: center;
    vertical-align: middle;
    }
    section.notice {
    padding: 80px 0;
    }

    .page-title {
    margin-bottom: 60px;
    }
    .page-title h1 {
    font-size: 40px;
    color: #333333;
    font-weight: 400;
    text-align: center;
    }

    #board-search .search-window {
    padding: 15px 0;
    background-color: #f9f7f9;
    }
    #board-search .search-window .search-wrap {
    position: relative;
    /*   padding-right: 124px; */
    margin: 0 auto;
    width: 80%;
    max-width: 564px;
    }
    #board-search .search-window .search-wrap input {
    height: 40px;
    width: 100%;
    font-size: 14px;
    padding: 7px 14px;
    border: 1px solid #ccc;
    }
    #board-search .search-window .search-wrap input:focus {
    border-color: #333;
    outline: 0;
    border-width: 1px;
    }
    #board-search .search-window .search-wrap .btn {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 108px;
    padding: 0;
    font-size: 16px;
    }

    .board-table {
    font-size: 13px;
    width: 100%;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
    }

    .board-table a {
    color: #333;
    display: inline-block;
    line-height: 1.4;
    word-break: break-all;
    vertical-align: middle;
    }
    .board-table a:hover {
    text-decoration: underline;
    }
    .board-table th {
    text-align: center;
    }

    .board-table .th-num {
    width: 100px;
    text-align: center;
    }

    .board-table .th-date {
    width: 200px;
    }

    .board-table th, .board-table td {
    padding: 14px 0;
    }

    .board-table tbody td {
    border-top: 1px solid #e7e7e7;
    text-align: center;
    }

    .board-table tbody th {
    padding-left: 28px;
    padding-right: 14px;
    border-top: 1px solid #e7e7e7;
    text-align: left;
    }

    .board-table tbody th p{
    display: none;
    }

    .btn {
    display: inline-block;
    padding: 0 30px;
    font-size: 15px;
    font-weight: 400;
    background: transparent;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    text-transform: uppercase;
    -webkit-border-radius: 0;
    -moz-border-radius: 0;
    border-radius: 0;
    -webkit-transition: all 0.3s;
    -moz-transition: all 0.3s;
    -ms-transition: all 0.3s;
    -o-transition: all 0.3s;
    transition: all 0.3s;
    }

    .btn-dark {
    background: #555;
    color: #fff;
    }

    .btn-dark:hover, .btn-dark:focus {
    background: #373737;
    border-color: #373737;
    color: #fff;
    }

    .btn-dark {
    background: #555;
    color: #fff;
    }

    .btn-dark:hover, .btn-dark:focus {
    background: #373737;
    border-color: #373737;
    color: #fff;
    }

    /* reset */

    * {
    list-style: none;
    text-decoration: none;
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    }
    .clearfix:after {
    content: '';
    display: block;
    clear: both;
    }
    .container {
    width: 1100px;
    margin: 0 auto;
    }
    .blind {
    position: absolute;
    overflow: hidden;
    clip: rect(0 0 0 0);
    margin: -1px;
    width: 1px;
    height: 1px;
    }


</style>

</head>
<body>
<section class="notice">
    <div class="page-title">
        <div class="container">
            <h1>자유게시판</h1>
        </div>
    </div>

    <!-- board seach area -->
    <div id="board-search">
        <div class="container">
            <div class="search-window">
                <form action="">
                    <div class="search-wrap">
                        <label for="search" class="blind">내용 검색</label>
                        <input id="search" type="search" name="" placeholder="검색어를 입력해주세요." value="">
                        <button type="submit" class="btn btn-dark">검색</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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