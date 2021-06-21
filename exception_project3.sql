---exception handing for not inserting null for medium and hard


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
