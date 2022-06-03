(function(){
	$('select#year').on('click',function(){
		$('div.delMsg').text("Are You Sure! Want To Delete Result");
	});	
	$('input#submit').on('click',function(){
		var second=300;		
		var dot=1;
		window.setInterval(function(){
			var process="";
			var minute= Math.floor(second / 60 );
			var sec=second % 60 ;		
			for ( i = 1; i<= dot ; i++) {
				process+= " . ".bold();
			}			
			$('div.createMsg').html("Processing Data ... It can take "+minute +" : "+sec+" minutes or more "+process);
			second--;
			dot++;
			if(dot > 4){

				dot = 1;
			}
				

		},1000);

		
	});

})();