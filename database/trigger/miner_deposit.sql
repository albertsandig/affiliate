/*
	Remarks:
		Update the new value
*/	

CREATE TRIGGER trigger_miner_deposit_insert
	AFTER INSERT ON miner_deposit
	FOR EACH ROW
	BEGIN
		UPDATE user_wallet AS A
		SET amount = A.amount + NEW.amount
		WHERE 
			A.user_no = NEW.user_no AND 
			A.currency_type_id = NEW.currency_type_id;
	END;