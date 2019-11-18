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
                <span class="sr-only">Toggle navigation</span>
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
                <li><a href="#scripts" aria-controls="scripts" role="tab" data-toggle="tab">CACHED SCRIPTS ({{ $opcache->countScripts() }})</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    <div class="tab-content">
        <div class="tab-pane fade active in" id="status">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">STATUS</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                        @foreach($opcache->opcacheStatus() as $key => $value)
                            <tr>
                                <th scope="row" width="600">{{ $key }}</th>
                                <td>{{ is_bool($value) ? ($value ? 'true' : 'false') : $value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">MEMORY USAGE</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                        @foreach($opcache->memoryUsage() as $key => $value)
                            <tr>
                                <th scope="row" width="600">{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">INTERNED STRINGS USAGE</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                        @foreach($opcache->internedStringsUsage() as $key => $value)
                            <tr>
                                <th scope="row" width="600">{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">OPCACHE STATISTICS</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                        @foreach($opcache->opcacheStatistics() as $key => $value)
                            <tr>
                                <th scope="row" width="600">{{ $key }}</th>
                                <td>{{ $value }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
                                <td>{{ $value }}</td>
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
                                <th>path</th>
                                <th>hits</th>
                                <th>last used</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($opcache->scripts() as $value)
                            <tr>
                                <td>{{ $value['full_path'] }}</td>
                                <td>{{ $value['hits'] }}</td>
                                <td>{{ date('Y-m-d H:i:s', $value['last_used_timestamp']) }}</td>
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
</body>
</html>