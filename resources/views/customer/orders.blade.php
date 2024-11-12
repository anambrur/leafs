@extends('frontend.master')
@section('title', 'Orders')
@section('content')
    <section class="common-section bg-black">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include('customer.left-sidebar')
                </div>
                <div class="col-sm-9">
                    <div class="account-panel">
                        <h2>Order
                            @isset($status)
                                @if ($status == 1)
                                    Completed
                                @elseif($status == 2)
                                    Progress
                                @elseif($status == 3)
                                    Pending
                                @else
                                    Canceled
                                @endif
                            @endisset List
                        </h2>
                        @if (count($orders) > 0)
                            <div class="account-panel-inner">
                                @foreach ($orders as $order)
                                    <div class="single-order">
                                        <div class="order-head clearfix">
                                            <h5 class="pull-left"><b>Order date:</b>
                                                {{ date('d-m-Y', strtotime($order->created_at)) }}</h5>
                                            <h5 class="pull-right"><b>Order ID:</b>
                                                {{ SM::orderNumberFormat($order) }}</h5>
                                        </div>
                                        <div class="order-content">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p><b>Order Total:</b> {{ SM::get_setting_value('currency') }}
                                                        {{ $order->grand_total }}</p>
                                                    <p><b>Paid:</b> {{ SM::get_setting_value('currency') }}
                                                        {{ $order->paid }}</p>
                                                    <?php
                                                    $due = $order->net_total - $order->paid;
                                                    $dueSign = $due < 0 ? '-' : '';
                                                    ?>
                                                    @if ($due > 0)
                                                        <p><b>Due:</b> {{ $dueSign }}
                                                            {{ SM::get_setting_value('currency') }}{{ abs($due) }}</p>
                                                        <a href="{{ url("dashboard/orders/pay/$order->id") }}"
                                                            class="btn btn-warning">Pay your Due</a>
                                                    @endif
                                                    <div class="order-btn">
                                                        <a title="View Invoice" target="_blank"
                                                            href="{{ url("dashboard/orders/detail/$order->id") }}"><i
                                                                class="fa fa-eye"></i></a>
                                                        <a title="Download Invoice"
                                                            href="{{ url("dashboard/orders/download/$order->id") }}"><i
                                                                class="fa fa-download"></i></a>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p><b>Order Status:</b>
                                                        @if ($order->order_status == 1)
                                                            Completed
                                                        @elseif ($order->order_status == 2)
                                                            Processing
                                                        @elseif ($order->order_status == 3)
                                                            Pending
                                                        @else
                                                            Canceled
                                                        @endif
                                                    </p>
                                                    <p><b>Payment Status:</b>
                                                        @if ($order->payment_status == 1)
                                                            Completed
                                                        @elseif ($order->payment_status == 2)
                                                            Pending
                                                        @else
                                                            Canceled
                                                        @endif
                                                    </p>

                                                    @if (!empty(trim($order->completed_files)))
                                                        <?php $files = SM::getMediaArrayFromStringImages($order->completed_files); ?>
                                                        @if (count($files) > 0)
                                                            <p><strong>Completed Files:</strong><br>
                                                                @foreach ($files as $file)
                                                                    <?php
                                                                    $filename = $file->slug;
                                                                    $img = SM::sm_get_galary_src_data_img($filename, $file->is_private == 1);
                                                                    ?>
                                                                    <a href="{{ url('/dashboard/media/download/' . $file->id) }}"
                                                                        title="Download {{ $file->title }}">
                                                                        <img src="{{ $img['src'] }}"
                                                                            caption="{{ $file->caption }}"
                                                                            description="{{ $file->description }}"
                                                                            class="orderFile">
                                                                    </a>
                                                                @endforeach
                                                            </p>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="text-center">
                                {!! $orders->links('common.pagination_orders') !!}
                            </div>
                        @else
                            <div class="alert alert-warning">
                                <i class="fa fa-warning"></i> No
                                @isset($status)
                                    @if ($status == 1)
                                        Completed
                                    @elseif($status == 2)
                                        Progress
                                    @elseif($status == 3)
                                        Pending
                                    @else
                                        Canceled
                                    @endif
                                @endisset
                                Order Found!
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
