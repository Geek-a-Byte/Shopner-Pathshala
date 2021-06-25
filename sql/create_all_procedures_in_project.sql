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

create or replace procedure myproc(x in number,myrc out sys_refcursor) as
begin
 open myrc for select course_code from courses where teacher_id=x;
end;


set serveroutput on;
CREATE OR Replace PROCEDURE pre_course_level(code IN varchar2, c_level OUT varchar2) 
AS
BEGIN 
select course_level into c_level from courses where course_code=code;
END;
