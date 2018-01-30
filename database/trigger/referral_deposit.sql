CREATE TRIGGER trigger_referral_deposit_insert 
	AFTER INSERT ON referral_deposit
	FOR EACH ROW
	BEGIN
		SELECT 
			A.referedBy
		INTO @referedBy
		FROM refer AS A
		WHERE 
			A.refer_id = NEW.refer_id;
		
		SELECT 
			B.currency_type_id
		INTO @currency_type_id
		FROM deposit_transactions AS A
		INNER JOIN transaction_type AS B
			USING (transaction_type_id)
		WHERE A.transaction_id = NEW.transaction_id;
			
		UPDATE user_wallet AS A
		SET amount = A.amount + NEW.amount
		WHERE 
			A.user_no = @referedBy AND 
			A.currency_type_id = @currency_type_id;
	END;
	