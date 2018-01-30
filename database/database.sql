CREATE TABLE user_type(
	type_no	int(11) NOT NULL AUTO_INCREMENT,
	name 		varchar(40) NOT NULL UNIQUE,
	PRIMARY KEY (type_no)
); 


CREATE TABLE user_info (
	/* CREDENTIALS */
	user_no			int NOT NULL AUTO_INCREMENT,
	email 			varchar(40) NOT NULL UNIQUE,
	password 		varchar(40) NOT NULL ,
	type_no 			int(11) NOT NULL,
	/* USER INFORMATION*/
	firstname		varchar(100),
	lastname			varchar(100),
	age				int,
	birthday			date,
	gender			varchar(10),
	address			varchar(100),
	mobile_number	varchar(20),
	img_source		text,
	peso_address	varchar(200) UNIQUE,
	create_date		timestamp DEFAULT CURRENT_TIMESTAMP,
	is_online		boolean DEFAULT FALSE,
	verify			boolean DEFAULT FALSE,
	FOREIGN KEY (type_no) REFERENCES user_type(type_no),
	PRIMARY KEY (user_no)
);

ALTER TABLE user_info ADD FULLTEXT (email,firstname, lastname,address,mobile_number);

/* USER WALLER */

CREATE TABLE currency_type(
	currency_type_id		int(11) NOT NULL AUTO_INCREMENT,
	name						varchar(20),	-- PHP, DOLLAR,TOKEN,POINTS
	icon						text,
	PRIMARY KEY (currency_type_id)
);

CREATE TABLE user_wallet(
	user_no					int NOT NULL,
	currency_type_id		int NOT NULL,
	amount					double NOT NULL DEFAULT 0.00,
	FOREIGN KEY (currency_type_id) REFERENCES currency_type(currency_type_id),
	FOREIGN KEY (user_no) REFERENCES user_info(user_no)
);

/* TRANSACTION */

CREATE TABLE ads_type(
	ads_type_id				int(11) NOT NULL AUTO_INCREMENT,
	name						varchar(50) NOT NULL UNIQUE, -- LAZADA and PROPELLER
	PRIMARY KEY (ads_type_id)
); 

CREATE TABLE transaction_type(
	transaction_type_id	int(11) NOT NULL AUTO_INCREMENT,
	code						varchar(20) NOT NULL UNIQUE, -- REWARD-S,REWARD-M, QUIZ, LA-ADS, PRO-ADS, SHO-ADS
	ads_type_id				int(11) NOT NULL,
	currency_type_id		int(11) NOT NULL,
	duration					int(11),
	duration_unit			varchar(20),
	amount					double,
	url						varchar(500),
	content					text, 
	FOREIGN KEY (currency_type_id) REFERENCES currency_type(currency_type_id),
	FOREIGN KEY (ads_type_id) REFERENCES ads_type(ads_type_id),
	PRIMARY KEY (transaction_type_id)
);

CREATE TABLE deposit_transactions(
	transaction_id			int(200) NOT NULL AUTO_INCREMENT,
	user_no					int(200) NOT NULL,
	transaction_type_id	int(11),
	deposit_date			timestamp DEFAULT CURRENT_TIMESTAMP,
	end_time					timestamp,-- DEFAULT (CURRENT_TIMESTAMP + INTERVAL 5 OR 60 MINUTE),
	FOREIGN KEY (transaction_type_id) REFERENCES transaction_type(transaction_type_id),
	FOREIGN KEY (user_no) REFERENCES user_info(user_no),
	PRIMARY KEY (transaction_id)
);


CREATE TABLE miner_deposit(
	miner_transaction_id 	int(200) NOT NULL AUTO_INCREMENT,
	user_no						int(200) NOT NULL,
	amount						double(20,2),
	currency_type_id			int(11) NOT NULL,
	deposit_date				timestamp DEFAULT CURRENT_TIMESTAMP,					
	FOREIGN KEY (user_no) REFERENCES user_info(user_no),
	PRIMARY KEY (miner_transaction_id)
);

/*
	WITHDRAWALS
*/
CREATE TABLE withdrawal_transaction(
	withdrawal_transaction_id		int(200) NOT NULL AUTO_INCREMENT,
	user_no								int(200) NOT NULL,
	status								varchar(20),
	reference_id						varchar(200) UNIQUE,
	peso_address						varchar(200) NOT NULL,
	amount								double(20,2) NOT NULL,
	request_date						timestamp DEFAULT CURRENT_TIMESTAMP,
	approve_date						timestamp,
	FOREIGN KEY (user_no) REFERENCES user_info(user_no),
	PRIMARY KEY (withdrawal_transaction_id)
);
/*
	Days 
*/
CREATE TABLE days (
	_day	int (31)
);


/*
	Referral
*/
CREATE TABLE refer(
	refer_id		int(200) NOT NULL AUTO_INCREMENT,
	referedBy	int(11) NOT NULL,
	user_no		int(11) NOT NULL,
	FOREIGN KEY (referedBy) REFERENCES user_info(user_no),
	FOREIGN KEY (user_no) REFERENCES user_info(user_no),
	PRIMARY KEY (refer_id)
);

CREATE TABLE referral_deposit(
	referral_deposit_id 	int(200) NOT NULL AUTO_INCREMENT,
	refer_id					int(200) NOT NULL,
	amount					double(20,2),
	transaction_id			int(200),
	FOREIGN KEY (refer_id) REFERENCES refer(refer_id),
	FOREIGN KEY (transaction_id) REFERENCES deposit_transactions(transaction_id),
	PRIMARY KEY (referral_deposit_id)
);

/*
	Event Module
*/

CREATE TABLE event (
	event_no 		int(11) NOT NULL,
	event_name 		varchar(40) NOT NULL UNIQUE,
	started_date	timestamp DEFAULT CURRENT_TIMESTAMP,
	ended_date		date,
	created_by		int,
	PRIMARY KEY (event_no),
	FOREIGN KEY (created_by) REFERENCES user_info(user_no)
);

CREATE TABLE participant (
	event_no 		int(11) NOT NULL,
	user_no			int(11) NOT NULL,
	FOREIGN KEY (event_no) REFERENCES event(event_no),
	FOREIGN KEY (user_no) REFERENCES user_info(user_no)
);


/*
	Raffle Module
*/

CREATE TABLE raffle(
	raffle_id			int(200) NOT NULL AUTO_INCREMENT,
	code					varchar(200) UNIQUE NOT NULL,
	image					text,
	prize					varchar(200),
	description			text,
	max_winner			int,
	raffle_draw			timestamp ,
	date_created		timestamp DEFAULT CURRENT_TIMESTAMP,	
	date_updated		timestamp,
	created_by			int,
	FOREIGN KEY (created_by) REFERENCES user_info(user_no),
	PRIMARY KEY (raffle_id)
);

ALTER TABLE raffle ADD FULLTEXT (prize,code, description);

CREATE TABLE raffle_participant(
	p_no					int(200)  NOT NULL AUTO_INCREMENT,
	raffle_id			int(200),
	fname					varchar(200),
	lname					varchar(200),
	fb_profile			text,
	email_address		varchar(200),
	date_created		timestamp DEFAULT CURRENT_TIMESTAMP,	
	FOREIGN KEY (raffle_id) REFERENCES raffle(raffle_id),
	PRIMARY KEY (p_no)
);

ALTER TABLE raffle_participant ADD FULLTEXT (fname,lname, email_address);


CREATE TABLE raffle_winner(
	p_no					int(200),
	date_created		timestamp DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (p_no) REFERENCES raffle_participant(p_no)
);





