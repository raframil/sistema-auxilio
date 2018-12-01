@extends('backpack::layout')

@section('header')
    <section class="content-header">
    	<h1> Relatório de Paciente</h1>
      <ol class="breadcrumb">
        <li><a href="{{ backpack_url() }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Paciente Relatório</li>
      </ol>
    </section>
    <script src="{{ URL::to('js/jquery.canvasjs.min.js') }}"></script>
@endsection


<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "Pacientes x Doenças"
	},
	axisY: {
		title: "Pacientes (x)",
		suffix: "",
		includeZero: true
	},
	axisX: {
		title: "Nome da Doença"
	},
	data: [{
		type: "column",
		yValueFormatString: "# pacientes",
		dataPoints: [
			<?php 	
				foreach ($contDoencas as $contDoenca ) {  ?>
			{ label: '<?php echo $contDoenca['nome'] ?>', y: <?php echo $contDoenca['count'] ?> },	
			<?php } ?>	
		]
	}]
});
chart.render();

}
</script>


@section('content')
	<div id="chartContainer" style="height: 370px; width: 100%;"></div>
@endsection
