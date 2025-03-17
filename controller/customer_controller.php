<?php

session_start();

require_once("../model/customer_model.php");

$conn = $db_obj->getConnection();

class CustomerController extends Customer
{
    public function checkEmailExistence($email)
    {
        $result = $this->getCustomerInfo_ByEmail($email);

        if ($result->num_rows > 0) {
            $response = "yes";
        } else {
            $response = "no";
        }

        return $response;
    }

    public function checkUserExistence($nic)
    {
        $result = $this->getCustomerInfo_ByNIC($nic);

        if ($result->num_rows > 0) {
            $response = "yes";
        } else {
            $response = "no";
        }

        return $response;
    }

    public function addNewCustomer($fname, $lname, $nic, $gender, $contact, $addr1, $addr2, $addr3, $postalId, $uimg)
    {
        $result = $this->setNewCustomer($fname, $lname, $nic, $gender, $contact, $addr1, $addr2, $addr3, $postalId, $uimg);
        return $result;
    }

    public function addNewLogin($email, $pw, $customerId)
    {
        $result = $this->setNewLogin($email, $pw, $customerId);
        return $result;
    }

    public function updateCustomer($customerId, $fname, $lname, $contact, $gender, $postal_code, $addr1, $addr2, $addr3, $uimg)
    {
        $result = $this->setExistCustomer($customerId, $fname, $lname, $contact, $gender, $postal_code, $addr1, $addr2, $addr3, $uimg);

        if ($result) {
            $response = "Changes Applied";
            $status = "1";
        } else {
            $response = "Something went wrong. Task Fail";
            $status = "0";
        }

        header("Location: ../view/editCustomer.php?response=$response&res_status=$status");
    }

    public function changePassword($customerId, $Npw, $Cpw)
    {

        $getLoginInfo = $this->getCustomerInfo_ByCusIdFromLogin($customerId);
        $loginArray = $getLoginInfo->fetch_assoc();
        $getCurrPW = $loginArray["login_password"];

        if ($Cpw == "") {
            $result = $this->setNewPassword($customerId, $Npw);

            if ($result) {

                unset($_SESSION["resetKey"]);

                $cusInfo = $this->getCustomerInfo_ByCusIdFromCustomer($customerId);
                $cusInfoArray = $cusInfo->fetch_assoc();

                $customer = array(
                    "userId" => $customerId,
                    "userFname" => $cusInfoArray["customer_fname"],
                    "userLname" => $cusInfoArray["customer_lname"],
                    "userImage" => $cusInfoArray["customer_img"]
                );

                $_SESSION["customer"] = $customer;

                $response = "Password Reset Successfully";
                $status = "1";
            } else {
                $response = "Something Went Wrong. Task Fail";
                $status = "0";
            }
        } else if ($Cpw == $getCurrPW) {
            $result = $this->setNewPassword($customerId, $Npw);
            if ($result) {
                $response = "Password Changed Successfully";
                $status = "1";
            } else {
                $response = "Something Went Wrong. Task Fail";
                $status = "0";
            }
        } else {
            $response = "Please Check Your Current Password";
            $status = "0";
        }

        header("Location: ../view/changePassword.php?response=$response&res_status=$status");
    }
}

$cusCont_obj = new CustomerController($conn);

///////////////////////////////////////// Switch Status /////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

switch ($request) {

    case 'checkEmailExistence':

        $email = trim($_POST["email"]);

        echo $cusCont_obj->checkEmailExistence($email);

        break;

    case 'checkUserExistence':

        $nic = trim($_POST["nic"]);

        echo $cusCont_obj->checkUserExistence($nic);

        break;

    case 'addCustomer':

        $email = trim($_POST["email"]);
        $fname = trim($_POST["fname"]);
        $lname = trim($_POST["lname"]);
        $nic = trim($_POST["nic"]);
        $gender = trim($_POST["gender"]);
        $contact = "0" . trim($_POST["contact"]);
        $addr1 = trim($_POST["addr1"]);
        $addr2 = trim($_POST["addr2"]);
        $addr3 = trim($_POST["addr3"]);
        $postalId = trim($_POST["postalcode"]);

        $pw = trim($_POST["pw"]);
        $pw = sha1($pw);

        ///////////////////// File Uploading ///////////////////
        if ($_FILES["uimg"]["name"] != "") {
            $uimg = $_FILES["uimg"]["name"];
            $uimg = time() . "_" . $uimg;
        } else {
            $uimg = ($gender == "M") ? "defaultImageM.jpg" : "defaultImageF.jpg";
        }

        $tmp_location = $_FILES["uimg"]["tmp_name"];
        $permenent = "../image/users/$uimg";

        move_uploaded_file($tmp_location, $permenent);

        $result = $cusCont_obj->addNewCustomer($fname, $lname, $nic, $gender, $contact, $addr1, $addr2, $addr3, $postalId, $uimg);

        if ($result) {
            $customerId = $result;
            $cusCont_obj->addNewLogin($email, $pw, $customerId);

            $customer = array(
                "userId" => $customerId,
                "userFname" => $fname,
                "userLname" => $lname,
                "userImage" => $uimg
            );

            $_SESSION["customer"] = $customer;

            header("Location: ../view/dashboard.php");
        } else {
            $response = "Something went wrong. Task Fail";
            $status = "0";

            header("Location: ../view/registerForm.php?response=$response&res_status=$status&email=$email");
        }

        break;

    case 'editCustomer':

        $customerId = $_SESSION["customer"]["userId"];
        $fname = trim($_POST["fname"]);
        $lname = trim($_POST["lname"]);
        $nic = trim($_POST["nic"]);
        $gender = trim($_POST["gender"]);
        $contact = "0" . trim($_POST["contact"]);
        $addr1 = trim($_POST["addr1"]);
        $addr2 = trim($_POST["addr2"]);
        $addr3 = trim($_POST["addr3"]);
        $postalId = trim($_POST["postalcode"]);

        $uimg = $_SESSION["customer"]["userImage"];

        ///////////////////// File Uploading ///////////////////
        if ($_FILES["uimg"]["name"] != "") {
            $uimg = $_FILES["uimg"]["name"];
            $uimg = time() . "_" . $uimg;

            $tmp_location = $_FILES["uimg"]["tmp_name"];
            $permenent = "../image/users/$uimg";

            move_uploaded_file($tmp_location, $permenent);

            if ($_SESSION["customer"]["userImage"] != "defaultImageM.jpg" && $_SESSION["customer"]["userImage"] != "defaultImageF.jpg") {
                unlink("../image/users/" . $_SESSION["customer"]["userImage"] . "");
            }

            $_SESSION["customer"]["userImage"] = $uimg;
        }

        $cusCont_obj->updateCustomer($customerId, $fname, $lname, $contact, $gender, $postalId, $addr1, $addr2, $addr3, $uimg);

        break;

    case 'changePW':

        $customerId = $_POST["customerId"];
        $currPW = isset($_POST["pw"]) ? sha1(trim($_POST["pw"])) : "";
        $newPW = sha1(trim($_POST["Npw"]));

        $cusCont_obj->changePassword($customerId, $newPW, $currPW);

        break;
}
