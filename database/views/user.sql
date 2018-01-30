CREATE VIEW view_user_info AS
	SELECT 
		A.user_no		,		
		CONCAT(B.firstname," ", B.lastname) AS fullname, 
	   B.age				,
	   B.birthday		,	
	   B.gender			,
	   B.address		,	
	   B.mobile_number,	
	   B.img_source	,	
	   B.verify			,
	   B.create_date	,	
	   B.php_money		,
	   B.points			,
	   B.peso_address	,
		CONCAT(B.firstname, B.lastname, B.mobile_number) AS search_text		
	FROM user_credential AS A
	INNER JOIN user_info AS B
		USING (user_no);
		
-- SAMPLE
SELECT 
	A.user_no,
	A.fullname
FROM view_user_info As A
WHERE MATCH (A.search_text) AGAINST ('gwapo')


SELECT 
	CONCAT(A.firstname," ", A.lastname) AS fullname
FROM user_info AS A
WHERE MATCH  (A.firstname, A.lastname,A.address) AGAINST ('gwapo' )

SELECT 
	A.name
FROM names AS A
WHERE MATCH  (A.name) AGAINST ('+Finch' )
	