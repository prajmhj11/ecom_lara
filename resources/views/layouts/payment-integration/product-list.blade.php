<!DOCTYPE html>
<html>
	<head>
		<title>Multiple Payment Gateway Integration With Laravel</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
	</head>
	<body>
		<div class="container">
            <div class="card">
                <h1 class="card-header text-center">Esewa Integration</h1>
            </div>
			<div class="pt-md-5">
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<div class="image_container" style="height: 257px;">
								<img src="" class="card-img-top"tyle="width: 100%; height: 100%;">
							</div>
							<div class="card-body">
								<h5 class="card-title">Product 1</h5>
								<p class="card-text">Rs. 15</p>
								<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit totam eos, facere culpa aut ut quibusdam officiis iste ducimus cumque! Alias unde perspiciatis in? Nisi ipsam magni provident numquam deserunt.</p>
								<form method="post" action="{{route('checkout')}}">
									{{csrf_field()}}
									<input type="hidden" name="pid" value="1">
									<input type="submit" name="submit" value="Buy Now">
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">
							<div class="image_container" style="height: 257px;">
								<img src="" class="card-img-top"tyle="width: 100%; height: 100%;">
							</div>
							<div class="card-body">
								<h5 class="card-title">Product 2</h5>
								<p class="card-text">Rs. 15</p>
								<p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit totam eos, facere culpa aut ut quibusdam officiis iste ducimus cumque! Alias unde perspiciatis in? Nisi ipsam magni provident numquam deserunt.</p>
								<form method="post" action="{{route('checkout')}}">
									{{csrf_field()}}
									<input type="hidden" name="pid" value="2">
									<input type="submit" name="submit" value="Buy Now">
								</form>
							</div>
						</div>
					</div>

				</div>
			</div>
		</body>
	</html>
