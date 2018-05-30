          $(function(){
            $("input[name='panjang_ruang'],input[name='lebar_ruang']").ionRangeSlider({
              min: 3,
              max: 20,
              type: 'single',
              step: 0.5,
              postfix: " meter"
            });
            $("input[name='jumlah_pintu'],input[name='jumlah_kunci_pintu']").ionRangeSlider({
              min: 0,
              max: 5,
              type: 'single',
              step: 1,
              postfix: " buah"
            });
            $("input[name='jumlah_jendela'],input[name='jumlah_kunci_jendela']").ionRangeSlider({
              min: 0,
              max: 40,
              type: 'single',
              step: 1,
              postfix: " buah"
            });
            $("input[name='jumlah_kursi']").ionRangeSlider({
              min: 20,
              max: 80,
              type: 'single',
              step: 1,
              postfix: " buah"
            });
            $("input[name='pencahayaan']").ionRangeSlider({
              min: 20,
              max: 400,
              type: 'single',
              step: 1,
              postfix: " lux"
            });
            $("input[name='kelembapan']").ionRangeSlider({
              min: 10,
              max: 100,
              type: 'single',
              step: 1,
              postfix: " %"
            });
            $("input[name='suhu_udara']").ionRangeSlider({
              min: 20,
              max: 40,
              type: 'single',
              step: 0.5,
              postfix: " °"
            });
          });