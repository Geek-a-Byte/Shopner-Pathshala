drop table courses;
drop table tests;
drop table results;

create table courses(
course_code varchar2(10),
course_level varchar2(10)not null,
course_name varchar2(20)not null,
course_duration number(3,0)constraint course_duration_ck check(course_duration>13),
course_content varchar2(20),
course_purpose varchar2(200),
pre_requisite varchar2(10),
teacher_id number(10,0),
constraint courses_course_code_pk primary key(course_code),
constraint course_teacher_id_fk foreign key (teacher_id)references  teachers(teacher_id)
);

create table tests
(
test_code varchar2(10),
course_code varchar2(10),
test_question varchar2(500),
test_date date,
test_highest_score number (6,3),
test_lowest_score number (6,3),
constraint tests_test_code_pk primary key(test_code),
constraint tests_course_code_fk foreign key (course_code)references courses(course_code) on delete set null
);



create table results
(
serial_number number(10,0),
child_id number(10,0),
test_code varchar2(10),
score number(6,3),
constraint serial_number_pk primary key(serial_number),
constraint results_child_id_fk foreign key (child_id)references childs(child_id),
constraint results_test_code_fk foreign key (test_code)references tests(test_code) on delete set null

);


insert into results values (00001,'   ','W_001',20);

-- for view tests --
select course_code,course_level,test_code,test_question
from courses join tests using(course_code) join child_takes_course using(course_code)
where child_id = 2;