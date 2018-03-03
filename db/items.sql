CREATE TABLE tbl_Items(
    itemID INTEGER NOT NULL,
    plainText TEXT,
    itemName TEXT NOT NULL,
    itemDescription TEXT,
    itemGoldTotal INTEGER,
    itemGoldSell INTEGER,
    itemGoldBase INTEGER,
    itemPurchasable BOOLEAN,
    itemStats TEXT,
    itemTags TEXT,
    itemDepth INTEGER,
    itemInto TEXT,
    itemFrom TEXT,
    itemMaps TEXT,
    PRIMARY KEY (itemID)
);