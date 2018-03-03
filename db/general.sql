USE leagueinfo_co_uk_www;

CREATE TABLE tbl_SiteConfig (
    confName VARCHAR(50) NOT NULL,
    confValue TEXT NOT NULL,
    PRIMARY KEY (confName)
) ENGINE=INNODB;

CREATE TABLE tbl_Maps (
    mapID INTEGER NOT NULL,
    mapName TEXT NOT NULL,
    PRIMARY KEY(mapID)
) ENGINE=INNODB;

CREATE TABLE tbl_Items(
    itemID INTEGER NOT NULL,
    plainText TEXT,
    itemName TEXT NOT NULL,
    itemDescription TEXT,
    itemSanitizedDescription TEXT,
    itemGoldTotal INTEGER,
    itemGoldSell INTEGER,
    itemGoldBase INTEGER,
    itemPurchasable BOOLEAN,
    itemStats TEXT,
    itemTags TEXT,
    itemDepth INTEGER,
    itemInto TEXT,
    itemFrom TEXT,
    PRIMARY KEY (itemID)
) ENGINE=INNODB;

CREATE TABLE tbl_ItemToMaps (
    itemID INTEGER NOT NULL,
    mapID INTEGER NOT NULL,
    PRIMARY KEY (itemID, mapID),
    FOREIGN KEY (itemID) REFERENCES tbl_Items(itemID),
    FOREIGN KEY (mapID) REFERENCES tbl_Maps(mapID)
) ENGINE=INNODB;

CREATE TABLE tbl_Champions (
    championID INTEGER NOT NULL,
    champName TEXT NOT NULL,
    champKey TEXT NOT NULL,
    title TEXT NOT NULL,
    lore TEXT,
    info TEXT,
    tags TEXT NOT NULL,
    abilityType TEXT NOT NULL,
    allyTips TEXT,
    enemyTips TEXT,
    imgFull TEXT NOT NULL,
    PRIMARY KEY (championID)
) ENGINE=INNODB;

CREATE TABLE tbl_ChampionStats (
    championID INTEGER NOT NULL,
    armorperlevel DECIMAL(10,5) NOT NULL,
    attackdamage DECIMAL(10,5) NOT NULL,
    mpperlevel DECIMAL(10,5) NOT NULL,
    attackspeedoffset DECIMAL(10,5) NOT NULL,
    mp DECIMAL(10,5) NOT NULL,
    armor DECIMAL(10,5) NOT NULL,
    hp DECIMAL(10,5) NOT NULL,
    hpregenperlevel DECIMAL(10,5) NOT NULL,
    attackspeedperlevel DECIMAL(10,5) NOT NULL,
    attackrange DECIMAL(10,5) NOT NULL,
    movespeed DECIMAL(10,5) NOT NULL,
    attackdamageperlevel DECIMAL(10,5) NOT NULL,
    mpregenperlevel DECIMAL(10,5) NOT NULL,
    critperlevel DECIMAL(10,5) NOT NULL,
    spellblockperlevel DECIMAL(10,5) NOT NULL,
    crit DECIMAL(10,5) NOT NULL,
    mpregen DECIMAL(10,5) NOT NULL,
    spellblock  DECIMAL(10,5) NOT NULL,
    hpregen DECIMAL(10,5) NOT NULL,
    hpperlevel DECIMAL(10,5) NOT NULL,
    PRIMARY KEY (championID),
    FOREIGN KEY (championID) REFERENCES tbl_Champions(championID)
) ENGINE=INNODB;

CREATE TABLE tbl_ChampionSkins(
    skinID INTEGER NOT NULL,
    championID INTEGER NOT NULL,
    num INTEGER NOT NULL,
    skinName TEXT NOT NULL,
    PRIMARY KEY (skinID),
    FOREIGN KEY (championID) REFERENCES tbl_Champions(championID)
) ENGINE=INNODB;

CREATE TABLE tbl_ChampionSpells(
	spellID INTEGER AUTO_INCREMENT NOT NULL,
    spellKey TEXT NOT NULL,
    championID INTEGER NOT NULL,
    spellKeyBinding CHAR NOT NULL,
    spellName TEXT NOT NULL,
    spellToolTip TEXT,
    spellDescription TEXT,
    spellSanitizedDescription TEXT,
    spellSanitizedToolTip TEXT,
    spellResource TEXT,
    spellVars TEXT,
    spellCostType TEXT,
    spellMaxRank INTEGER,
    spellCooldown TEXT,
    spellCooldownBurn TEXT,
    spellRange TEXT,
    spellRangeBurn TEXT,
    spellCost TEXT,
    spellCostBurn TEXT,
    spellEffect TEXT,
    spellEffectBurn TEXT,
    spellImageFull TEXT,
    PRIMARY KEY (spellID),
    FOREIGN KEY (championID) REFERENCES tbl_Champions(championID)
) ENGINE=INNODB;