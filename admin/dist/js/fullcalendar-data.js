/*FullCalendar Init*/
$(document).ready(function() {
	'use strict';


    var date = new Date();
    var day = date.getDate();
    var month = date.getMonth();
    var year = date.getFullYear();
	$('#calendar').fullCalendar({
	themeSystem: 'bootstrap4',
	  customButtons: {
		calendarSidebar: {
			text: 'icon',
		}
	},
	header: {
	left: 'calendarSidebar ,today',
	center: 'prev,title,next',
	right: 'month,agendaWeek,agendaDay,listMonth'
	},
	droppable: true,	
	editable: true,
	height: 'parent',
	eventLimit: true, // allow "more" link when too many events
	windowResizeDelay:500,
	events:'load.php',
		
	});
	setTimeout(function(){
		$('.fc-left .fc-calendarSidebar-button').attr("id","calendarapp_sidebar_move").html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>');
		$('.fc-left .fc-today-button').removeClass('btn-primary').addClass('btn-outline-secondary btn-sm');
		$('.fc-center .btn').removeClass('btn-primary').addClass('btn-outline-light btn-sm');
		$('.fc-right .btn-group').addClass('btn-group-sm');
		$('.fc-right .btn').removeClass('btn-primary').addClass('btn-outline-secondary');
	},100);
});
