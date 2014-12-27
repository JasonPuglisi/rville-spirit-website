<?php
include('php/header.php');
?>

	</div>

	<div class='jumbotron'>
		<div class='container'>
			<h1 class='boxed-light'>Rville Spirit</h1>
			<p class='boxed-light'>Welcome to the Robbinsville High School store! Check out what we've got for sale below, and <a href='https://twitter.com/RHS_SchoolStore' target='_blank'>follow us on Twitter</a> for the latest news. Thanks for visiting!</p>
		</div>
	</div>

	<div class='container'>
		<div class='row text-center'>
			<h2>Products</h2>
		</div>
		<hr>
		<div class='row text-center'>

<?php
$results = $db->query('SELECT pid, name, description, image, price FROM products WHERE featured = 1');

$count = 0;
foreach ($results as $product)
{	$product_pid = $product['pid'];
	$product_name = $product['name'];
	$product_description = $product['description'];
	$product_image = $product['image'];
	$product_price = $product['price'];

	if ($count % 3 == 0 && $count != 0)
	{
?>

		</div>
		<div class='row text-center'>

<?php
	}
?>

			<div class='col-md-4'>
				<a href='product?pid=<?php echo $product_pid ?>'>
					<img class='img-responsive img-featured img-featured-link' src='img/product/<?php echo $product_image ?>' alt='<?php echo $product_name ?>' width='250px'>
				</a>
				<div class='caption'>
					<h3><a href='product?pid=<?php echo $product_pid ?>'><?php echo $product_name ?></a><br>
					<small><?php echo '$', $product_price / 100 ?></small></h3>

<?php
	if ($product_description != null)
	{
?>

					<p><?php echo $product_description ?></p>

<?php
	}
?>

				</div>
			</div>

<?php
	$count++;
}
?>

			<br>
		</div>
	</div>

<?php
include('php/footer.php');

// EOF: index.php
