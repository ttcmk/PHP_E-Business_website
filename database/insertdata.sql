alter table Region drop foreign key fk_region;
alter table Store drop foreign key fk_store;

insert into Zipcode values('12201','Albany','NY');
insert into Zipcode values('14201','Buffalo','NY');
insert into Zipcode values('19019','Philidelphia','PA');
insert into Zipcode values('99701','Fairsbanks','AK');
insert into Zipcode values('71953','Dallas','AR');
insert into Zipcode values('96801','Honolulu','HI');
insert into Zipcode values('10001','New York','NY');
insert into Zipcode values('15122','Pittsburgh','PA');


insert into Address values('01','Wall Street','10001');
insert into Address values('02','Broadway','71953');
insert into Address values('03','Bowery','14201');
insert into Address values('04','Houston Street','19019');
insert into Address values('05','Canal Street','99701');
insert into Address values('06','Madison Street','96801');
insert into Address values('07','Maiden Lane','15122');
insert into Address values('08','Steinway Street','12201');
insert into Address values('09','Love Lane','19019');
insert into Address values('10','Center Avenue','10001');
insert into Address values('11','Forbes Avenue','19019');
insert into Address values('12','Figueroa Street','99701');
insert into Address values('13','W Main Street','10001');
insert into Address values('14','W Commonwealth Avenue','96801');
insert into Address values('15','Arthur Avenue','15122');
insert into Address values('16','Western Avenue','19019');
insert into Address values('17','Bridge Street','14201');


insert into Business values('01','Internet company','Alliance Data Systems Corp', 20000000);
insert into Business values('02','Internet company','ADT Corp', 40000000);
insert into Business values('03','Food company','Aegon',2000000);
insert into Business values('04','Food company','Aetna',6000000);
insert into Business values('05','Electrical company','Agco',3500000);
insert into Business values('06','Securities company','Aaon',25000000);
insert into Business values('07','Airline company','American Airlines Group',80000000);
insert into Business values('08','Securities company','American Financial Group',70000000);
insert into Business values('09','Internet company','Geomet',1000000);
insert into Business values('10','Food company','GNMA',40000000);


insert into Business_Customer values('1001','ADT Corp','01','02','1000000');
insert into Business_Customer values('1002','Alliance Data Systems Corp','02','01','1000001');
insert into Business_Customer values('1003','Aegon','03','03','1000002');
insert into Business_Customer values('1004','Aetna','04','04','1000003');
insert into Business_Customer values('1005','Agco','05','05','1000004');
insert into Business_Customer values('1006','Aaon','06','06','1000005');
insert into Business_Customer values('1007','American Airlines Group','07','07','1000006');
insert into Business_Customer values('1008','American Financial Group','08','08','1000007');
insert into Business_Customer values('1009','Geomet','09','09','1000008');
insert into Business_Customer values('1010','GNMA','10','10','1000009');


insert into Home values('01','Male','28','Married', 60000);
insert into Home values('02','Female','30','Single', 70000);
insert into Home values('03','Female','35','Married', 56000);
insert into Home values('04','Male','21','Single', 65000);
insert into Home values('05','Male','23','Single', 30000);
insert into Home values('06','Female','26','Single', 100000);
insert into Home values('07','Female','28','Married', 95000);
insert into Home values('08','Female','22','Married', 90000);
insert into Home values('09','Male','22','Married', 110000);
insert into Home values('10','Female','45','Single', 95000);



insert into Home_Customer values('1001','John','11','01','20000');
insert into Home_Customer values('1002','Sarah','12','02','20001');
insert into Home_Customer values('1003','Iris','13','03','20002');
insert into Home_Customer values('1004','Peter','14','04','20003');
insert into Home_Customer values('1005','David','15','05','20004');
insert into Home_Customer values('1006','Floria','16','06','20005');
insert into Home_Customer values('1007','Lara','17','07','20006');



