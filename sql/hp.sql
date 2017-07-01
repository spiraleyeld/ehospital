
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
  ssno varchar(5) not null,
  ssname varchar(20) not null,
  timestart varchar(20) not null,
  timeend varchar(20) not null,
  constraint pk_session_pno primary key(ssno)
);

insert into session values('ss01','morning','09:00:00','12:00:00');
insert into session values('ss02','afternoon','14:00:00','18:00:00');
insert into session values('ss03','night','19:00:00','22:00:00');




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

drop view if exists schedule;

create view schedule as 
    select a.siteno, d.sname, a.empno,c.ename, a.ssno,b.timestart, b.timeend 
    from empsite a left join session b on a.ssno=b.ssno 
                   left join emp c on a.empno=c.empno 
                   left join site d on a.siteno = d.siteno;


create view onduty as select *,case when current_time()>timestart and current_time()<timeend then 'on_duty' else '' end status from schedule;
