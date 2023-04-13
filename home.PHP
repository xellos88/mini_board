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
<html>
    <head>
        <meta charset="UTF-8">
        <title>MINI PROJECT</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="./static/font.css">
        <link rel="stylesheet" href="./static/layout.css">
        <link rel="stylesheet" href="./static/home.css">
    </head>
    <body>
        <div class="bookcover">
            <div class="bookdot">
                <div class="page">
                    <div class="column1">
                        <div class="visit"><span id="basic-text">TODAY <span id="TODAY">12</span> | TOTAL 12345</span></div>
                        <div class="profile">
                            <img class="profile-image" src="1./static/images/images.jpg">
                            <div class="profile-text"><div id="basic-text">@######<br>나무위키는 파라과이 소재의 Umanle S.R.L.이 운영하는 영리 목적의 위키 웹사이트이다</div></div>
                            <div class="profile-dropdown">
                                <div id="basic-text">(´◡`)</div>
                                <div class="dropdown">
                                    <select>
                                        <option value="padotagi">파도타기</option>
                                        <option value="comunity">커뮤니키 가기</option>
                                        <option value="instagram">인스타그램으로 가기</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column2">
                        <div class="top-text-box">
                            <div class="title"><div id="basic-text"> 미니홈피</div></div>
                            <div class="url"><div id="basic-text">http://WWW.NAVER.COM</div></div>
                        </div>
                        <div class="main-content">
                            <div class="upper-content">
                                <div id="bold-text">Updated News</div>
                                <hr> 
                                <div class="update-box">
                                    <div class="new-text">
                                        <div id="basic-text"><span id="photo">사진첩</span> aaaaaaaaaaaaaaaaaaaa</div>
                                        <div id="basic-text"><span id="board">게시판</span> bbbbbbbbbbbbbbbbbbbb</div> 
                                        <div id="basic-text"><span id="photo">사진첩</span> cccccccccccccccccccc</div>
                                        <div id="basic-text"><span id="board">게시판</span> dddddddddddddddddddd</div>
                                    </div>
                                    <div class="new-image-container">
                                        <img class="new-image" src="1./static/images/img.jpg">
                                        <img class="new-image" src="1./static/images/img2.jpg">
                                        <a href="#"><img class="plus-image" src="1./static/images/plus-image.jpg"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-content">
                                <div id="bold-text">BOARD MINI</div>
                                <hr>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>번호</th>
                                            <th>제목</th>
                                            <th>작성일</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach( $result_paging as $record)
                                            {
                                        ?>
                                            <tr>
                                                <td><?php echo $record["board_no"]?></td>
                                                <td><a href="board_detail.php?board_no=<?php echo $record["board_no"]?> "><?php echo $record["board_title"]?></a></td>
                                                <td><?php echo $record["board_write_date"]?></td>
                                            </tr>
                                        <?php        
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <button type="button" class="btn"><a href="board_insert.php">작성</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="menu">
                        <a href="#"><div class="menu-box">홈</div></a>
                        <a href="#"><div class="menu-box">다이어리</div></a>
                        <a href="#"><div class="menu-box">사진첩</div></a>
                        <a href="#"><div class="menu-box">방명록</div></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>