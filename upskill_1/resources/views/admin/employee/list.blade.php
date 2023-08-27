@extends('admin.master')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ url('admin/employee/list') }}" class="text-muted">Employee </a> /</span> Employee List</h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <div class="add-button p-2">
            <a href="{{ url('admin/employee/add') }}" class="add_category btn btn-primary float-end">Add</a>
        </div>
        <div class="table-responsive text-nowrap p-2">
            <div x-data="{ showMessage: true }" x-show="showMessage" x-init="setTimeout(() => showMessage = false, 2000)">
                @if(Session::has('success'))
                    <div class="alert alert-warning bg-green-300">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    
                 @endif
            </div>
            <table class="table table-striped table-bordered" id="example">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Companies Name</th>
                        <th>Companies Image</th>
                        <th>Create Date</th>
                        <td>Update Date</td>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <div style="display: none">{{ $no = 0; }}</div>
                    {{-- @foreach ($Companies as $row)
                    <div style="display: none">{{ $no++}}</div>
                      <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$no; }}</strong></td>
                          <td>{{ $row->companies_name }}</td>
                          <td> <img src="{{ asset('storage/images/'.$row->image) }}" class="img-fluid img-thumbnail" width="80"></td>
                          <td>{{ $row->created_at }}</td>
                          <td>{{ $row->updated_at }}</td>
                          <td><span class="badge bg-label-primary me-1">  </span></td>
                          <td>
                              <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                      <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                      <a class="dropdown-item" href="{{route('companies.edit',$row->id)}}"><i class="bx bx-edit-alt me-1"></i>
                                          Edit</a>
                                      <a class="dropdown-item deleteRecord" href="{{route('companies.destroy',$row->id)}}" data-toggle="modal" data-confirm="Confirm delete?" id="smallButton" data-target="#smallModal" data-attr="" title="Delete Category Record"><i class="bx bx-trash me-1"></i>
                                          Delete</a>
                                  </div>
                              </div>
                          </td>
                      </tr>
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection
