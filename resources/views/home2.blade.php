<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/popper.min.js')}}"></script>

{{-- for datatable --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <button class="btn btn-danger" id="delete">Delete</button>
                {{-- <div id="filter" style="margin-left: 30%; margin-top:-20px;"></div> --}}
                <table id="myTable" class="table display">
                    <tfoot>
                        <tr>
                            <th></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Gender date</th>
                            
                        </tr>
                    </tfoot>
                    <thead>
                        <tr>
                            <th><input type="checkbox" name="allchk" id="allchk"></th>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['res'] as $item)
                            <tr>
                                <td><input type="checkbox" name="ids" id="ids" class="checkclass" value="{{$item->id}}"></td>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->mobile}}</td>
                                <td>{{$item->gender}}</td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/jquery.js')}}"></script>
    {{-- for datatable  --}}
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable( {
                
                // pagination length
                "aLengthMenu": [ [2, 4, 8, -1], [2, 4, 8, "All"] ],
                "iDisplayLength": 4, 
                // end pagination length
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );

            
        } );    
    </script> 
    {{-- end datatable  --}}


    <script>
        // all check box select
        $(function(e){
            $("#allchk").click(function(){
                $(".checkclass").prop("checked",$(this).prop('checked'));
            });
        });

        $("#delete").click(function(e){
            e.preventDefault();
            var allid=[];
            $("input:checkbox(name=ids):checked").each(function(){
                allid.push($(this).val());
            });
            $.ajax({
                url : '{{route("delete")}}',
                type: 'GET',
                data: {allid:allid},
                success:function(data)
                {
                    window.location.href='{{route("home")}}';
                }
            });
        });
    </script>
    
</body>
</html>