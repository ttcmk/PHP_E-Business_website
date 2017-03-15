create table Zipcode
	(zipcode	varchar(20),
	 city		varchar(50),
	 state		varchar(50),
	 primary key (zipcode)
	);

create table Address
	(AddressID	varchar(20), 
	 street		varchar(50), 
	 zipcode    varchar(20),
	 primary key (AddressID),
	 foreign key (zipcode) references Zipcode(zipcode)
	 	on delete cascade
	);

create table Business
	(BusinessID		     			varchar(20), 
	 business_category				varchar(50), 
	 company_name					varchar(20),
	 company_gross_annual_income	varchar(20),
	 primary key (BusinessID)
	);

create table Business_Customer
	(Business_CustomerID	varchar(20), 
	 name					varchar(20), 
	 AddressID				varchar(20), 
	 BusinessID				varchar(20),
	 password				varchar(16),
	 primary key (Business_CustomerID),
	 foreign key (BusinessID) references Business(BusinessID)
		on delete cascade,
	 foreign key (AddressID) references Address(AddressID)
	 	on delete cascade
	);

create table Home
	(HomeID				varchar(20), 
     gender				varchar(8),
	 age				varchar(6), 
	 marriage_status	varchar(20),
	 income				varchar(20),
	 primary key (HomeID)
	);

create table Home_Customer
	(Home_CustomerID	varchar(20), 
	 name				varchar(20),
	 AddressID			varchar(20), 
	 HomeID				varchar(20),
	 password			varchar(16),
	 primary key (Home_CustomerID),
	 foreign key (HomeID) references Home(HomeID)
		on delete cascade,
	 foreign key (AddressID) references Address(AddressID)
	 	on delete cascade
	);

create table Product
	(ProductID			varchar(20), 
	 name				varchar(20), 
	 inventory_amount	numeric(10),
	 price				numeric(10),
	 kind				varchar(20),
	 primary key (ProductID)
	);

create table Region
	(RegionID			varchar(10), 
	 region_name		varchar(20),
	 region_managerID	varchar(20),
	 primary key (RegionID)
	);

create table Store
	(StoreID				varchar(10),
	 AddressID				varchar(20),
	 managerID				varchar(20),
	 NumberofSalespersons 	numeric(5),
	 RegionID				varchar(10),
	 primary key (StoreID),
	 foreign key (AddressID) references Address(AddressID)
		on delete cascade,
	 foreign key (RegionID) references Region(RegionID)
	 	on delete cascade
	);

create table Salesperson
	(SalespersonID		varchar(20),
	 name				varchar(20),
	 AddressID			varchar(20),
	 e_mail				varchar(50),
	 StoreID			varchar(10),
	 jobtitle			varchar(20),
	 salary				numeric(10),
	 primary key (SalespersonID),
	 foreign key (AddressID) references Address(AddressID)
	 	on delete cascade,
	 foreign key (StoreID) references Store(StoreID)
	 	on delete cascade
	);

create table Business_Transaction
	(orderID				varchar(10), 
	 order_date				datetime,
	 SalespersonID  		varchar(20),
	 ProductID 				varchar(20),
	 quantity				numeric(5),
	 Business_CustomerID 	varchar(20),
	 primary key (orderID),
	 foreign key (SalespersonID) references Salesperson(SalespersonID)
		on delete cascade,
	 foreign key (ProductID) references Product(ProductID)
	 	on delete cascade,
	 foreign key (Business_CustomerID) references Business_Customer(Business_CustomerID)
	 	on delete cascade
	);

create table Home_Transaction
	(orderID			varchar(10), 
	 order_date			datetime,
	 SalespersonID  	varchar(20),
	 ProductID 			varchar(20),
	 quantity			numeric(5),
	 Home_CustomerID 	varchar(20),
	 primary key (orderID),
	 foreign key (SalespersonID) references Salesperson(SalespersonID)
		on delete cascade,
	 foreign key (ProductID) references Product(ProductID)
	 	on delete cascade,
	 foreign key (Home_CustomerID) references Home_Customer(Home_CustomerID)
	 	on delete cascade
	);

alter table Store add constraint fk_store 
foreign key (managerID) references Salesperson(SalespersonID)
	on update cascade
	on delete cascade;

alter table Region add constraint fk_region 
foreign key (region_managerID) references Salesperson(SalespersonID)
	on update cascade
	on delete cascade;



