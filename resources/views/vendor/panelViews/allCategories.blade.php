@extends('panelViews::mainTemplate')
@section('page-wrapper')
	<div class="pull-right">
        <a href="{{url('panel/Category/edit')}}" class="btn btn-primary">Add</a>
	</div>
	<div class="rpd-datagrid">
	<table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Edit</th>
		</tr>
        </thead>
        <tbody>
        	
			@foreach ($catGrid as $category)
				<tr>
					<td>{{$category->name}}</td>
					<td>
						<a class="" title="Show" href="{{url('panel/Category/edit?show='.$category->id)}}"><span class="glyphicon glyphicon-list-alt"> </span></a>
	    				<a class="" title="Modify" href="{{url('panel/Category/edit?modify='.$category->id)}}"><span class="fa fa-edit"> </span></a>
	    				<a class="text-danger" title="Delete" href="{{url('panel/Category/edit?delete='.$category->id)}}"><span class="glyphicon glyphicon-trash"> </span></a>
					</td>
				</tr>
				@if (count($category->childrenRecursive)>0)
					@foreach ($category->childrenRecursive as $subcategory)
						<tr>
							<td style="padding-left:55px;">
								{{$subcategory->name}}
							</td>
							<td>
								<a class="" title="Show" href="{{url('panel/Category/edit?show='.$subcategory->id)}}"><span class="glyphicon glyphicon-list-alt"> </span></a>
			    				<a class="" title="Modify" href="{{url('panel/Category/edit?modify='.$subcategory->id)}}"><span class="fa fa-edit"> </span></a>
			    				<a class="text-danger" title="Delete" href="{{url('panel/Category/delete?modify='.$subcategory->id)}}"><span class="glyphicon glyphicon-trash"> </span></a>
							</td>
						</tr>
					@endforeach
				@endif
			

			@endforeach
		</tbody>
	</table>
	<br />
	<br />
	</div>
@stop   
