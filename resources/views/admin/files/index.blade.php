
@extends('admin.index')
@section('admin') 

    <div class="col-md-12">
            <div class="card">
                <div class="card-body">
    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="file">Upload File:</label>
            <input type="file" id="file" name="file" class="form-control-file" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
    </form>
        </div>
    </div>
</div>
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

 
</div>

<div class="row">
    <div class="col-12 col-lg-3">
        <div class="card">
            <div class="card-body">
                <div class="d-grid"> <a href="javascript:;" class="btn btn-primary">+ Add File</a>
                </div>
                <h5 class="my-3">My Drive</h5>
                <div class="fm-menu">
                    <div class="list-group list-group-flush">
                        <a href="{{route('files.index')}}" class="list-group-item py-1"><i class='bx bx-devices me-2'></i><span>My files</span></a>
                        <a href="{{route('image.files')}}" class="list-group-item py-1"><i class='bx bx-analyse me-2'></i><span>images</span></a>
                        <a href="{{route('video.files')}}" class="list-group-item py-1"><i class='bx bx-plug me-2'></i><span>videos</span></a>
                  
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-0 text-primary font-weight-bold">45.5 GB <span class="float-end text-secondary">50 GB</span></h5>
                <p class="mb-0 mt-2"><span class="text-secondary">Used</span><span class="float-end text-primary">Upgrade</span>
                </p>
                <div class="progress mt-3" style="height:7px;">
                    <div class="progress-bar" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 20%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="mt-3"></div>
                <div class="d-flex align-items-center">
                    <div class="fm-file-box bg-light-primary text-primary"><i class='bx bx-image'></i>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h6 class="mb-0">Images</h6>
                        <p class="mb-0 text-secondary">1,756 files</p>
                    </div>
                    <h6 class="text-primary mb-0">15.3 GB</h6>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <div class="fm-file-box bg-light-success text-success"><i class='bx bxs-file-doc'></i>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h6 class="mb-0">Documents</h6>
                        <p class="mb-0 text-secondary">123 files</p>
                    </div>
                    <h6 class="text-primary mb-0">256 MB</h6>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <div class="fm-file-box bg-light-danger text-danger"><i class='bx bx-video'></i>
                    </div>
                    <div class="flex-grow-1 ms-2">
                        <h6 class="mb-0">Media Files</h6>
                        <p class="mb-0 text-secondary">24 files</p>
                    </div>
                    <h6 class="text-primary mb-0">3.4 GB</h6>
                </div>
             
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-9">
        <div class="card">
            <div class="card-body">
                <div class="fm-search">
                    <div class="mb-0">
                        <div class="input-group input-group-lg">	<span class="input-group-text bg-transparent"><i class='bx bx-search'></i></span>
                            <input type="text" class="form-control" placeholder="Search the files">
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 col-lg-4">
                        <div class="card shadow-none border radius-15">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fm-icon-box radius-15 bg-primary text-white"><i class='lni lni-google-drive'></i>
                                    </div>
                                    <div class="ms-auto font-24"><i class='bx bx-dots-horizontal-rounded'></i>
                                    </div>
                                </div>
                                <h5 class="mt-3 mb-0">Files</h5>
                                <p class="mb-1 mt-4"><span>45.5 GB</span>  <span class="float-end">50 GB</span>
                                </p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card shadow-none border radius-15">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fm-icon-box radius-15 bg-danger text-white"><i class='lni lni-dropbox-original'></i>
                                    </div>
                                    <div class="ms-auto font-24"><i class='bx bx-dots-horizontal-rounded'></i>
                                    </div>
                                </div>
                                <h5 class="mt-3 mb-0">images</h5>
                                <p class="mb-1 mt-4"><span>1,2 GB</span>  <span class="float-end">3 GB</span>
                                </p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 45%;" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="card shadow-none border radius-15">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="fm-icon-box radius-15 bg-warning text-dark"><i class='bx bxs-door-open'></i>
                                    </div>
                                    <div class="ms-auto font-24"><i class='bx bx-dots-horizontal-rounded'></i>
                                    </div>
                                </div>
                                <h5 class="mt-3 mb-0">files</h5>
                                <p class="mb-1 mt-4"><span>2,5 GB</span>  <span class="float-end">3 GB</span>
                                </p>
                                <div class="progress" style="height: 7px;">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end row-->
            
                <!--end row-->
                <div class="d-flex align-items-center">
                    <div>
                        <h5 class="mb-0">Recent Files</h5>
                    </div>
                    <div class="ms-auto"><a href="javascript:;" class="btn btn-sm btn-outline-secondary">View all</a>
                    </div>
                </div>
                <div class="table-responsive mt-3">
                    <table class="table table-striped table-hover table-sm mb-0">
                        <thead>
                            <tr>
                                <th>Name <i class='bx bx-up-arrow-alt ms-2'></i>
                                </th>
                                <th>Last Modified</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)




                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div><i class='bx bxs-file-pdf me-2 font-24 text-danger'></i>
                                        </div>
                                        <div class="font-weight-bold text-danger">        <a href="{{ asset('storage/' . $file->path) }}">{{ $file->name }}</a>
                                        </div>
                                    </div>
                                </td>

                                <td>{{$file->created_at}}</td>
                                <td><i class='bx bx-dots-horizontal-rounded font-24'></i>
                                </td>
                            </tr>
                           
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
