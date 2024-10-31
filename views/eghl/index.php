<?php

use app\models\Order;
use yii\web\View;

/**
 * @var View $this
 * @var Order $order
 * @var array $post
 */

$this->title = 'Order Status';

?>

<h2 class="mb-3"><?= $this->title; ?></h2>

<p>Order Number: <strong><?= $order->id; ?></strong></p>
<p>eGHL Status: <strong><?= $post['TxnMessage']; ?></strong></p>

