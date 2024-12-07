
<div class="container">
          <div class="page-inner">
          @if(session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
          <div   class="row">
<label for="inlineinput" class="col-md-3 col-form-title d-block">Update Product</label>
                          <div class="col-md-5 p-0 m-5 row">
                          <form action="{{url('/update_product_confirm',$product->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group form-group-default">
                           <label>Title</label>
                          <input
                            id="Title"
                            name="title"
                            type="text"
                            class="form-control"
                            placeholder="Title Here"
                            required=""
                            value="{{$product->title}}"
                          />
                        </div>
                        <div class="form-group">
                          <div class="input-group">
                            <span class="input-group-text">Description</span>
                            <textarea
                              id="description"
                              name="description"
                              class="form-control"
                              placeholder="Description Here"
                              aria-label="With textarea"
                              required=""
                            >{{$product->description}}</textarea>
                          </div>
                        </div>
                        <div class="form-group form-group-default">
                          <label>Price</label>
                          <input
                            id="price"
                            name="price"
                            type="number"
                            class="form-control"
                            required=""
                            placeholder="Price Here"
                            value="{{$product->price}}"
                          />
                        </div> 
                         <div class="form-group form-group-default">
                          <label>Discount Price</label>
                          <input
                            id="dprice"
                            name="dprice"
                            type="number"
                            class="form-control"
                            required=""
                            placeholder="Discount Price Here"
                            value="{{$product->discountprice}}"
                          />
                        </div>   
                         <div class="form-group form-group-default">
                          <label>Quantity</label>
                          <input
                            id="quantity"
                            name="quantity"
                            type="number"
                            required=""
                            class="form-control"
                            placeholder="Quantity Here"
                            value="{{$product->quantity}}"
                          />
                        </div>  <div class="form-group form-group-default">
                          <label>Catagory</label>
                          <select
                            name="catagory"
                            class="form-select"
                            required=""
                            id="formGroupDefaultSelect"
                          >   
                          @foreach ($catagory as $catagory)
                            <option value="{{$product->catagory}}" selected="">{{ $catagory->catagory_name }}</option>
                          @endforeach
                          </select>
                        </div>  

                        <figure class="imagecheck-figure col-6 m-auto">
                                  <img
                                    src="/products/{{$product->image}}"
                                    alt="title"
                                    class="imagecheck-image"
                                  />
                                </figure>
<div class="m-auto">
                          <input
                            name="image"
                            type="file"
                            class="form-control-file"
                            id="exampleFormControlFile1"
                          /></div>
                        </div>
                        <button class="btn btn-success">Update Product</button>

                        </div>


                        </form>
                        </div>
        </div>
    </div>