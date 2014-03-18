<link rel="stylesheet" type="text/css" href="css/bc.css">
<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
<script>
	$(function () {
		startRefresh();
	});

	function startRefresh() {
		setTimeout(startRefresh, 10000);
		var turl = 'https://btc-e.com/api/2/ppc_usd/ticker';
		var murl = 'http://coinmarketcap.northpole.ro/api/usd/ppc.json';
		$.getJSON('http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20json%20where%20url%3D%22' + encodeURIComponent(turl) + '%22&format=json', function (data) {
			jQuery('#ticker').html('$');
			jQuery('#ticker').append(data['query'].results.ticker.last);
			jQuery('#ticker').append(' PPC/USD');
		});
		$.getJSON('http://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20json%20where%20url%3D%22' + encodeURIComponent(murl) + '%22&format=json&callback=?', function(data) {
			jQuery('#marketcap').html('$');
			jQuery('#marketcap').append(data.query.results.json.marketCap);
			jQuery('#marketcap').append(' USD');
		});
	}
</script>