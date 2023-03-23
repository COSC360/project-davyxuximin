CREATE TABLE users (
  userid INT NOT NULL,
  username VARCHAR(255),
  userimage BLOB,
  address VARCHAR(255),
  phone VARCHAR(255),
  sex VARCHAR(10),
  school VARCHAR(255),
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255),
  PRIMARY KEY (userid, email)
);
INSERT INTO users (userid, username, userimage, address, phone, sex, school, email, password)
VALUES (1, 'John Smith', LOAD_FILE('/Applications/XAMPP/xamppfiles/htdocs/project/images/profile.jpg'), '123 Main St', '555-1234', 'Male', 'ABC University', 'johnsmith@example.com', 'mypassword');
