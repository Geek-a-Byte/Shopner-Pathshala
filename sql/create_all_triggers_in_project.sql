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


CREATE OR REPLACE TRIGGER results_result_ID 
            before insert on results
            for each row
                begin
            if :new.result_id is null then
                select result_id_seq.nextval 
                into :new.result_id 
                from dual;
            end if;
            end;

ALTER TRIGGER results_result_ID ENABLE;

CREATE OR REPLACE TRIGGER courses_course_code 
            before insert on courses
            for each row
            declare
            name varchar2(255);
            code varchar2(255);
            duration number(3,0);
            c_pre varchar2(255);
            c_pre_level varchar2(255);
            content varchar2(255);
            level varchar2(255);
            duration_low exception;
            wrong_pre_requ exception;
            easy_pre_requ_should_be_null exception;
            no_course_content exception;
            begin
            name:= :new.course_name;
            duration:=:new.course_duration;
            c_pre:=:new.pre_requisite;
            level:=:new.course_level;
            content:=:new.course_content;
            begin
            if level!='easy' then
            pre_course_level(c_pre,c_pre_level);
            end if;
            if duration<13  or duration is null then
                RAISE_APPLICATION_ERROR(-20001,'course duration low');
            end if;
            if content is null then
                RAISE_APPLICATION_ERROR(-20001,'no course content given');
            end if;
            if  level='medium' and c_pre_level!='easy' then
               RAISE_APPLICATION_ERROR(-20001,'wrong prerequisite');
            end if;
            if  level='hard' and c_pre_level!='medium' then
               RAISE_APPLICATION_ERROR(-20001,'wrong prerequisite');
            end if;
            if  level='easy' and c_pre is NOT NULL then
              RAISE_APPLICATION_ERROR(-20001,'easy prerequisite should be null');
            end if;
            create_course_code(name,code);         
            if :new.course_code is null then
                select code 
                into :new.course_code 
                from dual;
            end if;
           end;
end;
ALTER TRIGGER courses_course_code ENABLE;






--not necessary
set serveroutput on;
declare
c_pre courses.pre_requisite%type;
c_course courses.course_code%type;
e_invalid_value exception;
p courses.course_code%type;
begin
select C1.pre_requisite,course_code
into c_pre,c_course
from courses C1
inner join courses C2 using (course_code)
where C2.course_level='medium' or C2.course_level='hard'  ;
if c_pre ='null' and c_course='w_02' then
raise e_invalid_value ;
end if;
exception
when e_invalid_value then
dbms_output.put_line('can not insert null');
when TOO_MANY_ROWS  then
dbms_output.put_line('onek besi');
end;




 CREATE OR REPLACE TRIGGER "ABC"."POSTS_ID_TRG" 
            before insert on POSTS
            for each row
                begin
            if :new.ID is null then
                select posts_id_seq.nextval into :new.ID from dual;
            end if;
             if :new.SLUG is null then
                select :new.ID into :new.SLUG from dual;
            end if;
            end;



