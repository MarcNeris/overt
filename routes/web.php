<?php
	//********************************************************************//
	//********************************************************************//
	//
	//OVERT INTELLIGENCE
	//
	//********************************************************************//


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/', 'HomeController@overt')->name('overt');
	//********************************************************************//
	//
	//ROTAS ADMINISTRACAO AUTH
	//
	//********************************************************************//
	//********************************************************************//
$this->group(['middleware'=>['auth'],'namespace'=>'Auth', 'prefix' =>'auth'], function()
{
	$this->get('clearcache','AuthController@clearcache')->name('clearcache');

});

Auth::routes();

$this->group(['middleware'=>['auth']], function()
{
	$this->get('perfil','Controller@perfil')->name('perfil');
	$this->get('BAM',	'Bam\bamController@BAM')->name('BAM');
	$this->get('CRM',	'Crm\crmController@CRM')->name('CRM');

});
	//********************************************************************//
	//
	//ROTA PARA OS SERVICOS DO SISTEMA
	//
	//********************************************************************//
	//********************************************************************//
$this->group(['middleware'=>['auth'],'namespace'=>'Services', 'prefix' =>'services'], function()
{
	$this->get('getCep{cep}',			'ServiceController@getCep')					->name('services.getCep');
	$this->get('getCnpj{cnpj}',			'ServiceController@getCnpj')				->name('services.getCnpj');
	$this->any('getLinkedIn',			'ServiceController@getLinkedIn')			->name('services.getLinkedIn');
	$this->get('getBCB{BCB}',			'SoapController@getBCB')					->name('services.getBCB');
	$this->get('getDollar',				'SoapController@getDollar')					->name('services.getDollar');
	$this->post('soapService',			'SoapController@soapService')				->name('services.soapService');
	$this->get('soapServices',			'SoapController@soapServices')				->name('services.soapServices');
	$this->get('getSenior/{service}',	'SoapController@getSenior')					->name('services.getSenior');

});
	//********************************************************************//
	//
	//ROTAS PARA O BAM BUSINES ACTIVITY MONITORING
	//
	//********************************************************************//
	//********************************************************************//
$this->group(['middleware'=>['auth'],'namespace'=>'Bam', 'prefix' =>'bam'], function()
{
	$this->get('live',					'bamController@live')			->name('bam.live');
	$this->get('ajuda',					'bamController@ajuda')			->name('bam.ajuda');
	$this->get('producao/{CodBam}',		'bamprd000Controller@bam')		->name('bam.producao');
	$this->get('get_bamprd000{CodBam}',	'bamprd000Controller@get_bamprd000')	->name('bam.get_bamprd000');
	$this->get('gerar_dados',			'bamprd000Controller@gerar_dados')		->name('gerar_dados');
	$this->get('get_barra{CodBam}',		'bamprd000Controller@get_barra');


	//********************************************************************//
	//
	//GRAFICOS BAM SENIOR
	//
	//********************************************************************//
	//DASHBOARD
	//********************************************************************//
	$this->get('dashboard',			'bamController@dashboard')				->name('bam.dashboard');
	$this->get('e600mcc',			'dashboardController@e600mcc')			->name('bam.e600mcc');
	//********************************************************************//
	//FINANCAS
	//********************************************************************//
	$this->get('financas',			 'bamController@financas')		->name('bam.financas');
	$this->get('e600mesSalMesNumCco','financasController@e600mesSalMesNumCco')	->name('bam.e600mesSalMesNumCco');
	$this->get('e501mcpVlrAbeCodTpt','financasController@e501mcpVlrAbeCodTpt')	->name('bam.e501mcpVlrAbeCodTpt');
	$this->get('e301tcrVlrAbeCodCli','financasController@e301tcrVlrAbeCodCli')	->name('bam.e301tcrVlrAbeCodCli');
	$this->get('e301tcrVlrTitCodCli','financasController@e301tcrVlrTitCodCli')	->name('bam.e301tcrVlrTitCodCli');
	$this->get('e501tcpVlrAbeCodFor','financasController@e501tcpVlrAbeCodFor')	->name('bam.e501tcpVlrAbeCodFor');
	$this->get('e501tcpVlrTitCodFor','financasController@e501tcpVlrTitCodFor')	->name('bam.e501tcpVlrTitCodFor');
	$this->get('e501mcpVlrAbeCodFor','financasController@e501mcpVlrAbeCodFor')	->name('bam.e501mcpVlrAbeCodFor');
	//********************************************************************//
	//OPERACOES
	//********************************************************************//
	$this->get('operacoes',				'bamController@operacoes')				->name('bam.operacoes');
	$this->get('get_DshOpe',	  		'operacoesController@get_DshOpe')		->name('bam.get_DshOpe');
	$this->get('get_e900cop',			'operacoesController@get_e900cop')		->name('bam.get_e900cop');
	$this->get('e900eoqCodProQtdOrp/{NumOrp}','operacoesController@e900eoqCodProQtdOrp');
	$this->get('operacoes/monitoramento/{NumOrp}',	  'operacoesController@monitoramento');
	//********************************************************************//
	//FATURAMENTO
	//********************************************************************//
	$this->get('faturamento',			'bamController@faturamento')				->name('bam.faturamento');
	$this->get('e140nfvSalMesCodCli',	'faturamentoController@e140nfvSalMesCodCli')->name('bam.e140nfvSalMesCodCli');
	$this->get('e140ipv',				'faturamentoController@e140ipv')			->name('bam.e140ipv');
	$this->get('e140nfv/{CodEmp}/{CodFil}/{CodTns}','faturamentoController@e140nfv');
	//********************************************************************//
	//CONTROLADORIA
	//********************************************************************//
	$this->get('controladoria',			'bamController@controladoria')					->name('bam.controladoria');
	$this->get('e650salSalMesCtaRed',	'controladoriaController@e650salSalMesCtaRed')	->name('bam.e650salSalMesCtaRed');
	//********************************************************************//
	//HCM
	//********************************************************************//
	$this->get('hcm',					'bamController@hcm')					->name('bam.hcm');
	$this->get('folha',					'hcmController@folha')					->name('bam.folha');
	$this->get('get_r044cal',			'hcmController@get_r044cal')			->name('bam.get_r044cal');
	$this->get('r034funQtdColTipSex',	'hcmController@r034funQtdColTipSex')	->name('bam.r034funQtdColTipSex');
	$this->get('r034funNumLocQtdfun',	'hcmController@r034funNumLocQtdfun')	->name('bam.r034funNumLocQtdfun');
	$this->get('r034funPosTraQtdFun',	'hcmController@r034funPosTraQtdFun')	->name('bam.r034funPosTraQtdFun');
	$this->get('r034funNomCcuQtdFun',	'hcmController@r034funNomCcuQtdFun')	->name('bam.r034funNomCcuQtdFun');
	$this->get('r046verTotEveDesEve',	'hcmController@r046verTotEveDesEve')	->name('bam.r046verTotEveDesEve');
	$this->get('r046verCodColDesEve/{CodCal}',	'hcmController@r046verCodColDesEve');

	//********************************************************************//
	//TOP 5
	//********************************************************************//
	$this->get('top5',					'bamController@top5')					->name('bam.top5');
});
	//********************************************************************//
	//
	//ROTA PARA AS TABELAS DE REGISTRO
	//
	//********************************************************************//
	//********************************************************************//
