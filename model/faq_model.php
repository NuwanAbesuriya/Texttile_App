<?php

require_once("../common/dbConnection.php");

class FAQ
{
    private $conn;
    private $table = "faqs";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function setNewFAQ($content, $cusName, $cusEmail)
    {
        $sql = "INSERT INTO $this->table(faq_content, faq_cus_name, faq_cus_email) VALUES('$content', '$cusName', '$cusEmail')";
        $result = $this->conn->query($sql);
        return $result;
    }
}
