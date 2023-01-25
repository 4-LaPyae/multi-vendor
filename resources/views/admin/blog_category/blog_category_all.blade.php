@extends('admin.admin_master')
@section('admin')


 <div class="page-content">
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">Blog Category All</h4>



                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Blog Category All Data </h4>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Blog Category Name</th> 
                            <th>Action</th>

                        </thead>
                        <tbody>
                        	
                        	@foreach($blogcategory as $key => $item)
                        <tr>
                            <td> {{ $key+1}} </td>
                            <td> {{ $item->blog_category }} </td> 
                            <td>
        <div class="d-flex justify-content-around w-50" >
            <a href="{{ route('blogcategories.edit',$item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>
            <form action="{{ route('blogcategories.destroy', $item->id) }}" method="post" >
            @method('DELETE')
            @csrf
                <button type="submit" class="btn btn-danger sm" onclick="return confirm('Are you sure!')">
            <i class="fas fa-trash-alt"></i>
            </button>
            </form>
        </div>
                            </td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>

                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->



                    </div> <!-- container-fluid -->
                </div>


@endsection