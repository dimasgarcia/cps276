--  the Database
CREATE DATABASE Project_6;
USE Project_6;

-- Tables
CREATE TABLE Customer (
    id INT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(255),
    lastname VARCHAR(255),
    address VARCHAR(255),
    city VARCHAR(255),
    state VARCHAR(255),
    zip VARCHAR(20),
    phone VARCHAR(20),
    email VARCHAR(255),
    password VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE ProductGroup (
    id INT PRIMARY KEY AUTO_INCREMENT,
    groupname VARCHAR(255),
    imagefolder VARCHAR(255)
) ENGINE=InnoDB;

CREATE TABLE Product (
    id INT PRIMARY KEY AUTO_INCREMENT,
    groupid INT,
    productname VARCHAR(255),
    productprice DECIMAL(10, 2),
    image VARCHAR(255),
    description TEXT,
    FOREIGN KEY (groupid) REFERENCES ProductGroup(id)
) ENGINE=InnoDB;

CREATE TABLE Orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    timestamp INT,
    customerid INT,
    FOREIGN KEY (customerid) REFERENCES Customer(id)
) ENGINE=InnoDB;

CREATE TABLE OrderInfo (
    id INT PRIMARY KEY AUTO_INCREMENT,
    orderid INT,
    productid INT,
    amount INT,
    FOREIGN KEY (orderid) REFERENCES Orders(id),
    FOREIGN KEY (productid) REFERENCES Product(id)
) ENGINE=InnoDB;


DESCRIBE Customer;
DESCRIBE ProductGroup;
DESCRIBE Product;
DESCRIBE Orders;
DESCRIBE OrderInfo;
SELECT * FROM Customer;
SELECT * FROM ProductGroup;
SELECT * FROM Product;
SELECT * FROM Orders;
SELECT * FROM OrderInfo;