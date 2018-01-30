
/*
	testing: 
	
	CALL	procedure_raffle_insert(
		'OE721FAAAYLYETANPH-74396431',
		'https://ph-live-03.slatic.net/p/7/guduzhe-outdoor-thin-plus-sized-waterproof-jacket-i-coat-female-rose-1510920369-71313185-90d713a3a8ddf76ed74f86ab130140a0-webp-zoom_850x850.jpg',
		'Guduzhe outdoor thin Plus-sized waterproof jacket I coat (Female rose)',
		'New style on the new Shishang popular brand color multi-selection
		Make : Guduzhe
		The mall celebrity inspired : No
		Item No. : 12338 ##
		Listing time : Summer2017
		CHANTI : China
		Tag price : 299
		Applicable objects : Unisex
		Fabric Technology : Other
		The main function : Waterproof
		The main function : Windproof
		The main function : Wear-Resistant
		The main function : Quick-drying
		Price Range : 201-500 yuan
		Material : Other
		Product Series : Outdoor casual I
		Suitable for Season : Spring
		Suitable for Season : Autumn
		Suitable for Season : Summer
		Suitable for Season : Four Seasons
		Clothing long : Regular
		',
		5,
		'2018-01-31',
		1
	)
*/

CREATE PROCEDURE procedure_raffle_insert(
	this_code					varchar(200),
	this_image					text,
	this_prize					varchar(200),
	this_description			text,
	this_max_winner			int,
	this_raffle_draw			timestamp,
	this_created_by			int
) BEGIN
	
	SELECT COUNT(A.code) > 0
	INTO @is_unique
	FROM raffle AS A
	WHERE A.code = this_code;
	
	IF @is_unique  THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Code is already exist.';
	END IF;
	
	INSERT INTO raffle(
		code,					
		image	,				
		prize	,				
		description	,		
		max_winner	,		
		raffle_draw	,
		created_by		
	) VALUES (
		this_code	,		
		this_image		,	
		this_prize		,	
		this_description	,
		this_max_winner	,
		this_raffle_draw	,
		this_created_by	
	);
END;

/*
	test:
	CALL	procedure_raffle_update(
		1,
		'OE721FAAAYLYETANPH-74396431',
		'https://ph-live-03.slatic.net/p/7/guduzhe-outdoor-thin-plus-sized-waterproof-jacket-i-coat-female-rose-1510920369-71313185-90d713a3a8ddf76ed74f86ab130140a0-webp-zoom_850x850.jpg',
		'Guduzhe outdoor thin Plus-sized waterproof jacket I coat (Female rose)',
		'Nothing to show',
		3,
		'2018-01-24'
	)
*/
CREATE PROCEDURE procedure_raffle_update(
	this_raffle_id				int(200),
	this_code					varchar(200),
	this_image					text,
	this_prize					varchar(200),
	this_description			text,
	this_max_winner			int,
	this_raffle_draw			timestamp
) BEGIN
	
	SELECT COUNT(A.code) > 0
	INTO @is_unique
	FROM raffle AS A
	WHERE A.code = this_code AND
			A.raffle_id <> this_raffle_id;
	
	IF @is_unique THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Code is already exist.';
	END IF;
	
	SELECT A.raffle_draw
	INTO @raffle_draw
	FROM raffle AS A
	WHERE A.raffle_id = this_raffle_id;
	
	IF @raffle_draw <= CURRENT_TIMESTAMP  THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Cannot update raffle. Raffle has already ended';
	END IF;
	
	IF this_raffle_draw <= CURRENT_TIMESTAMP  THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Raffle cannot be update into done state. Please change raffle date.';
	END IF;
	
	UPDATE raffle AS A
	SET 
		code = this_code,					
		image	= this_image,				
		prize	= this_prize,				
		description	= this_description,		
		max_winner = this_max_winner,		
		raffle_draw = this_raffle_draw,
		date_updated = CURRENT_TIMESTAMP
	WHERE 
		A.raffle_id = this_raffle_id;
		
END;


/*
	test: 
	
	CALL procedure_participate_raffle(
		'OE721FAAAYLYETANPH-74396431',
		'Albert',
		'Sandig',
		'https://www.facebook.com/darkvader123',
		'albert_sandig1@gmail.com'
	);
*/

CREATE PROCEDURE procedure_participate_raffle(
	this_code					varchar(200),
	this_fname					varchar(200),
	this_lname					varchar(200),
	this_fb_profile			text,
	this_email_address		varchar(200)
) BEGIN
	
	SELECT 	COUNT(A.raffle_id),
				A.raffle_id,
				A.raffle_draw
	INTO @is_exist,@raffle_id,@raffle_draw
	FROM raffle AS A
	WHERE A.code = this_code;
	
	IF @is_exist = 0 THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Code does not exist.';
	END IF;
	
	IF @raffle_draw <  CURRENT_TIMESTAMP THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'The raffle has already ended.';
	END IF;
	
	INSERT INTO raffle_participant(
		raffle_id		,
		fname				,
		lname				,
		fb_profile		,
		email_address	
	) VALUES (
		@raffle_id	,		
		this_fname	,
		this_lname		,		
		this_fb_profile	,	
		this_email_address	
	);
	
END;

/*
	test :
	
	CALL procedure_raffle_winner(1);
	
*/
CREATE PROCEDURE procedure_raffle_winner(
	this_p_no			int(200)
) BEGIN
	
	SELECT COUNT(A.raffle_id),B.raffle_draw,B.max_winner
	INTO @is_exist, @raffle_draw, @max_winner
	FROM raffle_participant AS A
	INNER JOIN raffle AS B
		USING (raffle_id)
	WHERE A.p_no = this_p_no ;
	
	IF @is_exist = 0 THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Code or Participant does not exist.';
	END IF;
	
	IF @raffle_draw > CURRENT_TIMESTAMP THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'The raffle is still ongoing.';
	END IF;
	
	
	SELECT COUNT(C.p_no)
	INTO @no_of_winner
	FROM raffle  AS A
	INNER JOIN raffle_participant AS B
		USING (raffle_id)
	INNER JOIN raffle_winner AS C
		USING (p_no);
	
	IF @max_winner <=  @no_of_winner THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Already reached the maximum winners.';
	END IF;
	
	INSERT INTO raffle_winner(
		p_no		
	) VALUES (
		this_p_no
	);
	
END;
