CREATE TABLE `docs` (
   DocumentStatusID int unsigned auto_increment not null,
   DocumentationRecID int,
   RelatedModuleID varchar(5),
   RelatedRecordID int,
   NotificationDetails text,
   RecipientStatusID int,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      DocumentStatusID
   )
) TYPE=InnoDB;

-- statement separator --


CREATE TABLE `docs_l` (
   _RecordID int unsigned not null auto_increment,
   DocumentStatusID int unsigned  not null,
   DocumentationRecID int,
   RelatedModuleID varchar(5),
   RelatedRecordID int,
   NotificationDetails text,
   RecipientStatusID int,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      _RecordID,
      DocumentStatusID
   )
) TYPE=InnoDB;
