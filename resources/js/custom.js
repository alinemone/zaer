
try {

    window.$ = window.jQuery = require('jquery');

} catch (e) {}


$('.show_confirm').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `آیا مطمئن هستید از حذف این آیتم ؟`,
        text: "ممکن است بعد از حذف دیگر امکان بازگشت نباشد.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});


  let namefamily
  let national_code
  let jaygah

  window.showInfo =  function (reception){
      namefamily = reception['people']['name_family']
      national_code = reception['people']['national_code']
      let place = reception['place']['id']
      let room = reception['room']['id']
      let bed = reception['bed']['id']

      if (place < 10){
          place = '0'+place
      }

      if (room < 10){
          room = '0'+room
      }
      if (bed < 10){
          bed = '0'+bed
      }

      jaygah = place + room + bed

    }


$('.confirm_release').click(function(event) {
    var form =  $(this).closest("form");
    var name = $(this).data("name");
    event.preventDefault();
    swal({
        title: `آیا از ترخیص مطمئن هستید ؟`,
        text: "نام و نام خانوادگی : "+ namefamily +"\n  کد ملی : "+ national_code +"\n  جایگاه : "+ jaygah  ,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                form.submit();
            }
        });
});


getcitis = function(sel) {

    if (!sel) {
        $('#city').find('option').remove();
    }else{
        axios.get('/province/'+sel+'/cities')
            .then(res => {
                const cities = res.data
                $('#city').find('option').remove();
                for (const [key, value] of Object.entries(cities)) {
                    $('#city').append(`<option  value="${value}">${key}</option>`);
                }
            })
            .catch(err => console.log(err));
    }
}



disableProvinceCity = function(sel){
    var province = document.getElementById('province')
    var city = document.getElementById('city')
    if (sel == 2){
        province.disabled = true
        city.disabled = true
    }else{
        province.disabled = false
        city.disabled = false
    }
}
jalaliDatepicker.startWatch()

getRooms = function (sel) {

    if (!sel.value) {
        $('#room').find('option').remove();
        $('#bed').find('option').remove();
    }else {

        axios.get('/admin/place/' + sel.value + '/rooms')
            .then(res => {
                const rooms = res.data
                $('#room').find('option').remove();
                for (var key of rooms) {
                    $('#room').append(`<option value="${key['id']}">${key['title'] + ' - طبقه ' + key['floor']}</option>`);
                }
                getallBeds({'value': document.getElementById('room').value})
            })
            .catch(err => console.log(err));
    }
}

getallBeds = function (sel) {



    axios.get('/admin/place/room/' + sel.value + '/allbeds')
        .then(res => {
            const beds = res.data
            $('#bed').find('option').remove();
            for (var key of beds) {
                $('#bed').append(`<option value="${key['id']}" >${key['bed_number']}</option>`);
            }
        })
        .catch(err => console.log(err));
}


function setValue() {

}

window.onload = setValue();
