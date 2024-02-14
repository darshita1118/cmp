<?php

$dataAdmissionStatus = [
    '0' => ["id" => "0", "name" => "Open Student", "color" => "#32ccc4"],
    '1' => ["id" => "1", "name" => "Application Form", "color" => "#3284cc"],
    '2' => ["id" => "2", "name" => "Under Proccess", "color" => "#ffa800"],
    '3' => ["id" => "3", "name" => "Rejected Form", "color" => "#3699ff"],
    '4' => ["id" => "4", "name" => "Spam Form", "color" => "#c94ef6"],
    '5' => ["id" => "5", "name" => "Admission Done", "color" => "#f64e60"],
];

$color = array_column($dataAdmissionStatus, 'color');

$sqlAdmissionStatus = array_column($admissionStatus, 'admisn_status');
/*
$handlersJson = json_encode($handlers);
$statusesJson = json_encode($statuses);
$sourcesJson = json_encode($sources);
$programsJson = json_encode($programs);

?>
<script>
const handlers = <?= $handlersJson ?>;
const statuses = <?= $statusesJson ?>;
const sources = <?= $sourcesJson ?>;
const programs = <?= $programsJson ?>;
</script>
*/
?>
<!--begin::Subheader-->
<style>
    .chartdiv {
        width: 100%;
        height: 400px;
        margin-left: auto;
        margin-right: auto;
    }
</style>

<!-- required files -->
<script src="<?= base_url('assets/js/amchart.js') ?>"></script>

