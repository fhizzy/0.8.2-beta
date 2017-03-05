CREATE TABLE `sitrs` (
   SituationResponseStepID int unsigned auto_increment not null,
   SituationResponseID int,
   ResponseStepOrder float,
   ResponseStep text,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      SituationResponseStepID
   )
) TYPE=InnoDB;

-- statement separator --


CREATE TABLE `sitrs_l` (
   _RecordID int unsigned not null auto_increment,
   SituationResponseStepID int unsigned  not null,
   SituationResponseID int,
   ResponseStepOrder float,
   ResponseStep text,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      _RecordID,
      SituationResponseStepID
   )
) TYPE=InnoDB;
