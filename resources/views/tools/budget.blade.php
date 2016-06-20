@extends('master')

@section('page.title')
@lang('main.budgetCalc')
@stop

@section('content')

    @include('components/breadcrumb', [
        'title' => trans('main.tools'), 'levels' => [
            ['title' => trans('main.tools'), 'url' => '/tools'],
            ['title' => trans('main.budgetCalc'), 'url' => ''],
        ] 
    ])

    <section class="tools">
        <div class="container">
            <form>
                <div class="tools-band">
                    <h3 class="tools-band-title">1. {{ trans('main.toolsIncome') }}</h3>
                    <div class="form-group">
                        <input type="hidden" id="income" name="{{ trans('main.income') }}">
                        <label>{{ trans('main.toolsNetIncome') }}</label>
                        <span id="tools-val" class="slider-value"></span>
                        <div v-slider
                             :min='1000'
                             :max='100000'
                             :step='100'
                             :value='0'
                             direction='{{currentDirection()}}'
                             input-id='income'
                             span-id='tools-val'>
                        </div>
                    </div>
                </div>
                <div class="tools-band">
                    <h3 class="tools-band-title">2. {{ trans('main.toolsExpensesLiabilities') }}</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="expensesLiab">
                                <h4>{{ trans('main.toolsMonthlyExpenses') }}</h4>
                                <div class="form-group">
                                    <input type="hidden" id="expenses-food" name="expenses[{{ trans('main.toolsFoodBeve') }}]">
                                    <label>{{ trans('main.toolsFoodBeve') }}</label>
                                    <span id="tools-valFood" class="slider-value"></span>
                                    <div v-slider
                                         :min='100'
                                         :max='10000'
                                         :step='15'
                                         :value='0'
                                         direction='{{currentDirection()}}'
                                         input-id='expenses-food'
                                         span-id='tools-valFood'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="expenses-rent" name="expenses[{{ trans('main.toolsRentLiving') }}]">
                                    <label>{{ trans('main.toolsRentLiving') }}</label>
                                    <span id="tools-valRent" class="slider-value"></span>
                                    <div v-slider
                                         :min='100'
                                         :max='10000'
                                         :step='15'
                                         :value='0'
                                         direction='{{currentDirection()}}'
                                         input-id='expenses-rent'
                                         span-id='tools-valRent'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="expenses-travel" name="expenses[{{ trans('main.travel') }}]">
                                    <label>{{ trans('main.travel') }}</label>
                                    <span id="tools-valTravel" class="slider-value"></span>
                                    <div v-slider
                                         :min='100'
                                         :max='10000'
                                         :step='15'
                                         :value='0'
                                         direction='{{currentDirection()}}'
                                         input-id='expenses-travel'
                                         span-id='tools-valTravel'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="expenses-tv" name="expenses[{{ trans('main.toolsTVInter') }}]">
                                    <label>{{ trans('main.toolsTVInter') }}</label>
                                    <span id="tools-calTVInter" class="slider-value"></span>
                                    <div v-slider
                                         :min='100'
                                         :max='10000'
                                         :step='15'
                                         :value='0'
                                         direction='{{currentDirection()}}'
                                         input-id='expenses-tv'
                                         span-id='tools-calTVInter'>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <input type="hidden" id="expenses-family" name="expenses[{{ trans('main.toolsFamilyFriends') }}]">
                                        <label>{{ trans('main.toolsFamilyFriends') }}</label>
                                        <span id="tools-valFamily" class="slider-value"></span>
                                        <div v-slider
                                             :min='100'
                                             :max='10000'
                                             :step='15'
                                             :value='0'
                                             direction='{{currentDirection()}}'
                                             input-id='expenses-family'
                                             span-id='tools-valFamily'>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="hidden" id="expenses-other" name="expenses[{{ trans('main.toolsOther') }}]">
                                        <label>{{ trans('main.toolsOther') }}</label>
                                        <span id="tools-valOther" class="slider-value"></span>
                                        <div v-slider
                                             :min='100'
                                             :max='10000'
                                             :step='15'
                                             :value='0'
                                             direction='{{currentDirection()}}'
                                             input-id='expenses-other'
                                             span-id='tools-valOther'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="expensesLiab">
                                <h4>{{ trans('main.toolsMonthlyLiabilities') }}</h4>
                                <div class="form-group">
                                    <input type="hidden" id="expenses-credit" name="expenses[{{ trans('main.CreditCardPayments') }}]">
                                    <label>{{ trans('main.CreditCardPayments') }}</label>
                                    <span id="tools-calCredit" class="slider-value"></span>
                                    <div v-slider
                                         :min='0'
                                         :max='10000'
                                         :step='15'
                                         :value='0'
                                         direction='{{currentDirection()}}'
                                         input-id='expenses-credit'
                                         span-id='tools-calCredit'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="expenses-personal-loans" name="expenses[{{ trans('main.PersonalLoanInstallments') }}]">
                                    <label>{{ trans('main.PersonalLoanInstallments') }}</label>
                                    <span id="tools-calPersonalLoan" class="slider-value"></span>
                                    <div v-slider
                                         :min='0'
                                         :max='10000'
                                         :step='15'
                                         :value='0'
                                         direction='{{currentDirection()}}'
                                         input-id='expenses-personal-loans'
                                         span-id='tools-calPersonalLoan'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="expenses-car-loans" name="expenses[{{ trans('main.CarLoanInstallments') }}]">
                                    <label>{{ trans('main.CarLoanInstallments') }}</label>
                                    <span id="tools-valCarLoan" class="slider-value"></span>
                                    <div v-slider
                                         :min='0'
                                         :max='10000'
                                         :step='15'
                                         :value='0'
                                         direction='{{currentDirection()}}'
                                         input-id='expenses-car-loans'
                                         span-id='tools-valCarLoan'>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" id="expenses-home-loans" name="expenses[{{ trans('main.HomeLoanInstallments') }}]">
                                    <label>{{ trans('main.HomeLoanInstallments') }}</label>
                                    <span id="tools-valHomeLoan" class="slider-value"></span>
                                    <div v-slider
                                         :min='0'
                                         :max='10000'
                                         :step='15'
                                         :value='0'
                                         direction='{{currentDirection()}}'
                                         input-id='expenses-home-loans'
                                         span-id='tools-valHomeLoan'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <budget-calculator title="{{ trans('main.budgetCalc') }}">{{ trans('main.calculate') }}</budget-calculator>
                </div>
            </form>
        </div>
    </section>

@endsection