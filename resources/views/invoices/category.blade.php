@extends('layouts.master')
@section('title')
List Of category
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
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
							<h4 class="content-title mb-0 my-auto">Settings</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ List Of Categories</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')


				<!-- row -->
				<div class="row">


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


@if(session()->has('edit'))

<div class="alert alert-success" role="alert">
<strong>{{session()->get('edit')}}</strong>
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

					<!--div-->
					<div class="col-xl-12">
						<div class="card mg-b-20">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
								<div class="col-sm-6 col-md-4 col-xl-3">
								@can('add product')	
								<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo1">Add Of Products</a>
								@endcan	
							</div>
								</div>
								</div>
							<div class="card-body">
								<div class="table-responsive">
									<table id="example1" class="table key-buttons text-md-nowrap">
										<thead>
											<tr>
												<th class="border-bottom-0">#</th>
												<th class="border-bottom-0">Products of Name</th>	
												<th class="border-bottom-0">Descriptions</th>
												<th class="border-bottom-0">Sections of Name</th>
												<th class="border-bottom-0">Operations</th>
											</tr>
										</thead>
										<tbody>
											<?php $i=0?>
											@foreach($products as $pro)
											<?php $i++?>
											<tr>
												<td>{{$i}}</td>
												<td>{{$pro->product_name}}</td>
												<td>{{$pro->description}}</td>
												<td>

												{{$pro->sections->section_name}}
												</td>
												<td>
												<ul class="list-inline m-0">
												@can('edit product')	
											<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                       data-id="{{ $pro->id }}" data-section_name="{{$pro->product_name}}"
                                                       data-description="{{$pro->description}}"  
													   data-name="{{$pro->sections->section_name}}" 
													   data-toggle="modal" href="#exampleModal2"
                                                       title="edit"><i class="las la-pen"></i></a>

													   @endcan
													   @can('delete product')
													   <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
													   data-id="{{ $pro->id }}" 
													   data-section_name="{{$pro->product_name}}"
                                                      
													   data-toggle="modal" href="#exampleModal3"
                                                       title="delates"><i class="las la-trash"></i></a>
													   @endcan

                                            </ul>
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
				<!-- Basic modal -->
				<div class="modal" id="modaldemo1">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Add Of Products</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
					<form action="{{route('category.store')}}" method="POST">
						{{csrf_field()}}
  <div class="form-group">
    <label for="exampleFormControlInput1">Name OF Prodect</label>
    <input type="text" class="form-control" id="product_name" name="product_name">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Name OF Department</label>
    <select class="form-select form-control" id="name" name="name" >
  <option disabled  selected>select of Department</option>
  @foreach($sections as $sec)
  <option value="{{$sec->id}}">{{$sec->section_name}}</option>
 @endforeach
</select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="description"  name="description" rows="3"></textarea>
  </div>

 

							</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary" type="submit">Save </button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
					</div>
					</form>
				</div>
			</div>
		</div>
		<!-- End Basic modal -->
		<!-- Basic modal -->

		<div class="modal" id="exampleModal2">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Edit Of Products</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button">
							<span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
					<form action="category/update" method="POST">
						{{method_field('Patch')}}
						{{csrf_field()}}
  <div class="form-group">
  <input type="hidden" class="form-control" id="id" name="id">
    <label for="exampleFormControlInput1">Name OF Products</label>

    <input type="text" class="form-control" id="section_name" name="section_name">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Name OF Department</label>
    <select class="form-select form-control" id="name" name="name" required>
  <option disabled  selected>select of Department</option>
  @foreach($sections as $sec)
  <option value="{{$sec->id}}">{{$sec->section_name}}</option>
 @endforeach
</select>
  </div>

  <div class="form-group">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="description"  name="description" rows="3"></textarea>
  </div>

 

							</div>
					<div class="modal-footer">
						<button class="btn ripple btn-primary" type="submit">Save </button>
						<button class="btn ripple btn-secondary" data-dismiss="modal" type="button">Close</button>
					</div>
					</form>
				</div>
			</div>
		</div>

				</div>



		
		<!-- End Basic modal -->
		
		<div class="modal" id="exampleModal3">
			<div class="modal-dialog" role="document">
				<div class="modal-content modal-content-demo">
					<div class="modal-header">
						<h6 class="modal-title">Delete Of product</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button">
							<span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
					<form action="category/destroy" method="POST">
						{{method_field('delete')}}
						{{csrf_field()}}
  <div class="form-group">
  <input type="hidden" class="form-control" id="id" name="id">
    <label for="exampleFormControlInput1">Name OF product</label>

    <input type="text" class="form-control" id="section_name" name="section_name">
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

				


				<!-- Basic modal -->

				

				
				

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

        <script>
        $('#exampleModal2').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var product_name = button.data('section_name')
            var description = button.data('description')
			var name = button.data('name')
			
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(product_name);
            modal.find('.modal-body #description').val(description);
			modal.find('.modal-body #name').val(name);
        })
  
    </script>
	 <script>
        $('#exampleModal3').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id = button.data('id')
            var section_name = button.data('section_name')
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #section_name').val(section_name);
           
        })
  
    </script>
	
@endsection