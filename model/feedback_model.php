<?php

require_once("../common/dbConnection.php");

class Feedback
{
    private $conn;
    private $table = "feedbacks";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function setNewFeedback($content, $starCount, $invoiceId, $customerId)
    {
        $sql = "INSERT INTO $this->table(feedback_content, feedback_starcount, customer_customerId, invoice_invoiceId) " .
            "VALUES('$content', $starCount, $customerId, $invoiceId)";

        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getFeedback_ByInvoiceId($invoiceId)
    {
        $sql = "SELECT * FROM $this->table WHERE invoice_invoiceId = $invoiceId";
        $result = $this->conn->query($sql);

        return $result;
    }

    protected function getFeedback_ByCustomerId($customerId)
    {
        $sql = "SELECT * FROM $this->table f, invoices i WHERE " .
            "f.invoice_invoiceId = i.invoice_id AND f.customer_customerId = $customerId";
        $result = $this->conn->query($sql);

        return $result;
    }

    ////////////////////////////// Public Accesses //////////////////////////
    public function giveFeedback_ByInvoiceId($invoiceId)
    {
        $result = $this->getFeedback_ByInvoiceId($invoiceId);
        return $result;
    }

    public function giveFeedback_ByCustomerId($customerId)
    {
        $result = $this->getFeedback_ByCustomerId($customerId);
        return $result;
    }
}
