
drop table if exists site;

create table site (
  siteno varchar(5) not null,
  sname varchar(14) not null,
  constraint pk_site_siteno primary key(siteno)
);

 
insert into site values('s01','ward1');
insert into site values('s02','ward2');


drop table if exists emp;

create table emp (
  empno varchar(5) not null,
  ename varchar(14) not null,
  constraint pk_emp_empno primary key(empno)
);


insert into emp values('e01','ken');
insert into emp values('e02','wei');


drop table if exists session;

create table session (
  siteno varchar(5) not null,  
  ssno varchar(5) not null,
  empno varchar(5) not null,
  constraint pk_session_pno primary key(ssno)
);

insert into session values('ss01','morning');
insert into session values('ss02','afternoon');
insert into session values('ss03','night');




drop table if exists empsite;

create table empsite (
  siteno varchar(5) not null,
  ssno varchar(5) not null,
  empno varchar(5) not null,
  constraint pk_empsite_sitessemp primary key(siteno,ssno,empno),
  constraint fk_empsite_siteno foreign key(siteno) references site(siteno),
  constraint fk_empsite_ssno foreign key(ssno) references session(ssno),
  constraint fk_empsite_empno foreign key(empno) references emp(empno)
);


insert into empsite values('s01','ss01','e01');
insert into empsite values('s01','ss02','e01');
insert into empsite values('s01','ss03','e02');
insert into empsite values('s02','ss01','e02');
insert into empsite values('s02','ss02','e02');
insert into empsite values('s02','ss03','e01');