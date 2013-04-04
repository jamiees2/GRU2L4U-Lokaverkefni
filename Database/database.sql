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