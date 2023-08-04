@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
Details Of Invoices
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">List Of Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Details Of Invoices</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')



    <!-- row opened -->
    <div class="row row-sm">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    @if(session()->has('add'))

<div class="alert alert-success" role="alert">
<strong>{{session()->get('add')}}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="close">
<span aria-hidden="true">&times;</span>
</button>
</div>


@endif


	@if(session()->has('delete'))

<div class="alert alert-success" role="alert">
<strong>{{session()->get('delete')}}</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="close">
<span aria-hidden="true">&times;</span>
</button>
</div>


@endif
        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">Details</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">status</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">Attachments</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row">number of invoices</th>
                                                            <td>{{$invoices->invoices_number}}</td>
                                                            <th scope="row">invoices_Date</th>
                                                            <td>{{$invoices->invoices_Date}}</td>
                                                            <th scope="row"> due_date</th>
                                                            <td>{{$invoices->due_date}}</td>
                                                            <th scope="row">product</th>
                                                            <td>{{$invoices->product}}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">section</th>
                                                            <td>{{$invoices->sections->section_name}}</td>
                                                            <th scope="row"> Amount_collection</th>
                                                            <td>{{$invoices->Amount_collection}}</td>
                                                            <th scope="row">Amount_commision </th>
                                                            <td>{{$invoices->Amount_commision}}</td>
                                                            <th scope="row">discount</th>
                                                            <td>{{$invoices->discount}}</td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row">rate_vat </th>
                                                            <td>{{$invoices->rate_vat}}</td>
                                                            <th scope="row">rate_vat </th>
                                                            <td>{{$invoices->rate_vat}}</td>
                                                            <th scope="row">total</th>
                                                            <td>{{$invoices->total}}</td>
                                                            <th scope="row">status</th>
															<td>
															@if($invoices->value_status==1)
													  <span class="text-success">{{$invoices->status}}</span>
													  @elseif($invoices->value_status==2)
													  <span class="text-danger">{{$invoices->status}}</span>
													  @else
													  <span class="text-warning">{{$invoices->status}}</span>
													  @endif 
</td>

                                                        
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">note</th>
                                                            <td>{{$invoices->note}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>invoice_number</th>
                                                            <th>product</th>
                                                            <th>section_name</th>
                                                            <th>Status  </th>
                                                            <th>Payment_Date </th>
                                                            <th>note </th>
                                                            <th>created_at   </th>
                                                            <th>user </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php $i=0?>
													   @foreach($invoices_details as $deta)
													   <?php $i++?>    
													   <tr>
                                                                <td>{{$i}}</td>
                                                                <td>{{$deta->invoices_number}}</td>
                                                                <td>{{$deta->section}}</td>
                                                                <td>{{$invoices->sections->section_name}}</td>
                                                             
																<td>
															@if($deta->value_status==1)
													  <span class="text-success">{{$deta->status}}</span>
													  @elseif($deta->value_status==2)
													  <span class="text-danger">{{$deta->status}}</span>
													  @else
													  <span class="text-warning">{{$deta->status}}</span>
													  @endif 
</td>
                                                                <td> {{$deta->Payment_Date}}</td>
                                                                <td>{{$deta->note}}</td>
                                                                <td>{{$deta->created_at}}</td>
																<td>{{$deta->user}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>




										
                                        <div class="tab-pane" id="tab6">


                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                            @can('add archive')
                                                    <div class="card-body">
                                                        <p class="text-danger">* pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">Add Attachments</h5>
                                                        <form method="post" action="{{ url('/InvoiceAttachments') }}"
                                                        enctype="multipart/form-data"
                        autocomplete="off">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                    value="{{ $invoices->invoices_number }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $invoices->id }}">
                                                                <label class="custom-file-label" for="customFile">
                                                                    select Attachments</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">save</button>
                                                        </form>
                                                    </div>
                                                    @endcan

                                                <br>
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>section_name</th>
															<th>user </th>
                                                            <th>created_at   </th>
                                                           <th>opration</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <?php $i=0?>
													   @foreach($invoice as $deta)
													   <?php $i++?>    
													   <tr>
                                                                <td>{{$i}}</td>
                                                                <td>{{$deta->file_name}}</td>
                                                                <td>{{$deta->createadd}}</td>

                                
                                                               
                                                                <td>{{$deta->created_at}}</td>
																<td colspan="2">
																<a class="btn btn-outline-success btn-sm"
                                                                            href="{{ url('View_file') }}/{{ $invoices->invoices_number }}/{{ $deta->file_name }}"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            show</a>

																			<a class="btn btn-outline-info btn-sm"
																			href="{{ url('download') }}/{{ $invoices->invoices_number }}/{{ $deta->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            download</a>

                                                                            @can('delete archive')

																			<button class="btn btn-outline-danger btn-sm"
                                                                                data-toggle="modal"
                                                                                data-file_name="{{ $deta->file_name }}"
                                                                                data-invoice_number="{{ $deta->invoices_number }}"
                                                                                data-id_file="{{ $deta->id }}"
                                                                                data-target="#delete_file">delete</button>
                                                                                @endcan
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>

    </div>
    <!-- /row -->


    <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">delete Attachments</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('delete_file') }}" method="post">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p class="text-center">
                        <h6 style="color:red"> are you shore delete </h6>
                        </p>

                        <input type="hidden" name="id_file" id="id_file" value="">
                        <input type="hidden" name="file_name" id="file_name" value="">
                        <input type="hidden" name="invoice_number" id="invoice_number" value="">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-danger">تاكيد</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Container closed -->




    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>

	<script>
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
</script>
   

@endsection