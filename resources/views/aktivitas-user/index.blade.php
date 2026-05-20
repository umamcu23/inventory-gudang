@extends('layouts.app')

@include('hak-akses.create')
{{-- @include('data-pengguna.edit') --}}

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="modern-table-card">

            <!-- HEADER -->
            <div class="modern-table-header">

                <div class="modern-table-header-left">

                    <div class="modern-table-icon">
                        <i class="fa fa-history"></i>
                    </div>

                    <div>
                        <h5 class="modern-table-title">
                            Aktivitas User
                        </h5>

                        <p class="modern-table-subtitle">
                            Riwayat perubahan data yang dilakukan user sistem
                        </p>
                    </div>

                </div>

                <div class="modern-table-header-right">

                    <div class="modern-table-chip">
                        Audit Log
                    </div>

                </div>

            </div>

            <!-- TABLE -->
            <div class="table-responsive modern-table-wrapper">

                <table id="table_id"
                       class="table modern-table align-middle mb-0">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>User</th>
                            <th>Before</th>
                            <th>After</th>
                            <th>Description</th>
                            <th>Log At</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($logs as $log)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                @if ($log->causer !== null)
                                    <span class="badge badge-light">
                                        {{ $log->causer->name }}
                                    </span>
                                @endif
                            </td>

                            <td>
                                @if (isset($log->changes['old']))
                                    @foreach ($log->changes['old'] as $key => $itemChange)
                                        <div>{{ $key }} : {{ $itemChange }}</div>
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                @if (isset($log->changes['attributes']))
                                    @foreach ($log->changes['attributes'] as $key => $itemChange)
                                        <div>{{ $key }} : {{ $itemChange }}</div>
                                    @endforeach
                                @endif
                            </td>

                            <td>
                                <span class="badge badge-info">
                                    {{ $log->description }}
                                </span>
                            </td>

                            <td>
                                <small class="text-muted">
                                    {{ $log->created_at->format('d-m-Y H:i:s') }}
                                </small>
                            </td>

                        </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
</div>

<!-- Datatables Jquery -->
<script>
    $(document).ready(function(){
        $('#table_id').DataTable({
            paging: true
        });
    })
</script>


@endsection