$(document).ready(function() {

    $(window).load(function (){

        $('#WindowPreloader').fadeOut('2000');
    });
        new fJs.Sticky({
            elt: '#static-header',
        });
        AOS.init({
            offset: 200,
            duration: 600,
            easing: 'ease-in-sine',
            delay: 100,
          });
        new fJs.Intersection({
            elt: '.fvSlideOn',
            class: "animate__animated animate__fadeInDown opacity-100",
            root: null,
            ratio: 0.2,
            rootMargin: '0px',
            threshold: 0.7,
        });

        new fJs.NumberAutoCount();
        new fJs.AutoWriteText({
            separator: '|',
            timeout: 300
        });
        
    
})
