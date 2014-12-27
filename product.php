<?php
include('php/header.php');

$product_pid = $_GET['pid'];
$valid_pid = isset($product_pid) && ctype_digit($product_pid) && $product_pid > 26;

if ($valid_pid)
{	$stmt = $db->prepare('SELECT name, description, image, price, shipping, pickup, button_id, button_options_name, button_options FROM products WHERE pid=? LIMIT 1');
	$stmt->execute(array($product_pid));
	$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

	if ($results)
	{	$product_name = $results[0]['name'];
		$product_description = $results[0]['description'];
		$product_image = $results[0]['image'];
		$product_price = $results[0]['price'];
		$product_shipping = $results[0]['shipping'];
		$product_pickup = $results[0]['pickup'];
		$product_button_id = $results[0]['button_id'];
		$product_button_option_names = preg_split('/\|/', $results[0]['button_options_name']);
		$product_button_options_grouped = preg_split('/\|/', $results[0]['button_options']);
		$product_button_options = [];

		$product_title = $product_name;
		$product_subtitle = $product_description;

		foreach ($product_button_options_grouped as $index => $product_button_option)
		{	$product_button_options[$index] = preg_split('/,/', $product_button_option);
		}

		if ($product_shipping && $product_pickup) 
		{	$product_delivery = $DELIVERY_MESSAGE['shipping_and_pickup'];
		}

		else if ($product_shipping)
		{	$product_delivery = $DELIVERY_MESSAGE['shipping'];
		}

		else if ($product_pickup)
		{	$product_delivery = $DELIVERY_MESSAGE['pickup'];
		}
	}

	else
	{	$valid_pid = false;
	}
}

if (!$valid_pid)
{	$product_image = 'invalid.svg';

	$product_title = 'Invalid Product';
	$product_subtitle = $ERROR_MESSAGE['invalid_product'];
}
?>

	</div>

	<div class='jumbotron'>
		<div class='container text-center'>
			<img class='img-responsive img-featured' src='img/product/<?php echo $product_image ?>' alt='<?php echo $product_title ?>' width='250px'>
			<h1 class='boxed-light'><?php echo $product_title ?></h1><br>

<?php
if ($product_subtitle)
{
?>

			<p class='boxed-light'><?php echo $product_subtitle ?></p>

<?php
}
?>

		</div>
	</div>

<?php
if ($product_delivery)
{
?>

	<div class='container'>
		<div class='row text-center'>
			<h2 id='purchase'>Purchase</h2>
			<p><?php echo $product_delivery ?></p>
			<br>
		</div>
		<div class='container text-center'>
			<form class='form-inline' role='form' target='paypal' action='https://www.paypal.com/cgi-bin/webscr' method='post'>
				<input type='hidden' name='cmd' value='_s-xclick'>
				<input type='hidden' name='hosted_button_id' value='<?php echo $product_button_id ?>'>

<?php
foreach ($product_button_option_names as $index => $product_button_option_name)
{	$product_button_option_input_position = strrpos($product_button_option_name, ':input');
	if ($product_button_option_input_position > 0)
	{	$product_button_option_name = substr($product_button_option_name, 0, $product_button_option_input_position);
		$product_button_option_input_present = true;
	}
?>

				<input type='hidden' name='on<?php echo $index ?>' value='<?php echo $product_button_option_name ?>'>
				<div class='row form-group'>
					<div class='input-group'>
						<label class='contol-label text-right sr-only' for='<?php echo $product_button_option_name ?>'><?php echo $product_button_option_name ?></label>
						<div class='input-group-addon'><?php echo $product_button_option_name ?></div>

<?php
	if (!$product_button_option_input_position)
	{
?>

						<select class='form-control' name='os<?php echo $index ?>' id='<?php echo $product_button_option_name ?>'>

<?php
		foreach ($product_button_options[$index] as $product_button_option)
		{
?>

							<option value='<?php echo $product_button_option ?>'><?php echo $product_button_option ?></option>

<?php
		}
?>

						</select>

<?php
	}
	else
	{
?>

						<input type='text' maxlength='200' class='form-control' name='os<?php echo $index ?>' id='<?php echo $product_button_option_name ?>' placeholder='Your text here'>
					
<?php
	}
?>

					</div>
				</div>
				<br><br>

<?php
}
?>

				<div class='row'>
					<button type="submit" class="btn btn-default">Add to cart</button>
				</div>
			</form>
		</div>
		<br>
		<div class='row text-center'>
			<h2>About Your Order</h2>
			<p>When you're ready to place your oder, you'll be taken to PayPal's website to complete your purchase. We don't store or have access to any of your payment information, so the process is completely secure. You'll get a receipt sent to your email and we'll start processing your order right away. If you have questions, or need to change any of your order details, <a href='mailto:support@rvillespirit.com'>send us an email</a> and we'll help in any way possible. As soon as your order has been shipped or is ready for pickup, you'll get a confirmation email to keep you updated.</p>
		</div>
	</div>

<?php
}

include('php/footer.php');

// EOF: product.php
