@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <div>
            <h1 class="h3 text-gray-800">{{ $title }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.slider.store') }}" method="POST" enctype="multipart/form-data"
                        class="m-3">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="link_anh">Album hình ảnh:</label>
                                    <i id="add-row" class="fas fa-plus ml-2" style="cursor: pointer;"></i>
                                    <table class="table table-bordered table-hover table-striped mb-0">
                                        <tbody id="image-table-body">
                                            <tr>
                                                <td>
                                                    <label for="Alt" class="form-lable">Alt:</label>
                                                    <input type="text" @error('Alt') is-invalid @enderror
                                                        class="form-control" id="alt" value="{{ old('Alt') }}"
                                                        name="alt[0]" placeholder="Alt">
                                                    @error('alt')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                                <td class="d-flex align-items-center">
                                                    <img id="preview_0"
                                                        src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                                                        alt="Hình ảnh" style="width:100px;" class="mr-2 img-thumbnail">
                                                    <input type="file" class="form-control-file ml-2" id="link_anh"
                                                        name="list_hinh_anh[id_0]" onchange="previewImage(this, 0)">
                                                </td>
                                                <td class="text-center align-middle">
                                                    <i class="fas fa-trash" style="cursor: pointer;"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-success mr-2">Thêm mới</button>

                            <a href="{{ route('admin.slider.index') }}"><button type="button" class="btn btn-info">Danh
                                    sách</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- Thêm album ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = 1;

            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.getElementById('image-table-body');

                var newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td>
                        <label for="Alt" class="form-lable">Alt:</label>
                        <input type="text" @error('Alt') is-invalid @enderror class="form-control"
                            id="alt" value="{{ old('Alt') }}" name="alt[${rowCount}]" placeholder="Alt">
                        @error('Alt')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </td>
                    <td class="d-flex align-items-center">
                        <img id="preview_${rowCount}"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                            alt="Hình ảnh" style="width:100px;" class="mr-2 img-thumbnail">
                        <input type="file" class="form-control-file ml-2" id="link_anh" name="list_hinh_anh[id_${rowCount}]"
                            onchange="previewImage(this, ${rowCount})">
                    </td>
                    <td class="text-center align-middle">
                        <i class="fas fa-trash" style="cursor: pointer;" onclick="deleteRow(this)"></i>
                    </td>
                `;

                tableBody.appendChild(newRow);
                rowCount++;
            });
        });

        function previewImage(input, rowIndex) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById(`preview_${rowIndex}`).setAttribute('src', e.target.result)
                }
                reader.readAsDataURL(input.files[0])
            }
        }

        function deleteRow(item) {
            var row = item.closest('tr');
            row.remove();
        }
    </script>
@endsection
