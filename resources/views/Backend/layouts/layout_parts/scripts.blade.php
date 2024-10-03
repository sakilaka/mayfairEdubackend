<script>
    var base_url = "{{ url('/') }}";
    console.log(base_url);
</script>
<script src="{{asset('backend')}}/lib/jquery/jquery.min.js"></script>
<script src="{{asset('backend')}}/lib/jquery-ui/ui/widgets/datepicker.js"></script>
<!---- bootstarp Js ----->
<script src="{{asset('backend')}}/lib/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{asset('backend')}}/lib/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="{{asset('backend')}}/lib/moment/min/moment.min.js"></script>
<script src="{{asset('backend')}}/lib/peity/jquery.peity.min.js"></script>
<script src="{{asset('backend')}}/lib/rickshaw/vendor/d3.min.js"></script>
<script src="{{asset('backend')}}/lib/rickshaw/vendor/d3.layout.min.js"></script>
<script src="{{asset('backend')}}/lib/rickshaw/rickshaw.min.js"></script>
<script src="{{asset('backend')}}/lib/jquery.flot/jquery.flot.js"></script>
<script src="{{asset('backend')}}/lib/jquery.flot/jquery.flot.resize.js"></script>
<script src="{{asset('backend')}}/lib/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="{{asset('backend')}}/lib/jquery-sparkline/jquery.sparkline.min.js"></script>
<script src="{{asset('backend')}}/lib/echarts/echarts.min.js"></script>
{{-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyAq8o5-8Y5pudbJMJtDFzb8aHiWJufa5fg"></script> --}}
<script src="{{asset('backend')}}/lib/moment/min/moment.min.js"></script>
<script src="{{asset('backend')}}/lib/peity/jquery.peity.min.js"></script>
<script src="{{asset('backend')}}/lib/highlightjs/highlight.pack.min.js"></script>
<script src="{{asset('backend')}}/lib/gmaps/gmaps.min.js"></script>
{{-- <script src="{{asset('backend')}}/js/map.shiftworker.js"></script> --}}
 {{-- //unhide --}}
<script src="{{asset('backend')}}/lib/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('backend')}}/lib/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="{{asset('backend')}}/lib/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('backend')}}/lib/datatables.net-responsive-dt/js/responsive.dataTables.min.js"></script>


{{-- <script src="{{asset('backend')}}/lib/select2/js/select2.full.min.js"></script> --}}

<!--- Form Editor Js---->
<script src="{{asset('backend')}}/lib/summernote/summernote-bs4.min.js"></script>
<script src="{{asset('backend')}}/lib/peity/jquery.peity.min.js"></script>
<script src="{{asset('backend')}}/lib/highlightjs/highlight.pack.min.js"></script>
<script src="{{asset('backend')}}/lib/medium-editor/js/medium-editor.min.js"></script>
<!--- Form Editor Js---->
 <!--- Start ajax link-------->
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.3.4/axios.min.js"></script>
 <!--- End ajax link-------->
<!------All Custom js File link------>
<script src="{{asset('backend')}}/js/customjs.js"></script>
<!------All Custom js File link------>

<!--- start bracket Main Js ---->
<script src="{{asset('backend')}}/js/bracket.js"></script>
<!--- end bracket Main Js ---->
<script src="{{asset('backend')}}/js/suneditor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>

    $(document).ready(function() {
        console.log("hi");
    $('.select2').select2();
    });
  $(function(){
    'use strict'

    // FOR DEMO ONLY
    // menu collapsed by default during first page load or refresh with screen
    // having a size between 992px and 1299px. This is intended on this page only
    // for better viewing of widgets demo.
    // $(window).resize(function(){
    //   minimizeMenu();
    // });

    // minimizeMenu();

    function minimizeMenu() {
      if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
        // show only the icons and hide left menu label by default
        $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
        $('body').addClass('collapsed-menu');
        $('.show-sub + .br-menu-sub').slideUp();
      } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
        $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
        $('body').removeClass('collapsed-menu');
        $('.show-sub + .br-menu-sub').slideDown();
      }
    }
  });
</script>

    <!----- Start Datatable Js---------->

    <script>
        // console.log($('#sun-editor').len());
        if($('#sun-editor').length > 0){
         const suneditor=SUNEDITOR.create('sun-editor',{
            buttonList: [
                ['undo', 'redo', 'font', 'fontSize', 'formatBlock'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript', 'removeFormat'],
                '/', //Line break
                ['fontColor', 'hiliteColor', 'outdent', 'indent', 'align', 'horizontalRule', 'list', 'table'],
                ['link', 'image', 'video', 'fullScreen', 'showBlocks', 'codeView', 'preview', 'print', 'save']
            ],
            width: '100%',
            height:204
        });
        $(document).click(function() {
            document.getElementById('sun-editor').value = suneditor.getContents();
        });
    }
        $(function(){
        'use strict';

        $('#datatable1').DataTable({
            responsive: true,
            language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
            }
        });

        $('#datatable2').DataTable({
            bLengthChange: false,
            searching: false,
            responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

        });
    </script>

    <!----- End Datatable Js---------->

    <!--- Start Summernote Editor Js ---->
    <script>

        $(document).ready(function() {
            /*** summernote editor one ***/
            $('#summernote').summernote({
                height: 150
            })
            /*** summernote editor two ***/
            $('#summernote_two').summernote({
                height: 150
            })

            $('#summernote_three').summernote({
                height: 150
            })
            $('#summernotefour').summernote({
                height: 150
            })

        });

        </script>
    <!--- End Summernote Editor Js ---->

    <script>
       // console.log($('#showAlpha').length);
        if($('#showAlpha').length > 0){
            $('#showAlpha').spectrum({
                color: 'rgba(23,162,184,0.5)',
                showAlpha: true
            });
        }


    </script>

    <!--- Start Bootstrap Model Script-------->

    <script>
        $(function(){

          // showing modal with effect
          $('.modal-effect').on('click', function(e){
            e.preventDefault();

            var effect = $(this).attr('data-effect');
            $('#modaldemo8').addClass(effect);
            $('#modaldemo8').modal('show');
          });

          // hide modal with effect
          $('#modaldemo8').on('hidden.bs.modal', function (e) {
            $(this).removeClass (function (index, className) {
                return (className.match (/(^|\s)effect-\S+/g) || []).join(' ');
            });
          });
        });
    </script>

    <!--- End Bootstrap Model Script-------->

  <!--- Start ajax Sub Category Get Script-------->
    <script>
        $('body').on("change",'#cat',function(){
            let id = $(this).val();
            getSubCategory(id,"subCat");
        });
        $('body').on("change",'#phar_cat',function(){
            console.log("this");
            let id = $(this).val();
            getSubCategory(id,"phar_subCat");
        });
        function getSubCategory(id,outid){
            let url = '{{ url("/get/subcat/") }}/' + id;
            axios.get(url)
                .then(res => {
                    console.log(res);
                $('#'+outid).empty();
                    let html = '';
                    html += '<option value="">Select Sub category</option>'
                    res.data.forEach(element => {
                        html += "<option value=" + element.id + ">" + element.name + "</option>"
                    });


                    $('#'+outid).append(html);
                    $('#'+outid).val("").change();
                });
        }

 <!--- End ajax Sub Category Get Script-------->

  <!--- Start ajax Childd Category Get Script-------->

        $('body').on("change",'#subCat',function(){
            let id = $(this).val() == "" ? 0 :  $(this).val();
            gechildCategory(id,"childCat");

        });
        $('body').on("change",'#phar_subCat',function(){
            let id = $(this).val() == "" ? 0 :  $(this).val();
            gechildCategory(id,"phar_childCat");

        });
        function gechildCategory(id,outid){
            let url = '{{ url("/get/childcat/") }}/' + id;
            axios.get(url)
                .then(res => {
                    console.log(res);
                $('#'+outid).empty();
                   let html = '';
                    html += '<option value="">Select Child category</option>'
                    res.data.forEach(element => {
                        html += "<option value=" + element.id + ">" + element.name + "</option>"
                    });

                   $('#'+outid).append(html);
                });
        }


        $('body').on("change",'#childCat',function(){
            let id = $(this).val() == "" ? 0 :  $(this).val();
            getprochildcategory(id,"proChildCat");

        });
       
        function getprochildcategory(id,outid){
            let url = '{{ url("/get/prochildcat/") }}/' + id;
            axios.get(url)
                .then(res => {
                    console.log(res);
                $('#'+outid).empty();
                   let html = '';
                    html += '<option value="">Select Pro Child category</option>'
                    res.data.forEach(element => {
                        html += "<option value=" + element.id + ">" + element.name + "</option>"
                    });

                   $('#'+outid).append(html);
                });
        }


    </script>
 <!--- End ajax Child Category Get Script-------->

 <!--- Start on click image show Script-------->
 <script>
 $(document).on('change','.upload-img',function(){
    var files = $(this).get(0).files;
    var reader = new FileReader();
    reader.readAsDataURL(files[0]);
    var arg=this;
    reader.addEventListener("load", function(e) {
        var image = e.target.result;
        $(arg).parent().find('.display-upload-img').attr('src', image);
    });
});
</script>
 <!--- End on click image show Script-------->
<script>
    $(document).on('click','.changePass',function(){
        console.log(this);
        $('#user_id_pass').val($(this).attr('value'));
        $('#changePassword').modal('show');
    })
</script>
