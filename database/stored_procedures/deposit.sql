/* DEPOSIT */
CREATE PROCEDURE procedure_deposit_ads(
	IN this_user_no			INTEGER,
	IN this_trasaction_code VARCHAR(100)
) BEGIN
	SELECT 	transaction_type_id,
				amount,
				currency_type_id,
				duration,
				duration_unit
	INTO 	@id, @amount, @currency_id	,@time_duration, @unit
	FROM transaction_type
	WHERE code = this_trasaction_code;
	
	/*	CHECK IF USER ALREADY CLAIM */
	SELECT count(A.transaction_id) > 0
	INTO @is_already_claimed
	FROM deposit_transactions AS A
	INNER JOIN transaction_type AS B
		USING(transaction_type_id)
	WHERE  A.user_no = this_user_no AND
			 A.end_time >= CURRENT_TIMESTAMP AND 
			 B.transaction_type_id = @id;
			 
	IF @id IS NULL THEN
		SET @message_text =  concat(this_trasaction_code,' code does not exist.');
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = @message_text;
	END IF;
			 
	IF @is_already_claimed THEN
		SET @message_text =  concat('You already claim in this ad please wait for ', @time_duration, ' ', @unit,'(s)');
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = @message_text;
	END IF;
	
	INSERT INTO deposit_transactions(
		user_no					,
		transaction_type_id	,
		end_time	
	)VALUES(
		this_user_no,
		@id,
		CASE @unit
			WHEN 'MINUTE' THEN
				CURRENT_TIMESTAMP + INTERVAL @time_duration MINUTE
			ELSE
				CURRENT_TIMESTAMP + INTERVAL @time_duration SECOND
		END 
	);	
	
	SELECT A.content
	FROM transaction_type AS A
	WHERE A.transaction_type_id = @id;
	
END;



