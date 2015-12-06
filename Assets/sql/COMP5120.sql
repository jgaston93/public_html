CREATE TABLE Books (
	BookID int NOT NULL,
	Title varchar(50) NOT NULL,
	UnitPrice float NOT NULL,
	Author varchar(50) NOT NULL,
	Quantity int NOT NULL,
	SupplierID int NOT NULL,
	SubjectID int NOT NULL,
	PRIMARY KEY (BookID),
	FOREIGN KEY (SupplierID) REFERENCES Suppliers(SupplierID),
	FOREIGN KEY (SubjectID) REFERENCES Subjects(SubjectID)
);
CREATE TABLE Customers (
CustomerID int NOT NULL,
LastName varchar(50) NOT NULL,
FirstName varchar(50) NOT NULL,
Phone varchar(15) NOT NULL,
PRIMARY KEY (CustomerID)
);
CREATE TABLE Employees (
EmployeeID int NOT NULL,
LastName varchar(50) NOT NULL,
FirstName varchar(50) NOT NULL,
PRIMARY KEY (EmployeeID)
);
CREATE TABLE Orders (
OrderID int NOT NULL,
CustomerID int NOT NULL,
EmployeeID int NOT NULL,
OrderDate date NOT NULL,
ShippedDate date,
ShipperID int,
PRIMARY KEY (OrderID),
FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID),
FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID),
FOREIGN KEY (ShipperID) REFERENCES Shippers(ShipperID)
);
CREATE TABLE OrderDetails (
BookID int NOT NULL,
OrderID int NOT NULL,
Quantity int NOT NULL,
FOREIGN KEY (BookID) REFERENCES Books(BookID),
FOREIGN KEY (OrderID) REFERENCES Orders(OrderID)
);
CREATE TABLE Shippers (
ShipperID int NOT NULL,
ShpperName varchar(50) NOT NULL,
PRIMARY KEY (ShipperID)
);
CREATE TABLE Subjects (
SubjectID int NOT NULL,
Category varchar(50) NOT NULL,
PRIMARY KEY (SubjectID)
);
CREATE TABLE Suppliers (
SupplierID int NOT NULL,
CompanyName varchar(50) NOT NULL,
ContactLastName varchar(50),
ContactFirstName varchar(50),
Phone varchar(15) NOT NULL,
PRIMARY KEY (SupplierID)
);
INSERT INTO Books
VALUES (1,"book1",12.34,"author1",5,3,1);
INSERT INTO Books
VALUES (2,"book2",56.78,"author2",2,3,1);
INSERT INTO Books
VALUES (3,"book3",90.12,"author3",10,2,1);
INSERT INTO Books
VALUES (4,"book4",34.56,"author4",12,3,2);
INSERT INTO Books
VALUES (5,"book5",78.90,"author5",5,2,2);
INSERT INTO Books
VALUES (6,"book6",12.34,"author6",30,1,3);
INSERT INTO Books
VALUES (7,"book7",56.90,"author2",17,3,4);
INSERT INTO Books
VALUES (8,"book8",33.44,"author7",2,1,3);
INSERT INTO Customers
VALUES (1,"lastname1","firstname1","334-001-001");
INSERT INTO Customers
VALUES (2,"lastname2","firstname2","334-002-002");
INSERT INTO Customers
VALUES (3,"lastname3","firstname3","334-003-003");
INSERT INTO Customers
VALUES (4,"lastname4","firstname4","334-004-004");
INSERT INTO Employees
VALUES (1,"lastname5","firstname5");
INSERT INTO Employees
VALUES (2,"lastname6","firstname6");
INSERT INTO Orders
VALUES (1,1,1,"8/1/2013","8/3/2014",1);
INSERT INTO Orders
VALUES (2,1,2,"8/4/2013",NULL,NULL);
INSERT INTO Orders
VALUES (3,2,1,"8/1/2013","8/4/2014",2);
INSERT INTO Orders
VALUES (4,4,2,"8/4/2013","8/4/2014",1);
INSERT INTO Orders
VALUES (5,1,1,"8/4/2013","8/5/2014",1);
INSERT INTO Orders
VALUES (6,4,2,"8/4/2013","8/5/2014",1);
INSERT INTO Orders
VALUES (7,3,1,"8/4/2013","8/4/2014",1);
INSERT INTO OrderDetails
VALUES (1,1,2);
INSERT INTO OrderDetails
VALUES (4,1,1);
INSERT INTO OrderDetails
VALUES (6,2,2);
INSERT INTO OrderDetails
VALUES (7,2,3);
INSERT INTO OrderDetails
VALUES (5,3,1);
INSERT INTO OrderDetails
VALUES (3,4,1);
INSERT INTO OrderDetails
VALUES (4,4,1);
INSERT INTO OrderDetails
VALUES (7,4,1);
INSERT INTO OrderDetails
VALUES (1,5,1);
INSERT INTO OrderDetails
VALUES (1,6,2);
INSERT INTO OrderDetails
VALUES (1,7,1);
INSERT INTO Shippers
VALUES (1,"shipper1");
INSERT INTO Shippers
VALUES (2,"shipper2");
INSERT INTO Shippers
VALUES (3,"shipper3");
INSERT INTO Subjects
VALUES (1,"category1");
INSERT INTO Subjects
VALUES (2,"category2");
INSERT INTO Subjects
VALUES (3,"category3");
INSERT INTO Subjects
VALUES (4,"category4");
INSERT INTO Suppliers
VALUES (1,"supplier1","company1",NULL,"1111111111");
INSERT INTO Suppliers
VALUES (2,"supplier2","company2",NULL,"2222222222");
INSERT INTO Suppliers
VALUES (3,"supplier3","company3",NULL,"3333333333");
INSERT INTO Suppliers
VALUES (4,"supplier4","company4",NULL,"4444444444");


DROP TABLE Books;
DROP TABLE Customers;
DROP TABLE Employees;
DROP TABLE Orders;
DROP TABLE OrderDetails;
DROP TABLE Shippers;
DROP TABLE Subjects;
DROP TABLE Suppliers;



