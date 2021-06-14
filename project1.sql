drop table courses;

create table courses
(
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

insert into courses(course_code,course_level,course_name,course_duration,pre_requisite,teacher_id)values('W_001','easy','writting',21,'none',0000000001);
insert into courses(course_code,course_level,course_name,course_duration,pre_requisite,teacher_id)values('W_002','medium','writting',30,'W_002',0000000004);
insert into courses(course_code,course_level,course_name,course_duration,pre_requisite,teacher_id)values('W_003','hard','writting',60,'W_003',0000000001);
insert into courses(course_code,course_level,course_name,course_duration,pre_requisite,teacher_id)values('E_001','easy','emotion',21,'none',0000000002);
insert into courses(course_code,course_level,course_name,course_duration,pre_requisite,teacher_id)values('E_002','medium','emotion',30,'E_001',0000000003);
insert into courses(course_code,course_level,course_name,course_duration,pre_requisite,teacher_id)values('M_003','hard','math',120,'M_002',0000000002);


drop table tests;

create table tests
(
test_code varchar2(10),
course_code varchar2(10),
test_question varchar2(500),
test_date date,
test_highest_score number (6,3),
test_lowest_score number (6,3),
constraint tests_test_code_pk primary key(test_code),
constraint tests_course_code_fk foreign key (course_code)references courses(course_code)
);

insert into tests (test_code,course_code,test_date) values('T_001','W_001','11-JAN-1982');
insert into tests (test_code,course_code,test_date) values('T_002','W_001','11-JAN-1982');
insert into tests (test_code,course_code,test_date) values('T_003','W_001','11-JAN-1982');
insert into tests (test_code,course_code,test_date) values('T_004','W_003','11-JAN-1982');
insert into tests (test_code,course_code,test_date) values('T_005','W_003','11-JAN-1982');

drop table results;

create table results
(
serial_number number(10,0),
child_id number(10,0),
test_code varchar2(10),
score number(6,3),
constraint serial_number_pk primary key(serial_number),
constraint results_child_id_fk foreign key (child_id)references childs(child_id),
constraint results_test_code_fk foreign key (test_code)references tests(test_code)

);


insert into results values (00001,'   ','W_001',20);
