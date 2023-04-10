-- CREATE DATABASE board;
-- 
-- USE board;
-- 
-- CREATE TABLE board_info(
-- 	board_no INT PRIMARY KEY AUTO_INCREMENT NOT NULL
-- 	,board_title VARCHAR(100) NOT NULL
-- 	,board_contents VARCHAR(1000) NOT NULL
-- 	,board_write_date DATETIME NOT NULL
-- 	,board_del_flg CHAR(1) NOT NULL DEFAULT('0')
-- 	,board_del_date DATETIME
-- );
-- 
-- DESC board_info

INSERT INTO board_info(
	board_title 
	,board_contents
 	,board_write_date 
)
VALUES ('제목1','내용1',NOW()),('제목2','내용2',NOW()),('제목3','내용3',NOW()),('제목4','내용4',NOW())
		,('제목5','내용5',NOW()),('제목6','내용6',NOW()),('제목7','내용7',NOW()),('제목8','내용8',NOW())
		,('제목9','내용9',NOW()),('제목10','내용10',NOW());

SELECT * FROM board_info;
COMMIT;