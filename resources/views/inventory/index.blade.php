@extends('adminlte::page')

@section('preloader')
<div id="loader" class="loader">
    <div class="loader-content">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h4 class="mt-4 text-dark">Loading...</h4>
    </div>
</div>
<style>
    /* Loader */
    .loader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease-out;
    }

    .loader-content {
        text-align: center;
    }

    /* Wave Loader */
    .wave-loader {
        display: flex;
        justify-content: center;
        align-items: flex-end;
        height: 50px;
    }

    .wave-loader > div {
        width: 10px;
        height: 50px;
        margin: 0 5px;
        background-color: #8e44ad; /* Purple color */
        animation: wave 1s ease-in-out infinite;
    }

    .wave-loader > div:nth-child(2) {
        animation-delay: -0.9s;
    }

    .wave-loader > div:nth-child(3) {
        animation-delay: -0.8s;
    }

    .wave-loader > div:nth-child(4) {
        animation-delay: -0.7s;
    }

    .wave-loader > div:nth-child(5) {
        animation-delay: -0.6s;
    }

    @keyframes wave {
        0%, 100% {
            transform: scaleY(0.5);
        }
        50% {
            transform: scaleY(1);
        }
    }
</style>
@stop

@section('content')
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Inventory List</h3>
                        <div class="card-tools">
                            @can('inventory-create')
                            <a href="{{ route('inventory.create') }}" class="btn btn-success btn-sm rounded-pill">
                                Add Inventory <i class="fas fa-plus-circle"></i>
                            </a>
                            @endcan
                            <!-- Trigger Modal for Import -->
                            <button type="button" class="btn btn-primary btn-sm rounded-pill" data-toggle="modal" data-target="#importModal">
                                Import Inventory <i class="fas fa-file-import"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="importModalLabel">Import Inventory</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form inside modal -->
                                    <form id="importForm" action="{{ route('inventory.import') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="file">Choose Excel or CSV file</label>
                                            <input type="file" name="file" class="form-control" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Import</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">{{ $message }}</div>
                        @endif
                        <table id="inventory-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventory as $inventory)
                                    <tr>
                                        <td>{{ $inventory->id }}</td>
                                        <td>{{ $inventory->name }}</td>
                                        <td>{{ $inventory->description }}</td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    @can('inventory-edit')
                                                        <a class="dropdown-item" href="{{ route('inventory.edit',$inventory->id) }}"><i class="fas fa-edit"></i>&nbsp;Edit</a>
                                                    @endcan
                                                    @can('inventory-delete')
                                                        <form action="{{ route('inventory.destroy', $inventory->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this inventory?')"><i class="fas fa-trash"></i>&nbsp;Delete</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-md-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#inventory-table').DataTable();
        });
    </script>
@endsection