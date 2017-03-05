CREATE TABLE `irev` (
   VisitationID int unsigned auto_increment not null,
   IncidentReportID int,
   ContactTypeID int,
   VisitingOrganizationID int,
   OrganizationID int,
   MultiEmployer bool default 0,
   TradeSecret bool default 0,
   ContractorInspect bool default 0,
   ContractorID int,
   VisitReasonID int,
   VisitReasonDesc text,
   ConfBeginTime datetime,
   ConfEndTime datetime,
   OpenConfRemarks text,
   WalkBeginTime datetime,
   WalkEndTime datetime,
   WalkRoute text,
   WalkRemarks text,
   WalkSamples text,
   Samples bool default 0,
   WalkPhotos text,
   Photos bool default 0,
   CloseBeginTime datetime,
   CloseEndTime datetime,
   ClosingDesc text,
   MaterialExchange text,
   Citations bool default 0,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      VisitationID
   )
) TYPE=InnoDB;

-- statement separator --


CREATE TABLE `irev_l` (
   _RecordID int unsigned not null auto_increment,
   VisitationID int unsigned  not null,
   IncidentReportID int,
   ContactTypeID int,
   VisitingOrganizationID int,
   OrganizationID int,
   MultiEmployer bool default 0,
   TradeSecret bool default 0,
   ContractorInspect bool default 0,
   ContractorID int,
   VisitReasonID int,
   VisitReasonDesc text,
   ConfBeginTime datetime,
   ConfEndTime datetime,
   OpenConfRemarks text,
   WalkBeginTime datetime,
   WalkEndTime datetime,
   WalkRoute text,
   WalkRemarks text,
   WalkSamples text,
   Samples bool default 0,
   WalkPhotos text,
   Photos bool default 0,
   CloseBeginTime datetime,
   CloseEndTime datetime,
   ClosingDesc text,
   MaterialExchange text,
   Citations bool default 0,
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      _RecordID,
      VisitationID
   )
) TYPE=InnoDB;