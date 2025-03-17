<?php

session_start();

require_once("../model/order_model.php");

class OrderController extends Order
{
    public function viewOrderDetails_ByInvoiceId($invoiceId)
    {
        $result = $this->getOrderDetails_ByInvoiceId($invoiceId);
        return $result;
    }

    public function addNewOrder($date, $fname, $lname, $addr1, $addr2, $addr3, $postalId, $contact, $email, $customerId, $invoiceId)
    {
        $result = $this->setNewOrder($date, $fname, $lname, $addr1, $addr2, $addr3, $postalId, $contact, $email, $customerId, $invoiceId);
        return $result;
    }

    public function addNewOrderItems($orderId, $productId, $productQty, $productPrice, $subTotal, $sizeId)
    {
        $result = $this->setOrderItems($orderId, $productId, $productQty, $productPrice, $subTotal, $sizeId);
        return $result;
    }
}

$ordCont_obj = new OrderController($conn);

/////////////////////////////////////// Switch Status //////////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

switch ($request) {
    case 'viewOrderDetails':

        $invoiceId = $_POST["invoiceId"];

        $getOrderDetails = $ordCont_obj->viewOrderDetails_ByInvoiceId($invoiceId);
        $orderDetails_array = $getOrderDetails->fetch_assoc();

?>

        <div class="row font-weight-bold">
            <div class="col-sm-3 text-mute">
                <i class="fas fa-check"></i> <span>Date and Time :</span>
            </div>
            <div class="col-sm-4 text-mute">
                <span><?php echo $orderDetails_array["invoice_time"]; ?></span>
            </div>
        </div>

        <table class="table mt-3 font-weight-bold">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Product</td>
                    <td>Product Price</td>
                    <td>Quantity</td>
                    <td>Sub Total</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                $getOrderDetails_2 = $ordCont_obj->viewOrderDetails_ByInvoiceId($invoiceId);
                while ($row = $getOrderDetails_2->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td style="width: 30%;"><?php echo $row["product_name"]; ?></td>
                        <td><?php echo $row["product_price"]; ?></td>
                        <td><?php echo $row["product_qty"]; ?></td>
                        <td><?php echo $row["sub_total"]; ?></td>
                    </tr>
                <?php
                    $count++;
                }
                ?>
                <tr>
                    <td class="text-center" colspan="3">Delivery Fee</td>
                    <td class="text-center">200.00</td>
                </tr>
                <tr>
                    <td class="text-center" colspan="3">Total</td>
                    <td class="text-center"><?php echo $orderDetails_array["invoice_net_total"]; ?></td>
                </tr>
            </tbody>
        </table>

<?php

        break;

    case 'addOrder':

        $fname = trim($_POST["fname"]);
        $lname = trim($_POST["lname"]);
        $email = trim($_POST["email"]);
        $contact = trim($_POST["contact"]);
        $postalId = trim($_POST["postalcode"]);
        $addr1 = trim($_POST["addr1"]);
        $addr2 = trim($_POST["addr2"]);
        $addr3 = trim($_POST["addr3"]);

        $total = $_POST["total"];
        $AmtPay = $_POST["AmtPay"];

        $customerId = $_SESSION["customer"]["userId"];

        include_once("../model/invoice_model.php");
        $invoice_obj = new Invoice($conn);

        $invCount = $invoice_obj->giveInvoiceCount_ByInvoicedate();
        $row = $invCount->fetch_assoc();

        $count = $row["inv_count"];
        $count += 1;

        date_default_timezone_set("Asia/Colombo");
        $today = date("Y-m-d");

        $newInvoiceNum = "INV" . str_replace("-", "", $today) . "_" . str_pad($count, 5, "0", STR_PAD_LEFT);

        $invId = $invoice_obj->addNewInvoice($newInvoiceNum, $total, $AmtPay, $customerId);

        if ($invId) {
            $result = $ordCont_obj->addNewOrder($today, $fname, $lname, $addr1, $addr2, $addr3, $postalId, $contact, $email, $customerId, $invId);

            if ($result) {
                include_once("../model/cart_model.php");
                $cart_obj = new Cart($conn);

                $sessionId = session_id();
                $cart_obj->removeCart($sessionId);

                $subject = "Your Order has been received !";

                $body = '<div style="padding: 20px;">
                    <h1 style="background-color: #db9200; color: white; text-align:center; padding: 10px;">Thank You For Your Order</h1>
                    <h2>Hi.. </h2>
                    <h3>Just to let you know — we have received your order #, and it is now being processed :</h3>
                    <p>Invoice Number : &nbsp;&nbsp;&nbsp; Date : </p>

                    <table style="border: 1px solid black; width:100%;">
                        <thead>
                            <tr>
                                <td style="border: 1px solid black;">Product</td>
                                <td style="border: 1px solid black;">Price</td>
                                <td style="border: 1px solid black;">Quantity</td>
                                <td style="border: 1px solid black;">Subtotal</td>
                            </tr>
                        </thead>
                        <tbody>';

                foreach ($_SESSION["cart"] as $key => $value) {
                    $ordCont_obj->addNewOrderItems($result, $value["productId"], $value["productQty"], $value["productPrice"], $value["productSubTotal"], $value["sizeId"]);

                    include_once("../model/stock_model.php");
                    $stock_obj = new Stock($conn);

                    $stock_obj->updateStockItem_ByStockId($value["itemId"], $value["productQty"]);

                    include_once("../model/product_model.php");
                    $product_obj = new Product($conn);

                    $productResult = $product_obj->giveProduct_ByProductId($value["productId"]);
                    $productRow = $productResult->fetch_assoc();

                    include_once("../model/size_model.php");
                    $size_obj = new Size($conn);

                    $sizeResult = $size_obj->giveSize_BySizeId($value["sizeId"]);
                    $sizeRow = $sizeResult->fetch_assoc();

                    $body .= '<tr>
                    <td style="border: 1px solid black;">'
                        . $productRow["product_name"] . 'Size :' . $sizeRow["size_name"] .
                        '</td> 
                    <td  style="border: 1px solid black;">'
                        . $value["productPrice"] .
                        '</td> 
                    <td  style="border: 1px solid black;">'
                        . $value["productQty"] .
                        '</td> 
                    <td  style="border: 1px solid black;">'
                        . $value["productSubTotal"] .
                        '</td> 
                    </tr>';
                }

                $body .= '<tr>
                <td colspan="3" style="border: 1px solid black; text-align-center;">
                Net Total 
                </td>
                <td style="border: 1px solid black;">'
                    . $total .
                    '</td>
                </tr>
                <tr>
                <td colspan="3" style="border: 1px solid black; text-align-center;">
                Shipping
                </td>
                <td style="border: 1px solid black;">
                200.00
                </td>
                <tr>
                <td colspan="3" style="border: 1px solid black; text-align-center;">
                Total 
                </td>
                <td style="border: 1px solid black;">'
                    . $AmtPay .
                    '</td>
                </tr>
                </tr>
                </tbody>
                    </table>
                </div>';

                unset($_SESSION["cart"]);

                include_once("../common/mailConfig.php");
                sendEmail($email, $subject, $body);

                $response = "Your Order Has Been Placed Successfully";

                header("Location: ../view/home.php?response=$response");
            } else {
                $response = "Something went wrong..Order Not Placed";
                $status = "0";

                header("Location: ../view/payment.php?response=$response&res_status=$status");
            }
        } else {
            $response = "Something went wrong..Order Not Placed";
            $status = "0";

            header("Location: ../view/payment.php?response=$response&res_status=$status");
        }

        break;
}
?>