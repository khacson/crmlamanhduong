<script type="text/javascript">
$(function () {
	$('#container3').highcharts({
        chart: {
            type: 'pie',
			spacingBottom: 10,
			spacingTop: 10,
			spacingLeft: 10,
			spacingRight: 10,
        },
		/**/
        title: {
            text: 'Độ ưu tiên'
        },
        subtitle: {
            text: ''
        },
        plotOptions: {
            series: {
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:f} Ticket</b>  <br/>'
        },
        series: [{
            name: 'Ticket',
            colorByPoint: true,
            data: [<?=$billInput;?>]
        }],
    });
});
</script>
<div id="container3" style="min-width: 310px; max-width: 600px; height: 400px; margin: 0 auto"></div>