drop database if exists MiAnswer;
create database MiAnswer;
use MiAnswer;
create table users(uid varchar(255) primary key, uname varchar(255) not null, password varchar(255) not null, description varchar(255), bigimage varchar(255), smallimage varchar(255), scores int default 0, level int default 0);
create table topics(tid int primary key auto_increment, uid varchar(255) not null, title varchar(255) not null, details text, time datetime not null, scores int default 0, active int default 1);
create table topicimages(imid int primary key auto_increment, imagename varchar(255) not null, tid int not null);
create table answerimages(imid int primary key auto_increment, imagename varchar(255) not null, aid int not null);
create table answers(aid int primary key auto_increment, uid varchar(255) not null, tid int not null, details text not null, time datetime not null, accept int default 0, foreign key (tid) references topics(tid) on DELETE CASCADE);
create table comments(cid int primary key auto_increment, uid varchar(255) not null, aid int not null, details text not null, time datetime not null, foreign key (aid) references answers(aid) on DELETE CASCADE);
create table tags(tagid int primary key auto_increment, tname varchar(255) not null);
create table topictagrelations(tid int not null, tagid int not null, primary key(tid, tagid), foreign key (tid) references topics(tid) on DELETE CASCADE);
insert into users(uid, uname, password, description, bigimage, smallimage, scores, level) values ('u1', 'u1', 'u1', 'description1', 'user1big.jpg', 'user1small.jpg', 5, 1), ('u2', 'u2', 'u2', 'description2', 'user2big.jpg', 'user2small.jpg', 5, 1),  ('u3', 'u3', 'u3', 'description3', 'user3big.jpg', 'user3small.jpg', 5, 1),  ('u4', 'u4', 'u4', 'description4', 'user4big.jpg', 'user4small.jpg', 5, 1);
insert into topics(tid, uid, title, details, time, scores, active) values(1, 'u1', 'topic1', 'details1', '2013-11-14 09:40:00', 20, 1), (2, 'u2', 'topic2', 'details2', '2013-11-12 09:00:00', 30, 0);
insert into topicimages(imid, imagename, tid) values(1, 'topicimage1.jpg', 1), (2, 'topicimage2.jpg', 1), (3, 'topicimage3.jpg', 2);
insert into answerimages(imid, imagename, aid) values(1, 'answerimage1.jpg',1), (2, 'answerimage2.jpg', 1), (3, 'answerimage3.jpg', 2);
insert into answers(aid, uid, tid, details, time) values(1, 'u1', 1, 'answer1details', '2013-11-15 12:00:00'), (2, 'u2', 1, 'answer2details', '2013-11-15 12:45:00'),  (3, 'u3', 2, 'answer3details', '2013-11-12 21:00:00');
insert into comments(cid, uid, aid, details, time) values(1, 'u3', 1, 'comment1', '2013-11-16 12:00:00'), (2, 'u4', 2, 'comment2', '2013-11-13 23:00:20');
insert into tags(tagid, tname) values (1, 'tag1'), (2, 'tag2');
insert into topictagrelations(tid, tagid) values (1, 1), (1, 2), (2, 1);
