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

ALTER TRIGGER tests_test_code ENABLE;

CREATE OR REPLACE TRIGGER courses_course_code 
            before insert on courses
            for each row
            declare
            name varchar2(255);
            code varchar2(255);
            duration number(3,0);
            c_pre varchar2(255);
            level varchar2(255);
            duration_low exception;
            pre_requ_cannot_be_null exception;
            easy_pre_requ_should_be_null exception;
            begin
            name:= :new.course_name;
            duration:=:new.course_duration;
            c_pre:=:new.pre_requisite;
            level:=:new.course_level;
            begin
            if duration<13 then
               raise duration_low;
            end if;
            if  level='medium' and c_pre is NULL then
               raise pre_requ_cannot_be_null;
            end if;
            if  level='hard' and c_pre is NULL then
               raise pre_requ_cannot_be_null;
            end if;
            if  level='easy' and c_pre is NOT NULL then
               raise easy_pre_requ_should_be_null;
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
                when pre_requ_cannot_be_null then
                               -- goto exitline;
                         DBMS_OUTPUT.PUT_LINE('pre_requ_cannot_be_null');
               when easy_pre_requ_should_be_null then
                        DBMS_OUTPUT.PUT_LINE('easy_pre_requ_should_be_null');
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








