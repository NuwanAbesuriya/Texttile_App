 <?php

    session_start();

    require_once("../model/customer_model.php");

    class LoginController extends Customer
    {

        public function checkLogin($email, $pw)
        {
            $LoginInfo = $this->getCustomerInfo_ByEmail($email);

            if ($LoginInfo->num_rows > 0) {

                $info_array = $LoginInfo->fetch_assoc();
                $getEmail = $info_array["login_email"];
                $getPass = $info_array["login_password"];


                if ($getEmail == $email && $getPass == sha1($pw)) {

                    $getCusId = $info_array["customer_customerId"];
                    $getCusInfo = $this->getCustomerInfo_ByCusIdFromCustomer($getCusId);
                    $cusInfo_array = $getCusInfo->fetch_assoc();

                    $customer = array(
                        "userId" => $getCusId,
                        "userFname" => $cusInfo_array["customer_fname"],
                        "userLname" => $cusInfo_array["customer_lname"],
                        "userImage" => $cusInfo_array["customer_img"]
                    );

                    $_SESSION["customer"] = $customer;
                    unset($_SESSION["otp"]);

                    header("Location: ../view/dashboard.php");
                } else {
                    $response = "Email and Password Doesn't Match";
                    $status = "0";
                    header("Location: ../view/login.php?response=$response&res_status=$status");
                }
            } else if (isset($_SESSION["otp"])) {

                $otp = $_SESSION["otp"]["num"];

                if ($pw == $otp) {

                    unset($_SESSION["otp"]);
                    header("Location: ../view/registerForm.php?email=$email");
                } else {
                    $response = "OTP Entered Incorrect";
                    $status = "0";
                    header("Location: ../view/login.php?response=$response&res_status=$status");
                }
            } else {
                $response = "You are not registered user";
                $status = "0";

                header("Location: ../view/login.php?response=$response&res_status=$status");
            }
        }

        public function checkEmail($email)
        {
            $result = $this->getCustomerInfo_ByEmail($email);
            return $result;
        }
    }


    $loginCont = new LoginController($conn);

    /////////////////////////////////////// Switch Status ///////////////////////////////
    $request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

    switch ($request) {

        case 'login':

            $email = trim($_POST["email"]);
            $pw = trim($_POST["pw"]);

            $loginCont->checkLogin($email, $pw);

            break;

        case 'logout':

            unset($_SESSION["customer"]);

            header("Location: ../view/login.php");

            break;

        case 'sendOTP':

            if (!isset($_SESSION["otp"])) {

                $email = trim($_POST["email"]);
                $otp_gen = rand(10000, 99999);

                $otp_array = array(
                    "email" => $email,
                    "num" => $otp_gen
                );

                include_once("../common/mailConfig.php");

                $subject = "Email Verification Code";
                $body = "Use This OTP as Your Login Password : <h3>" . $otp_gen . "<h3>";

                $Mailresult = sendEmail($email, $subject, $body);

                if ($Mailresult) {

                    $_SESSION["otp"] = $otp_array;

                    $response = "Email has been sent";
                    $status = "1";
                } else {
                    $response = "Something went wrong. Email not sent";
                    $status = "0";
                }
            } else {
                $response = "Email Already has been sent";
                $status = "0";
            }

            header("Location: ../view/login.php?response=$response&res_status=$status");

            break;

        case 'sendResetLink':

            $email = trim($_POST["email"]);

            $checkEmail = $loginCont->checkEmail($email);

            if ($checkEmail->num_rows > 0) {

                $getInfo = $checkEmail->fetch_assoc();
                $customerId = base64_encode($getInfo["customer_customerId"]);
                $key = base64_encode(rand(10000, 99999));

                $subject = "Reset Password";
                $body = "Reset Your Password Via This Link : http://localhost/ecommerce/view/changePassword.php?resetKey=$key&cusId=$customerId";

                include_once("../common/mailConfig.php");
                $sendMail = sendEmail($email, $subject, $body);

                if ($sendMail) {
                    $_SESSION["resetKey"] = $key;

                    $response = "Reset Link Has Been Sent. Please Check Email";
                    $status = "1";
                } else {
                    $response = "Something went wrong. Email Has Not Been Sent";
                    $status = "0";
                }
            } else {
                $response = "Entered Email Doesn't Match Our Records";
                $status = "0";
            }

            header("Location: ../view/passwordReset.php?response=$response&res_status=$res_status");

            break;
    }
