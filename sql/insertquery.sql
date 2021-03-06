--------------------------------------------------------
--  File created - Friday-June-25-2021   
--------------------------------------------------------
--------------------------------------------------------
--  DDL for Table CHILDS
--------------------------------------------------------

  CREATE TABLE "ABC"."CHILDS" 
   (	"CHILD_ID" NUMBER(10,0), 
	"CREATED_AT" TIMESTAMP (6), 
	"UPDATED_AT" TIMESTAMP (6), 
	"ACCT_HOLDER_ID" NUMBER(10,0), 
	"CHILD_NAME" VARCHAR2(255 BYTE), 
	"CHILD_AGE" VARCHAR2(255 BYTE), 
	"CHILD_GENDER" VARCHAR2(255 BYTE), 
	"FATHER_NAME" VARCHAR2(255 BYTE), 
	"FATHER_PHONE_NO" VARCHAR2(255 BYTE), 
	"FATHER_EMAIL" VARCHAR2(255 BYTE), 
	"MOTHER_NAME" VARCHAR2(255 BYTE), 
	"MOTHER_PHONE_NO" VARCHAR2(255 BYTE), 
	"MOTHER_EMAIL" VARCHAR2(255 BYTE), 
	"COMMUNICATION_SKILL" VARCHAR2(255 BYTE), 
	"SPECIAL_SKILL" VARCHAR2(255 BYTE), 
	"EATING_HABIT" VARCHAR2(255 BYTE), 
	"HOBBY" VARCHAR2(255 BYTE), 
	"AUTISM_TYPE" VARCHAR2(255 BYTE), 
	"REPEATATIVE_BEHAVIOUR" VARCHAR2(255 BYTE), 
	"PROFILE_PHOTO" VARCHAR2(255 BYTE) DEFAULT 'default.jpg'
   ) SEGMENT CREATION IMMEDIATE 
  PCTFREE 10 PCTUSED 40 INITRANS 1 MAXTRANS 255 NOCOMPRESS LOGGING
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
REM INSERTING into ABC.CHILDS
SET DEFINE OFF;
Insert into ABC.CHILDS (CHILD_ID,CREATED_AT,UPDATED_AT,ACCT_HOLDER_ID,CHILD_NAME,CHILD_AGE,CHILD_GENDER,FATHER_NAME,FATHER_PHONE_NO,FATHER_EMAIL,MOTHER_NAME,MOTHER_PHONE_NO,MOTHER_EMAIL,COMMUNICATION_SKILL,SPECIAL_SKILL,EATING_HABIT,HOBBY,AUTISM_TYPE,REPEATATIVE_BEHAVIOUR,PROFILE_PHOTO) values (1,to_timestamp('21-JUN-21 10.51.33.000000000 PM','DD-MON-RR HH.MI.SSXFF AM'),to_timestamp('21-JUN-21 10.51.33.000000000 PM','DD-MON-RR HH.MI.SSXFF AM'),2,'Deanna Hopper','83','others','Quon Pennington','52','kowikos@mailinator.com','Ishmael Shelton','88','zesom@mailinator.com','Autem doloremque nat','Laborum Voluptas al','Aspernatur nisi illo','Voluptas ducimus do','abcd','Consectetur neque v','default.jpg');
Insert into ABC.CHILDS (CHILD_ID,CREATED_AT,UPDATED_AT,ACCT_HOLDER_ID,CHILD_NAME,CHILD_AGE,CHILD_GENDER,FATHER_NAME,FATHER_PHONE_NO,FATHER_EMAIL,MOTHER_NAME,MOTHER_PHONE_NO,MOTHER_EMAIL,COMMUNICATION_SKILL,SPECIAL_SKILL,EATING_HABIT,HOBBY,AUTISM_TYPE,REPEATATIVE_BEHAVIOUR,PROFILE_PHOTO) values (2,to_timestamp('21-JUN-21 10.51.38.000000000 PM','DD-MON-RR HH.MI.SSXFF AM'),to_timestamp('21-JUN-21 10.51.38.000000000 PM','DD-MON-RR HH.MI.SSXFF AM'),2,'Lysandra Baxter','18','male','Ethan Noel','79','ziqe@mailinator.com','Brock Thomas','91','lojuka@mailinator.com','Et et et ea est offi','Debitis ut quia anim','Deleniti pariatur A','Veritatis nihil anim','typo_2','Officia saepe ut eiu','default.jpg');
Insert into ABC.CHILDS (CHILD_ID,CREATED_AT,UPDATED_AT,ACCT_HOLDER_ID,CHILD_NAME,CHILD_AGE,CHILD_GENDER,FATHER_NAME,FATHER_PHONE_NO,FATHER_EMAIL,MOTHER_NAME,MOTHER_PHONE_NO,MOTHER_EMAIL,COMMUNICATION_SKILL,SPECIAL_SKILL,EATING_HABIT,HOBBY,AUTISM_TYPE,REPEATATIVE_BEHAVIOUR,PROFILE_PHOTO) values (3,to_timestamp('21-JUN-21 11.11.46.000000000 PM','DD-MON-RR HH.MI.SSXFF AM'),to_timestamp('21-JUN-21 11.11.46.000000000 PM','DD-MON-RR HH.MI.SSXFF AM'),1,'Hyatt Payne','4','others','Alana Benton','25','tyri@mailinator.com','Imelda Mcdaniel','62','lomuti@mailinator.com','Sapiente dolorem eiu','Facere nesciunt ea','Consequatur volupta','Blanditiis eius ulla','typo_3','Accusamus qui cum ex','default.jpg');
--------------------------------------------------------
--  DDL for Index CHILDS_CHILD_ID_PK
--------------------------------------------------------

  CREATE UNIQUE INDEX "ABC"."CHILDS_CHILD_ID_PK" ON "ABC"."CHILDS" ("CHILD_ID") 
  PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS" ;
