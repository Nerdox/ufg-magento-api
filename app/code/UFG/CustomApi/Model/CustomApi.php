<?php
namespace UFG\CustomApi\Model;

use UFG\CustomApi\Api\CustomApiInterface;
use \Magento\Framework\Exception\NotFoundException;

class CustomApi implements CustomApiInterface
{
    private $orderInterface;

    public function __construct(\Magento\Sales\Api\Data\OrderInterface $orderInterface) {
        $this->orderInterface = $orderInterface;
    }

    /**
     * Returns order data
     *
     * @api
     * @param int $orderId Order id.
     * @param string $email Customer email for order
     * @return array order status, order creation date, total amount
     */
    public function getOrder($orderId, $email) {
        $order = $this->orderInterface->load($orderId);
        
        if (!$order->getId() || $order->getCustomerEmail() != $email)
            throw new NotFoundException(__('Request does not match.'));

        $data = [
            $order->getStatus(),
            $order->getCreatedAt(),
            $order->getBaseTotalPaid()
        ];

        return $data;
    }
}