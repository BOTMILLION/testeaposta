document.addEventListener('DOMContentLoaded', function() {

 var splide_home = document.querySelectorAll('.splide_home');
 if(splide_home.length){
     for(var i=0; i<splide_home.length; i++){
         var splideElement = splide_home[i];
         var splideDefaultOptions = 
         {
           rewind: false,
           gap: '0.5rem',
           padding: 0,
           pagination: false,
           perPage: 10,
           perMove: 1,
           arrows: false,
           breakpoints: {
             1920: {
               perPage: 8,
             }, 
             1700: {
               perPage: 7,
             },
             1500: {
               perPage: 6,
             },
             1200: {
               perPage: 5,
             },
             767: {
               perPage: 4,
             },
             567: {
               perPage: 3,
             },
       
           },
         }         
         var splide_home_new = new Splide( splideElement, splideDefaultOptions ); 
         splide_home_new.mount();
     }
 }

 // RECOMENDADOS
 if(document.getElementsByClassName('premium_home').length){

  var premium_home = new Splide( '.premium_home',{
    rewind: false,
    gap: '0.5rem',
    padding: 0,
    pagination: false,
    perPage: 4,
    perMove: 1,
    arrows: false,
    breakpoints: {
      1400: { 
        perPage: 3,
      },
      991: { 
        perPage: 2,
      },
      767: { 
        perPage: 1,
      }
      

    },
  });
  premium_home.mount();
}    

});














