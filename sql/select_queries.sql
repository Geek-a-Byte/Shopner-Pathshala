select *
from(select * from results where course_name='Writing' order by result_id desc ) x
where ROWNUM <= 3


SELECT * FROM(SELECT course_name,score from courses C
          inner join child_takes_course CI USING(course_code)
          inner join tests T USING(course_code)
          inner join results R USING(test_code)
          where CI.child_id=1and R.child_id=1 and course_name='Writing' order BY R.result_id desc)   WHERE ROWNUM<=3;
          
          
          

select * from normal_user where role='Doctor';

select * from normal_user where role='Teacher';

select * from normal_user where role='Nurse';

select * from normal_user where role='Guardian';

