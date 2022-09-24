<div class="card-body table-responsive p-0">
    <table class="table table-hover text-nowrap">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listData as $rowData)
            <tr>
                <td>{{$rowData["name"]}}</td>
                <td>{{$rowData["desc"]}}</td>
                <td>{{$rowData["status"]}}</td>
                <td>Action</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>