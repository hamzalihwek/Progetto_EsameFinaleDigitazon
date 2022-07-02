@extends('layouts.app')  
@section('content')   		
	 
<div class="container mt-5">
  <div class="card mb-3 bg-light" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="" class="img-fluid rounded-start" alt="ciao">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">{{ $product->name }}</h5>
          <p class="card-text">Prodotti Disponibili: {{ $product->availability }}</p>
          <p class="card-text">Prezzo: {{ $product->price }}</p>
          <p class="card-text"><small class="text-muted">Sconto del: {{ $product->discount . '%'}}</small></p>
        </div>
      </div>
    </div>
  </div>
    <a href="{{ route('products.index') }}"><button type="button" class="btn btn-outline-secondary mt-2">
      <span> Back to list of products <span>
    </button> 
    </a>
  </div>
  <com-component></com-component>
@endsection