$('document').ready(function() {
	// Search
	//start modified
	/*$('form[name=searchf]').submit(function(evt) {
		evt.preventDefault();*/
	/*	$('.loader').fadeIn(200);*/
	/*	var itemname = document.getElementById('item-name');
		var Iname = itemname.options[itemname.selectedIndex].value;
		
		var username = document.getElementById('user-name');
		var Uname = username.options[username.selectedIndex].value;
		
		var date = $(this).children('input[name=demo]').val();*/
		
		//var itemid = urlGet()['itemid'];
//		var userid = urlGet()['userid'];
//		var catid = urlGet()['catid'];
//		
//		if(itemid == undefined)
//			itemid = 'no';
//		if(userid == undefined)
//			userid = 'no';
//		if(catid == undefined)
//			catid = 'no';
		
		/*if((Iname == '')&&(Uname == '')&&(date == '')) {
			/*$('.loader').fadeOut(200);*/
		/*	alert('Please write your search');
			return false;
		}
		
		$.post('logs.php', {
			'Iname':Iname,
			'Uname':Uname,
			'date':date		
		}, function(data) {
			if(data == '3') {*/
				/*$('.loader').fadeOut(200);*/
			/*	location.href = 'logs.php?item-name='+encodeURIComponent(Iname)+'user-name='+encodeURIComponent(Uname)+'date='+encodeURIComponent(date);
				return false;*/
		/*	}
			if(data == '2') {
				/*$('.loader').fadeOut(200);*/
			/*	alert('No items matched your search');
				return false;
			}*/
			
			/*$('.loader').fadeOut(200);*/
			/*alert('Something went wrong. Please try again');*/
			/*return false;*/
	/*	});
	});*/
	//end modified
	
	$('tr[data-type=element] td[data-type=id], tr[data-type=element] td[data-type=type], tr[data-type=element] td[data-type=name]')
	.click(function() {
		var item = $(this).parent().data('id');
		location.href = 'log.php?id='+item;
	});
	// Previous Page
	//$('#pagination .prev').click(function() { go('prev', $(this).attr('name')); });
//	
//	// Next page
//	$('#pagination .next').click(function() { go('next', $(this).attr('name')); });
//	
//	// Show per page
//	$('select[name=show-per-page]').on('change', function() { go('show-per-page', this.value); });
	
	// Handler of pagination and show per page
//	function go(act, val) {
//		var search = urlGet()['search'];
//		if(act == 'prev' || act == 'next') {
//			var p = val;
//			var pp = urlGet()['pp'];
//			var url = 'page='+p;
//
//			if(pp != undefined) url = url+'&pp='+pp;
//		}else if(act == 'show-per-page') {
//			var pp = val;
//			var page = urlGet()['page'];
//			var url = 'pp='+pp;
//			
//			if(page != undefined) url = url+'&page='+page;
//		}
//		
//		if(search != undefined) url = url+'&search='+search;
//		
//		var itemid = urlGet()['itemid'];
//		if(itemid != undefined) url = url+'&itemid='+itemid;
//		
//		var userid = urlGet()['userid'];
//		if(userid != undefined) url = url+'&userid='+userid;
//		
//		var catid = urlGet()['catid'];
//		if(catid != undefined) url = url+'&catid='+userid;
//		
//		location.href = 'logs.php?'+url;
//	}
	
	
	// Get url GET params
	//function urlGet() {
//		var vars = {};
//		var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
//			vars[key] = value;
//		});
//		return vars;
//	}
});