<?php
include 'db.php';

$limit = 12;

if (isset($_GET["page"])) {
	$page = $_GET['page'];
	settype($page, "int");
	$from = ($page - 1) * $limit;
	$sql = "SELECT * FROM products,categories WHERE product_cat=cat_id order by product_price DESC LIMIT $from, $limit";
}


if (isset($_POST["brand_id"])) {
	$brand = $_POST["brand_id"];
	$sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_brand=$brand LIMIT 0, $limit";
}

if (isset($_POST["min"]) && isset($_POST["max"])) {
	$min = $_POST["min"];
	$max = $_POST["max"];

	$sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_price between $min and $max  order by product_price ASC LIMIT 0, $limit";
}

if(isset($_POST["orderby"])){
	$orderby = $_POST["orderby"];
	$sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_price order by product_price $orderby LIMIT 0, $limit";
}

if(isset($_GET["search"])){
	$keyword = "%".$_GET["search"]."%";
	$sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_keywords like '$keyword' LIMIT 0, $limit";
}

$run_query = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($run_query)) {
	$pro_id    = $row['product_id'];
	$pro_cat   = $row['product_cat'];
	$pro_brand = $row['product_brand'];
	$pro_title = $row['product_title'];
	$pro_price = $row['product_price'];
	$pro_image = $row['product_image'];
	$cat_name = $row["cat_title"];

	echo "
    <div class='col-md-4 col-xs-6'>
								<a href='product.php?p=$pro_id'><div class='product'>
									<div class='product-img'>
										<img  src='product_images/$pro_image' style='max-height: 170px;' alt=''>
										<div class='product-label'>
											<span class='sale'>-30%</span>
											<span class='new'>NEW</span>
										</div>
									</div></a>
									<div class='product-body'>
										<p class='product-category'>$cat_name</p>
										<h3 class='product-name header-cart-item-name'><a href='product.php?p=$pro_id'>$pro_title</a></h3>
										<h4 class='product-price header-cart-item-info'>$pro_price<del class='product-old-price'>990.000</del></h4>
										<div class='product-rating'>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
											<i class='fa fa-star'></i>
										</div>
										<div class='product-btns'>
											<button class='add-to-wishlist' tabindex='0'><i class='fa fa-heart-o'></i><span class='tooltipp'>add to wishlist</span></button>
											<button class='add-to-compare'><i class='fa fa-exchange'></i><span class='tooltipp'>add to compare</span></button>
											<button class='quick-view' ><i class='fa fa-eye'></i><span class='tooltipp'>quick view</span></button>
										</div>
									</div>
									
								</div>
							</div>
			";
}


//nut add to cart them vao duoi class product-btns
// <div class='add-to-cart'>
// 	<a href='cart.php?action=add&pid=$pro_id&sl=1'><button pid='$pro_id' id='product' tabindex='0' class='add-to-cart-btn'><i class='fa fa-shopping-cart'></i>add to cart</button></a>
// </div>