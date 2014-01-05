PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE "address" ("id" INTEGER PRIMARY KEY  AUTOINCREMENT  NOT NULL , "label" VARCHAR NOT NULL , "street" VARCHAR NOT NULL , "housenumber" VARCHAR NOT NULL , "postalcode" VARCHAR NOT NULL , "city" VARCHAR NOT NULL , "country" VARCHAR NOT NULL );
INSERT INTO "address" VALUES(1,'The White House','Pennsylvania Ave NW','1600','DC 20500','Washington','USA');
INSERT INTO "address" VALUES(2,'Google Headquarters','Amphitheatre Parkway Mountain View','1600','CA 94043','California','USA');
INSERT INTO "address" VALUES(3,'Trump Tower',' Fifth Avenue Manhattan','725','NY 10022','New York City','USA');
DELETE FROM sqlite_sequence;
INSERT INTO "sqlite_sequence" VALUES('address',3);
COMMIT;
