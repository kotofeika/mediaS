CREATE DATABASE insta;
CREATE TABLE `pictures` (
  `id` int(11) AUTO_INCREMENT,
  `name` text DEFAULT NULL,
  `views` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY(id)
);
CREATE TABLE `users` (
  `user_id` int(11) AUTO_INCREMENT,
  `user_login` varchar(30),
  `user_password` varchar(32),
  `Admin` int(11) DEFAULT NULL,
    PRIMARY KEY(user_id)
)