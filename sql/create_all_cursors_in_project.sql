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