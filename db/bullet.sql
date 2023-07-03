CREATE DATABASE bullet;

USE bullet;

CREATE TABLE board (
  id int(6) unsigned NOT NULL AUTO_INCREMENT,
  title varchar(30) NOT NULL,
  name varchar(30) NOT NULL,
  content text NOT NULL,
  created_at timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  file blob,
  file_path varchar(255),
  PRIMARY KEY (id)
);

CREATE TABLE users (
  id int(6) unsigned NOT NULL AUTO_INCREMENT,
  username varchar(30) NOT NULL,
  password varchar(255),
  PRIMARY KEY (id)
);
