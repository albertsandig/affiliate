CREATE PROCEDURE procedure_is_number_exist(
	IN 	this_number VARCHAR(100),
	OUT	is_number_already_exist BOOLEAN
) BEGIN

	SELECT count(A.cp_number) > 0 INTO is_number_already_exist
	FROM participant AS A
	WHERE UPPER(A.cp_number) = UPPER (this_number);
	
END;

CREATE PROCEDURE procedure_is_event_exist(
	IN 	this_event_no VARCHAR(100),
	OUT	is_event_already_exist BOOLEAN
) BEGIN

	SELECT count(A.event_no) > 0 INTO is_event_already_exist
	FROM event AS A
	WHERE UPPER(A.event_no) = UPPER (this_event_no);
	
END;

CREATE PROCEDURE procedure_is_participant_already_participated(
	IN 	this_event_no VARCHAR(100),
	IN		this_number		INT,
	OUT	is_already_participated BOOLEAN
) BEGIN
	DECLARE this_p_no INT DEFAULT 0;
	
	SELECT A.p_no INTO this_p_no
	FROM participant AS A
	WHERE 
		cp_number = this_number;
		
	SELECT count(A.p_no) > 0 INTO is_already_participated
	FROM participated_event AS A
	WHERE UPPER(A.event_no) = UPPER (this_event_no) AND 
			A.p_no = this_p_no;
	
END;

CREATE PROCEDURE procedure_participate_event(
	this_event_no		INT,
	this_number 		VARCHAR(11),
	this_name 			VARCHAR(100)
) BEGIN
	DECLARE this_p_no INT DEFAULT 0;

	CALL	procedure_is_number_exist(
		this_number,
		@is_number_already_exist
	);
	
	CALL procedure_is_event_exist(
		this_event_no,
		@is_event_already_exist
	);
	
	IF @is_event_already_exist = FALSE THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'Event does not exist.';
	END IF;
	
	-- CHECK IF NUMBER ALREADY EXIST
	IF @is_number_already_exist = FALSE THEN
		-- INSERT PARTICIPANT
		INSERT INTO participant(
			cp_number,
			name
		) VALUES (
			this_number,
			this_name
		);
	END IF;
	
	CALL procedure_is_participant_already_participated(
		this_event_no,
		this_number,
		@is_already_participated
	);
	
	IF @is_already_participated THEN
		SIGNAL SQLSTATE '45000'
			SET MESSAGE_TEXT = 'You have already participated on this event.';
	END IF;
	
	
	SELECT A.p_no INTO this_p_no
	FROM participant AS A
	WHERE 
		cp_number = this_number;
		
	INSERT INTO participated_event(
		event_no,
		p_no
	) VALUES (
		this_event_no,
		this_p_no
	);
	
END;


