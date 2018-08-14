<html>
   <head>
   	<script src="../js/jquery.min.js"></script>
   </head>

   <body>
	   <script type="text/javascript">
	  		function initInfo(argument) {
	   			$.get("../Utils/GetServerInfo.php?method=GetServerIP",{},function(resp){ 
	              alert(resp);
	        	});
	        	alert(1);   
	        }
	   		$(window).load(initInfo());
	   </script>
   </body>

</html>
