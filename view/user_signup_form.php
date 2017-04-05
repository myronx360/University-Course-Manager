<?php

require_once('../model/mainModel.php');

// Get All from department
$departments = getAllDepartments();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
    "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Registration</title>

    <!-- Framework CSS -->
    <link rel="stylesheet" href="../screen.css" type="text/css" media="screen, projection">
    <link rel="stylesheet" href="../print.css" type="text/css" media="print">
    <!--[if lt IE 8]><link rel="stylesheet" href="ie.css" type="text/css" media="screen, projection"><![endif]-->
</head>
<body>
<div class="container">
    <h1>Registration Form</h1>
    <hr>
    <div class="span-3">
        <br/>
    </div>
    <form action="user_signup_form.php" method="get">
        <div class="span-18">
            <?php
            if (isset($_GET["error"])) {
                switch ($_GET["error"]) {
                    case 1:
                        echo "<div class='error'>" .
                            "Username already used, please use another username." .
                            "</div>";
                        break;
                    case 2:
                        echo "<div class='error'>
                            Username should contain 4-10 alphanumeric characters.
                        </div>";
                        break;
                    case 3:
                        echo "<div class='error'>
                                 Should be at least 8 charaters, 1 upper case letter [A-Z], one special character !,#,@.
                            </div>";
                        break;
                    case 4:
                        echo "<div class='error'>
                                 Password and confirm password should match.
                               </div>";
                        break;
                    case 5:
                        echo "<div class='error'>
                                Age should be a number.
                              </div>";
                        break;
                    case 6:
                        echo "<div class='error'>
                                Please select a gender.
                              </div>";
                        break;
                    case 7:
                        echo "<div class='error'>
                            Please select a role.
                            </div>";
                        break;
                    case 8:
                        echo "<div class='error'>
                            Please enter the correct email format.
                        </div>";
                        break;
                    case 9:
                        echo " <div class='error'>
                            Please accept the terms.
                        </div>";
                        break;
                    case 10:
                        echo "<div class='error'>
                            Firstname and Lastname should only contain characters [A-Z] or [a-z]
                        </div>";
                        break;
                }
            }
            ?>
    </form>
        <form id="dummy" action="signupHandler.php" method="post" class="inline">
            <fieldset>
                <div class="span-9">
                    <p>
                        <label for="username">Username</label><br>
                        <input type="text" class="text" id="username" name="username" value="">
                    </p>
                    <p>
                        <label for="password">Password</label><br>
                        <input type="password" class="text" id="password" name="password" value="">
                    </p>

                    <p>
                        <label for="firstname">Firstname</label><br>
                        <input type="text" class="text" id="firstname" name="firstname" value="" required>
                    </p>

                </div>


                <div class="span-8 last">
                    <p>
                        <label for="email">Email</label><br>
                        <input type="text" class="text" id="email" name="email" value="">
                    </p>

                    <p>
                        <label for="confirmpassword">Confirm Password</label><br>
                        <input type="password" class="text" id="confirmpassword" name="confirmpassword" value="">
                    </p>


                    <p>
                        <label for="lastname">Lastname</label><br>
                        <input type="text" class="text" id="lastname" name="lastname" value="" required>
                    </p>

                    <p>
                        <label>Gender</label><br>
                        <input type="radio" name="gender" value="male"> Male
                        <input type="radio" name="gender" value="female"> Female<br>
                    </p>
                    <p>
                        <label>Role</label><br>
                        <input type="radio" name="role" value="student"> Student
                        <input type="radio" name="role" value="manager"> Manager<br>
                    </p>
                    <p>
                        <label for="dept">Department</label><br>
                        <select id="dept" name="dept">
                            <?php foreach ($departments as $department) :?>
                                <option value="<?php echo $department['departmentID']; ?>"> <?php echo $department['departmentName']; ?></option>
                            <?php endforeach ?>
                        </select>

                    </p>

                    <p>
                        <input type="checkbox" name="accepted" id="accepted" value="accepted"> Please check this checkbox to accept our terms.
                    </p>

                    <p>
                        <input type="submit" value="Submit">
                        <input type="reset" value="Reset">
                    </p>

                </div>

            </fieldset>
        </form>
    </div>
    <div class="span-3 last">
        <br/>
    </div>
</div>
</body>
</html>
