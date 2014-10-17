<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div>{{$header}}</div>
		@if(count($products) != 0)
			</div>
				@foreach($products as $product)
					<!--products pake foreach disini-->
				@endforeach
			</div>
		@endif
		
		<div>{{$footer}}</div>
	</body>
</html>