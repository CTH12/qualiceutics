/*!
 * qualiceutics v0.1.0 (http://archercom.com/)
 * Copyright 2014-2016 Archer Communications [luis rosario //zapo]
 * Licensed under MIT (https://github.com/archercom/arrowhead/blob/master/LICENSE)
 */

(function ($, window, document, undefined) {

  'use strict';



  window.Qual = {



    tag: 'Qualiceutics',

    settings: {},

    modules: {},



    utils: {

      /**
       * check if the Drupal object exists
       * @return {boolean}
       */
      drupal_test: function () {
        var drupal_land = false;
        // recon to see if we're in Drupal-land
        if (typeof Drupal !== 'undefined') {
          drupal_land = true;
        }

        return drupal_land;
      },








      /**
       * smooth scroll to a section of the page
       * @return {N/A}
       */
      smooth_scroll: function () {
        // smooth scroll - original source below
        // http://www.learningjquery.com/2007/10/improved-animated-scrolling-script-for-same-page-links
        $('a[data-smooth-scroll]').on('click.smooth_scroll', function() {
          if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
              $('html,body').animate({
                scrollTop: target.offset().top
              }, 1000);

              return false;
            }
          }
        });
      },

      /**
       * copy text to clipboard
       * clipboard.js
       */
      clipboard: function () {
        var clipboards = new Clipboard('[data-clipboard]');

        clipboards.on('success', function(e) {
            e.clearSelection();

            // console.info('Action:', e.action);
            console.info('Text:', e.text);
            // console.info('Trigger:', e.trigger);
        });

        clipboards.on('error', function(e) {
            console.error('Action:', e.action);
            console.error('Trigger:', e.trigger);
        });
      },

      /**
       * Easter egg
       * @return {N/A}
       */
      konami: function () {

        // file urls
        var mp3s = [
          '/misc/internet.mp3',
          '/misc/mario.mp3',
          '/misc/seinfeld.mp3'
        ];
        // file paths are different for Drupal, sites/all/themes/

        if (Qual.utils.drupal_test()) {

          for (var i = 0; i < mp3s.length; i++) {
            mp3s[i] = Drupal.settings.basePath + Drupal.settings.themePath + mp3s[i];
          }
        }


        // load Howler
        if (Qual.sound === undefined) {
          Qual.sound = new Howl({
            urls: [mp3s[Math.floor(Math.random() * 3)]]
          }).play();
        } else {
          // play new sound. stop other one
          Qual.sound.unload();
          Qual.sound = new Howl({
            urls: [mp3s[Math.floor(Math.random() * 3)]]
          }).play();
        }


      }
    },



    init: function() {

      if (console !== undefined) console.log(this.tag);

      // add smooth scroll
      this.utils.smooth_scroll();

      // add clipboard functionality
      this.utils.clipboard();

      // initialize all modules
      for (var module in this.modules) {
        this.modules[module].init();
      }

      // konami /* play sound effect */
      var easter_egg = new Konami(this.utils.konami);


      // contact form setup
      // ----------------------------------------
      var $contactForm = $('#contact');
      $contactForm.on('submit', function (event) {
        event.preventDefault();
        // the actual submission
        $.ajax({
          url: 'process.php',
          type: 'post',
          data: $contactForm.serialize(),
          success: function () {
            $contactForm.find('input[type=text], textarea').val('');
            alert('Thank you! We\'ll get in touch soon');
          },
          error: function () {
            alert('Sorry, looks like something went wrong');
          }
        });
      });

      // change html text when clicked
      $('#exp').click(function() {
          if ($(this).html() === 'Read More') {
              $(this).html('Close');
              $(this).addClass('close-exp');
          } else {
              $(this).html('Read More');
              $(this).removeClass('close-exp');
          }

      });

      // have active accordion panel scroll to the top of view
      $('.accordion li > a').click(function() {
            var self = this;
            setTimeout(function () {
            var theOffset = $(self).offset();
            $('body,html').animate({ scrollTop: theOffset.top - 10 });
            }, 500);

      });
      // var orbit = new Foundation.Orbit($('#orbit-1'), {
      //       timerDelay: 7500

      //  });



    }




  };



  // initialize the things
  $(document).ready(function () {

    $(document).foundation();



    Qual.init();
  });

}($ || jQuery, window, window.document));

//# sourceMappingURL=main.js.map