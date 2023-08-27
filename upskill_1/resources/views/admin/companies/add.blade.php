@extends('admin.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('admin/companies/list') }}" class="text-muted">Companies </a>/</span> Add Companies</h4>
        <div class="col-md-12">
        <div class="row">
            <div class="card mb-4">
                    <div class="add-button p-2">
                    <a href="{{ url('admin/companies/list') }}" class="add_category btn btn-primary float-end">Back</a>
                    </div>
                    <form action="{{ url('admin/companies/add') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div>
                                <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 2000)">
                                @if(Session::has('success'))
                                    <div class="alert alert-success bg-green-300">
                                        {{ Session::get('success') }}
                                        @php
                                            Session::forget('success');
                                        @endphp
                                    </div>
                                 @endif
                                </div>
                                <div>
                                    <label for="defaultFormControlInput" class="form-label">Company Name</label>
                                    <input type="text" name="companies_name" class="form-control" id="defaultFormControlInput" placeholder="Company Name" aria-describedby="defaultFormControlHelp" >
                                    @error('companies_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
                                <div>
                                <label for="defaultFormControlInput1" class="form-label">Company image</label>
                                <input type="file" name="image" class="form-control" id="defaultFormControlInput1" placeholder="Company image" aria-describedby="defaultFormControlHelp" >

                                @error('image')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-dark mt-3" type="submit" name="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
