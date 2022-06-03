/* This file is link with index.php or index.view.php*/
/*Use to control forms informations to display*/


$("select.year").val("<?=$selectYear?>");
$("select.period").val("<?=$selectPeriod?>");
function changesPage(){
	var menu=$("ul#menu li");
	var menuListItems= menu.length;	
	var width=100/menuListItems+"%"; //if four item each will have 25% 
	menu.css('width',width);

	
	$("form#firstForm").on('change',function(e){
		e.preventDefault();
		var selectPeriod=$('select.period').val();
		var selectYear=$('select.year').val();	
		var text="";	
		if(selectPeriod!=""||selectYear!=""){
			text= selectYear+" Academic Year Exam Result ("+selectPeriod+")";

		}else{
			text="Exam Result Is not Still Availiable";
		}
		$('h2#examTitle').text(text);

	});	//end on change func ,tion
	var menuNo=1;
	var inputSearch=$('input.search');

	document.forms[1].CST.value="CST";
	inputSearch.val("1"+$('input.CST').val()+"-"); // document.forms[1].search.value="1CST-";	

	$('ul#menu li').on('click',function(e){
		e.preventDefault();
		menuNo=$(this).data('no');
		if(menuNo){ //if menu is availiable
			$(this).attr('class','clicked').siblings('li').attr('class','menuHover');
			var inputSearchStr=inputSearch.val();
			var no=inputSearchStr.substr(0,1);
			inputSearch.val(inputSearchStr.replace(no,menuNo));
			

		}
		
	});

	$('input.CST').on('change',function(e){
		e.preventDefault();
		if(menuNo){
			searchVal=menuNo+$(this).val()+"-";
			inputSearch.val(searchVal);

		}
		
		
	});

}	
changesPage();		

	
