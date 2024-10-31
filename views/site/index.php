<?php

use app\models\Location;
use app\models\PaymentType;
use app\modules\eghl\services\EghlService;
use yii\web\View;

/**
 * @var View $this
 * @var EghlService $payment
 * @var array $params
 * @var Location[] $locations
 * @var PaymentType[] $payment_types
*/

$this->title = 'Gateway';

?>

<div class="site-index">

    <form action="<?= $payment->getServiceUrl(); ?>" id="payment-form" method="post" enctype="multipart/form-data">
        <p>
            <strong>Payment</strong>
        </p>
        <input name="TransactionType" value="<?= $params['TransactionType']; ?>" type="hidden">
        <input name="PymtMethod" value="<?= $params['PymtMethod']; ?>" type="hidden">
        <input name="ServiceID" value="<?= $params['ServiceID']; ?>" type="hidden">
        <input name="OrderNumber" value="<?= $params['OrderNumber']; ?>" type="hidden">
        <input name="PaymentID" value="<?= $params['PaymentID']; ?>" type="hidden">
        <input name="PaymentDesc" value="<?= $params['PaymentDesc']; ?>" type="hidden">
        <input name="MerchantReturnURL" value="<?= $params['MerchantReturnURL']; ?>" type="hidden">
        <input name="CurrencyCode" id="CurrencyCode" value="<?= $params['CurrencyCode']; ?>" type="hidden">
        <input name="CustIP" value="<?= $params['UserIp']; ?>" type="hidden">
        <input name="PageTimeout" value="<?= $params['PageTimeout']; ?>" type="hidden">
        <input name="HashValue" value="<?= $params['HashValue']; ?>" type="hidden">
        <input name="Amount" value="<?= $params['Amount']; ?>" type="hidden">
        <div class="form-group row">
            <span class="col-sm-1 col-form-label mt-1">Location</span>
            <div class="col-sm-3 col-form-label">
                <select class="form-control" id="location" name="location">
                    <?php foreach ($locations as $location) { ?>
                        <option value="<?= $location->id; ?>"><?= $location->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <span class="col-sm-1 col-form-label mt-1">Type</span>
            <div class="col-sm-3 col-form-label">
                <select class="form-control" id="payment-type" name="payment-type">
                    <?php foreach ($payment_types as $payment_type) { ?>
                        <option value="<?= $payment_type->id; ?>"><?= $payment_type->name; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <span class="col-sm-1 col-form-label">Amount</span>
            <span class="col-sm-1 col-form-label"><strong><?= $params['Amount']; ?> <span class="currency-code-text"><?= $params['CurrencyCode']; ?></span></strong></span>
        </div>
        <div class="form-group row">
            <label for="CustName" class="col-sm-1 col-form-label">Name</label>
            <div class="col-sm-3">
                <input type="text" name="CustName" class="form-control" id="CustEMail" placeholder="Name">
            </div>
        </div>
        <div class="form-group row">
            <label for="CustName" class="col-sm-1 col-form-label">Email</label>
            <div class="col-sm-3">
                <input type="email" name="CustEmail" class="form-control" id="CustEMail" placeholder="Email">
            </div>
        </div>
        <div class="form-group row">
            <label for="CustName" class="col-sm-1 col-form-label">Phone</label>
            <div class="col-sm-3">
                <input type="tel" name="CustPhone" class="form-control" id="CustPhone" placeholder="Phone">
            </div>
        </div>
        <div class="form-group">
            <input class="btn btn-primary" value="Complete Order" type="submit">
        </div>
    </form>

</div>


<?php

$js = <<<JS

    let form = $('#payment-form');
          
    $('#location').on('change', function (e) {
        $.ajax({
            type: 'POST',
            url: '/rest/location',
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
                $('.currency-code-text').html(response.CurrencyCode);
                $("[name='CurrencyCode']").val(response.CurrencyCode);
                $("[name='HashValue']").val(response.HashValue);
            }
        });
    });
    
    form.on('submit', function(e) {
        $.ajax({
            type: 'POST',
            url: '/rest/order-create',
            data: form.serialize(),
            dataType: 'json',
            success: function (response) {
            }
        });
    });
          
JS;

$this->registerJs($js, View::POS_READY);

?>