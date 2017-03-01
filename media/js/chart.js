$('document').ready(function() {
	document.getElementById("export").onclick
		function export_table() {
			var today=new Date();
			var dd=today.getDate();
			var mm=today.getMonth();
			var yyyy=today.getFullYear();
			$(function() {
				$(".table2excel").table2excel({
					exclude: ".noExl",
					name: "Excel Document Name",
					filename: "inventory_report "+dd+"-"+mm+"-"+yyyy,
					fileext: ".xls"
				});
			});
			modal.style.display = "none";
			}


							// Get the modal
							var modal = document.getElementById('myModal');

							// Get the button that opens the modal
							var btn = document.getElementById("myBtn");

							// Get the <span> element that closes the modal
							var span = document.getElementsByClassName("close")[0];



							//When the page onload, open the modal
							window.onload=function(){

								modal.style.display = "block";
								
								
							}


							// When the user clicks on <span> (x), close the modal
							span.onclick = function() {
							    modal.style.display = "none";
							}

							// When the user clicks anywhere outside of the modal, close it
							window.onclick = function(event) {
							    if (event.target == modal) {
							        modal.style.display = "none";
							    }
							}





							document.getElementById("close").onclick
							function close_modal() {
							    modal.style.display = "none";
							}


});