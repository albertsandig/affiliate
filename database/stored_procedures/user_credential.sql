CREATE PROCEDURE procedure_logout_user(
	IN 	this_user_no INTEGER
) BEGIN
	
	UPDATE user_info AS A
	SET is_online = FALSE
	WHERE 
		A.user_no = this_user_no;
	
END;

CREATE PROCEDURE procedure_login_user(
	IN 	this_email VARCHAR(100),
	IN		this_password VARCHAR(100)
) BEGIN
	
	UPDATE user_info AS A
	SET is_online = TRUE
	WHERE 
		UPPER(A.email) = UPPER (this_email) AND
		A.password = md5(this_password); 
	
	SELECT  	A.user_no,
				A.email,
				A.type_no,
				B.name AS user_type,
				CONCAT(A.firstname, " ",  A.lastname) AS name,
				A.img_source AS profile_pic
	FROM user_info AS A
	INNER JOIN user_type AS B
		USING (type_no)
	WHERE 
		UPPER(A.email) = UPPER (this_email) AND
		A.password = md5(this_password);
END;


CREATE PROCEDURE procedure_check_email(
	IN 	this_email VARCHAR(100),
	OUT	is_email_already_exist BOOLEAN
) BEGIN

	SELECT count(A.email) > 0 INTO is_email_already_exist
	FROM user_info AS A
	WHERE UPPER(A.email) = UPPER (this_email);
	
END;


CREATE PROCEDURE procedure_refer(
	this_referred_by 	INT,
	this_user_no 		INT
) BEGIN
	SELECT COUNT(A.user_no) > 0
	INTO	@referedBy_id
	FROM user_info AS A
	WHERE user_no = this_referred_by;

	IF @referedBy_id THEN
		INSERT INTO refer(
			referedBy,
			user_no	
		) VALUES(
			@referedBy_id,
			this_user_no
		);
	END IF; 
	
END;

CREATE PROCEDURE procedure_create_user_registration(
	this_refereral 	INT,
	this_email 			VARCHAR(100),
	this_password 		VARCHAR(50),
	this_firstname 	VARCHAR(100),
	this_lastname 		VARCHAR(100),
	this_gender 		VARCHAR(100),
	this_address 		VARCHAR(200),
	this_mobile_no 	VARCHAR(100),
	this_birthdate 	DATE,
	this_user_type_no INT
) BEGIN
	
	SELECT COUNT(user_no)
	INTO @limit_member
	FROM user_info;
	
	IF @limit_member > 101 THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'The number of members in our site already exceed on its limit. You cannot register for now.';
	END IF;
	
	CALL	procedure_check_email(
		this_email,
		@is_email_already_exist
	);
	
	-- CHECK IF USER ALREADY EXIST
	IF @is_email_already_exist THEN
		 SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Email already exist.';
	END IF;
	
	-- INSERT USER INFORMATION
	INSERT INTO user_info(
		email,
		password,
		type_no,
		firstname,
		lastname,
		gender,
		address,
		mobile_number,
		birthday
	) VALUES (
		this_email,
		MD5(this_password),
		this_user_type_no,
		this_firstname,
		this_lastname,
		this_gender,
		this_address,
		this_mobile_no,
		this_birthdate
	);
	
	SELECT user_no
	INTO @this_user_no
	FROM user_info
	WHERE email = this_email;
	
	INSERT INTO user_wallet(
		user_no					,
		currency_type_id		
	) VALUES
	(@this_user_no ,1),
	(@this_user_no ,2);
	
	CALL procedure_refer(
		this_refereral,
		@this_user_no
	);
	
END;