<div class="row">

    <div class="col-xl-12">

        <div class="panel panel-default">

            <div class="panel-heading">
                <ol class="breadcrumb panel-title">
                    <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
                    <li class="breadcrumb-item"><a href="javascript:;">Reports</a></li>
                    <li class="breadcrumb-item active">Report Stats</li>
                </ol>
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-toggle="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-success" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"><i class="fa fa-lg fa-fw fa-sliders"></i></a>


                    <div class="offcanvas offcanvas-top ps-5 pe-5" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                        <div class="offcanvas-header border-bottom">
                            <h5 id="offcanvasTopLabel">Filters</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body mt-md-3">

                            <form action="" class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile No.</label>
                                        <input class="form-control" type="tel" placeholder="Enter Mobile No." />
                                    </div>

                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3"><label class="form-label">Date</label>
                                        <div class="input-group" id="default-daterange">

                                            <input type="text" name="default-daterange" class="form-control" value="" placeholder="click to select the date range">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select">...
                                            <option selected>--Select -- </option>
                                            <option value="1">Admin</option>
                                            <option value="2">Handler</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Source</label>
                                        <select class="form-select">...
                                            <option selected>--Select-- </option>
                                            <option value="1">Suspended</option>
                                            <option value="2">Active</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Department</label>
                                        <select class="form-select">...
                                            <option selected>--Department-- </option>
                                            <option value="1">Admin</option>
                                            <option value="2">Handler</option>

                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Program</label>
                                        <select class="form-select">...
                                            <option selected>--Chooes Program-- </option>
                                            <option value="1">Suspended</option>
                                            <option value="2">Active</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Lead Nationality</label>
                                        <select class="form-select">...
                                            <option selected>--Select-- </option>
                                            <option value="1">Suspended</option>
                                            <option value="2">Active</option>
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-3 mt-md-4">
                                    <button type="submit" class="btn btn-primary w-100px me-5px">Apply Filter</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

            </div>





            <div class="panel-body">

                <div class="mb-10px mt-10px fs-10px">
                    <b class="text-body">Overall STAT</b>
                </div>

                <div class="row gx-2 mb-20px">

                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-teal mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Created SID</div>
                                <div class="stats-number"><?= $totalRegistered ?></div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week (70.1%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-blue mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Total Registration</div>
                                <div class="stats-number"><?= $totalRegisterPayment ?></div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 40.5%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week (40.5%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-purple mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Total Admission Done</div>
                                <div class="stats-number"><?= $totalProvisionalModel ?></div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 76.3%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week (76.3%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-dark mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Total Leads</div>
                                <div class="stats-number"><?= $totalLeads ?></div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 54.9%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week (54.9%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-orange mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-file-alt fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Allocated Leads</div>
                                <div class="stats-number"><?= $totalAllocated ?></div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 23.5%;"></div>
                                </div>
                                <div class="stats-desc">More than last week (23.5%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-pink mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-exclamation-triangle fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Unlocated Lead</div>
                                <div class="stats-number"><?= $totalUnallocated ?></div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 10.5%;"></div>
                                </div>
                                <div class="stats-desc">More than last week (10.5%)</div>
                            </div>
                        </div>
                    </div>

                </div>


                <div class="col-lg-12">
                    <div class="card card-custom" data-card="true" id="kt_card_3">
                        <div class="card-header px-2">
                            <div class="card-title">
                                <h3 class="card-label">Counselor Panel</h3>
                            </div>
                        </div>
                        <div class="card-body px-2">



                            <!-- Bar -->
                            <script>
                                am5.ready(function() {

                                    // Create root element
                                    // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                    var root = am5.Root.new("chartdiv4");


                                    // Set themes
                                    // https://www.amcharts.com/docs/v5/concepts/themes/
                                    root.setThemes([
                                        am5themes_Animated.new(root)
                                    ]);


                                    // Create chart
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                    var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                        panX: true,
                                        panY: true,
                                        wheelX: "panX",
                                        wheelY: "zoomX"
                                    }));

                                    // Add cursor
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                    var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                    cursor.lineY.set("visible", false);


                                    // Create axes
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                    var xRenderer = am5xy.AxisRendererX.new(root, {
                                        minGridDistance: 30
                                    });
                                    xRenderer.labels.template.setAll({
                                        rotation: -90,
                                        centerY: am5.p50,
                                        centerX: am5.p100,
                                        paddingRight: 15
                                    });

                                    var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                        maxDeviation: 0.3,
                                        categoryField: "year",
                                        renderer: xRenderer,
                                        tooltip: am5.Tooltip.new(root, {})
                                    }));

                                    var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                        maxDeviation: 0.3,
                                        renderer: am5xy.AxisRendererY.new(root, {})
                                    }));


                                    // Create series
                                    // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                        name: "Series 1",
                                        xAxis: xAxis,
                                        stacked: true,
                                        yAxis: yAxis,
                                        valueYField: "value",
                                        sequencedInterpolation: true,
                                        categoryXField: "year",
                                        tooltip: am5.Tooltip.new(root, {
                                            labelText: "{valueY}"
                                        })
                                    }));

                                    series.columns.template.setAll({
                                        cornerRadiusTL: 5,
                                        cornerRadiusTR: 5
                                    });
                                    series.columns.template.adapters.add("fill", (fill, target) => {
                                        return chart.get("colors").getIndex(series.columns.indexOf(
                                            target));
                                    });

                                    series.columns.template.adapters.add("stroke", (stroke, target) => {
                                        return chart.get("colors").getIndex(series.columns.indexOf(
                                            target));
                                    });


                                    // Set data
                                    var data = <?= json_encode($lineChart) ?>;
                                    var newData = [];
                                    for (var j = 0; j < data.length; j++) {
                                        d = data[j];
                                        d.value = Number(d.value);
                                        newData.push(d);
                                    }

                                    xAxis.data.setAll(newData);
                                    series.data.setAll(newData);


                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear(1000);
                                    chart.appear(1000, 100);

                                    var exporting = am5plugins_exporting.Exporting.new(root, {
                                        menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                        dataSource: data
                                    });

                                    exporting.events.on("dataprocessed", function(ev) {
                                        for (var i = 0; i < ev.data.length; i++) {
                                            ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                        }
                                    });

                                }); // end am5.ready()
                            </script>
                            <!--end Bar -->

                            <div class="chartdiv" id="chartdiv4"></div>
                            <?php /*
                            <script>
                            am5.ready(function() {

                                // Create root element
                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                var root = am5.Root.new("chartdiv");


                                // Set themes
                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                root.setThemes([
                                    am5themes_Animated.new(root)
                                ]);


                                // Create chart
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                    panX: false,
                                    panY: false,
                                    wheelX: "panX",
                                    wheelY: "zoomX",
                                    layout: root.verticalLayout
                                }));


                                // Add legend
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/legend-xy-series/
                                var legend = chart.children.push(
                                    am5.Legend.new(root, {
                                        centerX: am5.p50,
                                        x: am5.p50
                                    })
                                );

                                var data = [{
                                        "month": "Jan-Mar",
                                        "leads": 2.5,
                                        "allocatedLeads": 2.5,
                                        "unallocatedLeads": 2.1,
                                        "registeredLeads": 1,
                                    },
                                    {
                                        "month": "Apr-Jun",
                                        "leads": 2.5,
                                        "allocatedLeads": 2.5,
                                        "unallocatedLeads": 2.1,
                                        "registeredLeads": 1,
                                    },
                                    {
                                        "month": "Jul-Sep",
                                        "leads": 2.5,
                                        "allocatedLeads": 2.5,
                                        "unallocatedLeads": 2.1,
                                        "registeredLeads": 1,
                                    },
                                    {
                                        "month": "Oct-Dec",
                                        "leads": 2.5,
                                        "allocatedLeads": 2.5,
                                        "unallocatedLeads": 2.1,
                                        "registeredLeads": 1,
                                    }
                                ]


                                // Create axes
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                    categoryField: "month",
                                    renderer: am5xy.AxisRendererX.new(root, {
                                        cellStartLocation: 0.1,
                                        cellEndLocation: 0.9
                                    }),
                                    tooltip: am5.Tooltip.new(root, {})
                                }));

                                xAxis.data.setAll(data);

                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                    renderer: am5xy.AxisRendererY.new(root, {})
                                }));


                                // Add series
                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                function makeSeries(name, fieldName) {
                                    var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                        name: name,
                                        xAxis: xAxis,
                                        yAxis: yAxis,
                                        valueYField: fieldName,
                                        categoryXField: "month"
                                    }));

                                    series.columns.template.setAll({
                                        tooltipText: "{name}, {categoryX}:{valueY}",
                                        width: am5.percent(60),
                                        tooltipY: 0
                                    });

                                    series.data.setAll(data);

                                    // Make stuff animate on load
                                    // https://www.amcharts.com/docs/v5/concepts/animations/
                                    series.appear();

                                    series.bullets.push(function() {
                                        return am5.Bullet.new(root, {
                                            locationY: 0,
                                            sprite: am5.Label.new(root, {
                                                text: "{valueY}",
                                                fill: root.interfaceColors.get(
                                                    "alternativeText"),
                                                centerY: 0,
                                                centerX: am5.p50,
                                                populateText: true
                                            })
                                        });
                                    });

                                    legend.data.push(series);
                                }

                                makeSeries("Leads", "leads");
                                makeSeries("Allocated Leads", "allocatedLeads");
                                makeSeries("Unallocated Leads", "unallocatedLeads");
                                makeSeries("Registered SID", "registeredLeads");



                                // Make stuff animate on load
                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                chart.appear(1000, 100);

                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                    dataSource: data
                                });

                                exporting.events.on("dataprocessed", function(ev) {
                                    for (var i = 0; i < ev.data.length; i++) {
                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                    }
                                });

                            }); // end am5.ready()
                            </script>
                            <div class="chartdiv" id="chartdiv">

                            </div>
                             */ ?>


                        </div>
                    </div>
                </div>

                <br>

                <div class="mb-10px mt-10px fs-10px">
                    <b class="text-body">Overall STAT</b>
                </div>

                <div class="row gx-2 mb-20px">

                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-teal mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Open Student</div>
                                <div class="stats-number">7,842,900</div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 70.1%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week (70.1%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-blue mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Application Form</div>
                                <div class="stats-number">180,200</div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 40.5%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week (40.5%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-purple mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Under Process</div>
                                <div class="stats-number">38,900</div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 76.3%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week (76.3%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-dark mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Rejected Form</div>
                                <div class="stats-number">3,988</div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 54.9%;"></div>
                                </div>
                                <div class="stats-desc">Better than last week (54.9%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-orange mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-file-alt fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Spam Form</div>
                                <div class="stats-number">20</div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 23.5%;"></div>
                                </div>
                                <div class="stats-desc">More than last week (23.5%)</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-4 col-sm-6">
                        <div class="widget widget-stats bg-pink mb-7px">
                            <div class="stats-icon stats-icon-lg"><i class="fa fa-exclamation-triangle fa-fw"></i></div>
                            <div class="stats-content">
                                <div class="stats-title">Admission Dome</div>
                                <div class="stats-number">5</div>
                                <div class="stats-progress progress">
                                    <div class="progress-bar" style="width: 10.5%;"></div>
                                </div>
                                <div class="stats-desc">More than last week (10.5%)</div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-12">
                    <div class="card card-custom" data-card="true" id="kt_card_3">
                        <div class="card-header px-2">
                            <div class="card-title">
                                <h3 class="card-label">Applied Application Form(<?= $totalRegisteredStudent ?>)
                                </h3>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card-body px-2">
                                    <?php /*
                            <form action="" method="get" class=" px-3 py-3">
                                <div class="row align-items-center">
                                    <div class="col-lg-2 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="from">From</label>
                                            <input type="text" name="from" id="from" class="form-control datep" value="" autocomplete="off" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-xl-3">
                                        <div class="input-icon form-group">
                                            <label for="to">To</label>
                                            <input type="text" name="to" id="to" class="form-control datep" value="" autocomplete="off" placeholder="dd-mm-yyyy">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">
                                            <label for="handlers">Handlers</label>
                                            <select name="handlers[]" data-live-search="true" id="handlers" class="form-control selectpicker" multiple>
                                                <?php foreach ($handlers as $handler) : ?>
                                                    <option value="<?= $handler['lu_id'] ?>"><?= $handler['user_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">
                                            <label for="tl">Select Team</label>
                                            <select name="tl[]" id="tl" data-live-search="true" class="form-control selectpicker" multiple>
                                                <?php foreach ($teamLeaders ?? [] as $leader) : ?>
                                                    <option value="<?= $leader['lu_id'] ?>"><?= $leader['user_name'] ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-xl-3">
                                        <div class="align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="source">Source</label>
                                                <select name="source[]" data-live-search="true" id="source" class="form-control selectpicker" multiple>
                                                    <?php foreach ($sources as $source) : ?>
                                                        <option value="<?= $source['source_id'] ?>">
                                                            <?= $source['source_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">
                                            <div class="m-auto ">
                                                <label for="status">Status</label>
                                                <select name="status[]" data-live-search="true" id="status" class="form-control selectpicker" multiple>
                                                    <?php foreach ($statuses as $status) : ?>
                                                        <option value="<?= $status['status_id'] ?>">
                                                            <?= $status['status_name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">

                                            <div class="m-auto ">
                                                <label for="department">Department</label>
                                                <select name="department[]" id="department"
                                                    class="form-control selectpicker" multiple>
                                                    <option value="">--Select--</option>

                                                    <option value="">1</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-3 col-xl-3">
                                        <div class=" align-items-center form-group">
                                            <div class="m-auto ">
                                                <label for="program">Program</label>
                                                <select name="program[]" data-live-search="true" id="program" class="form-control selectpicker" multiple>
                                                    <?php foreach ($programs as $program) : ?>
                                                        <option value="<?= $program['sc_id'] ?>">
                                                            <?= $program['course_name'] ?></option>
                                                    <?php endforeach; ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-lg-3 col-xl-3 form-group">
                                        <label for="">&nbsp;</label>
                                        <button type="submit" class="form-control btn btn-light-primary font-weight-bold">Search</button>

                                    </div>

                                </div>
                            </form>
                            */ ?>
                                    <div class="mb-3">
                                        <div class="row mx-0">
                                            <?php $chartData = [];
                                            foreach ($dataAdmissionStatus as $admssion) : ?>
                                                <div class="col-xl-2">
                                                    <!--begin::Stats Widget 10-->
                                                    <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $admssion['color'] ?>;">
                                                        <!--begin::Body-->
                                                        <div class="card-body p-0">
                                                            <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">

                                                                <div class="d-flex flex-column text-center">
                                                                    <span class="text-dark-75 font-weight-bolder font-size-h3"><?php $key = array_search($admssion['id'], $sqlAdmissionStatus, true); ?><?php $stats = ($key !== false) ? $admissionStatus[$key]['sid'] : '0';
                                                                                                                                                                                                        echo $stats; ?></span>
                                                                    <span class="text-muted font-weight-bold mt-2 text-center"><?= $admssion['name'] ?></span>
                                                                </div>
                                                            </div>
                                                            <?php $chartData[] = ['category' => $admssion['name'], 'value' => (int) $stats]; ?>
                                                        </div>
                                                        <!--end::Body-->
                                                    </div>
                                                    <!--end::Stats Widget 10-->
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>


                                    <!--begin::Entry-->
                                    <div class="row mx-0">
                                        <!-- Bar -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("chartdiv2");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                                    panX: true,
                                                    panY: true,
                                                    wheelX: "panX",
                                                    wheelY: "zoomX"
                                                }));

                                                // Add cursor
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                                cursor.lineY.set("visible", false);


                                                // Create axes
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                                var xRenderer = am5xy.AxisRendererX.new(root, {
                                                    minGridDistance: 30
                                                });
                                                xRenderer.labels.template.setAll({
                                                    rotation: -90,
                                                    centerY: am5.p50,
                                                    centerX: am5.p100,
                                                    paddingRight: 15
                                                });

                                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    categoryField: "category",
                                                    renderer: xRenderer,
                                                    tooltip: am5.Tooltip.new(root, {})
                                                }));

                                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    renderer: am5xy.AxisRendererY.new(root, {})
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                                    name: "Series 1",
                                                    xAxis: xAxis,
                                                    stacked: true,
                                                    yAxis: yAxis,
                                                    valueYField: "value",
                                                    sequencedInterpolation: true,
                                                    categoryXField: "category",
                                                    tooltip: am5.Tooltip.new(root, {
                                                        labelText: "{valueY}"
                                                    })
                                                }));

                                                series.columns.template.setAll({
                                                    cornerRadiusTL: 5,
                                                    cornerRadiusTR: 5
                                                });
                                                series.columns.template.adapters.add("fill", (fill, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });

                                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });


                                                // Set data
                                                var data = <?= json_encode($chartData) ?>;


                                                xAxis.data.setAll(data);
                                                series.data.setAll(data);


                                                // Make stuff animate on load
                                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                                series.appear(1000);
                                                chart.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <!--end Bar -->
                                        <div class="col-lg-6 mb-3">
                                            <div class="card gutter-b">
                                                <div class="chartdiv" id="chartdiv2"></div>
                                            </div>
                                        </div>
                                        <!-- pie -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("chartdiv3");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                                    layout: root.verticalLayout
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                                var series = chart.series.push(am5percent.PieSeries.new(root, {
                                                    alignLabels: true,
                                                    calculateAggregates: true,
                                                    valueField: "value",
                                                    categoryField: "category"
                                                }));

                                                series.slices.template.setAll({
                                                    strokeWidth: 3,
                                                    stroke: am5.color(0xffffff)
                                                });

                                                series.labelsContainer.set("paddingTop", 30)


                                                // Set up adapters for variable slice radius
                                                // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                                series.slices.template.adapters.add("radius", function(radius, target) {
                                                    var dataItem = target.dataItem;
                                                    var high = series.getPrivate("valueHigh");

                                                    if (dataItem) {
                                                        var value = target.dataItem.get("valueWorking", 0);
                                                        return radius * value / high
                                                    }
                                                    return radius;
                                                });


                                                // Set data
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                                var data = <?= json_encode($chartData) ?>;
                                                series.data.setAll(data);


                                                // Create legend
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                                var legend = chart.children.push(am5.Legend.new(root, {
                                                    centerX: am5.p50,
                                                    x: am5.p50,
                                                    marginTop: 15,
                                                    marginBottom: 15
                                                }));

                                                legend.data.setAll(series.dataItems);


                                                // Play initial series animation
                                                // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                                series.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <!-- end Pie -->
                                        <div class="col-lg-6 mb-3">
                                            <div class="card gutter-b">
                                                <div class="chartdiv" id="chartdiv3"></div>
                                            </div>
                                        </div>



                                        <!-- Bar -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("formStepchart");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                                    panX: true,
                                                    panY: true,
                                                    wheelX: "panX",
                                                    wheelY: "zoomX"
                                                }));

                                                // Add cursor
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                                cursor.lineY.set("visible", false);


                                                // Create axes
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                                var xRenderer = am5xy.AxisRendererX.new(root, {
                                                    minGridDistance: 30
                                                });
                                                xRenderer.labels.template.setAll({
                                                    rotation: -90,
                                                    centerY: am5.p50,
                                                    centerX: am5.p100,
                                                    paddingRight: 15
                                                });

                                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    categoryField: "category",
                                                    renderer: xRenderer,
                                                    tooltip: am5.Tooltip.new(root, {})
                                                }));

                                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    renderer: am5xy.AxisRendererY.new(root, {})
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                                    name: "Series 1",
                                                    xAxis: xAxis,
                                                    stacked: true,
                                                    yAxis: yAxis,
                                                    valueYField: "value",
                                                    sequencedInterpolation: true,
                                                    categoryXField: "category",
                                                    tooltip: am5.Tooltip.new(root, {
                                                        labelText: "{valueY}"
                                                    })
                                                }));

                                                series.columns.template.setAll({
                                                    cornerRadiusTL: 5,
                                                    cornerRadiusTR: 5
                                                });
                                                series.columns.template.adapters.add("fill", (fill, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });

                                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });


                                                // Set data
                                                var data = <?= json_encode($formStep ?? []) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });


                                                xAxis.data.setAll(data);
                                                series.data.setAll(data);


                                                // Make stuff animate on load
                                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                                series.appear(1000);
                                                chart.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <!--end Bar -->
                                        <div class="col-lg-12 mb-3">
                                            <div class="card gutter-b card-custom">
                                                <div class="card-header px-2">
                                                    <div class="card-title">
                                                        <h3 class="card-label">Application Form Step Chart(<?= array_sum(array_column($formStep ?? [], 'value')) ?>)</h3>
                                                    </div>
                                                </div>
                                                <div class="chartdiv" id="formStepchart"></div>
                                            </div>
                                        </div>

                                        <!-- Lead Status chart Start -->
                                        <div class="col-lg-12">
                                            <h4>Lead Status Wise</h4>
                                            <div class='row'>
                                                <?php $count = 0;
                                                foreach ($leadStatusWise as $status) :
                                                    if ($count == count($color))
                                                        $count = 0;
                                                ?>
                                                    <div class="col-xl-2">
                                                        <!--begin::Stats Widget 10-->
                                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $color[$count++] ?>;">
                                                            <!--begin::Body-->
                                                            <div class="card-body p-0">
                                                                <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">

                                                                    <div class="d-flex flex-column text-center">
                                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $status['value'] ?? '0'; ?></span>
                                                                        <span class="text-muted font-weight-bold mt-2 text-center"><?= $status['category'] ?></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                        <!--end::Stats Widget 10-->
                                                    </div>

                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <!-- Pie Chart -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("leadStatusWise");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                                    layout: root.verticalLayout
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                                var series = chart.series.push(am5percent.PieSeries.new(root, {
                                                    alignLabels: true,
                                                    calculateAggregates: true,
                                                    valueField: "value",
                                                    categoryField: "category"
                                                }));

                                                series.slices.template.setAll({
                                                    strokeWidth: 3,
                                                    stroke: am5.color(0xffffff)
                                                });

                                                series.labelsContainer.set("paddingTop", 30)


                                                // Set up adapters for variable slice radius
                                                // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                                series.slices.template.adapters.add("radius", function(radius, target) {
                                                    var dataItem = target.dataItem;
                                                    var high = series.getPrivate("valueHigh");

                                                    if (dataItem) {
                                                        var value = target.dataItem.get("valueWorking", 0);
                                                        return radius * value / high
                                                    }
                                                    return radius;
                                                });


                                                // Set data
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                                var data = <?= json_encode($leadStatusWise) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });
                                                series.data.setAll(data);


                                                // Create legend
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                                var legend = chart.children.push(am5.Legend.new(root, {
                                                    centerX: am5.p50,
                                                    x: am5.p50,
                                                    marginTop: 15,
                                                    marginBottom: 15
                                                }));

                                                legend.data.setAll(series.dataItems);


                                                // Play initial series animation
                                                // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                                series.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <div class="col-lg-6 mb-3">
                                            <div class="card gutter-b">
                                                <div class="chartdiv" id="leadStatusWise"></div>
                                            </div>
                                        </div>
                                        <!-- Bar Chart -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("leadStatusWiseBar");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                                    panX: true,
                                                    panY: true,
                                                    wheelX: "panX",
                                                    wheelY: "zoomX"
                                                }));

                                                // Add cursor
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                                cursor.lineY.set("visible", false);


                                                // Create axes
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                                var xRenderer = am5xy.AxisRendererX.new(root, {
                                                    minGridDistance: 30
                                                });
                                                xRenderer.labels.template.setAll({
                                                    rotation: -90,
                                                    centerY: am5.p50,
                                                    centerX: am5.p100,
                                                    paddingRight: 15
                                                });

                                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    categoryField: "category",
                                                    renderer: xRenderer,
                                                    tooltip: am5.Tooltip.new(root, {})
                                                }));

                                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    renderer: am5xy.AxisRendererY.new(root, {})
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                                    name: "Series 1",
                                                    xAxis: xAxis,
                                                    stacked: true,
                                                    yAxis: yAxis,
                                                    valueYField: "value",
                                                    sequencedInterpolation: true,
                                                    categoryXField: "category",
                                                    tooltip: am5.Tooltip.new(root, {
                                                        labelText: "{valueY}"
                                                    })
                                                }));

                                                series.columns.template.setAll({
                                                    cornerRadiusTL: 5,
                                                    cornerRadiusTR: 5
                                                });
                                                series.columns.template.adapters.add("fill", (fill, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });

                                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });


                                                // Set data
                                                var data = <?= json_encode($leadStatusWise) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });


                                                xAxis.data.setAll(data);
                                                series.data.setAll(data);


                                                // Make stuff animate on load
                                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                                series.appear(1000);
                                                chart.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <div class="col-lg-6 mb-3">
                                            <div class="card gutter-b">
                                                <div class="chartdiv" id="leadStatusWiseBar"></div>
                                            </div>
                                        </div>
                                        <!-- Lead Status chart End -->

                                        <!-- Lead Source chart Start -->
                                        <div class="col-lg-12">
                                            <h4>Lead Source Wise</h4>
                                            <div class='row'>
                                                <?php $count = 0;
                                                foreach ($leadSourceWise as $source) :
                                                    if ($count == count($color))
                                                        $count = 0;
                                                ?>
                                                    <div class="col-xl-2">
                                                        <!--begin::Stats Widget 10-->
                                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $color[$count++] ?>;">
                                                            <!--begin::Body-->
                                                            <div class="card-body p-0">
                                                                <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">

                                                                    <div class="d-flex flex-column text-center">
                                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $source['value'] ?? '0'; ?></span>
                                                                        <span class="text-muted font-weight-bold mt-2 text-center"><?= $source['category'] ?></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                        <!--end::Stats Widget 10-->
                                                    </div>

                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <!-- Pie Chart -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("leadSourceWise");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                                    layout: root.verticalLayout
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                                var series = chart.series.push(am5percent.PieSeries.new(root, {
                                                    alignLabels: true,
                                                    calculateAggregates: true,
                                                    valueField: "value",
                                                    categoryField: "category"
                                                }));

                                                series.slices.template.setAll({
                                                    strokeWidth: 3,
                                                    stroke: am5.color(0xffffff)
                                                });

                                                series.labelsContainer.set("paddingTop", 30)


                                                // Set up adapters for variable slice radius
                                                // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                                series.slices.template.adapters.add("radius", function(radius, target) {
                                                    var dataItem = target.dataItem;
                                                    var high = series.getPrivate("valueHigh");

                                                    if (dataItem) {
                                                        var value = target.dataItem.get("valueWorking", 0);
                                                        return radius * value / high
                                                    }
                                                    return radius;
                                                });


                                                // Set data
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                                var data = <?= json_encode($leadSourceWise) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });
                                                series.data.setAll(data);


                                                // Create legend
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                                var legend = chart.children.push(am5.Legend.new(root, {
                                                    centerX: am5.p50,
                                                    x: am5.p50,
                                                    marginTop: 15,
                                                    marginBottom: 15
                                                }));

                                                legend.data.setAll(series.dataItems);


                                                // Play initial series animation
                                                // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                                series.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <div class="col-lg-6 mb-3">
                                            <div class="card gutter-b">
                                                <div class="chartdiv" id="leadSourceWise"></div>
                                            </div>
                                        </div>
                                        <!-- Bar Chart -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("leadSourceWiseBar");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                                    panX: true,
                                                    panY: true,
                                                    wheelX: "panX",
                                                    wheelY: "zoomX"
                                                }));

                                                // Add cursor
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                                cursor.lineY.set("visible", false);


                                                // Create axes
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                                var xRenderer = am5xy.AxisRendererX.new(root, {
                                                    minGridDistance: 30
                                                });
                                                xRenderer.labels.template.setAll({
                                                    rotation: -90,
                                                    centerY: am5.p50,
                                                    centerX: am5.p100,
                                                    paddingRight: 15
                                                });

                                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    categoryField: "category",
                                                    renderer: xRenderer,
                                                    tooltip: am5.Tooltip.new(root, {})
                                                }));

                                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    renderer: am5xy.AxisRendererY.new(root, {})
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                                    name: "Series 1",
                                                    xAxis: xAxis,
                                                    stacked: true,
                                                    yAxis: yAxis,
                                                    valueYField: "value",
                                                    sequencedInterpolation: true,
                                                    categoryXField: "category",
                                                    tooltip: am5.Tooltip.new(root, {
                                                        labelText: "{valueY}"
                                                    })
                                                }));

                                                series.columns.template.setAll({
                                                    cornerRadiusTL: 5,
                                                    cornerRadiusTR: 5
                                                });
                                                series.columns.template.adapters.add("fill", (fill, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });

                                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });


                                                // Set data
                                                var data = <?= json_encode($leadSourceWise) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });


                                                xAxis.data.setAll(data);
                                                series.data.setAll(data);


                                                // Make stuff animate on load
                                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                                series.appear(1000);
                                                chart.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <div class="col-lg-6 mb-3">
                                            <div class="card gutter-b">
                                                <div class="chartdiv" id="leadSourceWiseBar"></div>
                                            </div>
                                        </div>
                                        <!-- Lead Source chart End -->

                                        <!-- Lead Department chart Start -->
                                        <div class="col-lg-12">
                                            <h4>Lead Department Wise</h4>
                                            <div class='row'>
                                                <?php $count = 0;
                                                foreach ($departmentWise as $dept) :
                                                    if ($count == count($color))
                                                        $count = 0;
                                                ?>
                                                    <div class="col-xl-2">
                                                        <!--begin::Stats Widget 10-->
                                                        <div class="card card-custom card-stretch gutter-b" style="border: 1px solid <?= $color[$count++] ?>;">
                                                            <!--begin::Body-->
                                                            <div class="card-body p-0">
                                                                <div class="align-items-center justify-content-between px-3 py-2 flex-grow-1 " style="">

                                                                    <div class="d-flex flex-column text-center">
                                                                        <span class="text-dark-75 font-weight-bolder font-size-h3"><?= $dept['value'] ?? '0'; ?></span>
                                                                        <span class="text-muted font-weight-bold mt-2 text-center"><?= $dept['category'] ?></span>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <!--end::Body-->
                                                        </div>
                                                        <!--end::Stats Widget 10-->
                                                    </div>

                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                        <!-- Pie Chart -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("departmentWise");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                                    layout: root.verticalLayout
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                                var series = chart.series.push(am5percent.PieSeries.new(root, {
                                                    alignLabels: true,
                                                    calculateAggregates: true,
                                                    valueField: "value",
                                                    categoryField: "category"
                                                }));

                                                series.slices.template.setAll({
                                                    strokeWidth: 3,
                                                    stroke: am5.color(0xffffff)
                                                });

                                                series.labelsContainer.set("paddingTop", 30)


                                                // Set up adapters for variable slice radius
                                                // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                                series.slices.template.adapters.add("radius", function(radius, target) {
                                                    var dataItem = target.dataItem;
                                                    var high = series.getPrivate("valueHigh");

                                                    if (dataItem) {
                                                        var value = target.dataItem.get("valueWorking", 0);
                                                        return radius * value / high
                                                    }
                                                    return radius;
                                                });


                                                // Set data
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                                var data = <?= json_encode($departmentWise) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });
                                                series.data.setAll(data);


                                                // Create legend
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                                var legend = chart.children.push(am5.Legend.new(root, {
                                                    centerX: am5.p50,
                                                    x: am5.p50,
                                                    marginTop: 15,
                                                    marginBottom: 15
                                                }));

                                                legend.data.setAll(series.dataItems);


                                                // Play initial series animation
                                                // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                                series.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <div class="col-lg-12 mb-3">
                                            <div class="card gutter-b">
                                                <div style=" width: 100%;height: 600px; margin-left: auto; margin-right: auto;" id="departmentWise"></div>
                                            </div>
                                        </div>
                                        <!-- Bar Chart -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("departmentWiseBar");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                                    panX: true,
                                                    panY: true,
                                                    wheelX: "panX",
                                                    wheelY: "zoomX"
                                                }));

                                                // Add cursor
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                                cursor.lineY.set("visible", false);


                                                // Create axes
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                                var xRenderer = am5xy.AxisRendererX.new(root, {
                                                    minGridDistance: 30
                                                });
                                                xRenderer.labels.template.setAll({
                                                    rotation: -90,
                                                    centerY: am5.p50,
                                                    centerX: am5.p100,
                                                    paddingRight: 15
                                                });

                                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    categoryField: "category",
                                                    renderer: xRenderer,
                                                    tooltip: am5.Tooltip.new(root, {})
                                                }));

                                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    renderer: am5xy.AxisRendererY.new(root, {})
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                                    name: "Series 1",
                                                    xAxis: xAxis,
                                                    stacked: true,
                                                    yAxis: yAxis,
                                                    valueYField: "value",
                                                    sequencedInterpolation: true,
                                                    categoryXField: "category",
                                                    tooltip: am5.Tooltip.new(root, {
                                                        labelText: "{valueY}"
                                                    })
                                                }));

                                                series.columns.template.setAll({
                                                    cornerRadiusTL: 5,
                                                    cornerRadiusTR: 5
                                                });
                                                series.columns.template.adapters.add("fill", (fill, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });

                                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });


                                                // Set data
                                                var data = <?= json_encode($departmentWise) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });


                                                xAxis.data.setAll(data);
                                                series.data.setAll(data);


                                                // Make stuff animate on load
                                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                                series.appear(1000);
                                                chart.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <div class="col-lg-12 mb-3">
                                            <div class="card gutter-b">
                                                <div style=" width: 100%;height: 600px; margin-left: auto; margin-right: auto;" id="departmentWiseBar"></div>
                                            </div>
                                        </div>
                                        <!-- Lead Department chart End -->

                                        <!-- Lead Program chart Start -->
                                        <div class="col-lg-12">
                                            <h4>Lead Program Wise</h4>


                                            <div class="table-responsive">
                                                <table class="table table-hover mb-0 text-dark">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Username</th>
                                                            <th>Email Address</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $count = 0;
                                                        foreach ($programWise as $program) :
                                                            if ($count == count($color))
                                                                $count = 0;
                                                        ?>

                                                            <tr>
                                                                <td><?= $count ?></td>
                                                                <td><?= $program['value'] ?? '0'; ?></td>
                                                                <td><?= $program['category'] ?></td>
                                                            </tr>
                                                        <?php $count++;
                                                        endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>


                                        </div>
                                        <!-- Pie Chart -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("programWise");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/
                                                var chart = root.container.children.push(am5percent.PieChart.new(root, {
                                                    layout: root.verticalLayout
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Series
                                                var series = chart.series.push(am5percent.PieSeries.new(root, {
                                                    alignLabels: true,
                                                    calculateAggregates: true,
                                                    valueField: "value",
                                                    categoryField: "category"
                                                }));

                                                series.slices.template.setAll({
                                                    strokeWidth: 3,
                                                    stroke: am5.color(0xffffff)
                                                });

                                                series.labelsContainer.set("paddingTop", 30)


                                                // Set up adapters for variable slice radius
                                                // https://www.amcharts.com/docs/v5/concepts/settings/adapters/
                                                series.slices.template.adapters.add("radius", function(radius, target) {
                                                    var dataItem = target.dataItem;
                                                    var high = series.getPrivate("valueHigh");

                                                    if (dataItem) {
                                                        var value = target.dataItem.get("valueWorking", 0);
                                                        return radius * value / high
                                                    }
                                                    return radius;
                                                });


                                                // Set data
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/pie-chart/#Setting_data
                                                var data = <?= json_encode($programWise) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });
                                                series.data.setAll(data);


                                                // Create legend
                                                // https://www.amcharts.com/docs/v5/charts/percent-charts/legend-percent-series/
                                                var legend = chart.children.push(am5.Legend.new(root, {
                                                    centerX: am5.p50,
                                                    x: am5.p50,
                                                    marginTop: 15,
                                                    marginBottom: 15
                                                }));

                                                legend.data.setAll(series.dataItems);


                                                // Play initial series animation
                                                // https://www.amcharts.com/docs/v5/concepts/animations/#Animation_of_series
                                                series.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <div class="col-lg-12 mb-3">
                                            <div class="card gutter-b">
                                                <div style=" width: 100%;height: 600px; margin-left: auto; margin-right: auto;" id="programWise"></div>
                                            </div>
                                        </div>
                                        <!-- Bar Chart -->
                                        <script>
                                            am5.ready(function() {

                                                // Create root element
                                                // https://www.amcharts.com/docs/v5/getting-started/#Root_element
                                                var root = am5.Root.new("programWiseBar");


                                                // Set themes
                                                // https://www.amcharts.com/docs/v5/concepts/themes/
                                                root.setThemes([
                                                    am5themes_Animated.new(root)
                                                ]);


                                                // Create chart
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/
                                                var chart = root.container.children.push(am5xy.XYChart.new(root, {
                                                    panX: true,
                                                    panY: true,
                                                    wheelX: "panX",
                                                    wheelY: "zoomX"
                                                }));

                                                // Add cursor
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
                                                var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {}));
                                                cursor.lineY.set("visible", false);


                                                // Create axes
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
                                                var xRenderer = am5xy.AxisRendererX.new(root, {
                                                    minGridDistance: 30
                                                });
                                                xRenderer.labels.template.setAll({
                                                    rotation: -90,
                                                    centerY: am5.p50,
                                                    centerX: am5.p100,
                                                    paddingRight: 15
                                                });

                                                var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    categoryField: "category",
                                                    renderer: xRenderer,
                                                    tooltip: am5.Tooltip.new(root, {})
                                                }));

                                                var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
                                                    maxDeviation: 0.3,
                                                    renderer: am5xy.AxisRendererY.new(root, {})
                                                }));


                                                // Create series
                                                // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
                                                var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                                                    name: "Series 1",
                                                    xAxis: xAxis,
                                                    stacked: true,
                                                    yAxis: yAxis,
                                                    valueYField: "value",
                                                    sequencedInterpolation: true,
                                                    categoryXField: "category",
                                                    tooltip: am5.Tooltip.new(root, {
                                                        labelText: "{valueY}"
                                                    })
                                                }));

                                                series.columns.template.setAll({
                                                    cornerRadiusTL: 5,
                                                    cornerRadiusTR: 5
                                                });
                                                series.columns.template.adapters.add("fill", (fill, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });

                                                series.columns.template.adapters.add("stroke", (stroke, target) => {
                                                    return chart.get("colors").getIndex(series.columns.indexOf(
                                                        target));
                                                });


                                                // Set data
                                                var data = <?= json_encode($programWise) ?>;
                                                data = data.map(obj => {
                                                    // Map over all the keys in your object
                                                    Object.keys(obj).map(key => {
                                                        // Check if the key is numeric
                                                        if (!isNaN(obj[key])) {
                                                            obj[key] = +obj[key];
                                                        }
                                                    })
                                                    return obj;
                                                });


                                                xAxis.data.setAll(data);
                                                series.data.setAll(data);


                                                // Make stuff animate on load
                                                // https://www.amcharts.com/docs/v5/concepts/animations/
                                                series.appear(1000);
                                                chart.appear(1000, 100);

                                                var exporting = am5plugins_exporting.Exporting.new(root, {
                                                    menu: am5plugins_exporting.ExportingMenu.new(root, {}),
                                                    dataSource: data
                                                });

                                                exporting.events.on("dataprocessed", function(ev) {
                                                    for (var i = 0; i < ev.data.length; i++) {
                                                        ev.data[i].sum = ev.data[i].value + ev.data[i].value2;
                                                    }
                                                });

                                            }); // end am5.ready()
                                        </script>
                                        <div class="col-lg-12 mb-3">
                                            <div class="card gutter-b">
                                                <div style=" width: 100%;height: 600px; margin-left: auto; margin-right: auto;" id="programWiseBar"></div>
                                            </div>
                                        </div>
                                        <!-- Lead Program chart End -->


                                    </div>
                                </div>

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


    <script>
        const base_url = '<?= base_url() ?>';

        function reloadChart(id, btnId, p) {
            $('#' + btnId).prop('disabled', true)
            $.ajax({
                url: base_url + '/helper/' + p,
                type: 'POST',
                data: {
                    'country': p,
                },
                async: false,
                success: function(result) {
                    $('#' + btnId).prop('disabled', false)
                },
                error: function() {
                    //console.log(result)
                    $('#' + btnId).prop('disabled', false)
                    showFire(`error`, `Something Went Wrong on Server Side`);
                }
            })
            return;
        }
    </script>