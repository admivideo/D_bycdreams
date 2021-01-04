(function ($) {
  'use strict';

  $(function () {

     var isMobile = !!navigator.userAgent.match(/Android|iPhone|BlackBerry|IEMobile|Opera Mini/i);

     if(wactShowDevices == 'only-mobile' && isMobile) {
      showIcon();
     }

     if(wactShowDevices == 'only-desktop' && !isMobile) {
      showIcon();
     }

     if(wactShowDevices == 'all-devices') {
       showIcon();
     }

      function showIcon () {
        setTimeout(function(){
          $('.wact-icon').show();
          if(wactIconAnimation != 'none') {
            $('.wact-icon').addClass(wactIconAnimation);
          }
        }, wactShowDelay)
      }

      $(".wact-icon").click(function() {
        if(wactShowChat == 'yes') {
          openChatWindow();
        } else {
          openWhatsApp();
        }
      });


      $("#wact-input-chat").on("change keyup paste", function() {
        var val =  $(this).val();
        if(val.length == 0) {
          $("#wact-input-chat").val(' ');
        }
      });

      function openChatWindow() {

        if($(window).width() < wactWidth) {
          $('#wact-chat-window').css({'left':5, 'right':5});
        }

        if(wactWelcomeMessage.length == 0) {
          $('#wact-bubble').hide();
        }
        $('#wact-chat-window').fadeIn(200);
         SetCaretAtEnd(document.getElementById("wact-input-chat"))
      }

      $("#wact-chat-close").click(function() {
         $('#wact-chat-window').fadeOut(200);
      });

      $("#wact-input-send").click(function() {
         openWhatsApp();
      });

      function SetCaretAtEnd(elem) {
        var elemLen = elem.value.length;
        if (document.selection) {
            elem.focus();
            var oSel = document.selection.createRange();
            oSel.moveStart('character', -elemLen);
            oSel.moveStart('character', elemLen);
            oSel.moveEnd('character', 0);
            oSel.select();
        }
        else if (elem.selectionStart || elem.selectionStart == '0') {
            elem.selectionStart = elemLen;
            elem.selectionEnd = elemLen;
            elem.focus();
        }
    }


      function openWhatsApp() {
        var message = wactShowChat == 'yes' ? $('#wact-input-chat').val() : wactPredefinedText;

        if(message.charAt(0) == " ") {
          message = message.substr(1);
        }
        var link = wactChatUrl + encodeURIComponent(message);
        analyticsEvent(link);
        window.open(link);
      }

       function analyticsEvent(link) {
        try{
          if (typeof dataLayer == 'object') {
            dataLayer.push({
              'event': 'EasyWhatsAppContact',
              'eventAction': 'click',
              'eventLabel': link
            });
          }
          if (typeof gtag == 'function') {
            gtag('event', 'click', {
              'event_category': 'EasyWhatsAppContact',
              'event_label': link,
              'transport_type': 'beacon'
            });
          } else if (typeof ga == 'function') {
            ga('set', 'transport', 'beacon');
            var trackers = ga.getAll();
            trackers.forEach(function (tracker) {
              tracker.send("event", 'EasyWhatsAppContact', 'click', link);
            });
          }
        }catch(error) {
          console.log(error);
        }
      }


      $("#wact-input-chat").autoGrow({
        extraLine: false
      });

  });
})(jQuery);
;jQuery.fn.autoGrow=function(a){return this.each(function(){var d=jQuery.extend({extraLine:true},a);var e=function(g){jQuery(g).after('<div class="autogrow-textarea-mirror"></div>');return jQuery(g).next(".autogrow-textarea-mirror")[0]};var b=function(g){f.innerHTML=String(g.value).replace(/&/g,"&amp;").replace(/"/g,"&quot;").replace(/'/g,"&#39;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\n/g,"<br />")+(d.extraLine?".<br/>.":"");if(jQuery(g).height()!=jQuery(f).height()){jQuery(g).height(jQuery(f).height())}};var c=function(){b(this)};var f=e(this);f.style.display="none";f.style.wordWrap="break-word";f.style.whiteSpace="pre-wrap";f.style.padding=jQuery(this).css("paddingTop")+" "+jQuery(this).css("paddingRight")+" "+jQuery(this).css("paddingBottom")+" "+jQuery(this).css("paddingLeft");f.style.borderStyle=jQuery(this).css("borderTopStyle")+" "+jQuery(this).css("borderRightStyle")+" "+jQuery(this).css("borderBottomStyle")+" "+jQuery(this).css("borderLeftStyle");f.style.borderWidth=jQuery(this).css("borderTopWidth")+" "+jQuery(this).css("borderRightWidth")+" "+jQuery(this).css("borderBottomWidth")+" "+jQuery(this).css("borderLeftWidth");f.style.width=jQuery(this).css("width");f.style.fontFamily=jQuery(this).css("font-family");f.style.fontSize=jQuery(this).css("font-size");f.style.lineHeight=jQuery(this).css("line-height");f.style.letterSpacing=jQuery(this).css("letter-spacing");this.style.overflow="hidden";this.style.minHeight=this.rows+"em";this.onkeyup=c;this.onfocus=c;b(this)})};