DROP TABLE nfl_plays_raw;
DROP TABLE nfl_plays;
CREATE TABLE nfl_plays_raw(				 posteam text,
                                     posteam_type text,
                                     side_of_field text,
                                     yardline_100 int,
                                     quarter_seconds_remaining int,
                                     half_seconds_remaining int,
                                     qtr int,
                                     down int,
                                     time text,
                                     ydstogo int,
                                     play_type text,
                                     yards_gained int,
                                     pass_length text,
                                     pass_location text,
                                     run_location text,
                                     run_gap text,
                                     field_goal_result text,
                                     kick_distance int,
                                     posteam_timeouts_remaining int,
                                     defteam_timeouts_remaining int,
                                     posteam_score int,
                                     defteam_score int,
                                     score_differential int,
                                     interception int,
                                     safety int,  
                                     fumble_lost int,
                                     touchdown int,
                                     field_goal_attempt int,
                                     punt_attempt int,
                                     offense_formation text,
                                     offense_personnel text,
                                     route text
);

COPY nfl_plays_raw
FROM 'C:\\Users\\camdi\\OneDrive\\Desktop\\Data 505\\Final\\nfl_plays.csv'
WITH(format CSV, HEADER);

CREATE TABLE nfl_plays as
SELECT * FROM nfl_plays_raw
WHERE play_type != 'kickoff' and play_type not ilike '' and play_type not ilike 'no_play';

DROP TABLE IF EXists op;
CREATE TEMP TABLE op as
SELECT offense_personnel FROM nfl_plays
WHERE (play_type ilike 'run' or play_type ilike 'pass') and down != 4
GROUP BY offense_personnel;

DROP TABLE IF EXISTS op_2;
CREATE TEMP TABLE op_2 as 
SELECT offense_personnel as o_personnel,
	CASE
		WHEN offense_personnel ilike '%0 RB%0 TE%' THEN '00'
		WHEN offense_personnel ilike '%0 RB%1 TE%' THEN '01'
		WHEN offense_personnel ilike '%0 RB%2 TE%' THEN '02'
		WHEN offense_personnel ilike '%0 RB%3 TE%' THEN '03'
		WHEN offense_personnel ilike '%1 RB%0 TE%' THEN '10'
		WHEN offense_personnel ilike '%1 RB%1 TE%' THEN '11'
		WHEN offense_personnel ilike '%1 RB%2 TE%' THEN '12'
		WHEN offense_personnel ilike '%1 RB%3 TE%' THEN '13'
		WHEN offense_personnel ilike '%1 RB%4 TE%' THEN '14'
		WHEN offense_personnel ilike '%2 RB%0 TE%' THEN '20'
		WHEN offense_personnel ilike '%2 RB%1 TE%' THEN '21'
		WHEN offense_personnel ilike '%2 RB%2 TE%' THEN '22'
		WHEN offense_personnel ilike '%2 RB%3 TE%' THEN '23'
		WHEN offense_personnel ilike '%3 RB%0 TE%' THEN '30'
		WHEN offense_personnel ilike '%3 RB%1 TE%' THEN '31'
		WHEN offense_personnel ilike '%3 RB%2 TE%' THEN '32'
		ELSE NULL
	END as personnel_num
FROM op;

SELECT play_type FROM nfl_plays_raw
GROUP BY play_type;

DROP TABLE IF EXISTS nfl_plays_personNum;
CREATE TABLE nfl_plays_personNum as
SELECT * FROM nfl_plays_raw 
LEFT JOIN op_2 on op_2.o_personnel = nfl_plays_raw.offense_personnel
WHERE play_type != '' AND play_type != 'no_play';


COPY nfl_plays_personNum
TO 'C:\\Users\\camdi\\OneDrive\\Desktop\\Data 505\\Final\\nfl_plays_offense_personnel.csv'
WITH(format CSV, HEADER);

