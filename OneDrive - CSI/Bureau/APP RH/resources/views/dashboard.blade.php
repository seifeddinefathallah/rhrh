@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
      <!-- Welcome Card -->
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Hello {{ Auth::user()->name }}! </h5>
            
              </div>
            </div>
          </div>
        </div>
      </div>

<!-- Leave Balances -->
<div class="col-lg-4 col-md-4 order-1">
  <div class="row">
    @foreach ($leaveBalances as $index => $balance)
      <div class="col-lg-12 col-md-6 col-12 mb-4">
        <div class="card {{ 'card-style-' . $index }}">
          <div class="card-body">
            <div class="d-flex align-items-start justify-content-between">
              <div class="avatar flex-shrink-0 ">
                <img src="{{ asset('backend/assets/img/icons/unicons/' . ($index === 0 ? 'wallet-info.png' : ($index === 1 ? 'chart-success.png' : ($index === 2 ? 'cc-warning.png' : 'wallet.png')))) }}" alt="Leave Type" class="rounded" />

              </div>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="cardOpt{{ $index }}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="bx bx-dots-vertical-rounded"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt{{ $index }}">
                  <a class="dropdown-item" href="javascript:void(0);">View More</a>
                  <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
              </div>
            </div>
            <h5 class="card-title mt-3">Congé {{ $balance->name }}</h5>
            <p class="mb-1">Jours restants: <span class="fw-bold">{{ $balance->remaining_days }} J</span></p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>



     
    </div>
  </div>
</div>
@endsection
