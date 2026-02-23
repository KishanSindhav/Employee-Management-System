create database if not exists emp_management;

use emp_management;

create table user_detail(
uid int(3) primary key auto_increment,
first_name varchar(15) not null,
last_name varchar(12) not null,
role char(1) not null,
email varchar(50)not null unique key,
address varchar(100)not null,
salary int(6) ,
password varchar(32)not null,
pPAth varchar(255) default NULL
);

desc user_detail;

insert into user_detail(first_name,last_name,role,email,address,password)
values("Hiren","Vaghela","1","hirensinh@gmail.com","iyava,sanand,ahemdabad","6ebe76c9fb411be97b3b0d48b791a7c9"),
("Kishan","Sindhav","1","kishan@gmail.com","navrangpura,ahemdabad","6ebe76c9fb411be97b3b0d48b791a7c9"),
("Trupal","Lathiya","2","lathiyat13@gmail.com","lathi,amreli","25f9e794323b453885f5181f1b624d0b"),
("Harsh","Dedakiya","2","hd002@gmail.com","nikol,ahemdabad","25f9e794323b453885f5181f1b624d0b"),
("Aryan","Hirapara","2","aryan12@gmail.com","nikol,ahemdabad","25f9e794323b453885f5181f1b624d0b"),
("Nidhi","Chavada","2","nidhuu@gmail.com","vastral,ahemdabad","25f9e794323b453885f5181f1b624d0b"),
("Ansh","Yadav","2","aj@gmail.com","block12,university,rajkot","25f9e794323b453885f5181f1b624d0b"),
("Ankit","Yadav","2","ankit78@gmail.com","a block,gandhinagar","25f9e794323b453885f5181f1b624d0b"),
("Tej","Doshi","2","tejdoshi3@gmail.com","s block,motichok,gandhinagar","25f9e794323b453885f5181f1b624d0b"),
("Ekta","Agja","2","ekta001@gmail.com","manekchok,ahemdabad","25f9e794323b453885f5181f1b624d0b");

create table temp(
uid int(3) primary key auto_increment,
first_name varchar(15) not null,
last_name varchar(12) not null,
role char(1) not null,
email varchar(50)not null unique key,
address varchar(100)not null,
salary int(6) ,
password varchar(32)not null
);
desc temp;

create table empsalary(
uid int(3) not null,
user_name varchar(15) ,
bsalary int(6) not null,
gsalary int(7),
date date,
foreign key (uid) references user_detail(uid)
);
desc empsalary;






create table notification(
id int(5) auto_increment primary key,
uid int (3) not null,
title varchar(100),
content varchar(5000),
time timestamp,
foreign key (uid) references user_detail(uid)
);

insert into notification(uid,title,content,time)
values(1,"What is the new policy of working hours?","No worker under the Act shall be required to work for more than 
48 hours in any week, according to Section 51.",now()),
(3,"Which day companies give salary?","India. In India, salaries are generally paid on the last working day of 
the month (Government, Public sector departments, Multi-national organisations as well as majority of other 
private sector companies).",now()),
(1,"What is the salary policy?","Salary policies are practical documents to aid in the administration of employees
 salaries. They set the framework in which remuneration of employees is determined.",now());

create table temp_notification(
id int(5) auto_increment primary key,
uid int (3) not null,
title varchar(100),
content varchar(5000),
time timestamp,
foreign key (uid) references user_detail(uid)
);

create table comm_emp_man(
id int(6) auto_increment primary key,
uid int(3) not null,
email varchar(50),
responce varchar(2000) not null,
time timestamp,
read_flag char(1),
foreign key (uid) references user_detail(uid)
);

create table comm_cto(
id int(6) auto_increment primary key,
uid int(3) not null,
responce varchar(2000) not null,
time timestamp,
read_flag char(1),
is_cto char(1),
foreign key (uid) references user_detail(uid)
);




create table project(
pid int(5) auto_increment primary key,
ptitle varchar(100),
description varchar(5000),
startDate date,
endDate date
);

create table avail(
pid int(5),
uid int (3) not null,
avail_flag char (1),
foreign key (uid) references user_detail(uid),
foreign key (pid) references project(pid)
);

insert into avail(uid,avail_flag)
values(3,0),
(4,0),
(5,0),
(6,0),
(7,0),
(8,0),
(9,0),
(10,0),
(1,0),
(2,0);

create table project_detail(
pid int(5) not null,
uid int(3) not null,
completedflag char(1),
completedDate date,
foreign key (pid) references project(pid)
);

create table feedback(
id int(4) auto_increment primary key,
uid int (3) not null,
pid int(5) not null,
feedback varchar(2000) not null,
foreign key (pid) references project(pid),
foreign key (uid) references user_detail(uid)
);
desc feedback;

create table task(
id int(4) auto_increment primary key,
ntask varchar(500) not null,
uid int (3) not null,
pid int(5) not null,
done_flag char(1) DEFAULT 0,
foreign key (pid) references project(pid),
foreign key (uid) references user_detail(uid)
);
desc task;

create table attendance(
uid int (3) not null,
date date,
status char(1) default 'P',
workHour float(4,2) default 0,
foreign key (uid) references user_detail(uid)
);

create table tempCount(
id int(5) primary key auto_increment,
uid int(3) not null,
date date not null,
lTime time not null,
lOutTime time,
foreign key (uid) references user_detail(uid)
);

CREATE TABLE emp_leave (
    id INT(5) PRIMARY KEY AUTO_INCREMENT,
    uid INT(3) NOT NULL,
    reason VARCHAR(200) NOT NULL,
    sdate DATE NOT NULL,
    edate DATE NOT NULL,
    path VARCHAR(50),
    status TINYINT(1) NOT NULL DEFAULT 0,
    FOREIGN KEY (uid) REFERENCES user_detail(uid)
);

-- attendance =  count(month end , total attendanc , total working days in month)