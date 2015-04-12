$( document ).ready(function() {

// animation for selecting a seat
	occupied = "rgb(242, 85, 44)";

	$('.seats li').click(function(event) {
		/* Act on the event */
		if (!$(this).hasClass('assigned')) {
			$(this).addClass('assigned');
			$(this).css('background-color',occupied);

			$.$.post('/path/to/file', function(data) {
				$(this).attr('id');
			});

		}else{
			alert('This seat is already assigned');
		};
	});

	$('.seats li').hover(function() {
		/* Stuff to do when the mouse enters the element */
		available = true;
		bgcolor = $(this).css('background-color');
		if (bgcolor == occupied) {
			$(this).css({'background-color' : 'rgb(187, 18, 47)','cursor':'default'});
			available = false;
		}else{
			$(this).css('background-color','rgb(0, 158, 96)');
			available = true;
		};
	}, function() {
		/* Stuff to do when the mouse leaves the element */
		if (!$(this).hasClass('assigned')) {
			$(this).css('background-color',bgcolor);
		}else{
			$(this).css('background-color',occupied);
		};
	});
// end animation for selecting a seat

});