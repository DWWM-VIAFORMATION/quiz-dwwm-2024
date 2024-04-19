
use quizz;
insert into quiz (title) values ('Mon premier Quizz');
insert into question (text,numQuiz) values ('Quelle est la capitale de la France ?',1);
insert into reponse(text, isValid, numQuestion) values ('Lyon',0,1);
insert into reponse(text, isValid, numQuestion) values ('Marseille',0,1);
insert into reponse(text, isValid, numQuestion) values ('Paris',1,1);
insert into question (text,numQuiz) values ('De quel pays Canberra est-elle la capitale ?',1);
insert into reponse(text, isValid, numQuestion) values ('Australie',1,1);
insert into reponse(text, isValid, numQuestion) values ('Nouvelle-Zélande',0,1);
insert into reponse(text, isValid, numQuestion) values ('Indonésie',0,1);
insert into utilisateur(username,password,rank_utilisateur) values ('titou','Piv9eGaagEMLhUiJircH0w==','USER');