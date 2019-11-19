<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Laravel Opcache Gui">
    <meta name="author" content="aping">

    <title>Laravel Opcache Gui</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body style="padding-top:70px;">

<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Laravel Opcache GUI</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">{{ $opcache->version() }}</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right" id="nav-tabs">
                <li class="active"><a href="#status" aria-controls="status" role="tab" data-toggle="tab">STATUS</a></li>
                <li><a href="#configuration" aria-controls="configuration" role="tab" data-toggle="tab">CONFIGURATION</a></li>
                <li><a href="#scripts" aria-controls="scripts" role="tab" data-toggle="tab">CACHED SCRIPTS ({{ $opcache->opcacheStatistics('num_cached_scripts') }})</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="tab-content">
        <div class="tab-pane fade active in" id="status">
            <div class="row">
                <div class="col-md-8">
                    <!-- STATUS -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">STATUS</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tbody>
                                @foreach($opcache->opcacheStatus() as $key => $value)
                                    <tr>
                                        <th scope="row" width="400">{{ $key }}</th>
                                        <td>{{ value_format($value, $key) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- MEMORY USAGE -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">MEMORY USAGE</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tbody>
                                @foreach($opcache->memoryUsage() as $key => $value)
                                    <tr>
                                        <th scope="row" width="400">{{ $key }}</th>
                                        <td>{{ value_format($value, $key) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- INTERNED STRINGS USAGE -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">INTERNED STRINGS USAGE</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tbody>
                                @foreach($opcache->internedStringsUsage() as $key => $value)
                                    <tr>
                                        <th scope="row" width="400">{{ $key }}</th>
                                        <td>{{ value_format($value, $key) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- OPCACHE STATISTICS -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">OPCACHE STATISTICS</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tbody>
                                @foreach($opcache->opcacheStatistics() as $key => $value)
                                    <tr>
                                        <th scope="row" width="400">{{ $key }}</th>
                                        <td>{{ value_format($value, $key) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">MEMORY (bytes)</h3>
                        </div>
                        <div class="panel-body" style="text-align: center;">
                            <canvas class="chart" height="300"></canvas>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">KEYS</h3>
                        </div>
                        <div class="panel-body" style="text-align: center;">
                            <canvas class="chart" height="300"></canvas>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">HITS</h3>
                        </div>
                        <div class="panel-body" style="text-align: center;">
                            <canvas class="chart" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="configuration">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">CONFIGURATION</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                        @foreach($opcache->directives() as $key => $value)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ value_format($value, $key) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="scripts">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">SCRIPTS</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Hits</th>
                                <th>Memory</th>
                                <th>Path</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($opcache->scripts() as $value)
                            <tr>
                                <td>{{ $value['hits'] }}</td>
                                <td>{{ value_format($value['memory_consumption'], 'memory_consumption') }}</td>
                                <td>{{ $value['full_path'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.bootcss.com/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdn.bootcss.com/Chart.js/1.1.1/Chart.min.js"></script>
<script type="text/javascript">
    $(function () {
        function showChart(ctx, data) {
            return new Chart(ctx.getContext("2d")).Pie(data, {});
        }
        //memory
        showChart($('.chart').get(0), [
            {
                value: eval('{{ $opcache->memoryUsage('used_memory') }}'),
                color: "#F7464A",
                highlight: "#FF5A5E",
                label: "used"
            },
            {
                value: eval('{{ $opcache->memoryUsage('free_memory') }}'),
                color:"#46BFBD",
                highlight: "#5AD3D1",
                label: "free"
            },
            {
                value: eval('{{ $opcache->memoryUsage('wasted_memory') }}'),
                color:"#FDB45C",
                highlight: "#FFC870",
                label: "wasted"
            }
        ]);
        //keys
        showChart($('.chart').get(1), [
            {
                value: eval('{{ $opcache->opcacheStatistics('num_cached_keys') }}'),
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "cached"
            },
            {
                value: eval('{{ $opcache->opcacheStatistics('max_cached_keys') - $opcache->opcacheStatistics('num_cached_keys') }}'),
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "free"
            }
        ]);
        //hits
        showChart($('.chart').get(2), [
            {
                value: eval('{{ $opcache->opcacheStatistics('misses') }}'),
                color: "#46BFBD",
                highlight: "#5AD3D1",
                label: "misses"
            },
            {
                value: eval('{{ $opcache->opcacheStatistics('hits') }}'),
                color:"#F7464A",
                highlight: "#FF5A5E",
                label: "hits"
            }
        ]);
    });
</script>
</body>
</html>