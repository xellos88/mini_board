CREATE TABLE test_member (
	mem_no		INT(11) PRIMARY KEY
	,mem_name	VARCHAR(50)
);

SELECT *
from test_member;

INSERT INTO test_member(

mem_name)
VALUES
('김미현');

INSERT INTO test_member(
mem_name)
VALUES
('박상준');

DELETE
FROM test_member
WHERE mem_no = 2;


ALTER TABLE test_member MODIFY mem_no INT(11) AUTO_INCREMENT;
ALTER TABLE test_member AUTO_INCREMENT = 10;

SELECT *
FROM employees
WHERE last_name = 'Swan';

SHOW INDEX FROM employees;


CREATE INDEX idx_employees_last_name ON employees(last_name);

DROP INDEX idx_employees_last_name ON employees;
