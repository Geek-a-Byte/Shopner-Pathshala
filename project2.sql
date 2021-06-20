SET SERVEROUTPUT ON

CREATE Or replace PROCEDURE find_available_doctors(x IN varchar2,d_id out number,d_name out varchar2,d_email out varchar2,d_designation out varchar2 )
AS
BEGIN
select doctor_id ,doctor_name,doctor_email_id,doctor_designation  into d_id,d_name,d_email,d_designation from doctors D
where x>=D.working_hour_from and x<=D.working_hour_to;
END;


select * from doctors 
where working_hour_from='03-Jun-21 00:00';

DECLARE
a VARCHAR2(255);
d_id number(10,0);
d_name varchar2(255);
d_email varchar2(255);
d_designation varchar2(255);
BEGIN
a:='30-Jun-21 00:00';
find_available_doctors(a,d_id,d_name,d_email,d_designation);
dbms_output.put_line(d_id||d_name);
END;


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
  
