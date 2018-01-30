SELECT
	A.transaction_type_id,
	A.code,
	COALESCE(B.type_count,0) as code_count
FROM transaction_type AS A
LEFT JOIN (
	SELECT 	A.transaction_type_id,
				COUNT(A.transaction_id) AS type_count
	FROM deposit_transactions AS A
	GROUP BY A.transaction_type_id
) AS B
	USING (transaction_type_id)
ORDER BY A.transaction_type_id

---------------------------------

SELECT 
	A.code,
	COALESCE(COUNT(B.transaction_id),0) as code_count
FROM transaction_type AS A
LEFT JOIN deposit_transactions AS B
	USING (transaction_type_id)
GROUP BY A.code
ORDER BY A.transaction_type_id

---------------------------------

SELECT 
	CAST(A.deposit_date AS DATE) as deposit_date,
	COALESCE(COUNT(A.transaction_id),0) as code_count
FROM deposit_transactions AS A
GROUP BY CAST(A.deposit_date AS DATE)
ORDER BY A.deposit_date DESC

---------------DEPOSIT DATE IN A WEEK------------



SELECT 
	CAST(A.deposit_date AS DATE) AS deposit_date,
	count(CASE WHEN B.ads_type_id = 1 then 1 END) AS LAZADA,
	count(CASE WHEN B.ads_type_id = 2 then 1 END) AS PROPELLER
FROM deposit_transactions AS A
INNER JOIN transaction_type AS B
	USING (transaction_type_id)
WHERE 
	A.deposit_date BETWEEN (CURRENT_DATE - INTERVAL 8 DAY) AND (CURRENT_DATE + INTERVAL 1 DAY)
GROUP BY CAST(A.deposit_date AS DATE)
ORDER BY A.deposit_date;
------------------------------------------------GET Days in a week


SELECT 
	A._day,
	COALESCE(B.deposit_date, (CURRENT_DATE - INTERVAL (A._day-1) DAY)) AS deposit_date
FROM days AS A
LEFT JOIN (
SELECT 
	DISTINCT CAST(A.deposit_date AS DATE) AS deposit_date,
	CURRENT_DATE - CAST(A.deposit_date AS DATE) + 1 AS num
FROM deposit_transactions AS A
WHERE
	A.deposit_date BETWEEN (CURRENT_DATE - INTERVAL 8 DAY) AND (CURRENT_DATE + INTERVAL 1 DAY)
) AS B ON A._day = B.num



--------------------------REPORT BY WEEK--------------------------


EXPLAIN
SELECT 
	COALESCE(B.deposit_date, (CURRENT_DATE - INTERVAL (A._day-1) DAY)) AS deposit_date,
	COALESCE(B.LAZADA,0) AS LAZADA,
	COALESCE(B.PROPELLER,0) AS PROPELLER
FROM days AS A
LEFT JOIN (
	SELECT 
		CAST(A.deposit_date AS DATE) AS deposit_date,
		count(CASE WHEN B.ads_type_id = 1 then 1 END) AS LAZADA,
		count(CASE WHEN B.ads_type_id = 2 then 1 END) AS PROPELLER,
		CURRENT_DATE - CAST(A.deposit_date AS DATE) + 1 AS num
	FROM deposit_transactions AS A
	INNER JOIN transaction_type AS B
		USING (transaction_type_id)
	WHERE 
		A.deposit_date BETWEEN (CURRENT_DATE - INTERVAL 8 DAY) AND (CURRENT_DATE + INTERVAL 1 DAY)
	GROUP BY CAST(A.deposit_date AS DATE)
) AS B ON A._day = B.num
ORDER BY A._day DESC


EXPLAIN
SELECT 
	A.deposit_date,
	COALESCE(B.LAZADA,0) AS LAZADA,
	COALESCE(B.PROPELLER,0) AS PROPELLER
FROM (
	SELECT 
		CURRENT_DATE - INTERVAL (A._day-1) DAY AS deposit_date
	FROM days AS A
) AS A 
LEFT JOIN (
	SELECT 
		CAST(A.deposit_date AS DATE) AS deposit_date,
		count(CASE WHEN B.ads_type_id = 1 then 1 END) AS LAZADA,
		count(CASE WHEN B.ads_type_id = 2 then 1 END) AS PROPELLER
	FROM deposit_transactions AS A
	INNER JOIN transaction_type AS B
		USING (transaction_type_id)
	WHERE 
		A.deposit_date BETWEEN (CURRENT_DATE - INTERVAL 8 DAY) AND (CURRENT_DATE + INTERVAL 1 DAY)
	GROUP BY CAST(A.deposit_date AS DATE)
) AS B
	USING (deposit_date)
	ORDER BY A.deposit_date

---- BETTER
EXPLAIN
SELECT 
	(CURRENT_DATE - INTERVAL (A._day-1) DAY) AS deposit_date,
	COALESCE(COUNT(CASE WHEN B.ads_type_id = 1 then 1 END),0) AS LAZADA,
	COALESCE(COUNT(CASE WHEN B.ads_type_id = 2 then 1 END),0) AS PROPELLER
FROM days AS A
LEFT JOIN (
	SELECT 
		CURRENT_DATE - CAST(A.deposit_date AS DATE) + 1 AS num,
		B.ads_type_id
	FROM deposit_transactions AS A
	INNER JOIN transaction_type AS B
		USING (transaction_type_id)
	WHERE 
		A.deposit_date BETWEEN (CURRENT_DATE - INTERVAL 8 DAY) AND (CURRENT_DATE + INTERVAL 1 DAY)
) AS B ON A._day = B.num
GROUP BY A._day
ORDER BY A._day DESC


 