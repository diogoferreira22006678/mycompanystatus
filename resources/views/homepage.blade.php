@extends('_layouts.layout', ['title' => 'Home'])

@section('body')
<div class="container-fluid" style="background-color: #f8f9fc;">
    <!-- Heading -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- Welcome Message With color #4e73df and using jumpotron class -->
                <div class="jumbotron" style="background-color: #4e73df; color: white; padding: 50px;">
                    <h1 class="display-4">Welcome to MyCompanyStatus!</h1>
                    <p class="lead">We provide financial data analysis for companies.</p>
                    <hr class="my-4">
                    <p>Our team of experts analyzes financial data of companies and provides insights into their performance.</p>
            </div>
        </div>
    </div>
    <!-- Features -->
    <div class="container" style="margin-top: 50px; background-color: white; padding: 40px;">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-5" style="color:#4e73df">What We Offer</h2>
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title" style="color:#4e73df">Financial Data Analysis</h3>
                        <p class="card-text">We analyze financial data of companies and provide insights into their performance.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title" style="color:#4e73df">Real-time Updates</h3>
                        <p class="card-text">We provide real-time updates on the financial data of companies, so you're always up-to-date.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title" style="color:#4e73df">Expert Feedback</h3>
                        <p class="card-text">Our team of experts provides valuable feedback on the financial data of companies, helping you make informed decisions.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="container" style="margin-top: 50px; background-color: white; padding: 40px;margin-bottom: 50px;">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-5" style="color:#4e73df">What Our Customers Say</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="card-text">"MyCompanyStatus has helped me make informed decisions about my investments. I highly recommend their services."</p>
                        <p class="text-muted" style="color:#4e73df">- John Doe</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="card-text">"I love the real-time updates provided by MyCompanyStatus. It's like having a personal financial advisor at my fingertips."</p>
                        <p class="text-muted" style="color:#4e73df">- Jane Smith</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p class="card-text">"The expert feedback provided by MyCompanyStatus has been invaluable. I trust their insights and recommendations."</p>
                        <p class="text-muted" style="color:#4e73df">- Bob Johnson</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
