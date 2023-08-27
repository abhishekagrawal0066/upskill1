@extends('admin.master')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('admin/employee/list') }}" class="text-muted">Employee </a>/</span> Add Employee</h4>
        <div class="col-md-12">
        <div class="row">
            <div class="card mb-4">
                    <div class="add-button p-2">
                    <a href="{{ url('admin/employee/list') }}" class="add_category btn btn-primary float-end">Back</a>
                    </div>
                    <form action="{{ url('admin/employee/add') }}" method="post" enctype="multipart/form-data">
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
                                    <label for="defaultFormControlInput" class="form-label">Select Company</label>
                                    <select name="company_name" id="defaultFormControlInput" class="form-select">
                                        <option value="">Select Company</option>
                                        @foreach ($Companies as $row)
                                            <option value="{{ $row->companies_name }}">{{$row->companies_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('company_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <br>
                                <div>
                                <label for="defaultFormControlInput1" class="form-label">Employee Name</label>
                                <input type="text" name="employee_name" class="form-control" id="defaultFormControlInput1" placeholder="Employee Name" aria-describedby="defaultFormControlHelp" >

                                @error('employee_name')
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
