<?php

require_once("../common/dbConnection.php");

class Invoice
{
    private $conn;
    private $table = "invoices";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    protected function getInvoice_ByInvoiceId($invoiceId)
    {
        $sql = "SELECT * FROM $this->table WHERE invoice_id = $invoiceId";
        $result = $this->conn->query($sql);
        return $result;
    }

    protected function getInvoiceCount_ByInvoicedate()
    {
        $sql = "SELECT count(invoice_id) as inv_count FROM $this->table WHERE DATE(invoice_time) = DATE(CURRENT_TIMESTAMP)";
        $result = $this->conn->query($sql);
        return $result;
    }

    protected function setNewInvoice($invNum, $invTotal, $inv_netTotal, $customerId)
    {
        $sql = "INSERT INTO $this->table(invoice_number, invoice_total, invoice_net_total, customer_customerId) " .
            "VALUES('$invNum', $invTotal, $inv_netTotal, $customerId)";

        $this->conn->query($sql);
        $invId = $this->conn->insert_id;

        return $invId;
    }

    //////////////////////////// Public Access ///////////////////////// 
    public function giveInvoice_ByInvoiceId($invoiceId)
    {
        $result = $this->getInvoice_ByInvoiceId($invoiceId);
        return $result;
    }

    public function giveInvoiceCount_ByInvoicedate()
    {
        $result = $this->getInvoiceCount_ByInvoicedate();
        return $result;
    }

    public function addNewInvoice($invNum, $invTotal, $inv_netTotal, $customerId)
    {
        $result = $this->setNewInvoice($invNum, $invTotal, $inv_netTotal, $customerId);
        return $result;
    }
}
