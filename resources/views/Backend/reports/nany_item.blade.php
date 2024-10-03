@section('title')
Nany  Report
@endsection

@extends('Backend.layouts.layouts')

@section('main_contain')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="br-mainpanel">

        <div class="br-pagebody">
          <div class="br-section-wrapper">
            <h6 class="br-section-label text-center"> Nany Package Wise Report</h6>

            <div class="mt-4 mb-4 d-flex justify-content-center align-items-center ">

                <div class="">
                    <label for="">From</label>
                    <input id="from_date" type="date" value="{{ date('Y-m-d') }}" class="form-control">
                </div>
                <div class="ml-3">
                    <label for="">To</label>
                    <input type="date" id="to_date"  value="{{ date('Y-m-d') }}" class="form-control">
                </div>
                <div class="ml-3 mt-4">
                    <button class="submit_search" style="background: #1394b7e3; color: white;padding: 10px 27px; border-radius: 5px;">Seach</button>
                </div>
                <!-- Button trigger modal -->
                {{-- <a href="" class="btn btn-info tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium" data-toggle="modal" data-target="#homeAddcategory"> <i class="fa fa-plus ml-0 mr-1"></i>Add New </a> --}}
            </div>

            {{-- <div class="table-wrapper"> --}}
              <table id="report_datatalbe" class="table nowrap">
                <thead>
                  <tr>
                    <th class="wd-25p">SL</th>
                    <th class="wd-25p">Service Date</th>
                    <th class="wd-25p">Invoice</th>
                    <th class="wd-25p">Nany Name</th>
                    <th class="wd-25p">Package Name</th>
                    <th class="wd-25p">Fee</th>
                    <th class="wd-25p">Discount</th>
                  </tr>
                </thead>
                <tbody>



                </tbody>

              </table>
            {{-- </div><!-- table-wrapper --> --}}


          </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
        <footer class="br-footer">
          <div class="footer-left">
            <div class="mg-b-2">Copyright &copy; <?php echo date('Y');?> NavieaSoft. All Rights Reserved.</div>
            <div>Attentively and carefully made by NavieaSoft.</div>
          </div>
        </footer>
    </div><!-- br-mainpanel -->


@endsection

@section('script')

{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
{{-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>



<script>
    var d_table= $('#report_datatalbe').DataTable({
         "processing": true,
        "serverSide": true,

        "ajax":{
            "url": "{{ route('get_nany_package_report') }}",
            "dataType": "json",
            "type": "POST",
            "data":{ _token: "{{csrf_token()}}"},
            // "success":function(res){
            //     console.log(res);
            // }
        },
        "columns": [
            { "data": "sl" },
            { "data": "package_buy_date" },
            { "data": "invoice" },
            { "data": "nany_name" },
            { "data": "package_name" },
            { "data": "fee" },
            { "data": "discount" },
        ],
        "lengthMenu": [[10, 25, 50,100,500, -1], [10, 25, 50,100,500, "All"]],
           scrollX: true,
           dom: 'Blfrtip',
            buttons: [
                'print',
                'excelHtml5',
                'csvHtml5',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    customize : function(doc){
                        console.log(doc.content[1]);
                    //    doc.content[1].table.widths =Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                        // doc.defaultStyle.alignment = 'center';
                        // doc.styles.tableHeader.alignment = 'center';
                        //             doc.content[1].table.widths = [5,90,90,90,90,90,90,90,90,90,90];
                    }
                }
            ],
            'columnDefs': [
            {
                'targets': 0,
                'checkboxes': {
                    'selectRow': true
                }
            }
            ],
            'select': {
                'style': 'multi'
            },
        });

  $('.submit_search').on('click',function(){
    let f_date = $('#from_date').val();
     let t_date = $('#to_date').val();
     d_table.column(1).search(f_date,null, null).draw();
    //console.log(d_table.column(1));

  });
</script>
@endsection
