CREATE TABLE `hzr` (
   HazardID int unsigned auto_increment not null,
   HazardTitle varchar(128),
   Description text,
   OrganizationID int,
   ReceivedDate datetime,
   ReportSourceID int,
   HazAbateStatusID int,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      HazardID
   )
) TYPE=InnoDB;

-- statement separator --


CREATE TABLE `hzr_l` (
   _RecordID int unsigned not null auto_increment,
   HazardID int unsigned  not null,
   HazardTitle varchar(128),
   Description text,
   OrganizationID int,
   ReceivedDate datetime,
   ReportSourceID int,
   HazAbateStatusID int,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      _RecordID,
      HazardID
   )
) TYPE=InnoDB;
