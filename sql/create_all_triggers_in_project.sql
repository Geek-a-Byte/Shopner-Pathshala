select * from user_errors where type = 'TRIGGER' and name = 'NORMAL_USER_ID';
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










