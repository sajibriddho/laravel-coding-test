@extends('backend.master_layout')
@section('dashboard_active', 'active')
@section('main_content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">{{ 'Transactions' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">{{ 'Transactions' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card custom__card--datatable shadow">
                        <div class="card-header pt-0">
                            <h3 class="card-title">All Users</h3>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <table class="table custom__table--two">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($users as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->balance }}</td>
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
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="card custom__card--datatable shadow">
                        <div class="card-header pt-0">
                            <h3 class="card-title">All Trsansactions</h3>
                        </div>
                        <div class="card-body px-0 pt-0">
                            <table class="table custom__table--two">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Transaction Type</th>
                                        <th>Amount</th>
                                        <th>Fee</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = $allTransactions->perPage() * ($allTransactions->currentPage() - 1) + 1;
                                        $itemsOnCurrentPage = 0;
                                    @endphp
                                    @forelse ($allTransactions as $row)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ '0' . $row->user_id . ' - ' . $row->user->name }}
                                                ({{ $row->user->account_type }})
                                            </td>
                                            <td>{{ $row->date }}</td>
                                            <td>
                                                @if ($row->transaction_type == 'deposit')
                                                    <span class="badge badge-primary">Deposit</span>
                                                @else
                                                    <span class="badge badge-success">Withdrawal</span>
                                                @endif
                                            </td>
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
                                                <span>Showing <?= count($allTransactions) ?> of <?= $totalRows ?>
                                                    rows</span>
                                                <span><?php if ($allTransactions->hasPages()) {
                                                    echo $allTransactions->links('pagination::bootstrap-4');
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
