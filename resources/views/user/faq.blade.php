@extends('user.layout.app')
@section('content')
<div class="faq-wrapper" style="min-height:450px;">
  <div class="container">
	
	  <div class="row justify-content-center">
        	<div class="col-md-6">
            	<div class="heading_s1 mb-3 mb-md-4">
                	<h3>General Questions</h3>
                </div>
                @foreach($generalfaqs as $key=>$gfaq)
            	<div id="accordion{{$key}}" class="accordion accordion_style1">
                    
                    <div class="card">
                        <div class="card-header" id="headingOne{{$key}}">
                            <h6 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapseOne{{$key}}" aria-expanded="false" aria-controls="collapseOne"></a>{{$gfaq->question}}</h6>
                          </div>
                          <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordion{{$key}}">
                            <div class="card-body">
                            	<p>{{$gfaq->answer}}</p>
                            </div>
                        </div>
                    </div>
                    
                
              	</div>
                @endforeach
            </div>
            <div class="col-md-6 mt-4 mt-md-0">
            	<div class="heading_s1 mb-3 mb-md-4">
                	<h3>Other Questions</h3>
                </div>
                @foreach($otherfaqs as $key=>$ofaq)
            	<div id="accordion2{{$key}}" class="accordion accordion_style1">  
                    <div class="card">
                        <div class="card-header" id="headingSix{{$key}}">
                            <h6 class="mb-0"> <a class="collapsed" data-toggle="collapse" href="#collapseSix{{$key}}" aria-expanded="false" aria-controls="collapseSix"></a>{{$ofaq->question}}</h6>
                          </div>
                          <div id="collapseSix{{$key}}" class="collapse" aria-labelledby="headingSix" data-parent="#accordion2{{$key}}">
                            <div class="card-body">
                            	<p>{{$ofaq->answer}}</p>
                            </div>
                        </div>
                    </div>
              	</div>
                @endforeach
            </div>
        </div>
	  
  </div>	
</div>
@endsection