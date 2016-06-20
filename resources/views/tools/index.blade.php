@extends('master')

@section('page.title')
@lang('main.tools')
@stop

@section('content')

@include('components/breadcrumb', [ 'title' => trans('main.tools'), 'levels' => [['title' => trans('main.tools'), 'url' => ''] ] ])

<section class="preTools">
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<a href="{{ route('tools.budget.index') }}">
					<div class="apply-option text-center">
						<img src="/assets/img/tools/Budget_Calculator.png" class="img-responsive">
						<div class="apply-option-footer">
							{{ trans('main.budgetCalc') }}
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4">
				<a href="#">
					<div class="apply-option text-center">
						<img src="/assets/img/tools/Mobile_Data_Calculator.png" class="img-responsive">
						<div class="apply-option-footer">
							{{ trans('main.mobileCalc') }}
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4">
				<a href="#">
					<div class="apply-option text-center">
						<img src="/assets/img/tools/Travel_Planner.png" class="img-responsive">
						<div class="apply-option-footer">
							{{ trans('main.travelPlanner') }}
						</div>
					</div>
				</a>
			</div>
		</div>
	</div>
</section>

@endsection