$this->group(['middleware'=>['auth'],'namespace'=>'Reg', 'prefix' =>'reg'], function(){
	//********************************************************************//
	//Rotas Administração de Empresas
	//********************************************************************//
	$this->get('empresas',	'regemp000Controller@empresas') 				->name('reg.empresas');
	$this->get('empresa',	'regemp000Controller@empresa')					->name('reg.empresa');
	$this->post('new_regemp000',	'regemp000Controller@new_regemp000')	->name('reg.new_regemp000');
	$this->get('get_regemp000',	'regemp000Controller@get_regemp000')		->name('reg.get_regemp000');
	//********************************************************************//
	//Rotas Administração de Clientes
	//********************************************************************//
	$this->post('new_regcli000',	'regcli000Controller@new_regemp000')	->name('reg.new_regcli000');
	//********************************************************************//
	//Rotas Administração de Usuários
	//********************************************************************//
	$this->get('usuarios',			'users0001Controller@usuarios')			 ->name('reg.usuarios');
	$this->get('usuario',			'users0001Controller@usuario')			 ->name('reg.usuario');
	$this->get('usuarioEmpresa',	'users0001Controller@usuarioEmpresa')	 ->name('reg.usuarioEmpresa');
	$this->post('new_users0001',	'users0001Controller@new_users0001')	 ->name('reg.new_users0001');
	$this->get('get_users0001',		'users0001Controller@get_users0001')	 ->name('reg.get_users0001');
	$this->get('get_usuarioEmpresa','users0001Controller@get_usuarioEmpresa')->name('reg.get_usuarioEmpresa');
	$this->get('get_usuario{email}','users0001Controller@get_usuario')		 ->name('reg.get_usuario');




	$this->post('new_regcto000',	'regcto000Controller@new_regcto000')	->name('reg.new_regcto000');


	
	$this->get(	'get_regcto000',	'regcto000Controller@get_regcto000')	->name('reg.get_regcto000');

	$this->any('atv_regemp000/{id}',	'regemp000Controller@atv_regemp000');

	$this->any('atv_users0001/{id}',	'users0001Controller@atv_users0001');

	$this->any('usuarioPerfil/{id}',	'users0001Controller@usuarioPerfil');

	$this->get('get_usersrole/{id}',	'usersroleController@get_usersrole');


	$this->get('upd_users0001/{id}/{idRegRol}',	'users0001Controller@upd_users0001');
	


	$this->get(	'get_regempusu',	'regemp000Controller@get_regempusu')	->name('reg.get_regempusu');

	$this->any('search', 'regemp000Controller@autocomplete');

	//********************************************************************//
	//AUTO QUERY PARA O AUTOCOMPLETE
	//********************************************************************//
	$this->any('regmun000', 'autoqueryController@regmun000');
	$this->any('regcne000', 'autoqueryController@regcne000');
	$this->any('usersrole', 'autoqueryController@usersrole');


	$this->get('contatos',	'regcto000Controller@contatos'			)->name('reg.contatos');


	//$this->post('upd_crmevt000',	'erpent000Controller@upd_erpent000')	->name('erp.upd_erpent000');
	
});


	//********************************************************************//
	//
	//ROTAS PARA OS SISTEMAS CRM
	//	
	//********************************************************************//
	//********************************************************************//
