var ft_list;

$(document).ready(function(){
	$('#new').click(newTodo);
	// $('#ft_list div').click(deleteTodo);
	ft_list = $('#ft_list');
	loadTodo();
});

function loadTodo(){
	ft_list.empty();
	$.ajax({
		url: 'select.php',
		method: 'GET',
		success : function(data){
			data = jQuery.parseJSON(data);
			jQuery.each(data, function(id, val) {
				ft_list.prepend($('<a href=""><div data-id="' + id + '">' + val + '</div></a>'));
			});
		}
	});
}

function newTodo(){
	var todo = prompt("Quel nom voulez-vous donner a votre partie ?");
	if (todo !== '') {
		ajx('insert.php?', "GET", 'todo=' + todo, loadTodo);
	}
}

function deleteTodo(){
	console.log($(this).data('id'));
	if (confirm("Do you really want to delete this one ?")){
		ajx('delete.php?', "GET", 'id=' + $(this).data('id'), loadTodo);
	}

}

function ajx(url, method, data, success) {
	$.ajax({
		url: url,
		method: method,
		data: data,
		success : success,
		error : function(){ alert("error ajax"); },
	});
}