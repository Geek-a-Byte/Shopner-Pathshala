--------------------------------------------------------
--  File created - Friday-June-25-2021   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table COURSES
--------------------------------------------------------

  CREATE TABLE "ABC"."COURSES" 
   (	"COURSE_CODE" VARCHAR2(255 BYTE), 
	"COURSE_LEVEL" VARCHAR2(255 BYTE), 
	"COURSE_NAME" VARCHAR2(255 BYTE), 
	"COURSE_DURATION" NUMBER(3,0), 
	"COURSE_CONTENT" VARCHAR2(255 BYTE), 
	"PRE_REQUISITE" VARCHAR2(255 BYTE), 
	"TEACHER_ID" NUMBER(10,0), 
	"CREATED_AT" TIMESTAMP (6), 
	"UPDATED_AT" TIMESTAMP (6)
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
REM INSERTING into ABC.COURSES
SET DEFINE OFF;
Insert into ABC.COURSES (COURSE_CODE,COURSE_LEVEL,COURSE_NAME,COURSE_DURATION,COURSE_CONTENT,PRE_REQUISITE,TEACHER_ID,CREATED_AT,UPDATED_AT) values ('rec_1','easy','Recognization',14,'https://sway.office.com/s/9kEj7VJzWlU00gTo/embed',null,1,null,null);
Insert into ABC.COURSES (COURSE_CODE,COURSE_LEVEL,COURSE_NAME,COURSE_DURATION,COURSE_CONTENT,PRE_REQUISITE,TEACHER_ID,CREATED_AT,UPDATED_AT) values ('w_1','easy','Writing',14,'https://sway.office.com/s/9kEj7VJzWlU00gTo/embed',null,1,null,null);
Insert into ABC.COURSES (COURSE_CODE,COURSE_LEVEL,COURSE_NAME,COURSE_DURATION,COURSE_CONTENT,PRE_REQUISITE,TEACHER_ID,CREATED_AT,UPDATED_AT) values ('w_2','medium','Writing',15,'https://sway.office.com/s/9kEj7VJzWlU00gTo/embed','w_1',1,null,null);
Insert into ABC.COURSES (COURSE_CODE,COURSE_LEVEL,COURSE_NAME,COURSE_DURATION,COURSE_CONTENT,PRE_REQUISITE,TEACHER_ID,CREATED_AT,UPDATED_AT) values ('r_1','medium','Reading',15,'https://sway.office.com/s/9kEj7VJzWlU00gTo/embed','w_2',1,null,null);
--------------------------------------------------------
--  DDL for Index COURSES_COURSE_CODE_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "ABC"."COURSES_COURSE_CODE_PK" ON "ABC"."COURSES" ("COURSE_CODE") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Trigger COURSES_COURSE_CODE
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "ABC"."COURSES_COURSE_CODE" 
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
/
ALTER TRIGGER "ABC"."COURSES_COURSE_CODE" ENABLE;
--------------------------------------------------------
--  Constraints for Table COURSES
--------------------------------------------------------

  ALTER TABLE "ABC"."COURSES" ADD CONSTRAINT "COURSES_COURSE_CODE_PK" PRIMARY KEY ("COURSE_CODE")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
  ALTER TABLE "ABC"."COURSES" ADD CONSTRAINT "COURSE_DURATION_CK" CHECK (course_duration>13) ENABLE;
  ALTER TABLE "ABC"."COURSES" MODIFY ("TEACHER_ID" NOT NULL ENABLE);
  ALTER TABLE "ABC"."COURSES" MODIFY ("COURSE_NAME" NOT NULL ENABLE);
  ALTER TABLE "ABC"."COURSES" MODIFY ("COURSE_LEVEL" NOT NULL ENABLE);
  ALTER TABLE "ABC"."COURSES" MODIFY ("COURSE_CODE" NOT NULL ENABLE);
--------------------------------------------------------
--  Ref Constraints for Table COURSES
--------------------------------------------------------

  ALTER TABLE "ABC"."COURSES" ADD CONSTRAINT "COURSE_TEACHER_ID_FK" FOREIGN KEY ("TEACHER_ID")
	  REFERENCES "ABC"."TEACHERS" ("TEACHER_ID") ENABLE;
