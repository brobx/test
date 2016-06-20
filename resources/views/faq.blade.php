@extends('master')

@section('page.title')
@lang('main.faq')
@stop

@section('content')
<section class="intro faq">
    <section class="section-wrapper">
        <div class="container table">
            <div class="intro-content">
                <h2 class="section-title">How Can We Help?</h2>
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="form-group form-group-lg">
                            <!-- <input type="text" name="" id="" placeholder="Search help ..." class="form-control"> -->
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search help ...">
                                <span class="input-group-btn">
                                    <button class="btn btn-trans btn-trans-normal" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </section>
</section>

<section class="faq">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row item">
                    <div class="col-md-3">
                        <h3>New to Qarenhom?</h3>
                    </div>
                    <div class="col-md-9">
                        <a href="#">What's Qarenhom?</a>
                        <a href="#">How does it work?</a>
                        <a href="#">What services do we provide?</a>
                        <a href="#" class="see-all">See all</a>
                    </div>
                </div>
                <div class="row item">
                    <div class="col-md-3">
                        <h3>New to Qarenhom?</h3>
                    </div>
                    <div class="col-md-9">
                        <a href="#">What's Qarenhom?</a>
                        <a href="#">How does it work?</a>
                        <a href="#">What services do we provide?</a>
                        <a href="#" class="see-all">See all</a>
                    </div>
                </div>
                <div class="row item">
                    <div class="col-md-3">
                        <h3>New to Qarenhom?</h3>
                    </div>
                    <div class="col-md-9">
                        <a href="#">What's Qarenhom?</a>
                        <a href="#">How does it work?</a>
                        <a href="#">What services do we provide?</a>
                        <a href="#" class="see-all">See all</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="help-contact">
    <div class="container text-center">
        <h3>Can't Find What You're Looking For?</h3>
        <a href="#" class="btn btn-trans">Contact Us</a>
    </div>
</section>
@endsection
