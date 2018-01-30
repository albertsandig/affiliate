SELECT 
	A.transaction_type_id,
	A.code,
	A.amount,
	A.duration,
	B.name AS advertisement_name,
	C.name AS currency_name,
	C.icon
FROM transaction_type AS A
INNER JOIN ads_type AS B
	USING (ads_type_id)
INNER JOIN currency_type AS C
	USING (currency_type_id)
	
	
	
CREATE PROCEDURE procedure_create_ads(
	this_code						VARCHAR(200),
	this_ad_type					INTEGER,
	this_currency_type			INTEGER,
	this_duration					INTEGER,	
	this_duration_unit			VARCHAR(200),
	this_url							VARCHAR(200),
	this_content					VARCHAR(200),
	this_amount						DOUBLE(20,2),
	this_user_no					INTEGER
) BEGIN

	SELECT 
		COUNT(A.code) > 0
	INTO @is_not_unique_code
	FROM transaction_type AS A
	WHERE A.code = this_code;
	
	IF @is_not_unique_code THEN
		SET @message_text =  concat('The code "', this_code, '" is aldready exist.');
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = @message_text;
	END IF;
	
	INSERT INTO transaction_type(
		code, 
		ads_type_id, 
		currency_type_id, 
		duration, 
		duration_unit, 
		amount, 
		url,
		content
	) VALUES (
		this_code		,		
	   this_ad_type			,
	   this_currency_type	,
	   this_duration			,
	   this_duration_unit	,
	   this_amount	,
		this_url		,
		this_content
	);
	
END;


CREATE PROCEDURE procedure_update_ads(
	this_id							INTEGER,
	this_code						VARCHAR(200),
	this_ad_type					INTEGER,
	this_currency_type			INTEGER,
	this_duration					INTEGER,	
	this_duration_unit			VARCHAR(200),
	this_url							VARCHAR(200),
	this_content					VARCHAR(200),
	this_amount						DOUBLE(20,2),
	this_user_no					INTEGER
) BEGIN

	SELECT 
		COUNT(A.code) > 1
	INTO @is_not_unique_code
	FROM transaction_type  AS A
	WHERE A.code = this_code;
	
	IF @is_not_unique_code THEN
		SET @message_text =  concat('The code "', this_code, '" is aldready exist.');
			SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = @message_text;
	END IF;
	
	UPDATE transaction_type AS A
	SET 
		code = this_code,		
	   ads_type_id = this_ad_type,
	   currency_type_id = this_currency_type,
		duration  = this_duration,
		duration_unit = this_duration_unit,
		amount = this_amount,
		url = this_url,
		content = this_content
	WHERE A.transaction_type_id = this_id;
	
END;