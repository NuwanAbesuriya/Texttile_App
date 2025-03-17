<?php

require_once("../common/dbConnection.php");

class Customer
{
    private $conn;
    private $table = "customers";
    private $table_log = "customer_login";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getCustomerInfo_ByEmail($email)
    {
        $sql = "SELECT * FROM $this->table_log WHERE login_email = '$email'";
        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getCustomerInfo_ByNIC($nic)
    {
        $sql = "SELECT * FROM $this->table WHERE customer_nic = '$nic'";
        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getCustomerInfo_ByCusIdFromCustomer($cusId)
    {
        $sql = "SELECT * FROM $this->table WHERE customer_id = $cusId";
        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getCustomerInfo_ByCusIdFromLogin($cusId)
    {
        $sql = "SELECT * FROM $this->table_log WHERE customer_customerId = $cusId";
        $result = $this->conn->query($sql);
        return $result;
    }

    protected function setNewCustomer($fname, $lname, $nic, $gender, $contact, $addr1, $addr2, $addr3, $postalId, $uimg)
    {

        $sql = "INSERT INTO $this->table(customer_fname,customer_lname,customer_addr1,customer_addr2,customer_addr3,customer_postal_id,customer_gender,customer_nic,customer_cno,customer_img) " .
            "VALUES('$fname','$lname','$addr1','$addr2','$addr3',$postalId,'$gender','$nic','$contact','$uimg')";
        $this->conn->query($sql);

        $insertID = $this->conn->insert_id;
        return $insertID;
    }

    protected function setNewLogin($email, $pw, $customerId)
    {
        $sql = "INSERT INTO $this->table_log(login_email, login_password, customer_customerId) " .
            "VALUES('$email', '$pw', $customerId)";

        $result = $this->conn->query($sql);
        return $result;
    }

    protected function setExistCustomer($customerId, $fname, $lname, $contact, $gender, $postal_code, $addr1, $addr2, $addr3, $uimg)
    {
        $sql = "UPDATE $this->table SET customer_fname='$fname', customer_lname='$lname', customer_cno='$contact', " .
            "customer_gender='$gender', customer_postal_id=$postal_code, customer_addr1='$addr1', customer_addr2='$addr2', " .
            "customer_addr3='$addr3', customer_img='$uimg' " .
            "WHERE customer_id = $customerId";

        $result = $this->conn->query($sql);
        return $result;
    }

    protected function setNewPassword($customerId, $pw)
    {
        $sql = "UPDATE $this->table_log SET login_password = '$pw' WHERE customer_customerId = $customerId";
        $result = $this->conn->query($sql);
        return $result;
    }

    ///////////////////////////// Public Access ///////////////////////
    public function giveCustomerInfo_ByCusIdFromCustomer($cusId)
    {
        $result = $this->getCustomerInfo_ByCusIdFromCustomer($cusId);
        return $result;
    }
    public function giveCustomerInfo_ByCusIdFromLogin($cusId)
    {
        $result = $this->getCustomerInfo_ByCusIdFromLogin($cusId);
        return $result;
    }
}
