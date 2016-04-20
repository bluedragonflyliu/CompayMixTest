<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>page</title>
	<style>
		.paginationjs-pages {

		}
		.pagination a {
		    text-decoration: none;
			border: 1px solid #AAE;
			color: #15B;
		}

		.pagination a, .pagination span {
		    display: inline-block;
		    padding: 0.1em 0.4em;
		    margin-right: 5px;
			margin-bottom: 5px;
		}

		.pagination .current {
		    background: #26B;
		    color: #fff;
			border: 1px solid #AAE;
		}

		.pagination .current.prev, .pagination .current.next{
			color:#999;
			border-color:#999;
			background:#fff;
		}
	</style>
</head>
<body>
	<div id='page1' class='pagination'></div>
	<div id='page2' class='pagination'></div>
	<script type="text/javascript" src="./jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="./pagination.min.js"></script>
	<script type="text/javascript">
		$('#page1').pagination({
			dataSource: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    		pageSize: 5,
    		showGoInput: true,
    		showGoButton: true,
    		showPrevious: true,
    		showNext: true,
		    	callback: function(data, pagination){
		    
    		},
		   
		});
		$('#page2').pagination({
			dataSource: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
    		pageSize: 4,

    		callback: function(data, pagination){
	       		
	    		}
		   
		});
	</script>
	<s
</body>
</html>