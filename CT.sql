drop table if exists article_category;
drop table if exists article_keyword;
drop table if exists article_comment;
drop table if exists article_media;
drop table if exists media;
drop table if exists category;
drop table if exists keyword;
drop table if exists comment;
drop table if exists article;
drop table if exists user;
CREATE TABLE article
(
	title		VARCHAR(40) 	PRIMARY KEY,
	content 	VARCHAR(140),
	likes		INTEGER,
	dislikes	INTEGER,
	pseudo 		VARCHAR(40),
    postdate    DATETIME
)engine=innodb;
CREATE TABLE media
(
	media_path 	VARCHAR(100)	PRIMARY KEY,
	type        VARCHAR(10)
)engine=innodb;
CREATE TABLE article_media
(
	media_path 	VARCHAR(100),
	title		VARCHAR(40),
    PRIMARY KEY(media_path,title)
)engine=innodb;

CREATE TABLE user
(
	pseudo 		VARCHAR(25) 	PRIMARY KEY
)engine=innodb;
CREATE TABLE keyword
(
	word		VARCHAR(40)		PRIMARY KEY,
	fame		INTEGER
)engine=innodb;
CREATE TABLE article_keyword
(
	title 		VARCHAR(40),
	word  		VARCHAR(40),
	PRIMARY KEY(title,word)
)engine=innodb;
CREATE TABLE category
(
	name		VARCHAR(40)		PRIMARY KEY,
	utilisation INTEGER
)engine=innodb;
CREATE TABLE article_category
(
	title		VARCHAR(40),
	name		VARCHAR(40),
	PRIMARY KEY(title,name)
)engine=innodb;
CREATE TABLE comment
(
	name		VARCHAR(40)		PRIMARY KEY,
	content		VARCHAR(100),
	pseudo		VARCHAR(25),
	title		VARCHAR(40)
)engine=innodb;
ALTER TABLE article ADD FOREIGN KEY (pseudo) REFERENCES user(pseudo);
ALTER TABLE article_category
	ADD FOREIGN KEY (title) REFERENCES article(title),
	ADD FOREIGN KEY (name) REFERENCES category(name);
ALTER TABLE article_keyword
	ADD FOREIGN KEY (title) REFERENCES article(title),
	ADD FOREIGN KEY (word) REFERENCES keyword(word);
ALTER TABLE comment
	ADD FOREIGN KEY (pseudo) REFERENCES user(pseudo),
	ADD FOREIGN KEY (title) REFERENCES article(title);
ALTER TABLE article_media
    ADD FOREIGN KEY(media_path) REFERENCES media(media_path),
    ADD FOREIGN KEY(title) REFERENCES article(title);
    