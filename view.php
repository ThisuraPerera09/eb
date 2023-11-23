<?php
include '../src/controllers/users.php';

$userForm = new UserForm();
$userForm->main();
$userDetails = $userForm->displayUserDetails();
?>
 
 
 <!DOCTYPE html>
 <html>

 <head>



 <script>
        function validateForm() {
            var name = document.getElementById('name').value;
            var age = document.getElementById('age').value;
            var email = document.getElementById('email').value;

            if (name.trim() === '') {
                alert('Please enter a name.');
                return false;
            }

            if (!/^[a-zA-Z\s]+$/.test(name)) {
                alert('Please enter a valid name (letters and spaces only).');
                return false;
            }

    
            if (age.trim() === '') {
                alert('Please enter an age.');
                return false;
            }

         
            if (!/^\d{1,3}$/.test(age)) {
                alert('Please enter a valid age (numeric, max 3 digits).');
                return false;
            }

            if (email.trim() === '') {
                alert('Please enter an email address.');
                return false;
            }

           
            if (!/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.[a-zA-Z]{2,})$/.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }

           
            return true;
        }

      

    </script>



     <meta charset='utf-8'>
     <title></title>
     <link rel="stylesheet" href="view.css">
     <style type='text/css'>
 
     </style>
 </head>

 <body>

 <div class='form'>
        <form method='post' action=''  id='user-form'>
            <h3 class='title'>User - Form </h3>

            <?php
    if ($userForm->successMsg) {
        echo "<p class='success-message'>{$userForm->successMsg}</p>";
    } elseif ($userForm->errorMsg) {
        echo "<p class='message'>{$userForm->errorMsg}</p>";
    }
    ?>


            <table width='400' cellpadding='12' align='center' cellspacing='1'>

                <tr>
                    <td>Name:</td>
                    <td><input name='name' type='text' id='name' class='input' value="<?php echo isset($userForm->name) ? $userForm->name : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Age: </td>
                    <td><input name='age' type='number' id='age' class='input' value="<?php echo isset($userForm->age) ? $userForm->age : ''; ?>"></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><input name='email' type='text' id='email' class='input' value="<?php echo isset($userForm->email) ? $userForm->email : ''; ?>"></td>
                </tr>
                <tr>
                    <td></td>
                    <br>
                    <td><input type='submit' name='Submit' value='Submit' class='submit'></td>
                </tr>
            </table>
        </form>

    </div>




     <div class='table'>
        <h3 class='title'>User - Details </h3>
        <table border='1' style='width: 100%; border-collapse: collapse;'>
            <tr>
                <th style='text-align:center; padding: 6px;'>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Email</th>
            </tr>

            <?php
            if (!empty($userDetails)) {
                foreach ($userDetails as $row) {
                    echo "<tr>
                        <td  style='text-align:center; padding: 6px;'>" . $row["id"] . "</td>
                        <td style='text-align:center'>" . $row["name"] . "</td>
                        <td style='text-align:center'>" . $row["age"] . "</td>
                        <td style='text-align:center'>" . $row["email"] . "</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>0 results</td></tr>";
            }
            ?>
        </table>
    </div>
            </body>

</html>

       


           