/*
User
  - Pseudo
  - Email
  - Password (image à stocker dans /public/images)
Post
  - Title
  - Content
  - Author (User) n->1
Comment
  - Content
  - Author (User) n->1
  - Post (Post) n->1
*/

CREATE DATABASE forum;

USE forum;

CREATE TABLE user (
  id_user INT(3) NOT NULL AUTO_INCREMENT,
  pseudo VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  avatar VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_user)
) ENGINE=InnoDB ;

CREATE TABLE post (
  id_post INT(3) NOT NULL AUTO_INCREMENT,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  author_id INT(3) NOT NULL,
  PRIMARY KEY (id_post),
  FOREIGN KEY (author_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;

CREATE TABLE comment (
  id_comment INT(3) NOT NULL AUTO_INCREMENT,
  content TEXT NOT NULL,
  author_id INT(3) NOT NULL,
  post_id INT(3) NOT NULL,
  PRIMARY KEY (id_comment),
  FOREIGN KEY (author_id) REFERENCES user(id_user) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (post_id) REFERENCES post(id_post) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB ;
