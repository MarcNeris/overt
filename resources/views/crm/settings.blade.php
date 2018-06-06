@extends('layouts.crmsidebar')

@section('title', 'CRM | Plano de Vôo')

@section('css')
@stop

@section('content')

<div class="container-fluid">
    <div class="col-md-12 mr-auto ml-auto">
        <!--      Wizard container        -->
        <div class="wizard-container">
            <div class="card wizard-card card-wizard" data-color="red" id="wizardProfile">

                <form method="POST" action="{{ route('reg.new_regemp000') }}">
                	{!! csrf_field() !!}
                	<div class="wizard-header">
                    	<h3 class="wizard-title">
                    	   Minhas Empresas
                    	</h3>
                	</div>
					<div class="wizard-navigation">
						<ul class="nav nav-pills">
                            <li class="nav-item">
                            	<a class="nav-link" href="#empresa" data-toggle="tab" role="tab">
                            	Empresa</a>
                            </li>
                            <li class="nav-item">
                            	<a class="nav-link" href="#account" data-toggle="tab" role="tab">
                            	Unidades</a>
                            </li>

                            <li class="nav-item">
                            	<a class="nav-link" href="#address" data-toggle="tab" role="tab">
                            	Endereço</a>
                            </li>
                            <li class="nav-item">
                            	<a class="nav-link" href="#settings" data-toggle="tab" role="tab">
                            	Configurações</a>
                            </li>
                        </ul>
                  	</div>
                    <div class="tab-content">
                        <div class="tab-pane" id="empresa">
                          	<div class="row">
			                  	
                            	<div class="col-md-2">
                              		<div class="form-group bmd-form-group is-filled">
					                    <label for="RegFed" class="bmd-label-floating">CNPJ/CPF</label>
					                    <input type="text" class="form-control valid" id="RegFed" name="RegFed" required="" aria-required="true" aria-invalid="false">
			                  		</div>
                            	</div>

                            	<div class="col-md-1">
				                    <div class="form-group bmd-form-group">
				                    	<div onclick="buscaCnpj()" type="null" class="btn btn-rose btn-round btn-just-icon">
				                      	<i class="material-icons">search</i>
				                      	<div class="ripple-container"></div>
				                      <div class="ripple-container"></div></div>
				                    </div>
			                  	</div>

                          		<div class="col-md-9">
                              		<div class="form-group bmd-form-group is-filled">
					                    <label for="NomEmp" class="bmd-label-floating">Nome Empresarial</label>
					                    <input type="text" class="form-control valid" id="NomEmp" name="NomEmp" required="" aria-required="true" aria-invalid="false">
			                  		</div>
			                  	</div>

			                  	<div class="col-md-2">
                              		<div class="form-group bmd-form-group is-filled">
					                    <label for="RegFed" class="bmd-label-floating">CNAE</label>
					                    <input type="text" class="form-control valid" id="CodAtv" name="CodAtv" required="" aria-required="true" aria-invalid="false">
			                  		</div>
                            	</div>

                            	<div class="col-md-8">
                              		<div class="form-group bmd-form-group is-filled">
					                    <label for="RegFed" class="bmd-label-floating">Atividade</label>
					                    <input type="text" class="form-control valid" id="RegFed" name="RegFed" required="" aria-required="true" aria-invalid="false">
			                  		</div>
                            	</div>

                            	<div class="col-md-2">
                              		<div class="form-group bmd-form-group is-filled">
					                    <label for="RegFed" class="bmd-label-floating">Data de Registro</label>
					                    <input type="text" class="form-control valid" id="DatReg" name="DatReg" required="" aria-required="true" aria-invalid="false">
			                  		</div>
                            	</div>
                        
                            	
                          	</div>
                          	<div class="row">
                          		<div class="col-md-12">
		                          	<div class="table-responsive">
				                    	<table id="uploads" class="table table-striped table-bordered  table-hover" cellspacing="1" width="100%">
				                        	<thead class="text-primary">
				                            	<tr>

				                            	</tr>
				                        	</thead>
				                    	</table>
				                    </div>
			                  	</div>
	                    	</div>
                        </div>
                        <div class="tab-pane" id="account">
                            <div class="row">

								<div class="col-md-3">
                              		<div class="form-group bmd-form-group is-filled has-success">
					                    <label for="xxx" class="bmd-label-floating">Teste</label>
					                    <input type="text" class="form-control valid" id="xxx" name="xxx" required="" aria-required="true" aria-invalid="false">
			                  		</div>
                            	</div>
                           
                            </div>



                            
                        </div>
                        <div class="tab-pane" id="address">
                            <div class="row">
                      			c
                            </div>
                        </div>
                        <div class="tab-pane" id="settings">
                            <div class="row">
                      			d
                            </div>
                        </div>
                    </div>
                    <div class="wizard-footer">
                        <div class="pull-right">
                            <input type='button' class='btn btn-next btn-fill btn-success btn-wd' name='next' value='Próximo' />
                            <button type="submit" class='btn btn-finish btn-fill btn-success btn-wd' name='finish' value='Enviar' >Enviar</button>
                        </div>

                        <div class="pull-left">
                            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Anterior' />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div> <!-- wizard container -->
    </div>
