<?php

require_once("../model/faq_model.php");

class FAQController extends FAQ
{
    public function addFAQ($content, $cusName, $cusEmail)
    {
        $result = $this->setNewFAQ($content, $cusName, $cusEmail);

        if ($result) {
            $response = "Sent FAQ Successfully";
            $status = "1";
        } else {
            $response = "Something went wrong. Task Fail";
            $status = "0";
        }

        header("Location: ../view/contactus.php?response=$response&res_status=$status");
    }
}

$faqCont_obj = new FAQController($conn);


/////////////////////////////////////// Switch Status //////////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

switch ($request) {
    case 'addFAQ':

        $content = trim($_POST["msg"]);
        $name = trim($_POST["cusName"]);
        $email = trim($_POST["cusEmail"]);

        $faqCont_obj->addFAQ($content, $name, $email);

        break;
}
