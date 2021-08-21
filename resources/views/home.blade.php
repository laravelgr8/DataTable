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


    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

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


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
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
    {{-- data table pagination with filter start --}}
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable( {
                // 'iDisplayLength': 2, //for pagination             
                initComplete: function () {   //filter start
                    this.api().columns([2, 3]).every( function () {
                        var column = this;
                        var select = $('<select class="form-control" style="width:250px; float:left;"><option value="">All Select</option></select>')
                            // .appendTo('#filter')  
                            .appendTo( $(column.header()) )
                            .on( 'change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
        
                                column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                            } );
        
                        column.data().unique().sort().each( function ( d, j ) {
                            select.append( '<option value="'+d+'">'+d+'</option>' )
                        } );
                    } );
                }//filter end
            } );
        } );
    </script>
    {{-- data table pagination with filter end --}}
</body>
</html>