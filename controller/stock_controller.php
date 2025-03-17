<?php

require_once("../model/stock_model.php");

class StockController extends Stock
{
    public function giveStockInfo_ByProductSizeId($productId, $sizeId)
    {
        $result = $this->getStockInfo_ByProductSizeId($productId, $sizeId);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            $row = "error";
        }

        return json_encode($row);
    }

    public function giveStockInfo_ByStockId($stockId)
    {
        $result = $this->getStockInfo_ByStockId($stockId);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        } else {
            $row = "error";
        }

        return json_encode($row);
    }
}

$stockCont_obj = new StockController($conn);

////////////////////////////////////// Switch Status //////////////////////////////////////
$request = isset($_REQUEST["type"]) ? $_REQUEST["type"] : "";

switch ($request) {

    case 'getStockInfo':

        $productId = $_POST["productId"];
        $sizeId = $_POST["sizeId"];

        echo $stockCont_obj->giveStockInfo_ByProductSizeId($productId, $sizeId);

        break;

    case 'getStockInfo_ByStockID':

        $stockId = $_POST["stockId"];

        echo $stockCont_obj->giveStockInfo_ByStockId($stockId);

        break;
}
