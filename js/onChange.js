function changesOnchange(){
		$("ul#menu").children('li').on('click',function(){

		var menuNo=$(this).data('no');
		if(menuNo){
			var curr=$("section#currTable");
			curr.slideUp(0).attr('id','');
			if(menuNo!="1"){
				var table="section."+menuNo+"CS";
				document.forms[1].CST.value="CS";
				document.forms[1].value="CS";
				document.forms[1].search[1].value=menuNo+document.forms[1].CST.value+"-";
			}else{
				var table="section."+menuNo+"CST";
				document.forms[1].CST.value="CST";
				document.forms[1].search[1].value=menuNo+document.forms[1].CST.value+"-";
			}
			
			
			$(table).slideDown(700).attr('id','currTable');

		}
		
	});
	$('input.CST').on('change',function(){
		var curr=$("section#currTable");
		curr.slideUp(0).attr('id','');
		var menuNo=$("li.clicked").data('no');
		var subject=$(this).val();		
		var table="section."+menuNo+subject;
		$(table).slideDown(700).attr('id','currTable');
		
	});

	$('input.search').on('keyup',function(){
		if($(this).val().length>3){

			$("section#currTable").slideUp(200);
			$.post('programming/action/searchProcess.php',$(this).serialize(),function(data){
			document.getElementById('searchTable').innerHTML=data;
			$("section#searchTable").slideDown(500);
			var text=$("section#searchTable .table .header span").text();
			if($.trim(text)==""){
			$("section#searchTable .table .header").html("<span id='error'>...Can't Find Data On Database...</span>");
			}

			
		});

		}
		

	});

	$('input.search').on('blur',function(e){
		e.preventDefault();
		$("section#searchTable").slideUp(0);
		$("section#currTable").slideDown(500);

	});
	$('input#backBtn').on('click',function(e){
		e.preventDefault();
		$("section#searchTable").slideUp(0);
		$("section#currTable").slideDown(500);


	});

	$('form#searchForm').on('submit',function(e){
		e.preventDefault();
		$("section#currTable").slideUp(200);
			$.post('programming/action/goProcess.php',$(this).serialize(),function(data){
			document.getElementById('searchTable').innerHTML=data;
			$("section#searchTable").slideDown(500);
			var text=$("section#searchTable .table .header span").text();
			if($.trim(text)==""){
			$("section#searchTable .table .header").html("<span>...Can't Find Data On Database...</span>");
			}

			
		});

	});
	


}
changesOnchange();
$('form#firstForm').on('change',function(){
		$.post('programming/action/changeProcess.php',$(this).serialize(),function(data){
			var dataArr=data.split("MOHANWaglu");
			var data=data+"<label class='error'> No data availiable... </label>";
			document.getElementById('tables').innerHTML="";
			document.getElementById('tables').innerHTML=dataArr[0];
			document.getElementById('menu').innerHTML=dataArr[1];			
			changesPage();	
			changesOnchange();		
		});

	});