insert into Product values('01','Born to Run', 20, 15, 'Book');
insert into Product values('02','Scrappy Little Nobody', 100, 25, 'Book');
insert into Product values('03','Dell E2416HM Monitors', 189, 150, 'Computers');
insert into Product values('04','Sony MDRXB950BT Headphones', 1020, 130, 'Electronics');
insert into Product values('05','Tommy Hilfiger Mens watch', 3, 86, 'Fashion');
insert into Product values('06','ACME Chairs', 200, 159, 'Furniture');
insert into Product values('07','Seagate Backup 2TB portable Hard Drive', 2000, 70, 'Electronics');
insert into Product values('08','WD 1TB Hard Drive', 1000, 50, 'Electronics');
insert into Product values('09','Danby Microwave', 102, 75, 'Appliances');
insert into Product values('10','Baxter of Clay Pomade', 200, 20, 'Beauty');
insert into Product values('11','Pokemon Sun - 3DS', 30, 36, 'Games');

insert into Region values('01','North','01');
insert into Region values('02','Sorth','02');
insert into Region values('03','East','03');
insert into Region values('04','West','04');



insert into Store values('1001','01','01',2,'01');
insert into Store values('1002','02','03',1,'01');
insert into Store values('1003','03','04',1,'02');
insert into Store values('1004','04','05',2,'02');
insert into Store values('1005','05','06',2,'03');
insert into Store values('1006','06','08',1,'03');
insert into Store values('1007','07','09',1,'04');
insert into Store values('1008','08','11',2,'04');




insert into Salesperson values('01','Johnson','01','Johnson@gmail.com','1001','Sales Representative',35000);
insert into Salesperson values('02','Sarah','02','Sarah@gmail.com','1001','Sales Representative',5000);
insert into Salesperson values('03','Lara','03','Lara@gmail.com','1002','Sales Engineer',55000);
insert into Salesperson values('04','Iris','04','Iris@gmail.com','1003','Sales Representative',65000);
insert into Salesperson values('05','John','05','John@gmail.com','1004','Sales Assistant',25000);
insert into Salesperson values('06','Peterson','06','Peterson@gmail.com','1004','Sales Representative',40000);
insert into Salesperson values('07','Keith','07','Keith@gmail.com','1005','Sales Assistant',25000);
insert into Salesperson values('08','Sokayna','08','Sokayna@gmail.com','1006','Sales Representative',55000);
insert into Salesperson values('09','James','09','James@gmail.com','1007','Sales Representative',55000);
insert into Salesperson values('10','Angle','10','Angle@gmail.com','1008','Sales Representative',46000);
insert into Salesperson values('11','Imp','11','Imp@gmail.com','1008','Sales Engineer',65000);
insert into Salesperson values('12','Snow','12','Snow@gmail.com','1005','Sales Representative',75000);


insert into Business_Transaction values('101','2016-11-10 12:03:30','01','03', 200,'1001');
insert into Business_Transaction values('102','2016-12-01 17:12:30','02','03', 30,'1002');
insert into Business_Transaction values('103','2015-02-10 02:19:45','03','06', 50,'1003');
insert into Business_Transaction values('104','2015-10-24 12:28:50','04','06', 20,'1004');
insert into Business_Transaction values('105','2016-07-23 08:13:22','05','08', 500,'1005');
insert into Business_Transaction values('106','2014-07-02 12:43:12','06','08', 10,'1006');
insert into Business_Transaction values('107','2015-05-17 17:06:22','07','08', 20,'1007');




insert into Home_Transaction values('108','2016-12-03 12:07:45','08','01', 1,'1001');
insert into Home_Transaction values('109','2016-11-13 14:22:42','09','02', 1,'1002');
insert into Home_Transaction values('110','2015-09-11 14:02:55','10','04', 1,'1003');
insert into Home_Transaction values('111','2016-08-07 11:41:32','11','07', 2,'1004');
insert into Home_Transaction values('112','2014-02-24 08:04:23','12','09', 2,'1005');
insert into Home_Transaction values('113','2016-09-23 12:04:13','12','10', 1,'1006');
insert into Home_Transaction values('114','2016-06-17 23:06:32','10','11', 2,'1007');

alter table Store add constraint fk_store 
foreign key (managerID) references Salesperson(SalespersonID)
	on update cascade
	on delete cascade;

alter table Region add constraint fk_region 
foreign key (region_managerID) references Salesperson(SalespersonID)
	on update cascade
	on delete cascade;