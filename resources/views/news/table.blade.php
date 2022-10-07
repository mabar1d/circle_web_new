<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>Title</th>
                <th>News Category</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listData as $rowData)
            <tr>
                <td>{{$rowData["title"]}}</td>
                <td>{{$rowData["news_category"]}}</td>
                <td>{{$rowData["status"]}}</td>
                <td>
                    <a href="listNews/detailNews/{{ $rowData['slug'] }}" target="_blank" class="btn btn-success" id="btn_detail"><i class="far fa-eye"></i></a>
                    <button type="button" class="btn btn-warning" id="btn_edit" value="{{ $rowData['id_news'] }}"><i class="far fa-edit"></i></button>
                    <button type="button" class="btn btn-danger" id="btn_delete" value="{{ $rowData['id_news'] }}"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>