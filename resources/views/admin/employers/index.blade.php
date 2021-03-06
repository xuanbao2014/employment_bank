@extends('admin.layouts.default')

@section('page_specific_header')
<style> .emp_link{ font-weight: 600;}
.emp_link:hover{ color:#2F749C;}
</style>
@stop

@section('content-header')
  Employers <small> all</small>
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title"> List of registered employers</h3>
      </div><!-- /.box-header -->
      <div class="box-body no-padding">
      <div class="table-responsive">
    	@if($results->count())
    		<table class="table table-hover">
          <thead>
              <tr>
                  <th width="1%">#</th>
                  <th width="10%">Organisation Name</th>
                  <th width="5%">Type</th>
                  <th width="5%">Sector</th>
                  <th width="5%">Industry</th>
                  <th width="7%">Contact Person</th>
                  <th width="6%">Verification Status</th>
                  <th width="6%">Created</th>
              </tr>
          </thead>
        <tbody>
        <?php
          // $count = 1; 
          // if($results->currentPage() != 1){
          //   $count = (($results->currentPage() - 1) * $results->perPage()) + 1;
          // }
        ?>
        		@foreach($results as $result)
		        <tr>
					    <td>{{ $result->id }}</td>
					    <td> 
                <a href="{!!route('admin.employer_view_profile', [Hashids::encode($result->id)])!!}" class="emp_link">
                  {{ $result->organization_name }} 
                </a>
              </td>
              <td>{{ $result->organization_type }}</td>
              <td>{{ $result->organization_sector }}</td>
              <td>{{ $result->industry->name }}</td>
							<td>
                {{ $result->contact_name }}
              </td>
              <td> 
                @if($result->verified_by == 0) {{ $result->verification_status}} 
                @else
                <a href="{!! route('admin.admins_accounts.view', Hashids::encode($result->verified_by)) !!}"> {{ $result->verification_status}} </a>
                @endif
              </td>
              <td> {{ $result->created_at->diffforhumans()}}</td>
						</tr>
					<?php //$count++; ?>
          @endforeach
	      </tbody>
      </table>
      {!! $results->render() !!}
      @else
    		<p style="text-align: center;"> No records found.</p>
    	@endif
        </div>
      </div>
  	</div>
    </div>
</div>
@endsection
