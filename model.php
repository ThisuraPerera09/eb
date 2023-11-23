<?php

class model
{
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect("localhost", "root", "", "user");

        if ($this->conn === false) {
            die("Could not connect." . mysqli_connect_error());
        }
    }

    public function insertUser($name, $email, $age)
    {
        $checkEmail = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($this->conn, $checkEmail);

        if (mysqli_num_rows($result) > 0) {
            return 'Email already exists. Please choose a different email.';
        } else {
            $sql = "INSERT INTO user (name, email, age) VALUES ('$name', '$email', '$age')";

            if (mysqli_query($this->conn, $sql)) {
                return "Your Details sent successfully";
            } else {
                return "Error $sql." . mysqli_error($this->conn);
            }
        }
    }




    public function getUserDetails()
    {
        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);

        $data = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }

        return $data;
    }

 
}
?>
