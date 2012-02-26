$(document).ready(function() {
    $('div.About').find('h4').css({'cursor':'pointer'});
    
    $('div.About').click(function() {
	$(document).url('/profile/aboutme/');
    });
})

