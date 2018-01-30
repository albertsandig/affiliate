INSERT INTO user_type VALUES 
(1,'SUPERUSER'),
(2,'ADMINISTRATOR'),
(3,'USER'),
(4,'AUTHOR');


INSERT INTO user_info( 
	user_no	,
	email 	,
	password ,
	type_no 	
) VALUES
(1,'albert.sandig1@gmail.com',md5('Machinedoll123'),1);


INSERT INTO currency_type VALUES
(1, 'PHP',"fa-ruble"),
(2, 'POINTS',"fa-star-o");


INSERT INTO user_wallet(
user_no					,
currency_type_id		
) VALUES
(1,1),
(1,2);

INSERT INTO ads_type VALUES
(1, 'LAZADA'),
(2, 'PROPELLER');

-----------------------------------


/*
INSERT INTO transaction_category VALUES
(1, 'REWARD'),
(2, 'ADVERTISEMENT'),
(2, 'TRADE');
*/


INSERT INTO transaction_type(
transaction_type_id,
code,
ads_type_id,
currency_type_id,
duration,
duration_unit,
amount,
content,
url
) VALUES 
(1, 'REWARD-P'	, 2, 2,'30','MINUTE','10','','http://ho.lazada.com.ph/SHUrUY?url=https%3A%2F%2Fwww.lazada.com.ph%2Fcherry-mobile-onrev-5-in-display-4gb-black-46709123.html%3Foffer_id%3D%7Boffer_id%7D%26affiliate_id%3D%7Baffiliate_id%7D%26offer_name%3D%7Boffer_name%7D%26affiliate_name%3D%7Baffiliate_name%7D%26transaction_id%3D%7Btransaction_id%7D'),
(2, 'REWARD-M'	, 1, 1,'30','MINUTE','0.10','','http://ho.lazada.com.ph/SHUrUY?url=https%3A%2F%2Fwww.lazada.com.ph%2Fcherry-mobile-flare-p1-gold-64697209.html%3Foffer_id%3D%7Boffer_id%7D%26affiliate_id%3D%7Baffiliate_id%7D%26offer_name%3D%7Boffer_name%7D%26affiliate_name%3D%7Baffiliate_name%7D%26transaction_id%3D%7Btransaction_id%7D'),
(3, 'QUIZ'		, 1, 2,'5','SECOND','2.5','','');

INSERT INTO days VALUES(1),(2),(3),(4),(5),(6),(7);



/*TEST DATA*/

CALL procedure_create_user_registration( 'test4@yahoo.com', md5('test4@yahoo.com'), 'test4', 'test4', 'Male', '', '123213213', '', 3 )
 CALL procedure_deposit_ads(
	3,
	'PRO-ADS'
) 


INSERT INTO refer VALUES(
	1,
	3
);

CALL procedure_deposit(
	16,
	'REWARD-P'
) ;

CALL procedure_deposit(
	16,
	'REWARD-M'
) ;

CALL procedure_deposit(
	16,
	'QUIZ'
) ;

CALL procedure_request_withdrawal(
	15,
	500
)
CALL procedure_approve_withdrawal(
	1,
	'XADSA'
)