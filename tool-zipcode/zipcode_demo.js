(function(){

// 動態地址效果
var $city = $("#city"),
	$area = $("#area");

$city.find('option').each(function(){
	$(this).remove();
});
$city.append('<option value="">選擇縣市</option>');
$area.find('option').each(function(){
	$(this).remove();
});
$area.append('<option value="">選擇地區</option>');

for ( var city in zipcode) {
	$city.append('<option value="'+city+'">'+city+'</option>');
}


$city.change(function(){

	$area.find('option').each(function(){
		$(this).remove();
	});
	$area.append('<option value="">選擇地區</option>');
	
	var city =  $city.val();
	//console.log(city);
	var areaMap = zipcode[city];
	//console.log(zipcode.[city]);
	for ( var area in areaMap) {
		$area.append('<option value="'+area+'">'+area+'</option>');
	}
});


}());

