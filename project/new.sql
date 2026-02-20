
use emp_management;

create table user_detail(
uid int(3) primary key auto_increment,
user_name varchar(15) unique key,
first_name varchar(15) not null,
last_name varchar(12) not null,
role int(1) not null,
email varchar(50)not null,
address varchar(100)not null,
salary int(6) ,
password varchar(15)not null
);

desc user_detail;

insert into user_detail(user_name,first_name,last_name,role,email,address,password)
values("manager1","hiren","vaghela","1","hirensinh@gmail.com","iyava,sanand,ahemdabad","987654321"),
("manager2","kishan","sindhav","1","kishan@gmail.com","navrangpura,ahemdabad","987654321"),
("employee1","trupal","lathiya","2","lathiyat13@gmail.com","lathi,amreli","123456789"),
("employee2","harsh","dedakiya","2","hd002@gmail.com","nikol,ahemdabad","123456789"),
("employee3","aryan","hirapara","2","aryan12@gmail.com","nikol,ahemdabad","123456789"),
("employee4","nidhi","chavada","2","nidhuu@gmail.com","vastral,ahemdabad","123456789"),
("employee5","ansh","yadav","2","aj@gmail.com","block12,university,rajkot","123456789"),
("employee6","ankit","yadav","2","ankit78@gmail.com","a block,gandhinagar","123456789"),
("employee7","tej","doshi","2","tejdoshi3@gmail.com","s block,motichok,gandhinagar","123456789"),
("employee8","ekta","agja","2","ekta001@gmail.com","manekchok,ahemdabad","123456789");

create table temp(
uid int(3) primary key auto_increment,
user_name varchar(15) unique key,
first_name varchar(15) not null,
last_name varchar(12) not null,
role int(1) not null,
email varchar(50)not null,
address varchar(100)not null,
salary int(6) ,
password varchar(15)not null
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
user_name varchar(15),
responce varchar(2000) not null,
time timestamp,
read_flag int(1),
foreign key (uid) references user_detail(uid)
);

create table comm_cto(
id int(6) auto_increment primary key,
uid int(3) not null,
responce varchar(2000) not null,
time timestamp,
read_flag int(1),
is_cto int(1),
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
avail_flag int (1),
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
completedflag int(1),
completedDate date,
foreign key (pid) references project(pid)
);

create table feedback(
id int(4) auto_increment primary key,
uid int (3) not null,
pid int(5) not null,
first_name varchar(15) not null,
last_name varchar(12) ,
email varchar(50)not null,
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
foreign key (pid) references project(pid),
foreign key (uid) references user_detail(uid)
);
desc task;