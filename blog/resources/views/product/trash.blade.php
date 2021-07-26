@extends('product.layout')

@section('content')


<div class="jumbotron container">
   <h3>Trashed products</h3>
    <a class="btn btn-primary btn-lg" href="{{ route('products.index')}}" role="button">Return  </a>
</div>

  <div class="container">
    <table class="table">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product name</th>
            <th scope="col">Product price</th>
            <th scope="col" style="width: 400px">Actions</th>
          </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($products as $item)
            <tr>
                <th scope="row">{{++$i}}</th>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }} DH  </td>
                <td>

                    <div class="row">
                        <div class="col-sm">
                            <a  class="btn btn-success" href="{{ route('product.back.from.trash',$item->id)}}"> Restore </a>
                            <a  class="btn btn-danger" href="{{ route('product.delete.from.database',$item->id)}}"> Hard Delete </a>
                        </div>

                      </div>


                </td>
              </tr>
            @endforeach

        </tbody>
      </table>

     {!! $products->links() !!}
  </div>

@endsection
