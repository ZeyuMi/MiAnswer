create database MiAnswer;
use MiAnswer;
create table users(uid varchar(255) primary key, uname varchar(255) not null, description varchar(255), scores int default 0, level int default 0);
create table topics(tid int primary key auto_increment, title varchar(255) not null, details text, scores int default 0, active int default 1);
create table answers(aid int primary key auto_increment, tid int not null, details text not null);
create table comments(cid int primary key auto_increment, aid int not null, details text not null);
create table tags(tagid int primary key auto_increment, tname varchar(255) not null);
create table topictagrelations(tid int not null, tagid int not null, primary key(tid, tagid));
