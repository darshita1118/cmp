<?= $this->extend('index') ?>
<?= $this->section('content') ?>

<!-- required files -->
<link href="<?= base_url('assets/plugins/nvd3/build/nv.d3.css') ?>" rel="stylesheet" />
<script src="<?= base_url('assets/plugins/d3/d3.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/nvd3/build/nv.d3.min.js') ?>"></script>


<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-inverse">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Reports</a></li>
                    <li class="breadcrumb-item active">Report Stats</li>
                </ol>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-default" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                </div>

            </div>





            <div class="panel-body">


                <div class="col-lg-12">
                    <div class="card card-custom" data-card="true" id="kt_card_3">
                        <div class="card-header px-2">
                            <div class="card-title">
                                <h3 class="card-label">Counselor Panel</h3>
                            </div>
                        </div>
                        <div class="card-body px-2">



                            <div id="nav-bar-chart" class="h-250px"></div>


                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

</div>



<script>
    var app = app || {};

    // Define app.color object with color values
    app.color = {
        red: '#FF0000',
        orange: '#FFA500',
        success: '#008000',
        cyan: '#00FFFF',
        blue: '#0000FF',
        purple: '#800080',
        gray500: '#808080',
        componentColor: '#3366cc'
    };
    
    var barChartData = [{
        key: 'Cumulative Return',
        values: [{
                'label': 'A',
                'value': 29,
                'color': app.color.red
            },
            {
                'label': 'B',
                'value': 15,
                'color': app.color.orange
            },
            {
                'label': 'C',
                'value': 32,
                'color': app.color.success
            },
            {
                'label': 'D',
                'value': 196,
                'color': app.color.cyan
            },
            {
                'label': 'E',
                'value': 44,
                'color': app.color.blue
            },
            {
                'label': 'F',
                'value': 98,
                'color': app.color.purple
            },
            {
                'label': 'G',
                'value': 13,
                'color': app.color.gray500
            },
            {
                'label': 'H',
                'value': 5,
                'color': app.color.componentColor
            }
        ]
    }];

    nv.addGraph(function() {
        var barChart = nv.models.discreteBarChart()
            .x(function(d) {
                return d.label
            })
            .y(function(d) {
                return d.value
            })
            .showValues(true)
            .duration(250);

        barChart.yAxis.axisLabel("Total Sales");
        barChart.xAxis.axisLabel('Product');

        d3.select('#nav-bar-chart').append('svg').datum(barChartData).call(barChart);
        nv.utils.windowResize(barChart.update);

        return barChart;
    });
</script>






<?= $this->endSection() ?>