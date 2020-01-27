CREATE TABLE candidati (
     id int(4) unsigned NOT NULL auto_increment,
     cognome varchar(25) NOT NULL default '',
     nome varchar(25) NOT NULL default '',
     nascita date NOT NULL default '0000-00-00',
     provinciaid int(4) NOT NULL,
     comuneid int(4) NOT NULL,
     area varchar(35) NOT NULL default '',
     telefono varchar(15) NOT NULL default '',
     email varchar(20) default '',
     preavviso varchar(15) default '',
     patenti varchar(20) default '',
     allegato varchar(20) default '',
     note varchar(20) default '',
     ultimamodifica date NOT NULL default '0000-00-00',
  UNIQUE (cognome, nome, nascita),
  PRIMARY KEY  (id)
) TYPE=MyISAM;





CREATE TABLE conoscenzeinfo (
  id int(4) NOT NULL auto_increment,
  software varchar(25) NOT NULL default '',
  livelloconoscenza varchar(32) NOT NULL default '',
  candidato_id int(4) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;


CREATE TABLE conoscenzelingua (
  id int(4) NOT NULL auto_increment,
  lingua varchar(25) NOT NULL default '',
  livelloconoscenza varchar(32) NOT NULL default '',
  candidato_id int(4) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;


CREATE TABLE colloqui (
  id int(4) NOT NULL auto_increment,
  datacolloquio date NOT NULL default '0000-00-00',
  posizioneproposta varchar(32) NOT NULL default '',
  azienda varchar(32) NOT NULL default '',
  aspetticomportamentali varchar(32) NOT NULL default '',
  coerenzaconruolo varchar(32) NOT NULL default '',
  valutazione varchar(32) NOT NULL default '',
  verifica_conoscenze varchar(32) NOT NULL default '',
  verifica_abilita varchar(32) NOT NULL default '',
  verifica_motivazioni varchar(32) NOT NULL default '',
  trasferte ENUM('Si', 'No') NOT NULL,
  parttime ENUM('Si', 'No') NOT NULL,
  tempodeterminato ENUM('Si', 'No') NOT NULL,
  candidato_id int(4) NOT NULL,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

CREATE TABLE esperienze (
  id int(4) NOT NULL auto_increment,
  nomeazienda varchar(32) NOT NULL default '',
  settoremeceologico varchar(32) NOT NULL default '',
  dipendenticandidato int(4) NOT NULL ,
  compiti varchar(32) NOT NULL default '',
  data_assunzione date NOT NULL default '0000-00-00',
  tipocontratto varchar(32) NOT NULL default '',
  livello varchar(32) NOT NULL default '',
  retribuzione int(8) NOT NULL,
  benefits varchar(32) NOT NULL default '',
  id_candidato int(4) NOT NULL ,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

CREATE TABLE titolostudio (
  id int(4) NOT NULL auto_increment,
  descrizionetitolostudio varchar(40) NOT NULL default '',
  areatitolostudio varchar(40) NOT NULL default '',
  id_candidato int(4) NOT NULL ,
  PRIMARY KEY  (id)
) TYPE=MyISAM;


CREATE TABLE formazione (
  id int(4) unsigned NOT NULL auto_increment,
  voto int(6) NOT NULL ,
  votomassimo int(6) NOT NULL ,
  id_titolostudio int(4) NOT NULL ,
  FOREIGN KEY (id_titolostudio) REFERENCES titolostudio(id)
  ON DELETE CASCADE,
  PRIMARY KEY  (id)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS ruoli (
  id int(4) unsigned NOT NULL auto_increment,
  descrizioneruolo varchar(30) NOT NULL default '',
  id_esperienze int(4) NOT NULL ,
  FOREIGN KEY (id_esperienze) REFERENCES esperienze(id)
  ON DELETE CASCADE,
  PRIMARY KEY  (id)
) TYPE=MyISAM;


CREATE TABLE IF NOT EXISTS provincia (
  id int(10) unsigned NOT NULL auto_increment,
  name varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;



CREATE TABLE IF NOT EXISTS comune (
  id int(10) NOT NULL auto_increment,
  catid int(10) NOT NULL default '0',
  name varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;


CREATE TABLE IF NOT EXISTS titoli_elenco (
  id int(10) NOT NULL auto_increment,
  name varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS titoli_area_elenco (
  id int(10) NOT NULL auto_increment,
  name varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;




CREATE TABLE IF NOT EXISTS software_elenco (
  id int(10) NOT NULL auto_increment,
  name varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;

CREATE TABLE IF NOT EXISTS lingue_elenco (
  id int(10) NOT NULL auto_increment,
  name varchar(30) NOT NULL default '',
  PRIMARY KEY  (id)
) TYPE=MyISAM;





CREATE TABLE `authteam` (
  `id` int(4) NOT NULL auto_increment,
  `teamname` varchar(25) NOT NULL default '',
  `teamlead` varchar(25) NOT NULL default '',
  `status` varchar(10) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `teamname` (`teamname`,`teamlead`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

-- 
-- Dump dei dati per la tabella `authteam` i livelli del sito
-- 

INSERT INTO `authteam` (`id`, `teamname`, `teamlead`, `status`) VALUES 
(2, 'Admin', 'admin', 'active'),
(10, 'Moderatore', 'admin', 'active'),
(11, 'Membro', 'admin', 'active');

-- --------------------------------------------------------

-- 
-- Struttura della tabella `authuser`
-- 

CREATE TABLE `authuser` (
  `id` int(11) NOT NULL auto_increment,
  `uname` varchar(25) NOT NULL default '',
  `passwd` varchar(32) NOT NULL default '',
  `team` varchar(25) NOT NULL default '',
  `level` int(4) NOT NULL default '0',
  `status` varchar(10) NOT NULL default '',
  `lastlogin` datetime default NULL,
  `logincount` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

-- 
-- Dump dei dati per la tabella `authuser` pass: ciao
-- 

INSERT INTO `authuser` (`id`, `uname`, `passwd`, `team`, `level`, `status`, `lastlogin`, `logincount`) VALUES 
(2, 'admin', '9df3b01c60df20d13843841ff0d4482c', 'Admin', 1, 'active', '2007-05-28 02:44:55', 0),
(18, 'prova', '6e6bc4e49dd477ebc98ef4046c067b5f', 'Moderatore', 2, 'active', '2007-05-28 03:07:12', 0),
(19, 'prova2', '6e6bc4e49dd477ebc98ef4046c067b5f', 'Membro', 3, 'active', '2007-05-28 02:39:50', 0);









INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Agrigento');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Alessandria');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Ancona');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Aosta');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Aquila');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Arezzo');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Ascoli-Piceno');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Asti');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Avellino');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Bari');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Barletta-Andria-Trani');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Belluno');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Benevento');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Bergamo');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Biella');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Bologna');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Bolzano');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Brescia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Brindisi');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Cagliari');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Caltanissetta');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Campobasso');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Caserta');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Catania');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Catanzaro');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Chieti');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Como');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Cosenza');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Cremona');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Crotone');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Cuneo');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Enna');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Fermo');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Ferrara');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Firenze');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Foggia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Forli-Cesena');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Frosinone');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Genova');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Gorizia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Grosseto');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Imperia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Isernia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'La-Spezia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Latina');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Lecce');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Lecco');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Livorno');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Lodi');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Lucca');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Macerata');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Mantova');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Massa-Carrara');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Matera');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Messina');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Milano');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Modena');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Monza-Brianza');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Napoli');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Novara');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Nuoro');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Oristano');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Padova');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Palermo');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Parma');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Pavia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Perugia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Pesaro-Urbino');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Pescara');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Piacenza');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Pisa');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Pistoia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Pordenone');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Potenza');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Prato');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Ragusa');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Ravenna');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Reggio-Calabria');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Reggio-Emilia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Rieti');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Rimini');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Roma');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Rovigo');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Salerno');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Sassari');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Savona');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Siena');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Siracusa');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Sondrio');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Taranto');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Teramo');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Terni');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Torino');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Trapani');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Trento');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Treviso');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Trieste');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Udine');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Varese');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Venezia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Verbania');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Vercelli');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Verona');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Vibo-Valentia');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Vicenza');
INSERT INTO `provincia` ( `id` , `name` ) VALUES ( NULL , 'Viterbo');



