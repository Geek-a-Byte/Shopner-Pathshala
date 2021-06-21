create table courses(
course_code varchar2(255) not null enable,
course_level varchar2(255)not null,
course_name varchar2(255)not null,
course_duration number(3,0)constraint course_duration_ck check(course_duration>13),
course_content varchar2(255),
pre_requisite varchar2(255),
teacher_id number(10,0) NOT NULL,
CREATED_AT TIMESTAMP (6), 
UPDATED_AT TIMESTAMP (6), 
constraint courses_course_code_pk primary key(course_code),
constraint course_teacher_id_fk foreign key (teacher_id)references  teachers(teacher_id)
);

create table tests
(
test_code varchar2(255) NOT NULL ENABLE,
course_code varchar2(255) NOT NULL,
teacher_id number(10,0) NOT NULL,
test_question varchar2(500),
CREATED_AT TIMESTAMP (6), 
UPDATED_AT TIMESTAMP (6), 
constraint tests_test_code_pk primary key(test_code),
constraint tests_course_code_fk foreign key (course_code)references courses(course_code),
constraint tests_teacher_id_fk foreign key (teacher_id)references  teachers(teacher_id)
);


create table results
(
result_id number(10,0),
child_id number(10,0),
test_code varchar2(10),
score number(6,3),
--constraint serial_number_pk primary key(serial_number),
constraint results_child_id_fk foreign key (child_id)references childs(child_id) on delete set null,
constraint results_test_code_fk foreign key (test_code)references tests(test_code) on delete set null,
primary key(result_id,child_id,test_code)
);

