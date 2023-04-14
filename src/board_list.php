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

	$result_cnt = select_board_info_cnt();

	// max page number
	$max_page_num = ceil( (int)$result_cnt[0]["cnt"] / $limit_num );

	// offset
	$offset = ( $page_num * $limit_num ) - $limit_num;

	$arr_prepare =
		array(
			"limit_num"	=> $limit_num
			,"offset"	=> $offset
		);

	// 페이징용 데이터 검색
	$result_paging = select_board_info_paging( $arr_prepare );

	$prev_page_num = $page_num - 1 > 0 ? $page_num - 1 : 1;
	$next_page_num = $page_num + 1 > $max_page_num ? $max_page_num : $page_num + 1;
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./common/board_css.css">
    <title>board_list</title>
</head>
<body>
	<?php include_once( URL_HEADER ) ?>
	<div class="container">
		<div class="button_i">
			<a href="board_insert.php" class="button_a_b radius-right radius-left">게시글 작성</a>
		</div>
		<table class='table-striped'>
			<thead>
				<tr>
					<th class="radius-left">게시글 번호</th>
					<th>게시글 제목</th>
					<th class="radius-right">작성일자</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach( $result_paging as $recode )
					{
				?>
						<tr>
							<td class="radius-left"><?php echo $recode["board_no"] ?></td>
							<td class=""><a href="board_detail.php?board_no=<?php echo $recode["board_no"] ?>"><?php echo $recode["board_title"] ?></a></td>
							<td class="radius-right"><?php echo $recode["board_write_date"] ?></td>
						</tr> 
				<?php
					}
				?>
			</tbody>
		</table>

		<!-- 페이징 번호 -->
		<div class="button">
			<a href="board_list.php?page_num=<?php echo $prev_page_num ?>" class="button_a"><<</a>
		<?php
			for( $i = 1; $i <= $max_page_num; $i++ )
			{
		?>
				<a href="board_list.php?page_num=<?php echo $i ?>" class="button_a"><?php echo $i ?></a>
		<?php
			}
		?>
			<a href="board_list.php?page_num=<?php echo $next_page_num ?>" class="button_a">>></a>
		</div>
	</div>
</body>
</html>