@extends('layouts.app')  
@section('content')  
<div class=""></div> 
<div class="card-group" style="margin-left: 300px">

  <!-- my php code which uses x-path to get results from xml query. -->
   @foreach ($products as $product) 
      <div class="col-sm-4 m-5 d-flex justify-content-center">
          <div class="card-columns-fluid">
              <div class="card  bg-light" style = "width: 22rem; " >
                  <div class="card-body">
                      <h5 class="card-title"><b> {{ $product->name }}</b></h5>
                      <p class="card-text"><b> {{ '$' . $product->price }} </b></p>
                      <p class="card-text"></p>
                      <p class="card-text"></p>
                      <a href="{{ route('products.show', $product) }}" class="btn btn-secondary">Full Details</a>
                  </div>
              </div>
          </div>
      </div>
  @endforeach
  </div>

</div><!--container div  -->
@endsection
