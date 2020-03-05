$(document).ready(function(){

$('.f-btn').addClass('aDeActive');
 
$(function () {                                 // Когда страница загрузится
    $('.f-btn').each(function () {             // получаем все нужные нам ссылки
        var location = window.location.href;  // получаем адрес страницы
        var link = this.href;                // получаем адрес ссылки
        if(location == link) {				// при совпадении адреса ссылки и адреса окна
        	$('.f-btn').removeClass('f-active');               
            $(this).removeClass('aDeActive').addClass('f-active');  //добавляем класс
        }
    });
});

});