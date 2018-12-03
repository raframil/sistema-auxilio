@extends('backpack::layout')

@section('header')
    <section class="content-header">
    	<h1> Relatório de Pacientes x Doenças</h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Paciente Relatório</li>
      </ol>
    </section>
		<script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ URL::to('js/jquery.canvasjs.min.js') }}"></script>
@endsection


<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "Quantidade de Paciente por Doença"
	},
	axisY: {
		title: "Número de Pacientes",
		suffix: "",
		includeZero: true
	},
	axisX: {
		title: "Doença"
	},
	data: [{
		type: "column",
		yValueFormatString: "# pacientes",
		dataPoints: [
			<?php 	
				foreach ($dadosDoencas as $contDoenca ) {  ?>
			{ label: '<?php echo $contDoenca['nome'] ?>', y: <?php echo $contDoenca['count'] ?> },	
			<?php } ?>	
		]
	}]
});
chart.render();

}
</script>


@section('content')
	<!-- filtros -->
	<div class="box box-default" style="padding:10px">
		<form class="" action="{{URL::to('/admin/paciente_relatorio')}}" method="post">
		{{ csrf_field() }}
			<div class="form-group">
				<label for="sel1">Ordenar de maneira:</label>
					<select class="form-control" id="selectOrder" name="selectOrder" style="width:30%;">
						<option value="desc">Decrescente</option>
						<option value="asc">Crescente</option>
					</select>
			</div>
			<div class="form-group">
				<label for="exibir">Número de Resultados</label>
				<input placeholder="Digite a quantidade de resultados que deseja exibir" value='10' type="number" name="qtd_result" class="form-control" id="qtd_result" style="width:30%;">
  		</div>
			<button type="submit" class="btn btn-primary" name="button" style="margin:10px;">Filtrar Resultado</button>
		</form>
	</div>
	<!-- tabela -->
	<div class="row">
        <div class="col-md-12">
            <div class="box box-default">   
							<table class="table">
								<thead>
									<tr>
										<th scope="col">#</th>
										<th scope="col">Nome da Doença</th>
										<th scope="col"style="text-align:center">Número de Pacientes</th>
									</tr>
								</thead>
								<tbody>
								<?php $i = 1; 
								foreach ($dadosDoencas as $dadoDoenca) { ?>
									<tr>
										<th scope="row"><?php echo $i++; ?></th>
										<td><?php echo $dadoDoenca['nome'] ?></td>
										<td style="text-align:center"><?php echo $dadoDoenca['count'] ?></td>
									</tr>
								<?php } ?>
								</tbody>
							</table>
            </div>
        </div>
    </div>

		<div id="chartContainer" style="height: 370px; width: 100%; margin-bottom:2%;"></div>
@endsection
