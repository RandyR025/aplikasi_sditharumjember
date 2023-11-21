// $(document).ready(function() {
//     $(".option").on('change', function() {
//        var optionID = $(this).val();
//        $.ajaxSetup({
//         headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//             $.ajax({
//               url: '/gethasilpenilaian',
//               method: "POST",
//               data:{optionID: optionID},
//               dataType: "json",
//               contentType: false,
//               processData: false,
//                success:function(data)
//                {
//                   console.log(data);

//              }
//            });
//     });
//     });

function handleClick(myRadio, myPengisian, myUser, myTanggal) {
    //  alert(myPengisian);
    
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
    var optionID = myRadio.value;
    var pengisianID = myPengisian;
    var userID = myUser;
    var tanggalID = myTanggal;
    var s = {
      "option_id":optionID,
      "pengisian_id":pengisianID,
      "user_id":userID,
      "tanggal_id":tanggalID
    }
    $.ajax({
          url: "/aplikasi_sditharumjember/penilaiancek",
          type: "POST",
          data: s,
          success: function (data) {
              console.log(data);
          },
      });
  }

  function handleClickWali(myRadio, myPengisian, myUser, myTanggal) {
    //  alert(myPengisian);
    
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
    var optionID = myRadio.value;
    var pengisianID = myPengisian;
    var userID = myUser;
    var tanggalID = myTanggal;
    var s = {
      "option_id":optionID,
      "pengisian_id":pengisianID,
      "user_id":userID,
      "tanggal_id":tanggalID
    }
    $.ajax({
          url: "/aplikasi_sditharumjember/gethasilpenilaianwali",
          type: "POST",
          data: s,
          success: function (data) {
              console.log(data);
          },
      });
  }

  function handleClickKepalaSekolah(myRadio, myPengisian, myUser, myTanggal) {
    //  alert(myPengisian);
    
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
    var optionID = myRadio.value;
    var pengisianID = myPengisian;
    var userID = myUser;
    var tanggalID = myTanggal;
    var s = {
      "option_id":optionID,
      "pengisian_id":pengisianID,
      "user_id":userID,
      "tanggal_id":tanggalID
    }
    $.ajax({
          url: "/aplikasi_sditharumjember/gethasilpenilaiankepalasekolah",
          type: "POST",
          data: s,
          success: function (data) {
              console.log(data);
          },
      });
  }
  