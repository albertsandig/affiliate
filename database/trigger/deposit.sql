/*
	Remarks:
		Update the new value
*/	

CREATE TRIGGER trigger_deposit_ads_insert
	AFTER INSERT ON deposit_transactions
	FOR EACH ROW
	BEGIN
		SELECT 
			A.amount,
			A.currency_type_id
		INTO @amount,@currency_type_id
		FROM transaction_type AS A
		WHERE 
			A.transaction_type_id = NEW.transaction_type_id;
			
		UPDATE user_wallet AS A
		SET amount = A.amount + @amount
		WHERE 
			A.user_no = NEW.user_no AND 
			A.currency_type_id = @currency_type_id;
			
		
		/* Check referral */
		SELECT 
			COUNT(A.referedBy),A.refer_id
		INTO @has_referral,@refeId
		FROM refer AS A
		WHERE A.user_no = NEW.user_no;
		
		IF @has_referral > 0 THEN
			INSERT INTO referral_deposit(
				refer_id,		-- referredBy		
				amount,				
				transaction_id		
			) VALUES (
				@refeId ,
				(@amount * 0.10),
				NEW.transaction_id
			);
		END IF;
		
	END;