drop table courses;
drop table child_course;
drop table tests;
drop table results;
drop trigger courses_course_code;
DROP SEQUENCE abc.rec_code_seq;
DROP SEQUENCE abc.writing_code_seq;
DROP SEQUENCE abc.reading_code_seq;
DROP SEQUENCE abc.memory_code_seq;
DROP SEQUENCE abc.math_code_seq;

BEGIN
  --drop all Sequences!
  FOR i IN (SELECT us.sequence_name
              FROM USER_SEQUENCES us) LOOP
    EXECUTE IMMEDIATE 'drop sequence '|| i.sequence_name ||'';
  END LOOP;
   --drop all tables!
   --Bye Tables!
  FOR i IN (SELECT ut.table_name
       FROM USER_TABLES ut) LOOP
       EXECUTE IMMEDIATE 'drop table '|| i.table_name ||' CASCADE CONSTRAINTS ';
  END LOOP;
END;