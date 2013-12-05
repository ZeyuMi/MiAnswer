drop database if exists MiAnswer;
create database MiAnswer;
use MiAnswer;
create table users(uid varchar(255) primary key, uname varchar(255) not null, password varchar(255) not null, description varchar(255), bigimage varchar(255) default 'user1big.jpg', smallimage varchar(255) default 'user1small.jpg', scores int default 10, level int default 1);
create table topics(tid int primary key auto_increment, uid varchar(255) not null, title varchar(255) not null, details text, time datetime not null, scores int default 0, active int default 1);
create table images(imid int primary key, imagename varchar(255) not null);
create table topicimages(imid int, tid int, primary key(imid, tid), foreign key(imid) references images(imid) on DELETE CASCADE);
create table answerimages(imid int, aid int, primary key(imid, aid), foreign key (imid) references images(imid) on DELETE CASCADE);
create table answers(aid int primary key auto_increment, uid varchar(255) not null, tid int not null, details text not null, time datetime not null, accept int default 0, likes int default 0, dislikes int default 0, foreign key (tid) references topics(tid) on DELETE CASCADE);
create table comments(cid int primary key auto_increment, uid varchar(255) not null, aid int not null, details text not null, time datetime not null, foreign key (aid) references answers(aid) on DELETE CASCADE);
create table tags(tagid int primary key auto_increment, tname varchar(255) not null, description text, num int default 1);
create table topictagrelations(tid int not null, tagid int not null, primary key(tid, tagid), foreign key (tid) references topics(tid) on DELETE CASCADE);
create table likerelations(aid int, uid varchar(255), tid int,  primary key(aid, uid, tid), foreign key(aid) references answers(aid) on DELETE CASCADE);
create table dislikerelations(aid int, uid varchar(255), tid int, primary key(aid, uid, tid), foreign key(aid) references answers(aid) on DELETE CASCADE);
insert into users(uid, uname, password, description, bigimage, smallimage, scores, level) values ('u1@q.c', 'u1', 'u1', 'description1', 'user1big.jpg', 'user1small.jpg', 5, 1), ('u2@q.c', 'u2', 'u2', 'description2', 'user2big.jpg', 'user2small.jpg', 5, 1),  ('u3@q.c', 'u3', 'u3', 'description3', 'user3big.jpg', 'user3small.jpg', 5, 1),  ('u4@q.c', 'u4', 'u4', 'description4', 'user4big.jpg', 'user4small.jpg', 5, 1);
insert into topics(tid, uid, title, details, time, scores, active) values(1, 'u1@q.c', 'topic1', 'details1', '2013-11-14 09:40:00', 20, 0), (2, 'u2@q.c', 'topic2', 'details2', '2013-11-12 09:00:00', 30, 1);
insert into images(imid, imagename) values(1, 'image1.jpg'), (2, 'image2.jpg');
insert into topicimages(imid,  tid) values(1, 1), (2, 1), (1, 2);
insert into answerimages(imid, aid) values(1, 1), (2, 1), (1, 2);
insert into answers(aid, uid, tid, details, time, accept) values(1, 'u1@q.c', 1, 'answer1details', '2013-11-15 12:00:00', 1), (2, 'u2@q.c', 1, 'answer2details', '2013-11-15 12:45:00', 0),  (3, 'u3@q.c', 2, 'answer3details', '2013-11-12 21:00:00', 0);
insert into comments(cid, uid, aid, details, time) values(1, 'u3@q.c', 1, 'comment1', '2013-11-16 12:00:00'),(2, 'u4@q.c', 2, 'comment2', '2013-11-13 23:00:20'), (3, 'u2@q.c', 1, 'comment3', '2013-11-16 21:00:00'), (4, 'u3@q.c', 1, 'comment4', '2013-11-15 14:00:00');
insert into tags(tagid, tname, description) values (1, 'tag1', 'asdojdsoasiodjaoisdioasodasd'), (2, 'tag2', 'ashduiahsdiauhsdihdaiudhsuihda'),(3, 'tag3', 'ashduiahsdiauhsdihdaiudhsuihda');
insert into topictagrelations(tid, tagid) values (1, 1), (1, 2), (2, 1);
