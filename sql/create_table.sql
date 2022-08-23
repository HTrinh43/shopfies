-- drop databse if exists
drop database if exists shopfies;

-- create database group12
create database if not exists shopfies;

-- this line will change the database direction to the new database which just created.
use shopfies;

--
-- Table `User`: store data about users.
-- 
create table if not exists `USER` (
    id int primary key auto_increment,
    username varchar(20) unique not null,
    `password` varchar(50) not null,
    first_name varchar(20) not null,
    last_name varchar(20) not null,
    email varchar(50) unique not null
);


--
-- Table TAG: store data about name tag.
--
create table if not exists TAG (
    id int primary key auto_increment,
    name varchar(20) not null
);


--
-- Table LIST: store data about item.
--
create table if not exists LIST (
    id int primary key auto_increment,
    name varchar(50) not null,
    description varchar(255) DEFAULT '',
    create_at datetime
);
--
-- Table LIST_TAG: store data about list_tag .
--
create table if not exists LIST_TAG(
    listid int not null,
    tagid int,
    foreign key (listid) references LIST (id) ON UPDATE CASCADE ON DELETE CASCADE,
    foreign key (tagid) references TAG (id) ON UPDATE CASCADE ON DELETE SET NULL
);
--
-- Table LIKES: store data about a like for a list.
--
create table if not exists LIKES (
    listid int not null,
    userid int not null,
    foreign key (listid) references LIST (id) ON UPDATE CASCADE ON DELETE CASCADE,
    foreign key (userid) references `USER` (id) ON UPDATE CASCADE ON DELETE CASCADE
);
--
-- Table LIST_USER: store data about user's list.
--
create table if not exists LIST_USER (
    listid int not null,
    userid int not null,
    foreign key (listid) references LIST (id) ON UPDATE CASCADE ON DELETE CASCADE,
    foreign key (userid) references `USER` (id) ON UPDATE CASCADE ON DELETE CASCADE
);

--
-- Table ITEM: store data about items.
--
create table if not exists ITEM (
    id int primary key auto_increment,
    name varchar(50) not null,
    description varchar(255) DEFAULT '',
    price float(6,2) DEFAULT 0.00
);

--
-- Table ITEM_LIST: store data about items in list.
--
create table if not exists ITEM_LIST (
    itemid int not null,
    foreign key (itemid) references ITEM (id) ON UPDATE CASCADE ON DELETE CASCADE,
    listid int not null,
    foreign key (listid) references LIST (id) ON UPDATE CASCADE ON DELETE CASCADE 
);


--
-- Table FAVORITE_LIST: store data about favorite list.
--
create table if not exists FAVORITE_LIST (
    listid int not null,
    userid int not null,
    foreign key (listid) references LIST (id) ON UPDATE CASCADE ON DELETE CASCADE,
    foreign key (userid) references `USER` (id) ON UPDATE CASCADE ON DELETE CASCADE
);

--
-- Table LOGIN_LOG: store data about user login.
--
create table if not exists LOGIN_LOG (
    userid int not null,
    time datetime,
    foreign key (userid) references `USER` (id)
);

