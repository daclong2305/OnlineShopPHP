<?php
include 'header.php';
?>
<script id="jsbin-javascript">
	(function(global) {
		if (typeof(global) === "undefined") {
			throw new Error("window is undefined");
		}
		var _hash = "!";
		var noBackPlease = function() {
			global.location.href += "#";
			// making sure we have the fruit available for juice....
			// 50 milliseconds for just once do not cost much (^__^)
			global.setTimeout(function() {
				global.location.href += "!";
			}, 50);
		};
		// Earlier we had setInerval here....
		global.onhashchange = function() {
			if (global.location.hash !== _hash) {
				global.location.hash = _hash;
			}
		};
		global.onload = function() {
			noBackPlease();
			// disables backspace on page except on input fields and textarea..
			document.body.onkeydown = function(e) {
				var elm = e.target.nodeName.toLowerCase();
				if (e.which === 8 && (elm !== 'input' && elm !== 'textarea')) {
					// e.preventDefault();
				}
				// stopping event bubbling up the DOM tree..
				e.stopPropagation();
			};
		};
	})(window);
</script>
<div class="main main-raised">

	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<!-- aside Widget -->
					<div id="get_category">
					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div class="aside">
						<h3 class="aside-title">Giá</h3>
						<div class="price-filter">
							<!-- <div id="price-slider" class="noUi-target noUi-ltr noUi-horizontal"> -->
							<!-- <div class="noUi-base">
									<div class="noUi-origin" style="left: 0%;">
										<div class="noUi-handle noUi-handle-lower" data-handle="0" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="10.000.000" aria-valuenow="0.0" aria-valuetext="1.000" style="z-index: 5;"></div>
									</div>
									<div class="noUi-connect" style="left: 0%; right: 0%;"></div>
									<div class="noUi-origin" style="left: 100%;">
										<div class="noUi-handle noUi-handle-upper" data-handle="1" tabindex="0" role="slider" aria-orientation="horizontal" aria-valuemin="0.0" aria-valuemax="10.000.000" aria-valuenow="100.0" aria-valuetext="99.000.000" style="z-index: 4;"></div>
									</div>
								</div> -->
							<!-- </div> -->
							<div class="input-number price-min">
								<input id="price-min" type="number" value="">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
							<span>-</span>
							<div class="input-number price-max">
								<input id="price-max" type="number" value="">
								<span class="qty-up">+</span>
								<span class="qty-down">-</span>
							</div>
						</div>
						<br>
						<button class="primary-btn cta-btn" id="filter">Áp dụng</button>

					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<div id="get_brand">
						<div class="aside">
							<h3 class="aside-title">Hãng</h3>
							<div class="btn-group-vertical">
								<?php
								include 'connect.php';
								$sql = "select * from brands";

								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									while ($row = $result->fetch_row()) {
										echo '
											<div type="button" class="btn navbar-btn selectBrand" brand=' . $row[1] . ' bid=' . $row[0] . '>
												<a href="#" class="hang">
													<span></span>' .
											$row[1] . '
													<small></small>
												</a>
											</div>
									';
									}
								}
								?>
							</div>
						</div>

					</div>
					<!-- /aside Widget -->

					<!-- aside Widget -->
					<!-- <div class="aside">
						<h3 class="aside-title">Top selling</h3>
						<div id="get_product_home"> -->
					<!-- product widget -->

					<!-- product widget -->
					<!-- </div>
					</div> -->
					<!-- /aside Widget -->
				</div>
				<!-- /ASIDE -->

				<!-- STORE -->
				<div id="store" class="col-md-9">
					<!-- store top filter -->
					<div class="store-filter clearfix">
						<div class="store-sort">
							<label>
								Giá:
								<select class="input-select">
									<option value="DESC">Giảm</option>
									<option value="ASC">Tăng</option>
								</select>
							</label>

							<!-- <label>
								Show:
								<select class="input-select">
									<option value="0">9</option>
									<option value="1">12</option>
									<option value="1">15</option>
								</select>
							</label> -->
						</div>
						<ul class="store-grid">
							<li class="active"><i class="fa fa-th"></i></li>
							<li><a href="#"><i class="fa fa-th-list"></i></a></li>
						</ul>
					</div>
					<!-- /store top filter -->

					<!-- store products -->
					<div class="row" id="product-row">

						<div class="col-md-12 col-xs-12" id="product_msg">

						</div>
						
						<!-- product -->
						<div id="get_product">
							<!--Here we get product jquery Ajax Request-->
							<?php include 'get_products.php' ?>
						</div>

						<!-- /product -->
					</div>
					<!-- /store products -->

					<!-- store bottom filter -->
					<div class="store-filter clearfix">
						<!-- <span class="store-qty">Showing 9 products</span> -->
						<ul class="store-pagination" id="page">
							<?php
							include 'connect.php';
							$sql = "SELECT count(product_id) FROM products,categories WHERE product_cat=cat_id";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								$row = $result->fetch_row();
								$total = $row[0];
								$pages = ceil($total / 12);
							}

							for ($i = 1; $i <= $pages; $i++) {
								echo "<li><a id='pageno' class='active' href='?page=$i'>$i</a></li>";
							}
							?>
							<!-- 
							<li><a id="pageno" class="active" href="?page=1">1</a></li>
							<li><a id="pageno" class="active" href="?page=2">2</a></li>
							<li><a id="pageno" class="active" href="?page=3">3</a></li>
							<li><a id="pageno" class="active" href="?page=4">4</a></li>
							<li><a id="pageno" class="active" href="?page=5">5</a></li>
							<li><a id="pageno" class="active" href="?page=6">6</a></li>
							<li><a id="pageno" class="active" href="?page=7">7</a></li> -->

							<!-- <li><a href="#"><i class="fa fa-angle-right"></i></a></li> -->
						</ul>
					</div>
					<!-- /store bottom filter -->
				</div>
				<!-- /STORE -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
</div>
<?php
include "newslettter.php";
include "footer.php";
?>