$(document).ready(main);

var contador=1;

function main(){
	$('.menu_bar').click(function(){
		//$('nav').toggle();

		if(contador==1){
			$('#menu').animate({
				left: '0'
			});
			contador=0;
		}else{
			contador=1;
			$('#menu').animate({
				left: '-100%'
			});
		}

	});

 //Muestra y oculta submenú
 $('.submenu').click(function(){
 	$(this).children('.children').slideToggle();
 });
}
