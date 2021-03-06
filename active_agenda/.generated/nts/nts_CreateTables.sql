CREATE TABLE `nts` (
   NoteID int unsigned auto_increment not null,
   RelatedModuleID varchar(5),
   RelatedRecordID int,
   Title text,
   NoteDetail text,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      NoteID
   ),
   INDEX nts_RelatedModuleIDRecordID (
      RelatedModuleID,
      RelatedRecordID
   )
) TYPE=InnoDB;

-- statement separator --


CREATE TABLE `nts_l` (
   _RecordID int unsigned not null auto_increment,
   NoteID int unsigned  not null,
   RelatedModuleID varchar(5),
   RelatedRecordID int,
   Title text,
   NoteDetail text,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      _RecordID,
      NoteID
   ),
   INDEX nts_l_RelatedModuleIDRecordID (
      RelatedModuleID,
      RelatedRecordID
   )
) TYPE=InnoDB;
