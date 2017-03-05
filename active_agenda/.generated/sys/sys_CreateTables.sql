CREATE TABLE `sys` (
   SystemID int unsigned auto_increment not null,
   OrganizationID int,
   SystemTypeID int unsigned not null,
   SystemName varchar(128),
   SystemDesc text,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      SystemID
   )
) TYPE=InnoDB;

-- statement separator --


CREATE TABLE `sys_l` (
   _RecordID int unsigned not null auto_increment,
   SystemID int unsigned  not null,
   OrganizationID int,
   SystemTypeID int unsigned not null,
   SystemName varchar(128),
   SystemDesc text,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      _RecordID,
      SystemID
   )
) TYPE=InnoDB;
