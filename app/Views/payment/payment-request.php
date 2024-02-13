<form method="post" name="redirect" action="<?= base_url('payment/request'.(isset($env)?'?urlType=test-server-JGDbKGJEH%$^%%HGDVBSJKHJKLHS':'')) ?>">
    <input type="hidden" name="merchant_id" value="<?= $merchantId ?>" />
    <input type="hidden" name="order_id" value="<?php echo $tran; ?>" />
    <input type="hidden" name="amount" value="<?php echo $amt; ?>" />
    <input type="hidden" name="currency" value="INR" />
    <input type="hidden" name="redirect_url" value="<?= $redirectURL ?>" />
    <input type="hidden" name="cancel_url" value="<?= $redirectURL ?>" />
    <input type="hidden" name="billing_tel" value="<?php echo $mobile; ?>" />
    <input type="hidden" name="billing_email" value="<?php echo $email; ?>" />
    <input type="hidden" name="sid" value="<?php echo $sid; ?>" />
    <input type="hidden" name="delivery_name" value="<?php echo $name; ?>" />
    <input type="hidden" name="delivery_country" value="India" />
    <input type="hidden" name="delivery_tel" value="<?php echo $mobile; ?>" />
    <input type="hidden" name="merchant_param1" value="<?php echo $sid; ?>" />
    <input type="hidden" name="merchant_param2" value="<?php echo $name; ?>" />
    <input type="hidden" name="merchant_param3" value="<?php echo $mobile; ?>" />
    <input type="hidden" name="merchant_param4" value="<?php echo $prog; ?>" />
    <input type="hidden" name="merchant_param5" value="<?php echo $sem; ?>" />
    
</form>
<script language='javascript'>document.redirect.submit();</script>
<?php /*
<input type="submit" name="submit" value="Submit For Payment">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
$(document).bind("contextmenu",function(e){  
	return false;  
});  
</script>

*/ ?>