/* DEPOSIT MINES */
CREATE PROCEDURE procedure_miner_deposit(
	IN this_user_no				INTEGER,
	IN this_amount 				double(20,2),
	IN this_currency_type_id	INTEGER
) BEGIN
	INSERT INTO miner_deposit(
		user_no	,				
		amount	,				
		currency_type_id		
	)VALUES(
		this_user_no,
		this_amount,
		this_currency_type_id
	);	
END;



