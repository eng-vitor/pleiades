<?php
session_start();
require __DIR__.'/../config.php';
include __DIR__.'../../scripts/status.php';
include __DIR__.'../../scripts/verifyauth.php';

$TITLEPAGE = 'Change Password - '.$SERVER_NAME;
include __DIR__ . '/static/header.php';
?>
        <div class="mininav">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="System.php"><i class="fa-solid fa-circle-chevron-left"></i> Back</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="fa-solid fa-unlock-keyhole"></i> Change Password</li>
                </ol>
            </nav>
        </div> 
            <?php
                if(isset($_SESSION['Msg'])){
                    echo $_SESSION['Msg'];
                    unset($_SESSION['Msg']);
                }
                else{
                    unset($_SESSION['Msg']);
                }
            ?>
        <form action="../scripts/changepass.php" method="POST" class="formpassword" align="center">
            <strong><i class="fa-solid fa-repeat"></i> Change your password!</i></strong>
            <h5>To change the password is simple, however the new password must follow the pattern below:</h5>
            <div class="alert alert-secondary" role="alert" align="left">
                <ul>
                    <li><i class="fa-solid fa-circle-up"></i> Must have at least 8 characters.</li>
                    <li><i class="fa-solid fa-circle-down"></i> Must be a maximum of 32 characters.</li>
                    <li><i class="fa-solid fa-arrow-down-1-9"></i> Must contain at least one number.</li>
                    <li><i class="fa-solid fa-hashtag"></i>Must contain at least one special character !@#$%¨&*().</li>
                </ul>
            </div>
            <label for="newpass"> New password</label>
            <input class="form-control form-control-lg" type="password" id="newpass" name="newpass" placeholder="Enter your new password" minlength="8" maxlength="32" required/>
            <label for="newpassconfirm"> Confirm the new password</label>
            <input class="form-control form-control-lg" type="password" id="newpassconfirm" name="newpassconfirm" placeholder="Enter your new password again" minlength="8" maxlength="32" required/>
            <button type="submit" class="btn btn-dark"><i class="fa-solid fa-arrow-up-from-bracket"></i> Change</button>
        </form>
<?php
include __DIR__ . '/static/footer.php';
?>