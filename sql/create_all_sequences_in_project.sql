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

create sequence result_id_seq
increment by 1
start with 1
maxvalue 100
nocycle;


set serveroutput on;

select writing_code_seq.currval from dual;
select  rec_code_seq.currval from dual;
select reading_code_seq.currval from dual;
select memory_code_seq.currval from dual;
select  math_code_seq.currval from dual;