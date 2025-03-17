<?php

session_start();

require_once("../model/cart_model.php");

class CartController extends Cart
{
    public function addNewItem($sessionId, $stockId)
    {
        $result = $this->setNewItem($sessionId, $stockId);
        return $result;
    }

    public function retrieveItem_FromCart($sessionId, $stockId)
    {
        $result = $this->getItem_FromCart($sessionId, $stockId);
        return $result;
    }

    public function updateCartQuantity($sessionId, $stockId)
    {
        $result = $this->setExistQuantity($sessionId, $stockId);
        return $result;
    }

    public function removeItem_FromCart($sessionId, $stockId)
    {
        $result = $this->deleteItem_FromCart($sessionId, $stockId);
        return $result;
    }

    public function removeQuantity_FromCart($sessionId, $stockId)
    {
        $result = $this->decreaseQuantity($sessionId, $stockId);
        return $result;
    }

    /////////////////////////// Stock Methods ///////////////////////
    public function removeQuantity_FromStock($stockId)
    {
        $result = $this->DecreaseQty_FromStock($stockId);
        return $result;
    }

    public function increaseQty_FromStock($stockId)
    {
        $result = $this->addQty_ToStock($stockId);
        return $result;
    }
}

$cartCont_obj = new CartController($conn);

///////////////////////////////////////// Switch Status /////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

switch ($request) {

    case 'addItem':

        $sessionId = session_id();
        $stockId = $_POST["stockId"];

        $checkCart = $cartCont_obj->retrieveItem_FromCart($sessionId, $stockId);

        if ($checkCart->num_rows > 0) {
            $result = $cartCont_obj->updateCartQuantity($sessionId, $stockId);
        } else {
            $result = $cartCont_obj->addNewItem($sessionId, $stockId);
        }

        if ($result) {
            $result2 = $cartCont_obj->removeQuantity_FromStock($stockId);
            if ($result2) {
                echo "Success";
            } else {
                echo "Error";
            }
        }

        break;

    case 'removeItem':

        $sessionId = session_id();
        $stockId = $_POST["itemId"];

        $cartCont_obj->removeItem_FromCart($sessionId, $stockId);

        break;

    case 'decreaseQty':

        $sessionId = session_id();
        $stockId = $_POST["stockId"];

        $result = $cartCont_obj->removeQuantity_FromCart($sessionId, $stockId);

        if ($result) {
            $cartCont_obj->increaseQty_FromStock($stockId);
        }

        break;
}
