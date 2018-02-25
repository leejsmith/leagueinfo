CREATE TABLE tbl_Champions (
    championID INTEGER NOT NULL,
    champName TEXT NOT NULL,
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
    statID INTEGER AUTO_INCREMENT NOT NULL,
    championID INTEGER NOT NULL,
    armorperlevel DECIMAL NOT NULL,
    attackdamage DECIMAL NOT NULL,
    mpperlevel DECIMAL NOT NULL,
    attackspeedoffset DECIMAL NOT NULL,
    mp DECIMAL NOT NULL,
    armor DECIMAL NOT NULL,
    hp DECIMAL NOT NULL,
    hpregenperlevel DECIMAL NOT NULL,
    attackspeedperlevel DECIMAL NOT NULL,
    attackrange DECIMAL NOT NULL,
    movespeed DECIMAL NOT NULL,
    attackdamageperlevel DECIMAL NOT NULL,
    mpregenperlevel DECIMAL NOT NULL,
    critperlevel DECIMAL NOT NULL,
    spellblockperlevel DECIMAL NOT NULL,
    crit DECIMAL NOT NULL,
    mpregen DECIMAL NOT NULL,
    spellblock  DECIMAL NOT NULL,
    hpregen DECIMAL NOT NULL,
    hpperlevel DECIMAL NOT NULL,
    PRIMARY KEY (statID),
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
    spellKey TEXT NOT NULL,
    championID INTEGER NOT NULL,
    spellKey CHAR NOT NULL,
    spellName TEXT NOT NULL,
    spellToolTip TEXT,
    spellDescription TEXT,
    spellSanitizedDescription TEXT,
    spellToolTip TEXT,
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
    PRIMARY KEY (spellKey),
    FOREIGN KEY (championID) REFERENCES tbl_Champions(championID)
) ENGINE=INNODB;

CREATE TABLE ChampionItems (
    championItemID TEXT NOT NULL,
    championID INTEGER NOT NULL
    championBlocks TEXT NOT NULL,
    champtionMap TEXT NOT NULL,
    PRIMARY KEY (championItemID),
    FOREIGN KEY (championID) REFERENCES tbl_Champions(championID)
)ENGINE=INNODB;