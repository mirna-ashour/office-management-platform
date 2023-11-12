   
    </div>
  
<script src='js/jquery-3.4.1.min.js' ></script>
<script src="bootstrap-4.3.1-dist/js/bootstrap.js"></script>
<script src='js/select2.min.js' type='text/javascript'></script>

 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/sl-1.3.1/datatables.min.js"></script>


<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
         'excel', 'pdf', 'print'
        ],
        responsive: true
    
    } );
} );
</script>

</body>

</html>