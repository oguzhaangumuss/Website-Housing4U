<div class="container">
          <div class="page-inner">
          @if(session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif

<div class="form-group form-inline">

                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Images</th>
                            <th>Catagory</th>
                            <th>Price</th>
                            <th>Discount Price</th>
                            <th>Quantity</th>
                            <th>Delete</th>
                            <th>Update</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $product)
                          <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>
                            <img class="col-6 " src="/products/{{$product->image}}" >
                            </td>
                            <td>{{$product->catagory}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discountprice}}</td>
                            <td>{{$product->quantity}}</td>
                            <td><a onclick="return confirm('Are you sure to delete this.')" class="btn btn-danger" href="{{url('/delete_product',$product->id)}}">Delete</a></td>
                            <td><a  class="btn btn-success" href="{{url('/update_product',$product->id)}}">Update</a></td>
                        </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>