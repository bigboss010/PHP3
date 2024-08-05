@extends('layouts.admins.master')

@section('title')
    {{ $title }}
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css">
    <style>
        .custom-control-input.bg-primary:checked~.custom-control-label::before {
            background-color: #007bff;
            border-color: #007bff;
        }

        .custom-control-input.bg-danger:checked~.custom-control-label::before {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .custom-control-input.bg-success:checked~.custom-control-label::before {
            background-color: #28a745;
            border-color: #28a745;
        }

        .ck.ck-editor__main>.ck-editor__editable:not(.ck-focused) {
            border-color: var(--ck-color-base-border);
            height: 200px;
        }
    </style>
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
                    <form action="{{ route('admin.pet.store') }}" method="POST" enctype="multipart/form-data" class="m-3">
                        @csrf
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="mb-3">
                                    <label for="ma_pet" class="form-lable">Mã pet:</label>
                                    <input type="text" @error('ma_pet') is-invalid @enderror class="form-control"
                                        id="ma_pet" value="{{ old('ma_pet') }}" name="ma_pet" placeholder="Mã pet">
                                    @error('ma_pet')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ten_pet" class="form-lable">Tên pet:</label>
                                    <input type="text" @error('ten_pet') is-invalid @enderror class="form-control"
                                        id="ten_pet" value="{{ old('ten_pet') }}" name="ten_pet" placeholder="Tên pet">
                                    @error('ten_pet')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="danh_muc_id" class="form-lable">Tên danh mục:</label>
                                    <select name="danh_muc_id" @error('danh_muc_id') is-invalid @enderror
                                        class="form-control form-select" id="danh_muc_id">
                                        <option selected>-- Vui lòng chọn danh mục --</option>
                                        @foreach ($danhMucs as $item)
                                            <option value="{{ $item->id }}"
                                                {{ old('ten_pet') == $item->id ? 'selected' : '' }}>
                                                {{ $item->ten_danh_muc }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('danh_muc_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="so_luong" class="form-lable">Số lượng:</label>
                                    <input type="number" @error('so_luong') is-invalid @enderror class="form-control"
                                        min="1" value="{{ old('so_luong') }}" id="so_luong" name="so_luong"
                                        placeholder="Số lượng pet">
                                    @error('so_luong')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gia_pet" class="form-lable">Giá gốc:</label>
                                    <input type="number" @error('gia_pet') is-invalid @enderror
                                        class="form-control" id="gia_pet" value="{{ old('gia_pet') }}" name="gia_pet"
                                        placeholder="Giá gốc">
                                    @error('gia_pet')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="gia_khuyen_mai" class="form-lable">Giá khuyến mại:</label>
                                    <input type="number" @error('gia_khuyen_mai') is-invalid @enderror
                                        class="form-control" value="{{ old('gia_khuyen_mai') }}" id="gia_khuyen_mai"
                                        name="gia_khuyen_mai" placeholder="Giá khuyến mại">
                                    @error('gia_khuyen_mai')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="ngay_nhap" class="form-lable">Ngày nhập:</label>
                                    <input type="date" @error('ngay_nhap') is-invalid @enderror class="form-control"
                                        id="ngay_nhap" value="{{ old('ngay_nhap') }}" name="ngay_nhap"
                                        placeholder="Mã pet">
                                    @error('ngay_nhap')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="mota" class="form-lable">Mô tả ngắn:</label>
                                    <textarea @error('mota') is-invalid @enderror class="form-control" name="mota" id="mota" cols="30"
                                        rows="3" placeholder="Mô tả ngắn">{{ old('mota') }}</textarea>
                                    @error('mota')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-2 ps-3 d-flex justify-content-between">
                                    <label for="trang_thai" class="form-lable">Trạng thái:</label>
                                    <div class="col-sm-10 mb-3 d-flex gap-2">
                                        <div class="form-check mr-3">
                                            <input type="radio" class="form-check-input" id="trang_thai"
                                                value="1" name="trang_thai" checked>
                                            <label for="trang_thai" class="form-check-lable">
                                                Hiển thị
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" id="trang_thai"
                                                value="0" name="trang_thai">
                                            <label for="trang_thai" class="form-check-lable">
                                                Ẩn
                                            </label>
                                        </div>
                                    </div>
                                    @error('trang_thai')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3 ps-3 d-flex justify-content-between">
                                    <label for="" class="form-lable">Tùy chỉnh khác:</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input bg-primary" name="is_new"
                                            id="is_new" checked>
                                        <label class="custom-control-label" for="is_new">New</label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input bg-danger" name="is_hot"
                                            id="is_hot" checked>
                                        <label class="custom-control-label" for="is_hot">Hot</label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input bg-success" name="is_home"
                                            id="is_home" checked>
                                        <label class="custom-control-label" for="is_home">Home</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                               <div class="mb-3">
                                <label for="mo_ta_chi_tiet" class="form-lable">Mô tả chi tiết:</label>
                                <textarea @error('mo_ta_chi_tiet') is-invalid @enderror id="mo_ta_chi_tiet" name="mo_ta_chi_tiet"
                                    class="form-control" cols="30" placeholder="Mô tả chi tiết" rows="5">{{ old('mo_ta_chi_tiet') }}</textarea>
                                @error('mo_ta_chi_tiet')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                               </div>
                               <div class="mb-3">
                                <label for="image">Hình ảnh:</label>
                                <input type="file" class="form-control-file" id="image" name="image"
                                    onchange="showImage(event)">
                                <div class="text-center mt-3">
                                    <img id="img" src="" alt="Hình ảnh" class="img-thumbnail"
                                        style="width:150px; display: none;">
                                </div>
                                </div>
                                <div class="mb-3">
                                    <label for="link_anh">Album hình ảnh:</label>
                                <i id="add-row" class="fas fa-plus ml-2" style="cursor: pointer;"></i>
                                <table class="table table-bordered table-hover table-striped mb-0">
                                    <tbody id="image-table-body">
                                        <tr>
                                            <td class="d-flex align-items-center">
                                                <img id="preview_0"
                                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                                                    alt="Hình ảnh" style="width:50px;" class="mr-2 img-thumbnail">
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

                            <a href="{{ route('admin.pet.index') }}"><button type="button" class="btn btn-info">Danh
                                    sách</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    {{-- CKEditor --}}
    <script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
        }
    }
    </script>
    <script type="module">
        import {
            ClassicEditor,
            Essentials,
            Paragraph,
            Bold,
            Italic,
            Font,
            Heading,
            Alignment,
            List,
            Link,
            Image,
            ImageToolbar,
            ImageCaption,
            ImageStyle,
            ImageResize,
            Table,
            TableToolbar,
            BlockQuote,
            CodeBlock
        } from 'ckeditor5';

        ClassicEditor
            .create(document.querySelector('#mo_ta_chi_tiet'), {
                plugins: [
                    Essentials, Paragraph, Bold, Italic, Font, Heading, Alignment,
                    List, Link, Image, ImageToolbar, ImageCaption, ImageStyle, ImageResize,
                    Table, TableToolbar, BlockQuote, CodeBlock
                ],
                toolbar: [
                    'undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link', '|',
                    'bulletedList', 'numberedList', '|', 'alignment:left', 'alignment:center',
                    'alignment:right', 'alignment:justify', '|', 'insertTable', 'blockQuote',
                    'codeBlock', '|', 'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                    'imageUpload', 'imageInsert'
                ],
                image: {
                    toolbar: [
                        'imageTextAlternative', 'imageStyle:full', 'imageStyle:side', 'imageResize'
                    ],
                    styles: [
                        'full', 'side'
                    ],
                    resizeOptions: [{
                            name: 'resizeImage:original',
                            label: 'Original',
                            value: null
                        },
                        {
                            name: 'resizeImage:50',
                            label: '50%',
                            value: '50'
                        },
                        {
                            name: 'resizeImage:75',
                            label: '75%',
                            value: '75'
                        }
                    ]
                },
                table: {
                    contentToolbar: [
                        'tableColumn', 'tableRow', 'mergeTableCells'
                    ]
                }
            })
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    <!-- A friendly reminder to run on a server, remove this during the integration. -->
    <script>
        window.onload = function() {
            if (window.location.protocol === 'file:') {
                alert('This sample requires an HTTP server. Please serve this file with a web server.');
            }
        };
    </script>
    {{-- Show hình ảnh --}}
    <script>
        function showImage(event) {
            const img = document.getElementById('img');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function() {
                img.src = reader.result;
                img.style.display = 'block';
            }
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>

    {{-- Thêm album ảnh --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rowCount = 1;

            document.getElementById('add-row').addEventListener('click', function() {
                var tableBody = document.getElementById('image-table-body');

                var newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td class="d-flex align-items-center">
                        <img id="preview_${rowCount}"
                            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS0Wr3oWsq6KobkPqznhl09Wum9ujEihaUT4Q&s"
                            alt="Hình ảnh" style="width:50px;" class="mr-2 img-thumbnail">
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
