$(document).ready(function(){ 
    $('input[placeholder], textarea[placeholder]').placeholder(); 
});

$(function($) {
    $("form").submit(function(){
        var first_name = $("form .first_name").val();
        var last_name  = $("form .last_name").val();
        var email      = $("form .email").val();
        var phone      = $("form .phone").val();
        var regexp = /^[а-яё]+$/i;

        if (first_name.length <= 3) {
            alert('Пожалуйста, введите Имя');
            return false;
        }
        
        if (last_name.length < 3) {
            alert('Пожалуйста, введите название Агенства');
            return false;
        }
        if (last_name.length > 20) {
            alert('Пожалуйста, введите ИАТА-номер');
            return false;
        }
               
        
        if (email.length <= 3) {
            alert('Пожалуйста, введите E-mail адрес');
            return false;
        }
        if (!(/^[\w\S]+@[\w\S]+.[\w]{2,}$/i).test(email)) {
            alert('Введите правильный E-Mail адрес');
            return false;
        }

        
        if (phone.length <= 3) {
            alert('Пожалуйста, введите телефон');
            return false;
        }
        if (!(/^[0-9-+)(\s]+$/i).test(phone)) {
            alert('Пожалуйста, введите телефон');
            return false;
        }

    });



})(jQuery);



