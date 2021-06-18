--drop table courses;
--drop table child_course;
--drop table tests;
--drop table results;
--sequence and table delete

drop trigger courses_course_code;
BEGIN
  --Bye Sequences!
  FOR i IN (SELECT us.sequence_name
              FROM USER_SEQUENCES us) LOOP
    EXECUTE IMMEDIATE 'drop sequence '|| i.sequence_name ||'';
  END LOOP;
   /**Bye Tables!
  FOR i IN (SELECT ut.table_name
       FROM USER_TABLES ut) LOOP
       EXECUTE IMMEDIATE 'drop table '|| i.table_name ||' CASCADE CONSTRAINTS ';
  END LOOP;
 **/
END;

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
serial_number number(10,0),
child_id number(10,0),
score number(6,3),
constraint serial_number_pk primary key(serial_number),
constraint results_child_id_fk foreign key (child_id)references childs(child_id)
);

create sequence writing_code_seq
increment by 1
start with 1
maxvalue 100
nocycle;

create sequence rec_code_seq
increment by 1
start with 1
maxvalue 100
nocycle;

create sequence reading_code_seq
increment by 1
start with 1
maxvalue 100
nocycle;

create sequence memory_code_seq
increment by 1
start with 1
maxvalue 100
nocycle;

create sequence math_code_seq
increment by 1
start with 1
maxvalue 100
nocycle;

create sequence test_code_seq
increment by 1
start with 1
maxvalue 100
nocycle;


CREATE OR REPLACE TRIGGER tests_test_code 
            before insert on tests
            for each row
                begin
            if :new.test_code is null then
                select test_code_seq.nextval 
                into :new.test_code 
                from dual;
            end if;
            end;

ALTER TRIGGER tests_test_code ENABLE;

CREATE OR REPLACE TRIGGER courses_course_code 
            before insert on courses
            for each row
            declare
            name varchar2(255);
            code varchar2(255);
            duration number(3,0);
            duration_low exception;
            begin
            name:= :new.course_name;
            duration:=:new.course_duration;
            begin
            if duration<13 then
               raise duration_low;
            end if;
            create_course_code(name,code); 
            DBMS_OUTPUT.PUT_LINE(name);
            if :new.course_code is null then
                select code 
                into :new.course_code 
                from dual;
            end if;
            exception 
                when duration_low then
                           -- goto exitline;
                     DBMS_OUTPUT.PUT_LINE('duration low');
            end;
end;
ALTER TRIGGER courses_course_code ENABLE;


create or replace procedure myproc(x in number,myrc out sys_refcursor) as
begin
 open myrc for select course_code from courses where teacher_id=x;
end;


set serveroutput on;
declare
  teach_id courses.teacher_id%type;
  course_id courses.course_code%type;
  course_n courses.course_name%type;
  cursor  c_teacher is
  select teacher_id,course_code,course_name from courses where teacher_id=001;
  begin
  open c_teacher;
  loop
  fetch c_teacher into teach_id,course_id,course_n;
  exit when c_teacher%notfound;
  dbms_output.put_line('teacher id: '||teach_id||'   course code :'||course_id||'   course name:'||course_n);
  end loop;
  close c_teacher;
  end;

select writing_code_seq.currval from dual;
select  rec_code_seq.currval from dual;
select reading_code_seq.currval from dual;
select memory_code_seq.currval from dual;
select  math_code_seq.currval from dual;

--:catagory,:level,:pre_requisite,:duration,:content,:teacher_id,:code
CREATE OR Replace PROCEDURE create_course_code(catagory IN varchar2,code OUT varchar2) 
AS 
BEGIN 
IF catagory = 'Writing' THEN
code:= 'w_'||writing_code_seq.nextval;
ELSIF catagory = 'Recognization' Then
code:= 'rec_'||rec_code_seq.nextval;
ELSIF catagory='Reading' Then
code:= 'r_'||reading_code_seq.nextval;
ELSIF catagory='Memory' Then
code:= 'me_'||memory_code_seq.nextval;
ELSIF catagory='Math' Then
code:= 'ma_'||math_code_seq.nextval;
END IF; 
END;


set serveroutput on;
DECLARE
a varchar2(255);
b varchar2(255);
BEGIN
a:= 'Recognization';
create_course_code(a, b); 
insert into courses (course_code,course_level,course_name) values(b,'easy','first');
dbms_output.put_line('course_code : ' || b); 
END; 

