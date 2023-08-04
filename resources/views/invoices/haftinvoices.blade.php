@extends('layouts.master')
@section('title')
Partial Of Invoices
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<!--Internal   Notify -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Invoices</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ paid Of Invoices</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">
					<!--div-->
					<div class="col-xl-12">

						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								<div class="col-sm-6 col-md-4 col-xl-3">
										<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" href="invoices/create">Add Of Invoice</a>
									</div>
										</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Number of Invoice</th>
												<th class="border-bottom-0">Date of Invoice</th>
												<th class="border-bottom-0">Date of Maturity</th>
												<th class="border-bottom-0">Department</th>
												<th class="border-bottom-0">Category</th>
												<th class="border-bottom-0">Discount</th>
												<th class="border-bottom-0">Rate_vat</th>
												<th class="border-bottom-0">value_vat</th>
												<th class="border-bottom-0">total</th>
												<th class="border-bottom-0">status</th>
												<th class="border-bottom-0">notes</th>
												<th class="border-bottom-0">operations</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=0?>
											@foreach($invoices as $inv)
											<?php $i++?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$inv->invoices_number}}</td>
												<td>{{$inv->invoices_Date}}</td>
												<td>{{$inv->due_date}}</td>
												<td>{{$inv->product}}</td>
												<td><a href="{{url('invoicesdatails')}}/{{$inv->id}}" >{{$inv->sections->section_name}}</a></td>
												<td>{{$inv->discount}}</td>
												<td>{{$inv->rate_vat}}</td>
												<td>{{$inv->value_vat}}</td>
												<td>{{$inv->total}}</td>
												<td>
													  <span class="text-warning">{{$inv->status}}</span>
													 



												</td>
												<td>{{$inv->note}}</td>
												<td>

												<div class="dropdown">
	<button aria-expanded="false" aria-haspopup="true" class="btn  btn-sm ripple btn-primary"
	data-toggle="dropdown" id="dropdownMenuButton" type="button">operations <i class="fas fa-caret-down ml-1"></i></button>
	<div  class="dropdown-menu tx-13">
		<a class="dropdown-item" href="{{url('edit_envoices')}}/{{$inv->id}}"><i class="text-primary fas fa-pen-alt"></i>&nbsp;&nbsp;edit</a>
		
		<a class="dropdown-item" href="#" data-invoice_id="{{ $inv->id }}"
                                                            data-toggle="modal" data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt">
															</i>&nbsp;&nbsp;delete</a>
																
																
																<a class="dropdown-item"
                                                            href="{{url('status')}}/{{$inv->id}}"><i
                                                                class=" text-success fas fa-money-bill"></i>&nbsp;&nbsp;
                                                            status payment</a>
	
	
															</div>
</div>


												</td>
											</tr>
											@endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!--/div-->


				</div>


		
				<div class="modal" id="delete_invoice">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Delete Of invoice</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button">
							<span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
					<form action="{{url('invoices/destroy')}}" method="POST">
						{{method_field('delete')}}
						{{csrf_field()}}
  <div class="form-group">
  <input type="hidden" class="form-control" id="id" name="id">
    Are You sure delete invoice ?
  </div>
					</div>
					<div class="modal-footer">
						<button class="btn ripple btn-danger" type="submit">Delete </button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
					</div>
					</form>
				</div>
			</div>
		</div>


				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<!--Internal  Notify js -->
<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>

<script>
        $('#delete_invoice').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('invoice_id')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            
           
        })
  
    </script>


@endsection