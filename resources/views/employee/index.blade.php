@extends('layouts.template')
@section('title','Dashboard')
@section('sub-judul','Karyawan')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-6">
            <form action="{{ route('employee.index') }}" method="GET" class="flex-grow-1 mr-2" id="searchForm">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" placeholder="Search" name="search" id="searchInput" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
            
        </div>
        <div class="col-6">
    <div class="d-flex justify-content-end">
        <a href="{{ route('employee.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i></a>

        </div>
    </div>
        
    </div>
    
    <div class="row">
        @foreach($employees as $employee)
        <div class="col-md-6 mt-4">
            <a href="{{ route('employee.show', $employee->id) }}" style="text-decoration: none; color: inherit;">
                <div class="card mb-3 shadow-lg" style="max-width: 540px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <img src="{{ asset('/storage/pictures/'. $employee->picture) }}" class="card-img h-100 w-100" style="object-fit: cover; max-height: 200px;" alt="Employee Picture">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-9">
                                        <h5>{{ ucfirst($employee->name) }}</h5>
                                    </div>
                                    <div class="col-3">
                                        @if($employee->status == 'active')
                                            <span style="color:black;" class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger font-weight-bold">Non Aktif</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="card-text">
                                    <i class="fas fa-info-circle"></i> {{ ucfirst($employee->employment_status) }} <br>
                                    @if($employee->careerHistories->isNotEmpty())
                                        @php
                                            $latestCareerHistory = $employee->careerHistories->last();
                                        @endphp
                                        <span><i class="fas fa-building"></i> </span>{{ ucfirst($latestCareerHistory->department->name) }}<br>
                                        <span><i class="fas fa-user-alt"></i> </span>{{ ucfirst($latestCareerHistory->position->job_position) }}<br>
                                    @endif
                                    <i class="fas fa-business-time"></i> {{ \Carbon\Carbon::parse($employee->joining_date)->diff(\Carbon\Carbon::now())->format('%y tahun, %m bulan, %d hari') }}<br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>            
        </div>
        
        @endforeach
    </div>
    <div class="pagination mt-3" style="display: flex; justify-content:center;">
        {{ $employees->onEachSide(1)->render('pagination::bootstrap-4') }}
    </div>
  </div>         
  </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                $('#searchForm').submit();
            });
        });
    </script>

@endsection
