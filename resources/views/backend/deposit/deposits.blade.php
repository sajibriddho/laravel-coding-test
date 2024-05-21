@extends('backend.master_layout')
@section('deposit_active', 'active')
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ 'Deposits' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ 'Deposits' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card custom__card__px--medical shadow">
                        <div class="card-header">
                            <h3 class="card-title">Deposit Amount</h3>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('deposit') }}" method="POST" enctype="multipart/form-data"
                                class="custom__form--one">
                                @csrf
                                <div class="form-group">
                                    <label for="">Select User
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-control select2bs4" name="user_id" id="" required>
                                        <option value="" selected disabled>Select User</option>
                                        @forelse ($users as $row)
                                            <option value="{{ $row->id }}"
                                                {{ old('user_id') == $row->id ? 'selected' : '' }}>
                                                {{ '0' . $row->id }} - {{ $row->name }} ({{ $row->account_type }})
                                            </option>
                                        @empty
                                            <option value="" disabled>No users available</option>
                                        @endforelse
                                    </select>
                                    @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Amount
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="amount" class="form-control" id=""
                                        placeholder="Enter Amount" value="{{ old('amount') }}" required />
                                    @error('amount')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group mt-4">
                                    <button type="submit" class="custom__button btn__sky__blue">
                                        <i class="fa-solid fa-floppy-disk mr-1"></i>
                                        Submit
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer"></div>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="card custom__card__px--medical shadow">
                        <div class="card-header">
                            <h3 class="card-title">Deposited Amounts</h3>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <table class="table custom__table--two">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = $deposits->perPage() * ($deposits->currentPage() - 1) + 1;
                                        $itemsOnCurrentPage = 0;
                                    @endphp
                                    @forelse ($deposits as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ '0' . $row->user_id . ' - ' . $row->user->name }}
                                                ({{ $row->user->account_type }})
                                            </td>
                                            <td>{{ $row->date }}</td>
                                            <td>{{ $row->amount }}</td>
                                            <td>{{ $row->fee }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <img src="{{ URL::asset('assets/backend/images/Ghost.gif') }}"
                                                    height="80px" width="auto" class="py-2" alt="">
                                                <br>
                                                <span>No data Found</span>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="100">
                                            <div class="d-flex " style="justify-content: space-between;">
                                                <span>Showing <?= count($deposits) ?> of <?= $totalRows ?>
                                                    rows</span>
                                                <span><?php if ($deposits->hasPages()) {
                                                    echo $deposits->links('pagination::bootstrap-4');
                                                } ?>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
