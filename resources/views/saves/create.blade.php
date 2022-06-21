@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success.up'))
          <div class="alert alert-success">
            {!! session('success.up') !!}
          </div>
      @endif
      @if(session('success.down'))
          <div class="alert alert-danger">
            {!! session('success.down') !!}
          </div>
    @endif
    <h2>Savings</h2>
  <form action="{{ route('saves.send') }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
    <div class="form-group">
      <label for="exampleInputEmail1">Keterangan</label>
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Total</label>
      <input id="total" type="number" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ old('total') }}" required autocomplete="total" autofocus>
        @error('total')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Post</button>
  </form>
  <p></p>
  <p style="color:red">*Hapus "." titik Anda</p>
</div>
@endsection