CREATE PROCEDURE procedure_request_withdrawal(
	this_user_no			INTEGER,
	this_amount			 	DOUBLE(20,2)
) BEGIN
	SELECT
		A.peso_address,
		A.verify
	INTO @address, @verify
	FROM user_info AS A
	WHERE A.user_no = this_user_no;
	
	SELECT 
		A.amount
	INTO @amount
	FROM user_wallet AS A
	WHERE A.currency_type_id = 1 AND
			A.user_no = this_user_no;
	
	IF NOT @verify THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Your account is not yet verified. Please verfiy your email address first.';			
	END IF;
	
	IF this_amount < 1000 THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Amount must be at least 1000 pesos.';			
	END IF;
	
	IF @amount < this_amount THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Balance must be greater the requested amount.';			
	END IF;
	
	IF @address = '' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Empty address';			
	END IF;
	
	INSERT INTO withdrawal_transaction(
		user_no,			
		status,			
		amount,
		peso_address
	)	VALUES(
		this_user_no,
		'PENDING',
		this_amount,
		@address
	);
	
	UPDATE user_wallet AS A
	SET	amount = A.amount - this_amount
	WHERE A.currency_type_id = 1 AND
			A.user_no = this_user_no;
	
END;

CREATE PROCEDURE procedure_approve_withdrawal(
	this_withdrawal_transaction_id	INTEGER,
	this_reference_id						VARCHAR(200)
)	BEGIN

	SELECT 	A.status
	INTO @w_status
	FROM	withdrawal_transaction AS A
	WHERE	
		A.withdrawal_transaction_id = this_withdrawal_transaction_id;
		
	IF @w_status <> 'PENDING' THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Transaction is not pending.';		
	ELSE 
		UPDATE withdrawal_transaction
		SET 	status = 'APPROVED',
				reference_id = this_reference_id,
				approve_date = CURRENT_TIMESTAMP
		WHERE withdrawal_transaction_id = this_withdrawal_transaction_id;
		
	END IF;
	
END;

