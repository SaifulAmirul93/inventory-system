$('document').ready(function() {
	$('form[name=new-ejuice]').submit(function(evt) {
		evt.preventDefault();
		
		var name = $('input[name=nejuice-name]').val();
		
		var desc = $('textarea[name=nejuice-descrp]').val();
		
		if(name == '') {
			alert('Please insert a Lineup name');
			return false;
		}
		
		$.post('new-ejuice.php', {
			'act':'1',
			'name':name,
			'desc':desc
		}, function(data) {
			
			
			if(data == '1') {
				alert('Lineup Series successfully created');
				location.href = 'new-ejuice.php';
			}else{
				alert(data);
				return false;
			}
		});
	});
	
	$('textarea[name=nejuice-descrp]').keyup(function(evt) {
		var count = $(this).val().length;
		var limit = 400;
		var val = $(this).val();
		var t = $(this);
		
		if(count > limit){
			t.val(val.substr(0,400));
			var dif = 0;
		}else
			var dif = limit-count;
		$('span.item-desc-left').html('Description ('+dif+' characters left)');
	});
});