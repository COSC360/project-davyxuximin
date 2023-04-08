CREATE TABLE questions (
  questionid INT NOT NULL AUTO_INCREMENT,
  userid INT NOT NULL,
  username VARCHAR(255),
  questtitle VARCHAR(255) NOT NULL,
  questcontent TEXT NOT NULL,
  questimage BLOB,
  PRIMARY KEY (questionid),
  FOREIGN KEY (userid) References users(userid)
);
INSERT INTO questions (userid, username, questtitle, questcontent, questimage)
VALUES (1, 'John Smith', 'How to use SQL?', 'I am trying to learn SQL but I am not sure where to start. Can anyone recommend some resources or tutorials?', LOAD_FILE('/Applications/XAMPP/xamppfiles/htdocs/project/images/question.jpeg'));
