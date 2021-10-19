<?php
namespace UFG\CustomApi\Api;
 
interface CustomApiInterface
{
    /**
     * Returns order data
     *
     * @api
     * @param int $orderId Order id.
     * @param string $email Customer email for order
     * @return array order status, order creation date, total amount
     */
    public function getOrder($orderId, $email);
}