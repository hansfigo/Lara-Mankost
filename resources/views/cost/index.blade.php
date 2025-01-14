@extends('layouts.app')

@section('content')
@if(!$hasData)
<div class="container">
 <div class="d-flex justify-content-center">
  <h1>You have not set a report time date</h1>
 </div>
</div>
@else
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
    <div class="row justify-content-center">
        <div class="col-lg-12">
         <h1 style="text-align:center;">Cost</h1>
         <a href="{{ route('cost.post') }}" class="btn btn-primary">Create new report</a>
          <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Fillter
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('cost.today') }}">Today</a>
            </div>
          </div>
         <p></p>
         <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Desc</th>
                <th scope="col">Total</th>
                <th scope="col">Date</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
            @php $no = 1; @endphp
            @forelse($cost as $c)
              <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $c->name }}</td>
                <td>@currency($c->total)</td>
                <td>{{ $c->created_at->toDateString() }}</td>
                <td>
                  <div><a class="btn btn-primary btn-sm" href="{{ route('cost.edit', $c->id) }}"><i class="fa fa-edit"></i></a></div>
                </td>
                <td>
                  <form action="{{ route('cost.hapus', $c->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            </tbody>
            @empty
              <p style="text-align:center;color:red;">Opss... not found :(</p>
            @endforelse
          </table>
        </div>
        <h1><span class="badge badge-success">Rp. @currency($tot_cost)</span></h1>
      </div>
    </div>
    <p></p>
    {{ $cost->links() }}
    <div class="col-md-12 bg-light text-right">
      <form action="{{ route('massdelete.costs') }}" method="POST">
        @csrf
        @method('delete')
        <a href="{{ route('massdelete.costs') }}" class="btn btn-danger"><i class="fa fa-trash"></i></a> *Delete all
      </form>
    </div>
</div>
@endif
@endsection