</div><!-- end row -->

					

@stop
@section('js')

<script type="text/javascript">

function buscaCnpj() {

var RegFed = document.getElementById('RegFed').value;

$.ajax({
      type: "GET",
      url: "../reg/get_cnpj/"+RegFed,
      dataType : 'json',
      success: function(data){

      $("#NomPsa").val(data.nome);
      $("#NomFta").val(data.fantasia);
      $("#TipReg").val(data.tipo);
      $("#DatReg").val(data.abertura);
      $("#CapEmp").val(data.capital_social);
      $("#NatJur").val(data.natureza_juridica);
      $("#hSitReg").val(data.situacao);
      $("#AtvEmp").val(data.atividade_principal[0]['text']);
      $("#CodAtv").val(data.atividade_principal[0]['code']);
      $("#CepEnd").val(data.cep);
      $("#NomEnd").val(data.logradouro);
      $("#NumEnd").val(data.numero);
      $("#CplEnd").val(data.complemento);
      $("#BroEnd").val(data.bairro);
      $("#NomMun").val(data.municipio);
      $("#NomUfe").val(data.uf);
      $("#NumTel").val(data.telefone);
      $("#NomUff").val('BRASIL');

      var AtvSec =[];
      $.each(data.atividades_secundarias, function( index, value ) {
        AtvSec[index] = "['"+ value['code']+"':'"+value['text']+"']";
      });

      $("#AtvSec").val(AtvSec);

      var QsaEmp=[];
    
      $.each(data.qsa, function( index, value ) {
        QsaEmp[index] = '{"nome":"'+value["nome"]+'", "qual":"'+value["qual"]+'"}';
      });



      $("#QsaEmp").val('['+QsaEmp+']');
      
      }
  });
};


</script>




<script src="{{ asset('assets/crm/js/dataTables.js') }}"></script>
<script>
  $(document).ready(function (){


    $('#uploads').DataTable({
      responsive: true,
      processing: true,
      serverSide: true,
      toolbar: ".toolbar",
      aaSorting: [[0, "asc"]],
      ajax: "{{ route('reg.get_regemp000')}}",
      columns: [
        //{data: 'id', title: 'ID'},
        {data: 'RegFed', title: 'Registro Federal'},
        {data: 'NomPsa', title: 'Razão Social'},
        {data: 'CodAtv', title: 'Atividade'},
        {data: null, title: 'Ações',
                className: "center",
                orderable: false,
                searchable: false,
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<div id='actions'>\n\
                         <a onclick='ativar(" + oData.KeyEmp + ")' href='#'><i class='fa fa-check fa-fw'></i></a>\n\
                         <a onclick='inativar(" + oData.KeyEmp + ")' href='#'><i class='fa fa-times fa-fw'></i></a>\n\
                         <a href='{{url('nfi/t001ent/')}}/" + oData.RegFed + "/ativar'><i class='fa fa-wrench fa-fw'></i></a></div>")
                }
            }
      ],
   
     
    });


  });
</script>

@endsection