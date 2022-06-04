/* eslint-disable */
Drupal.behaviors.libCarrousel = {
    attach(context) {
  
      var carrouselitem = document.querySelectorAll('.lib-comp-carrousel__item');
      var carrouselnav = document.querySelectorAll('.lib-comp-carrousel__circle');

      for (let i = 0; i < carrouselnav.length; i++) {
        carrouselnav[i].addEventListener("click", function(event) {
          event.preventDefault();
          for (let q = 0; q < carrouselitem.length; q++) {
            const element = carrouselitem[q];
            if ( element.classList.contains('is-active')) {
              element.classList.remove('is-active');
            }
          }
          carrouselitem[i].classList.add('is-active');
        });
      };
    },
  };
  