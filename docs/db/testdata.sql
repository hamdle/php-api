use wo_db;

/* users */
insert into users (email, password) values ('admin@localhost.com', md5('admin'));
insert into users (email, password) values ('eric@testmail.dev', md5('password456'));
insert into users (email, password) values ('user1@localhost.co', md5('testpass'));

/* exercises */
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Warm Up', 1, 1, 0, 'warm');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Pull Ups', 2, 5, 60, 'pull');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Chin Up', 2, 5, 60, 'pull');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Dips', 3, 5, 60, 'push');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Push Ups', 3, 5, 60, 'push');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Leg Raises', 3, 5, 60, 'core');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Cobra', 3, 40, 30, 'core');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Pistol Squats', 4, 5, 60, 'legs');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Inverted Rows', 4, 5, 60, 'core');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Lunges', 4, 5, 60, 'legs');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Plyo Burpees', 4, 5, 60, 'legs');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Planks', 3, 5, 60, 'core');
insert into exercises 
(title, default_sets, default_reps, wait_time, category) values 
('Hollow Body', 3, 5, 60, 'core');

/* entries */
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(3, 3, 2, 3, 6, 'none');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(1, 3, 2, 3, 6, 'none');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(2, 3, 2, 2, 7, 'up');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(4, 3, 2, 2, 5, 'none');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(0, 0, 2, 3, 6, 'down');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(2, 0, 2, 4, 5, 'none');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(3, 0, 2, 3, 8, 'up');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(0, 0, 0, 3, 6, 'down');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(2, 0, 0, 4, 5, 'none');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(3, 0, 0, 3, 8, 'up');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(0, 0, 1, 3, 10, 'down');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(2, 0, 1, 3, 5, 'none');
insert into entries 
(exercises_id, workout_id, user_id, sets, reps, feedback) values 
(1, 0, 1, 3, 12, 'up');

/* workouts */
insert into workouts 
(user_id, start, end, notes, feel) values 
(2, '2019-01-01 00:00:00', '2019-01-01 00:34:00', 'Com Truise - Persuasion System', 'average');
insert into workouts 
(user_id, start, end, notes, feel) values 
(2, '2019-02-11 01:00:00', '2019-02-11 01:36:02', 'Hammerhedd - Essence of Iron', 'average');
insert into workouts 
(user_id, start, end, notes, feel) values 
(0, '2019-03-01 12:40:40', '2019-01-01 13:22:03', 'Cate le Bon - Crab Day', 'average');
insert into workouts 
(user_id, start, end, notes, feel) values 
(3, '2019-09-09 21:04:44', '2019-09-09 21:34:55', 'Spotify new releases playlist', 'weak');
insert into workouts 
(user_id, start, end, notes, feel) values 
(2, '2019-02-14 15:00:00', '2019-02-14 15:34:00', 'Danny Brown uknowwhatimsayin 9/10', 'strong');
insert into workouts 
(user_id, start, end, notes, feel) values 
(3, '2019-11-16 22:13:04', '2019-11-16 22:55:40', '', 'strong');

/* reps */
insert into reps (entries_id, amount) values (1, '6');
insert into reps (entries_id, amount) values (1, '4+2');
insert into reps (entries_id, amount) values (1, '6');
insert into reps (entries_id, amount) values (2, '5');
insert into reps (entries_id, amount) values (2, '5');
insert into reps (entries_id, amount) values (3, '7+1');
insert into reps (entries_id, amount) values (3, '7');
insert into reps (entries_id, amount) values (4, '6');
insert into reps (entries_id, amount) values (4, '6');
insert into reps (entries_id, amount) values (4, '6');
insert into reps (entries_id, amount) values (6, '11');
insert into reps (entries_id, amount) values (6, '11');
insert into reps (entries_id, amount) values (6, '12');
insert into reps (entries_id, amount) values (7, '10+2');
insert into reps (entries_id, amount) values (7, '10');