$this->group(['middleware'=>['auth'],'namespace'=>'Crm', 'prefix' =>'crm'], function(){
	//********************************************************************//
	//ROTAs para as views do CRM
	//********************************************************************//
	$this->get('tarefas',	'crmController@tarefas'				)->name('crm');
	$this->get('tarefas',	'crmController@tarefas'				)->name('crm.tarefas');
	$this->get('empresas',	'crmController@empresas'			)->name('crm.empresas');
	$this->get('dashboard',	'crmController@dashboard'			)->name('crm.dashboard');
	$this->get('contas',	'crmController@contas'				)->name('crm.contas');
	$this->get('conta',		'crmController@conta'				)->name('crm.conta');
	$this->get('planodevoo','crmController@planodevoo'			)->name('crm.planodevoo');
	$this->get('contatos',	'crmController@contatos'			)->name('crm.contatos');
	//********************************************************************//
	//Rotas GET para o CRM
	//********************************************************************//
	$this->get('get_crmtfa000','crmtfa000Controller@get_crmtfa000')->name('crm.get_crmtfa000');
	$this->get('get_crmtfa001','crmtfa001Controller@get_crmtfa001')->name('crm.get_crmtfa001');
	$this->get('get_crmcta000','crmcta000Controller@get_crmcta000')->name('crm.get_crmcta000');
	$this->get('get_crmevt000','crmevt000Controller@get_crmevt000')->name('crm.get_crmevt000');
	//********************************************************************//
	//Rotas POST para o CRM
	//********************************************************************//
	$this->post('upd_crmtfa000','crmtfa000Controller@upd_crmtfa000')->name('crm.upd_crmtfa000');
	$this->post('upd_crmtfa001','crmtfa001Controller@upd_crmtfa001')->name('crm.upd_crmtfa001');
	$this->post('new_crmevt000','crmevt000Controller@new_crmevt000')->name('crm.new_crmevt000');
	$this->post('new_crmcta000','crmcta000Controller@new_crmcta000')->name('crm.new_crmcta000');
	$this->post('upd_crmevt000','crmevt000Controller@upd_crmevt000')->name('crm.upd_crmevt000');
});
	//********************************************************************//
	//********************************************************************//
	//
	//ROTAS PARA OS SISTEMAS SENIOR
	//	
	//********************************************************************//
$this->group(['middleware'=>['auth'],'namespace'=>'Senior', 'prefix' =>'senior'], function()
{

	//********************************************************************//
	//
	//ROTAS PARA O SAPIENS
	//	
	//********************************************************************//
	$this->get('get_e085cli','seniorController@get_e085cli')->name('senior.get_e085cli');
	$this->get('clientes','seniorController@clientes')->name('senior.clientes');

	$this->get('get_e085hcl/{CodCli}','seniorController@get_e085hcl');
	
	$this->get('e070emp','seniorController@e070emp')->name('senior.e070emp');

	$this->get('v070emp','seniorController@v070emp')->name('senior.v070emp');

	$this->get('e001tns','seniorController@e001tns')->name('senior.e001tns');

	$this->get('e070fil','seniorController@e070fil')->name('senior.e070fil');

	$this->get('ativar_erpemp000/{id}','seniorController@ativar_erpemp000');
	//********************************************************************//
	//
	//ROTAS PARA O VETORH
	//	
	//********************************************************************//
});
//********************************************************************//
//********************************************************************//
//
//ROTAS PARA OS SISTEMAS DATATABLES CONTROLLER
//	
//********************************************************************//
Route::get('getRowDetailsData','DataTablesController@getRowDetailsData')->name('getRowDetailsData');
//********************************************************************//