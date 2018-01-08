(function ($) {

  'use strict';

  $(function () {


    $('body').on('click','a.decade-sort', function(e){
      e.preventDefault();
      var sort_order = 'moot';
      if($(this).hasClass('desc')){
        sort_order = 'moot';
        $(this).removeClass('desc');
      } else if($(this).hasClass('asc')) {
        sort_order = 'desc'
        $(this).addClass('desc');
        $(this).removeClass('asc');
      } else {
        sort_order = 'asc';
        $(this).addClass('asc');
      }

      $(this).closest('.sortable-header').nextAll('ul').first().each(function(i,el){
        decadeSort($(el), sort_order)
      })
    })

    function dec_line(dec) {
      if(dec != 'non-alumni') dec = dec.toString() +'<span class="smaller">s</span>';
      return $('<li class="decade-line">'+ dec +'</li>');
    }

    function decadeSort(ul, order) {
      ul.find('li.decade-line').remove();
      var items = ul.find('li');
      order = order == 'moot' ? 0 : (order == 'asc' ? 1 : -1);
      items.sort(function(a,b){
        var ad = $(a).attr('x-decade');
        var bd = $(b).attr('x-decade');
        var aa = $(a).attr('x-sort');
        var ba = $(b).attr('x-sort');

        if(ad == '' || typeof ad == 'undefined')
          ad = 'ZZZZZZZZZZZ';
        if(bd == '' || typeof bd == 'undefined')
          bd = 'ZZZZZZZZZZZ';

        if(order != 0) {
          if(ad > bd) return 1*order;
          if(ad < bd) return -1*order;
        }
        if(aa > ba) return 1;
        if(aa < ba) return -1;
        return 0;
      });

      if(order != 0) {
        var prev_dec = null;
        $.each(items, function(i, li) {
          var dec = $(li).attr('x-decade') || 'non-alumni';
          if(prev_dec != dec) {
            prev_dec = dec;
            ul.append(dec_line(dec));
          }
          ul.append(li);
        });
      } else {
        $.each(items, function(i, li) {
          if(prev_dec == null) prev_dec = li
          ul.append(li);
        });
      }
    }

    function addTags(i, el) {
      var tags = $(el).attr('x-tags').toString().split('|');
      if(tags.length) {
        for(var i = 0; i < tags.length; i++) {
          switch(tags[i]) {
            case 'deceased':
              $(el).addClass('deceased');
              $(el).attr('title', 'Deceased');
              break;
            case '5 to 9 years cumulative giving':
              $(el).addClass('giving-5-9');
              $(el).attr('title', '5 to 9 years cumulative giving');
              break;
            case '10 to 24 years cumulative giving':
              $(el).addClass('giving-10-24');
              $(el).attr('title', '10 to 24 years cumulative giving');
              break;
            case '25+ years cumulative giving':
              $(el).addClass('giving-25');
              $(el).attr('title', '25+ years cumulative giving');
              break;
          }
        }
      }
    }

    if($('#mobile-menu-link') && $('.donors-nav')) {
      $('#mobile-menu').html('<div class="donors-nav">' + $('.donors-nav').html() +'</div>');

      $('#mobile-menu-link').on('click', function(e){
        e.preventDefault();
        if($('#mobile-menu').hasClass('hidden')) {
          $('#mobile-menu').removeClass('hidden');
        } else {
          $('#mobile-menu').addClass('hidden');
        }
      })
    }

    $('li[x-tags]').each(addTags);

    
  });
})(jQuery);
