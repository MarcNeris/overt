














// firebase.auth().onAuthStateChanged(user => {

//     if (user) {


     



//         const UID = firebase.database().ref();

//         UID.on('value', function(uid) {

//             userData = uid.val();

//            // console.log(userData);

//             $("#ponto").empty();

//             $.each(userData, function(uid, cnpj){

//                 const REP = firebase.database().ref(uid).child('10804639000183');

//                 UID.child('users').child(uid).child('10804639000183').child('01240025602').child('2018-06-27').on('value' , function(data) {
//                         ponto = data.val()
//                     //console.log(ponto);
//                 });

                

//                 REP.on('value', function(rep) {

//                     repData = rep.val();             

//                     $.each( repData, function(cpf, anoDia){

//                         $.each( anoDia, function(anoDia, Marcacao){
                            
//                             var REPStatus = '<tr><td>${diaHora}</td><td>${DBTime}</td><td>${network}</td><td>${cpf}</td><td>${device}</td></tr>';

//                             $.each( Marcacao, function(dia, ponto){
                                
//                                 ponto.cpf=cpf

//                                 ponto.DBTime = moment(ponto.dbTimestamp).format("DD/MM/YYYY HH:mm:ss");

//                                 saveSQL(ponto);
                                
//                                 $.tmpl( REPStatus, ponto ).appendTo( "#ponto" );
//                             })
//                         });
//                     });
//                 });
//             });
//         });
//     } 

//     else {

//     }
// });

// function saveSQL(ponto){
//     //console.log(ponto);

//      $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });

//     $.ajax({
//         //type: 'POST',
//         type: 'GET',
//         url:'upd_repusers',
//         data: ponto,
//         contentType: "json",
//         processData: false,
//         success: function(data) {

//             //console.log(data);
//         }
//     });
// }




// function get_barra(){
//     $.ajax({
//         url: "{{url('bam/get_barra')}}"+"{{ $bamprd000['CodBam'] or '' }}",
//         dataType : 'json',
//         success: function(get_barra){
            
//             bamprd000BarraData.series.data = [];
//             bamprd000BarraData.xAxis.data = [];

//             $.each( get_barra, function(k, v){
//                 bamprd000BarraData.series[0].data[k] = parseFloat(v.VlrBar);
//                 bamprd000BarraData.xAxis[0].data[k] = v.HraMov;
//             });
                    
//             bamprd000Barra.setOption(bamprd000BarraData, true);
//         }
//     });
// }











// function upd_users0001(idRegRol) {
//     id = '{{$idUsers0001}}';
    
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });


//     $.ajax({
//         url: "{{url('reg/upd_users0001/')}}/"+id+"/"+idRegRol,
//         type: 'GET',
//         success: function(data) {
//           showNotification( 'Perfil Atualizado!', 'info');
//         }
//     });
//   }