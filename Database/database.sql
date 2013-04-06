SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

CREATE TABLE IF NOT EXISTS classes (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(200) NOT NULL,
  description text NOT NULL,
  PRIMARY KEY ( id )
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

CREATE TABLE IF NOT EXISTS  rooms  (
  id int(10) unsigned NOT NULL AUTO_INCREMENT,
  number varchar(200) NOT NULL,
  type int(10) unsigned NOT NULL,
  PRIMARY KEY (id),
  KEY rooms_type_foreign (type)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

CREATE TABLE IF NOT EXISTS  timetable  (
  id  int(10) unsigned NOT NULL AUTO_INCREMENT,
  room_id  int(10) unsigned NOT NULL,
  class_id  int(10) unsigned NOT NULL,
  starts_at  timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  ends_at  timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  created_at  datetime NOT NULL,
  updated_at  datetime NOT NULL,
  PRIMARY KEY ( id ),
  KEY  timetable_room_id_foreign (room_id),
  KEY  timetable_class_id_foreign (class_id)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS  types  (
  id  int(10) unsigned NOT NULL AUTO_INCREMENT,
  description  varchar(200) NOT NULL,
  PRIMARY KEY ( id )
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

CREATE TABLE IF NOT EXISTS  users  (
  id  int(10) unsigned NOT NULL AUTO_INCREMENT,
  username  varchar(200) NOT NULL,
  email  varchar(200) NOT NULL,
  password  varchar(200) NOT NULL,
  role  int(11) NOT NULL,
  created_at  datetime NOT NULL,
  updated_at  datetime NOT NULL,
  PRIMARY KEY ( id )
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO  classes  ( id ,  name ,  description ) VALUES
(1, 'FOR2B2U', 'Grunnáfangi í forritun'),
(2, 'VSH2B2U', 'PHP kennsla');

INSERT INTO  rooms  ( id ,  number ,  type ) VALUES
(1, '630', 3),
(2, '631', 3),
(3, '634', 3),
(4, '635', 3),
(5, '636', 3),
(6, '637', 3),
(7, '638', 3),
(8, '639', 3),
(9, '632', 4),
(10, '633', 4);

INSERT INTO  types  ( id ,  description ) VALUES
(1, 'Óskilgreint'),
(2, 'Venjuleg stofa'),
(3, 'Tölvustofa - almenn'),
(4, 'Tölvustofa - sérsniðin');

ALTER TABLE rooms ADD CONSTRAINT rooms_type_foreign FOREIGN KEY (type) REFERENCES types (id);
ALTER TABLE timetable ADD CONSTRAINT timetable_class_id_foreign FOREIGN KEY (class_id) REFERENCES classes(id), ADD CONSTRAINT timetable_room_id_foreign FOREIGN KEY (room_id) REFERENCES rooms (id);
ALTER TABLE timetable ADD users_id INT(10) unsigned NOT NULL;
ALTER TABLE timetable ADD CONSTRAINT fk_users_id FOREIGN KEY(users_id) REFERENCES users(id);

ALTER TABLE timetable
DROP starts_at,
DROP ends_at,
DROP created_at, 
DROP updated_at;

CREATE TABLE IF NOT EXISTS Ref_Periods(
Period_Number INT(11) NOT NULL,
Period_start_time VARCHAR(20),
Period_End_time VARCHAR(20),
PRIMARY KEY(Period_Number));

INSERT INTO Ref_Periods(Period_Number,Period_start_time,Period_End_time) 
VALUES
(1,'8:10','8:50'),
(2,'8:50','9:30'),
(3,'9:50','10:30'),
(4,'10:30','11:10'),
(5,'11:15','11:55'),
(6,'11:55','12:35'),
(7,'12:35','13:15'),
(8,'13:15','13:55'),
(9,'13:55','14:35'),
(10,'14:40','15:20'),
(11,'15:20','16:00'),
(12,'16:55','17:35'),
(13,'17:35','18:15'),
(14,'18:15','18:55'),
(15,'18:55','19:35');

CREATE TABLE IF NOT EXISTS Ref_Days(
Day_Number INT(8) NOT NULL,
Day_Name VARCHAR(25) NOT NULL,
PRIMARY KEY(Day_Number));

INSERT INTO Ref_Days(Day_Number,Day_Name) 
VALUES
(1,'Mánudagur'),
(2,'Þriðjudagur'),
(3,'Miðvikudagur'),
(4,'Fimtudagur'),
(5,'Föstudagur'),
(6,'Laugardagur'),
(7,'Sunnudagur');

ALTER TABLE timetable 
ADD Day_Number INT(8) NOT NULL, 
ADD CONSTRAINT FK_Day_Number FOREIGN KEY(Day_Number) REFERENCES ref_days(Day_Number),
ADD Period_Number INT(11) NOT NULL, 
ADD CONSTRAINT FK_Period_Number FOREIGN KEY(Period_Number) REFERENCES ref_periods(Period_Number);