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

function handleClick(myRadio, myPengisian, myTanggal) {
  //  alert(myPengisian);
  
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
  });
  var optionID = myRadio.value;
  var pengisianID = myPengisian;
  var tanggalID = myTanggal;
  var s = {
    "option_id":optionID,
    "pengisian_id":pengisianID,
    "tanggal_id":tanggalID
  }
  $.ajax({
        url: "/aplikasi_sditharumjember/gethasilpenilaian",
        type: "POST",
        data: s,
        success: function (data) {
            console.log(data);
        },
    });
}
