<?php
session_start();

require_once("../model/feedback_model.php");

class FeedbackController extends Feedback
{
    public function addNewFeedback($content, $starCount, $invoiceId, $customerId)
    {
        $result = $this->setNewFeedback($content, $starCount, $invoiceId, $customerId);
        if ($result) {
            $response = "ok";
        } else {
            $response = "error";
        }

        return $response;
    }
}

$feedbackCont_obj = new FeedbackController($conn);

///////////////////////////////////////// Switch Status /////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

switch ($request) {

    case 'addFeedback':

        $content = $_POST["comment"];
        $rate = $_POST["rate"];
        $invoiceId = $_POST["invoiceId"];
        $customerId = $_SESSION["customer"]["userId"];

        echo $feedbackCont_obj->addNewFeedback($content, $rate, $invoiceId, $customerId);

        break;
}
