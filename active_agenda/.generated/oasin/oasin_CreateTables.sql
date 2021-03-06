CREATE TABLE `oasin` (
   OtherAssetInventoryID int unsigned auto_increment not null,
   OtherAssetID int,
   OrganizationID int,
   TrackingNumber varchar(50),
   AssetStorageMethodID int,
   AssetStorageDesc varchar(255),
   ReOrderQuantity float,
   ReOrderQuantityUoMID int,
   StartQuantity float,
   StartQuantityUoMID int,
   StartDate date,
   Issued int,
   IssuedUoMID int,
   Returned float,
   ReturnedUoMID int,
   Added float,
   AddedUoMID int,
   Transferred float,
   TransferredUoMID int,
   PresentQuantity float,
   PresentQuantityUoMID int,
   PresentQuantityDate date,
   BeginningCalculationDate date,
   EndingCalculationDate date,
   LossQuantity float,
   LossQuantityUoMID int,
   LossCost decimal(12,4),
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      OtherAssetInventoryID
   )
) TYPE=InnoDB;

-- statement separator --


CREATE TABLE `oasin_l` (
   _RecordID int unsigned not null auto_increment,
   OtherAssetInventoryID int unsigned  not null,
   OtherAssetID int,
   OrganizationID int,
   TrackingNumber varchar(50),
   AssetStorageMethodID int,
   AssetStorageDesc varchar(255),
   ReOrderQuantity float,
   ReOrderQuantityUoMID int,
   StartQuantity float,
   StartQuantityUoMID int,
   StartDate date,
   Issued int,
   IssuedUoMID int,
   Returned float,
   ReturnedUoMID int,
   Added float,
   AddedUoMID int,
   Transferred float,
   TransferredUoMID int,
   PresentQuantity float,
   PresentQuantityUoMID int,
   PresentQuantityDate date,
   BeginningCalculationDate date,
   EndingCalculationDate date,
   LossQuantity float,
   LossQuantityUoMID int,
   LossCost decimal(12,4),
   _ModDate datetime not null,
   _ModBy int unsigned not null default 0,
   _Deleted bool not null default 0,
   PRIMARY KEY(
      _RecordID,
      OtherAssetInventoryID
   )
) TYPE=InnoDB;
