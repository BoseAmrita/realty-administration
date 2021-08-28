
SET SQL_MODE = 'NO_AUTO_VALUE_ON_ZERO';

CREATE TABLE IF NOT EXISTS Users
(
F_name char(25) NOT NULL,
L_name char(25) NOT NULL,
Uids int NOT NULL AUTO_INCREMENT,
Gender char(10) NOT NULL,
Utype char(25) NOT NULL,
Password char(50) NOT NULL,
PRIMARY KEY (Uids),
CHECK (Gender IN ('Prefer Not to say','Male', 'Female'))
)AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS U_Address
(
Street char(25) NOT NULL,
House char(25) NOT NULL,
Zip integer NOT NULL,
City char(25) NOT NULL,
Uids int NOT NULL,
PRIMARY KEY (Uids)
);

CREATE TABLE IF NOT EXISTS Contact
(
Uids int NOT NULL,
Mobile char(25) NOT NULL,
PRIMARY KEY (Uids, Mobile),
FOREIGN KEY (Uids)
 REFERENCES users(Uids)
 ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Email
(
Uids int NOT NULL,
Emailids char(25) NOT NULL,
PRIMARY KEY (Uids, Emailids),
FOREIGN KEY (Uids)
 REFERENCES users(Uids)
 ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Sell
(
AdId int NOT NULL AUTO_INCREMENT,
AdType char(25) NOT NULL,
Uids int NOT NULL,
PRIMARY KEY (AdId),
FOREIGN KEY (Uids)
 REFERENCES users(Uids)
 ON DELETE CASCADE
)AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS  Buy
(
AdId int NOT NULL,
Uids int NOT NULL,
PRIMARY KEY (AdId, Uids),
FOREIGN KEY (Uids)
 REFERENCES users(Uids)
 ON DELETE CASCADE,
FOREIGN KEY (AdId)
 REFERENCES Sell(AdId)
 ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Estate
(
Eids int NOT NULL AUTO_INCREMENT,
Uids int NOT NULL,
Area char(25) NOT NULL,
Price integer NOT NULL,
Etype char(25) NOT NULL,
Surface char(25) NOT NULL,
Room integer NOT NULL,
Bathroom integer NOT NULL,
Additional char(25) NOT NULL,
PRIMARY KEY (Eids)
)AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS Placed_For
(
AdId int NOT NULL,
Eids int NOT NULL,
PRIMARY KEY (AdId),
FOREIGN KEY (AdId)
 REFERENCES Sell(AdId)
 ON DELETE CASCADE,
FOREIGN KEY (Eids) REFERENCES Estate(Eids) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Location
(
City char(25) NOT NULL,
House char(25) NOT NULL,
Street char(25) NOT NULL,
Zip integer NOT NULL,
Eids int NOT NULL,
PRIMARY KEY (Eids),
FOREIGN KEY (Eids) REFERENCES Estate(Eids) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS Upload
(
Iids int NOT NULL AUTO_INCREMENT,
Idata char(25) NOT NULL,
Ititle char(25) NOT NULL,
Eids int NOT NULL,
PRIMARY KEY (Iids),
FOREIGN KEY (Eids) REFERENCES Estate(Eids) ON DELETE CASCADE
)AUTO_INCREMENT=1;

