@extends('layout/detailNewsLayout')

@section('plugin_css')
@endsection

@section('script_css')
@endsection

@section('content')

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <div class="content-wrapper">

            <div>
                <div class="container">
                    <div class="row">
                        <div class="text-center">
                            <h1>{{$data->title}}</h1>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container">
                    <div class="text-center">
                        <img style="width: 700px;" src="{{ $data->image }}" alt="image-news">
                    </div>
                    <div class="row text-justify">
                        <p>{{$data->content}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <aside class="control-sidebar control-sidebar-dark">

    </aside>


    <footer class="main-footer">

        <div class="float-right d-none d-sm-inline">
            Anything you want
        </div>

        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
    </div>



    <!-- jQuery -->
    <script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
</body>

</html>