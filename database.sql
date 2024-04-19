drop database if exists quizz;
create database quizz;
use quizz;
create table quiz
(
    id int primary key not null auto_increment,
    title varchar(255) not null
);
create table question
(
    id int primary key not null auto_increment,
    text varchar(255) not null,
    numQuiz int,
    foreign key (numQuiz) references quiz(id)
);
create table reponse
(
    id int primary key not null auto_increment,
    text varchar(255) not null,
    isValid boolean,
    numQuestion int,
    foreign key (numQuestion) references question(id)
);
create table utilisateur
(
    id int primary key not null auto_increment,
    username varchar(255) not null,
    password  varchar(255) not null,
    rank_utilisateur varchar(255) not null
);