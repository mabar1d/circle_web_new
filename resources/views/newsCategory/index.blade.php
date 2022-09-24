@extends('layout/dashboardLayout')

@section('plugin_css')
@endsection

@section('script_css')
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>News Category</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">News Category</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                                <div class="input-group-append">
                                    <button id="btnSearchTableNewsCategory" type="button" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tableNewsCategory"></div>
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-right">
                            <li class="page-item"><button type="button" id="btnPrevTableNewsCategory" data-page="1" class="page-link">&laquo;</button></li>
                            <li class="page-item"><button type="button" id="btnNextTableNewsCategory" data-page="2" class="page-link">&raquo;</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection

@section('plugin_js')
@endsection

@section('script_js')
<script>
    function renderTableNewsCategory(search, page) {
        $.ajax({
            url: "{{ url('newsCategory/getTable') }}",
            type: "GET",
            dataType: 'json',
            data: {
                "search": search,
                "page": page
            },
            beforeSend: function() {
                // App.blockUI({
                //     boxed: true
                // });
            },
            success: function(response) {
                if (response.code == '00') {
                    $("#tableNewsCategory").empty();
                    $("#tableNewsCategory").html(response.html);
                    $("#btnPrevTableNewsCategory").data("page", response.prevPage);
                    $("#btnNextTableNewsCategory").data("page", response.nextPage);
                } else {
                    alert(response.desc);
                }
            },
            error: function(error) {
                alert(error);
            }
        });
    }
    $(document).ready(function() {
        renderTableNewsCategory();
        $("#btnSearchTableNewsCategory").click(function(e) {
            e.preventDefault();
            let search = $("input[name=table_search]").val();
            renderTableNewsCategory(search, page);
        });
        $("#btnNextTableNewsCategory").click(function(e) {
            e.preventDefault();
            let search = $("input[name=table_search]").val();
            let page = $(this).data("page");
            renderTableNewsCategory(search, page);
        });
        $("#btnPrevTableNewsCategory").click(function(e) {
            e.preventDefault();
            let search = $("input[name=table_search]").val();
            let page = $(this).data("page");
            renderTableNewsCategory(search, page);
        });
    });
</script>
@endsection