--------------------------------------------------------
--  DDL for Trigger CHILDS_CHILD_ID_TRG
--------------------------------------------------------

  CREATE OR REPLACE TRIGGER "ABC"."CHILDS_CHILD_ID_TRG" 
            before insert on CHILDS
            for each row
                begin
            if :new.CHILD_ID is null then
                select childs_child_id_seq.nextval into :new.CHILD_ID from dual;
            end if;
            end;
/
ALTER TRIGGER "ABC"."CHILDS_CHILD_ID_TRG" ENABLE;
--------------------------------------------------------
--  Constraints for Table CHILDS
--------------------------------------------------------

  ALTER TABLE "ABC"."CHILDS" MODIFY ("PROFILE_PHOTO" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" ADD CONSTRAINT "CHILDS_CHILD_ID_PK" PRIMARY KEY ("CHILD_ID")
  USING INDEX PCTFREE 10 INITRANS 2 MAXTRANS 255 COMPUTE STATISTICS 
  STORAGE(INITIAL 65536 NEXT 1048576 MINEXTENTS 1 MAXEXTENTS 2147483645
  PCTINCREASE 0 FREELISTS 1 FREELIST GROUPS 1 BUFFER_POOL DEFAULT FLASH_CACHE DEFAULT CELL_FLASH_CACHE DEFAULT)
  TABLESPACE "USERS"  ENABLE;
  ALTER TABLE "ABC"."CHILDS" MODIFY ("REPEATATIVE_BEHAVIOUR" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" MODIFY ("EATING_HABIT" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" MODIFY ("COMMUNICATION_SKILL" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" MODIFY ("MOTHER_NAME" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" MODIFY ("FATHER_NAME" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" MODIFY ("CHILD_GENDER" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" MODIFY ("CHILD_AGE" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" MODIFY ("CHILD_NAME" NOT NULL ENABLE);
  ALTER TABLE "ABC"."CHILDS" MODIFY ("CHILD_ID" NOT NULL ENABLE);
--------------------------------------------------------
--  Ref Constraints for Table CHILDS
--------------------------------------------------------

  ALTER TABLE "ABC"."CHILDS" ADD CONSTRAINT "CHILDS_ACCT_HOLDER_ID_FK" FOREIGN KEY ("ACCT_HOLDER_ID")
	  REFERENCES "ABC"."GUARDIANS" ("ACCT_HOLDER_ID") ON DELETE SET NULL ENABLE;