DROP TABLE nfl_23plays_raw;
DROP TABLE nfl_plays;
CREATE TABLE nfl_plays_raw(				 posteam text,
                                     posteam_type text,
                                     side_of_field text,
                                     yardline_100 int,
                                     quarter_seconds_remaining int,
                                     half_seconds_remaining int,
                                     qtr int,
                                     down int,
                                     time text,
                                     ydstogo int,
                                     play_type text,
                                     yards_gained int,
                                     pass_length text,
                                     pass_location text,
                                     run_location text,
                                     run_gap text,
                                     field_goal_result text,
                                     kick_distance int,
                                     posteam_timeouts_remaining int,
                                     defteam_timeouts_remaining int,
                                     posteam_score int,
                                     defteam_score int,
                                     score_differential int,
                                     interception int,
                                     safety int,  
                                     fumble_lost int,
                                     touchdown int,
                                     field_goal_attempt int,
                                     punt_attempt int,
                                     offense_formation text,
                                     offense_personnel text,
                                     route text
);

COPY nfl_23_plays_raw
FROM 'C:\\Users\\camdi\\OneDrive\\Desktop\\Data 505\\Final\\nfl_23_plays.csv'
WITH(format CSV, HEADER);

CREATE TABLE nfl_23_plays as
SELECT * FROM nfl_23_plays_raw
WHERE play_type != 'kickoff' and play_type not ilike '' and play_type not ilike 'no_play';

DROP TABLE IF EXists op_23;
CREATE TEMP TABLE op_23 as
SELECT offense_personnel FROM nfl_23_plays
WHERE (play_type ilike 'run' or play_type ilike 'pass') and down != 4
GROUP BY offense_personnel;

DROP TABLE IF EXISTS op_23_2;
CREATE TEMP TABLE op_23_2 as 
SELECT offense_personnel as o_personnel,
	CASE
		WHEN offense_personnel ilike '%0 RB%0 TE%' THEN '00'
		WHEN offense_personnel ilike '%0 RB%1 TE%' THEN '01'
		WHEN offense_personnel ilike '%0 RB%2 TE%' THEN '02'
		WHEN offense_personnel ilike '%0 RB%3 TE%' THEN '03'
		WHEN offense_personnel ilike '%1 RB%0 TE%' THEN '10'
		WHEN offense_personnel ilike '%1 RB%1 TE%' THEN '11'
		WHEN offense_personnel ilike '%1 RB%2 TE%' THEN '12'
		WHEN offense_personnel ilike '%1 RB%3 TE%' THEN '13'
		WHEN offense_personnel ilike '%1 RB%4 TE%' THEN '14'
		WHEN offense_personnel ilike '%2 RB%0 TE%' THEN '20'
		WHEN offense_personnel ilike '%2 RB%1 TE%' THEN '21'
		WHEN offense_personnel ilike '%2 RB%2 TE%' THEN '22'
		WHEN offense_personnel ilike '%2 RB%3 TE%' THEN '23'
		WHEN offense_personnel ilike '%3 RB%0 TE%' THEN '30'
		WHEN offense_personnel ilike '%3 RB%1 TE%' THEN '31'
		WHEN offense_personnel ilike '%3 RB%2 TE%' THEN '32'
		ELSE NULL
	END as personnel_num
FROM op_23;

SELECT play_type FROM nfl_23_plays_raw
GROUP BY play_type;

DROP TABLE IF EXISTS nfl_23_plays_personNum;
CREATE TABLE nfl_23_plays_personNum as
SELECT * FROM nfl_23_plays_raw 
LEFT JOIN op_2 on op_23_2.o_personnel = nfl_23_plays_raw.offense_personnel
WHERE play_type != '' AND play_type != 'no_play';


COPY nfl_23_plays_personNum
TO 'C:\\Users\\camdi\\OneDrive\\Desktop\\Data 505\\Final\\nfl_23_plays_offense_personnel.csv'
WITH(format CSV, HEADER);

