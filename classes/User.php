<?php

include_once(__DIR__ . "/Db.php");

class User
{
        private $firstname;
        private $lastname;
        private $username;
        private $email;
        private $password;
        private $profilePicture;
        private $bio;
        private $education;
        private $userId;

        public function getFirstname()
        {
                return $this->firstname;
        }

        public function setFirstname($firstname)
        {
                if (empty($firstname)) {
                        throw new Exception("firstname cant be empty");
                }
                $this->firstname = $firstname;

                return $this;
        }

        public function getLastname()
        {
                return $this->lastname;
        }

        public function setLastname($lastname)
        {
                if (empty($lastname)) {
                        throw new Exception("lastname cant be empty");
                }
                $this->lastname = $lastname;
                return $this;
        }

        public function getEmail()
        {
                return $this->email;
        }

        public function setEmail($email)
        {
                if (!str_ends_with($email, '@student.thomasmore.be')) {
                        if (!str_ends_with($email, '@thomasmore.be')) {
                                throw new Exception("email has to end with @student.thomasmore.be or @thomasmore.be");
                        }
                } else if (empty($email)) {
                        throw new Exception("email cant be empty");
                }
                $this->email = $email;
                return $this;
        }

        public function getPassword()
        {
                return $this->password;
        }

        public function setPassword($password)
        {
                if (strlen($password) < 5) {
                        throw new Exception("Passwords must be longer than 5 characters.");
                }
                $this->password = $password;
                return $this;
        }

        public function getProfilePicture()
        {
                return $this->profilePicture;
        }

        public function setProfilePicture($profilePicture)
        {
                $this->profilePicture = $profilePicture;
                return $this->profilePicture;
        }

        public function getBio()
        {
                return $this->bio;
        }

        public function setBio($bio)
        {
                $this->bio = $bio;
                return $this->bio;
        }

        public function getEducation()
        {
                return $this->education;
        }

        public function setEducation($education)
        {
                $this->education = $education;
                return $this->education;
        }

        public function canLogin()
        {
                $conn = Db::getInstance();
                $statement = $conn->prepare("select * from users where email = :email;");
                $statement->bindValue(':email', $this->email);
                $statement->execute();
                $user = ($statement->fetch());

                if (!$user) {
                        throw new Exception("User does not exist");
                        return false;
                }
                $hash = $user["password"];
                if (password_verify($this->password, $hash)) {
                        return true;
                } else {
                        throw new Exception("Wrong Password");
                        return false;
                }
        }

        public function register()
        {
                $options = [
                        'cost' => 12
                ];
                $password = password_hash($this->password, PASSWORD_BCRYPT, $options);
                $conn = Db::getInstance();
                $statement = $conn->prepare("insert into users (firstname, lastname, email, password, profilepicture) values (:firstname, :lastname, :email, :password, '');");
                $statement->bindValue(':firstname', $this->firstname);
                $statement->bindValue(':lastname', $this->lastname);
                $statement->bindValue(':email', $this->email);
                $statement->bindValue(':password', $password);
                return $statement->execute();
        }



        public static function updatePassword($token, $password)
        {
                $conn = Db::getInstance();
                $sql = "SELECT * FROM `passwordreset` WHERE `token` = '$token';";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);

                $expFormat = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
                $expDate = date("Y-m-d H:i:s", $expFormat);

                if (!$result) {
                        throw new Exception("Link is not usable");
                }

                $email = $result["email"];

                if ($result["expiry_date"] < $expDate) {
                        throw new Exception("Your link has been expired");
                }

                if (strlen($password) < 5) {
                        throw new Exception("Passwords must be longer than 5 characters.");
                }
                $options = [
                        'cost' => 12
                ];
                $password = password_hash($password, PASSWORD_BCRYPT, $options);
                $statement2 = $conn->prepare("UPDATE `users` SET `password` = '$password' WHERE `users`.`email` = '$email';");
                $statement2->execute();
                $statement3 = $conn->prepare("DELETE FROM `passwordreset` WHERE `token` = '$token';");
                $statement3->execute();
        }

        public static function getAll()
        {
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT email FROM users");
                $statement->execute();
                $result = $statement->fetch(PDO::FETCH_ASSOC);
                return $result;
        }

        public static function passwordResetToken($token, $expDate, $email)
        {
                $conn = Db::getInstance();
                $statement = $conn->prepare("INSERT INTO `passwordreset` (`token`, `expiry_date`, `email`) VALUES ('$token', '$expDate', '$email');");
                return $statement->execute();
        }

        public function canRegister($password, $password2)
        {
                $conn = Db::getInstance();
                $statement = $conn->prepare("select * from users where email = :email");
                $statement->bindValue(":email", $this->email);
                $statement->execute();
                $user = ($statement->fetch());
                if (!$user) {
                        if ($password == $password2) {
                                return true;
                        } else {
                                throw new Exception("wachtwoorden komen niet overeen");
                                return false;
                        }
                } else {
                        throw new Exception("gebruiker bestaat al");
                        return false;
                }
        }

        public function __toString()
        {
                return $this->firstname . " " . $this->lastname . " " . $this->email . " " . $this->email;
        }


        public static function getUserFromEmail($email)
        {
                $conn = Db::getInstance();
                $sql = "SELECT * FROM `users` WHERE `email` = '$email';";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetch();
                return $result;
        }

        public static function getUserFromId($id)
        {
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM users WHERE id = :id");
                $statement->bindValue(':id', $id);
                $statement->execute();
                $result = $statement->fetch();
                return $result;
        }

        public function updateUser()
        {
                $firstname = $this->getFirstName();
                $lastname = $this->getLastname();
                $email = $this->getEmail();
                $bio = $this->getBio();
                $education = $this->getEducation();

                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `email` = '$email',  `bio` = '$bio', `education` = '$education' WHERE `users`.`email` = '$email';");


                $statement->execute();
        }

        public function updateProfilePicture($profilepicture, $email)
        {
                $conn = Db::getInstance();
                $statement = $conn->prepare("UPDATE users SET profilepicture = :profilepicture WHERE email = :email");

                $statement->bindValue(":email", $email);
                $statement->bindValue(":profilepicture", $profilepicture);

                $statement->execute();

                header('location: usersettings.php');
        }

        public static function changeCurrentPassword($currentpassword, $newpassword, $newpassword2, $email)
        {


                $conn = Db::getInstance();
                $sql = "SELECT * FROM `users` WHERE `email` = '$email';";
                $statement = $conn->prepare($sql);
                $statement->execute();
                $result = $statement->fetch();

                $hash = $result["password"];
                if (password_verify($currentpassword, $hash)) {
                        if ($newpassword == $newpassword2) {
                                $options = [
                                        'cost' => 12
                                ];
                                $password = password_hash($newpassword, PASSWORD_BCRYPT, $options);
                                $statement2 = $conn->prepare("UPDATE `users` SET `password` = '$password' WHERE `users`.`email` = '$email';");
                                $statement2->execute();
                                return true;
                        } else {
                                throw new Exception("New passwords don't match");
                                return false;
                        }
                } else {
                        throw new Exception("Old password is incorrect");
                        return false;
                }
        }

        public static function deleteUser($email)
        {
                $conn = Db::getInstance();
                $statement = $conn->prepare("DELETE FROM `users` WHERE `email` = '$email';");
                $statement->execute();
        }
}
