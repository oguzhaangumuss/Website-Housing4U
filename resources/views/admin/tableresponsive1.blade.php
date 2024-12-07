@if(session()->has('message'))
<div class="alert alert-success">
    {{session()->get('message')}}
</div>
@endif
<div class="row">
<label for="inlineinput" class="col-md-3 col-form-title">Add Catagory</label>
                          <div class="col-md-5 p-0 row">
                          <form action="{{url('/add_catagory')}}" method="POST">
                            @csrf
                          <input
                              type="text"
                              class="form-control input-full"
                              id="inlineinput"
                              placeholder="Write Catagory Name To Add"
                              name="catagoryname"
                            />
                        </div>
                        <button class="btn col-md-3 row p-10 btn-success">Submit</button>
                        </form>
                        </div>
<div class="table-responsive">


<div class="form-group form-inline">

                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Added Catagories</th>
                            <th>Delete Area</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $data)
                          <tr>
                            <th scope="row">{{$data->id}}</th>
                            <td>{{$data->catagory_name}}</td>
                            <td><a onclick="return confirm('Are you sure to delete this.')" class="btn col-md-3  btn-danger" href="{{url('/delete_catagory',$data->id)}}">Delete</a></td>
                        </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>