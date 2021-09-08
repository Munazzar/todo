$(document).ready(function(){
	var $block = $( ".show" );
	$("button[id='add_new']").click(function(){
		$("#new").stop().slideToggle( 500 );
		
});

$("button[class='cancel-bt']").click(function(){
		$("#new").stop().slideToggle( 500 );
});

$("button[class='ct']").click(function(){
		var t_title=$("#t-title").val();
		var t_desc=$("#t-desc").val();
		var t_dt=$("#t-dt").val();
		if(t_title=='')
		{
			alert("enter valid title");
			$("#t-title").focus();
		}
		else if(t_dt==''){
			alert("enter valid Date");
			$("#t-dt").focus();
		}
		else
		{
			$.ajax({
			  url: "insert_task.php?title="+t_title+"&desc="+t_desc+"&date="+t_dt,
			  method:"POST",
			  context: document.body
			}).done(function(data) {
			  location.reload();
			});
			
		}
		
		
});

$("button[name='completed']").click(function()
{

var id=$(this).val();
$.ajax({
			  url: "mark_completed.php?taskid="+id,
			  method:"POST",
			  context: document.body
			}).done(function(data) {
				
			  location.reload();
			});
			
});



$("button[name='delete']").click(function()
{

var id=$(this).val();
$.ajax({
			  url: "delete_tasks.php?taskid="+id,
			  method:"POST",
			  context: document.body
			}).done(function(data) {
				//alert(data);
			  location.reload();
			});
			
});

});

function update(id){
	var value=document.getElementById(id).value;
	var arr=id.split("-");
		var taskid=arr[0];
		var col=arr[1];
	$.ajax({
			  url: "update_tasks.php?taskid="+taskid+"&col="+col+'&val='+value,
			  method:"POST",
			  context: document.body
			}).done(function(data) {
				//alert(data);
			  
			});
			
	
}
function update_user(id){
	var value=document.getElementById(id).value;
	var arr=id.split("-");
		var userid=arr[0];
		var col=arr[1];
	$.ajax({
			  url: "update_user.php?userid="+userid+"&col="+col+'&val='+value,
			  method:"POST",
			  context: document.body
			}).done(function(data) {
				//alert(data);
			  
			});
			
	
}