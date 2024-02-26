<?php
include '../src/model/model.php';

class UserForm
{
    public $name;
    public $age;
    public $email;
    public $successMsg;
    public $errorMsg;
    private $userModel;

    public function __construct()
    {
        $this->userModel = new model();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setAge($age)
    {
        $this->age = $age;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function main()
    {
        if (isset($_POST['Submit'])) {
            $this->name = trim($_POST["name"]);
            $this->age = trim($_POST["age"]);
            $this->email = trim($_POST["email"]);

            if ($this->validateForm()) {
                $this->insertData();
            }
        }
    }

    private function validateForm()
    {
        if ($this->name == "") {
            $this->errorMsg = "Please Enter a Name";
        
        } 
        elseif (!preg_match("/^[a-zA-Z\s]+$/", $this->name)) {
            $this->errorMsg = "Please enter a valid name (letters and spaces only).";
        }
        elseif ($this->age == "") {
            $this->errorMsg = "Please enter the age.";
            
        } elseif (!is_numeric(trim($this->age))) {
            $this->errorMsg = "Please enter numeric value.";
       
        } elseif (strlen($this->age) > 3) {
            $this->errorMsg = "Age should be maximum 3 digits.";
          
        } elseif ($this->email == "") {
            $this->errorMsg = "Please enter an Email";
          
        } elseif (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $this->email)) {
            $this->errorMsg = 'Enter a Valid Email';
          
        } else {
            return true;
        }
    }

    private function insertData()
    {
        $insert = $this->userModel->insertUser($this->name, $this->email, $this->age);

        if ($insert) {
            $this->successMsg = "Your Details were sent successfully";
            header("refresh:2");
     
        } else {
            $this->errorMsg = "Your Details were not submitted";
        }
        
    }

    public function displayUserDetails()
    {
        $data = $this->userModel->getUserDetails();
        return $data;
    }
}

$userForm = new UserForm();
$userForm->getName();
$userForm->main();
$userForm->displayUserDetails();
?>
