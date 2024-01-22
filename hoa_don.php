<?php 
		require_once 'head.php';
		include('config/config.php');
		if(empty($_SESSION['user'])){
			header("Location:login.php");
		}
	
        $last_bill_no = $conn->query("SELECT MAX(ma_hd + 1) AS bill_no FROM hoadonban");
        $bill_no = $last_bill_no->fetch_array();
        $invoice_id = $bill_no['bill_no'].'-'.uniqid();
        $dem=1;
	?>
<body>
<?php
    if(empty($_SESSION['user']) ){
        header("Location:login.php");
    }else if( $_SESSION['user'] == 'admin'){

        require_once 'header-sidebar.php';
    }else if( $_SESSION['user'] == 'user'){

        require_once 'header-sidebar_nv.php';
    }
?>
<input type="hidden" id="id_nv" value="<?= $_SESSION['ma_nv']?>">
<div class="mobile-menu-overlay"></div>
<div class="main-container">
    <div class="pd-ltr-20">
        
        <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="title">
                            <h4>Hóa đơn</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="admindashboard.php">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Hóa đơn
                                </li>
                            </ol>
                        </nav>
                    </div>
                    
                    
                </div>
                <div class="row">
                    
                </div>
                
            </div>
            <div>
                <h4 class="pd-20">Thêm sản phẩm</h3>
                
            </div>
  
            
                

            <div class="card-box mb-30 flex justify-content-between">
                <div class="row">
                    <div class="col-md-4 col-sm-12 mb-30">
                        <div class="card-box height-100-p pd-20">
                          
                            <form  method="POST"  id="dd" autocomplete="off">
                             
                                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['ma_nv'];?>" />
                                <input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $invoice_id;?>" />
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Camera</label>
                                    <div class="col-sm-12 col-md-10">
                                        <div class="videocam" id="barcode">
                                            <video id="barcodevideo" autoplay></video>
                                            <canvas id="barcodecanvasg" ></canvas>
                                        </div>
                                        <canvas id="barcodecanvas" ></canvas>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Mã</label>
                                    <div class="col-sm-12 col-md-10">
                                        <!-- <input type="hidden" type="text" id="bar_code_1" required class="form-control"  onchange="get_detail(this.value,1)"  /> -->
                                            
                                        <input type="text" id="bar_code_1" required class="form-control"  onchange="get_detail(this.value,1)" name="bar_code[]"  />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Tên</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select  id="name_1" class="form-control" onchange="getSectionStaff(this.value,1)">
                                            <option value="">Chọn sản phẩm</option>
                                            <?php $sqlP = $conn->query("SELECT * FROM sanpham WHERE trangthai = 1 ORDER BY ten_sp ASC");
                                            while($rowP = $sqlP->fetch_array()){?>
                                            <option value="<?php echo $rowP['barcode']?>"><?php echo $rowP['ten_sp'];?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Giá mua</label>
                                    <div class="col-sm-12 col-md-10"> 
                                        <input type="text" readonly class="form-control" id="av_quantity_1"  /> 
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Số lượng</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="number" class="form-control" onkeyup="calculate_price(this.value,1)" onchange="calculate_price(this.value,1)" step="1" id="quantity_1"  />
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Giá</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="number" required class="form-control" onkeyup="get_quantity(this.value,1)" step="1000" id="sale_price_1" />
                                        <input type="hidden" class="form-control" id="sale_price_org_1" name="sale_price_org[]" />
                                        <input type="hidden" class="form-control" id="igst_1" name="igst[]" />
                                    </div>
                                </div>
                                <div class="form-group row  flex justify-content-end pd-20">
                                    <a
                                        onclick="them_hoadon()"
                                        href=""
                                        class="btn btn-primary btn-sm pull-right"
                                        rel="content-y"
                                        data-toggle="collapse"
                                        role="button"
                                        >Thêm</a
                                    >
                                     <!-- <a type="submit" name="make_print" class="btn btn-primary" id="validateButton2">Thêm</a> -->
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- <input type="button" name="btnprint" value="Print" onclick="PrintMe('divid')"/> -->
                    <div class="card-box col-md-8 col-sm-12 mb-30">
                        <div class="card-box height-100-p pd-20">
                            <div
                                class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3">
                                <div class="h6 mb-md-0">
                                    <div class="d-flex">
                                        <button style="display: none;" type="submit" name="btnprint" id="print-btn" class="btn btn-primary btn-lg mr-2">Xuất hóa đơn</button>
                                        <button type="submit" id="add-btn" class="btn btn-primary btn-lg  mr-2">Lưu hóa đơn</button>
                                        <button style="display: none;" id="hdm-btn" class="btn btn-primary btn-lg  mr-2" onclick="window.location.reload()">Hóa đơn mới</button>
                                    </div>
                                </div>
                            
                            <div id="divid">
                                <div
                                    class="d-flex flex-wrap justify-content-center align-items-center pb-0 pb-md-3"
                                >
                                <h3 style="margin-top: 25px;">
                                    Hoá đơn
                                </h3>
                                </div>
                                <table id="app" class="table-bordered table">
                                    <thead>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th >Action</th>
                                    </thead>
                                    <tbody id ="ac">
                                        
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td class="text-left">
                                                <div class="d-flex flex-row">
                                                    <b>Phương thức thanh toán : </b>
                                                    <select name="payment_method" class="form-control" id="payment_method">
                                                        <option value='cash'>Tiền mặt</option>
                                                        <option value='card'>Thẻ</option>
                                                    </select>
    
                                                </div>
                                            </td>
                                            <td class='text-right'>
                                                <b>Tổng</b>
                                                
                                            </td>
                                            <td   colspan="2" >
                                                <div class="d-flex flex-row">
                                                    <input type="number" class="form-control" readonly name="total" value="0" id="getTotal" />
    
                                                </div>
                                            </td>
                                            
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                        </div>





                    
                    
                    
                    
                    

                </div>
            </div>
            <!-- Simple Datatable End -->
            <!-- Export Datatable End -->
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            //////
        </div>
    </div>
</div>

<script src="scripts/core.js"></script>
<script src="scripts/script.min.js"></script>
<script src="scripts/process.js"></script>
<script src="scripts/layout-settings.js"></script>
<script src="plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<!-- <script type="text/javascript" src="scripts/jquery.js"></script> -->
<script type="text/javascript" src="scripts/barcode.js"></script>


<script type="text/javascript">

var sound = new Audio("barcode.wav");

$(document).ready(function() {

	barcode.config.start = 0.1;
    barcode.config.end = 0.9;
    barcode.config.video = '#barcodevideo';
    barcode.config.canvas = '#barcodecanvas';
    barcode.config.canvasg = '#barcodecanvasg';
    barcode.setHandler(function(barcode) {
        barcode = barcode.substr(0, 12);
        $('#bar_code_1').html(barcode);
        document.getElementById('bar_code_1').value = barcode;
        return get_detail(barcode,1);

    });

    barcode.init();

	$('#bar_code_1').bind('DOMSubtreeModified', function(e) {
		sound.play();	
	});

});

</script>

    <script>
        var msp;
        var giasp;
        var n;
        function get_detail(a,b) {
                n=1;
                var nx = n+1;
                
                $.ajax({
                    type: 'POST',
                    url: 'ajax_product.php',
                    datatype: "json",
                   // async: false,
                    data:{name:a,action_type:"get_detail_by_name"},
                    success: function (data) {
                        var data = $.parseJSON(data);
                        if(data.type == 'Success'){
                            var barCode = document.querySelectorAll("#dd input[name='bar_code[]']");
                            for(key=0; key < barCode.length - 1; key++)  {
                                if(barCode[key].value == data.bar_code){
                                    alert("Sản phẩm đã được thêm vào 1!");
                                    return false;
                                }					
                            }

                            document.getElementById('name_'+n).value = data.barcode;
                            document.getElementById('sale_price_'+n).value = data.gia_ban;
                            document.getElementById('av_quantity_'+n).value = data.gia_mua;
                            document.getElementById('quantity_'+n).value = 1;
                            msp=data.ten_sp;
                            giasp=data.gia_ban;
                        }else{
                            alert("Không tìm thấy sản phẩm!");
                        }
                    },
                    error: function (data) {
                      //  alert(data.status + ' ' + data.statusText);
                    }
                });
        } ;
        function getSectionStaff(a,b) {
                n=1;
                // var nx = n+1;
                
                //var url = '../Section/GetSectionStaff/?' + 'SectionId=' + sectionId;
               // var selectList = "<label class='control-label text-bold'>Staff</label> <select id='Staff' name='Staff' class='form-control'>";
            //    console.log(nx);

                $.ajax({
                    type: 'POST',
                    url: 'ajax_product.php',
                    datatype: "json",
                   // async: false,
                    data:{name:a,action_type:"get_detail_by_name"},
                    success: function (data) {
                        var data = $.parseJSON(data);
                        // console.log(data);
                        if(data.type == 'Success'){
                            var barCode = document.querySelectorAll("#dd input[name='bar_code[]']");
                            for(key=0; key < barCode.length - 1; key++)  {
                                if(barCode[key].value == data.bar_code){
                                    alert("Sản phẩm đã được thêm vào 2  !");
                                    return false;
                                }					
                            }
                            document.getElementById('bar_code_'+n).value = data.barcode;
                            document.getElementById('sale_price_'+n).value = data.gia_ban;
                            document.getElementById('av_quantity_'+n).value = data.gia_mua;
                            document.getElementById('quantity_'+n).value = 1;
                            msp=data.ten_sp;
                            giasp=data.gia_ban;
                        }else{
                            alert("Prduct Not Found 2!");
                        }
                    },
                    error: function (data) {
                      //  alert(data.status + ' ' + data.statusText);
                    }
                });
        } ;
        let totalgia=0;
        
        function them_hoadon() {
                var barCode = document.querySelectorAll("#ac input[name='bar_code[]']");
                var nx = document.getElementById('bar_code_1').value;
                console.log(nx);
                if(barCode.length == 0){

                 //   alert(1);
                 var newRow = $('#app tbody').append('<tr id='+nx+'><input type="hidden" class="form-control" value="'+document.getElementById('bar_code_'+n).value+'" name="bar_code[]" id="bar_code1_'+nx+'"><td><input id="ten_sp_'+nx+'"  value="'+msp+'" class="form-control" required></td><td><input type="number" id="soluong_'+nx+'" onkeyup="calculate_price1(this.value,'+nx+')" onchange="calculate_price1(this.value,'+nx+')"  value="'+document.getElementById('quantity_'+n).value+'" step="1" class="form-control" onkeyup="calculate_price1(this.value,"'+nx+'") name="quantity[]" required></td><td><input type="number"  class="form-control" value="'+document.getElementById('sale_price_'+n).value+'" onkeyup="get_quantity(this.value,"'+nx+'") name="sale_price[]" id="giabang_'+nx+'" step="1000" required><input type="hidden" class="form-control" id="sale_price_org_'+nx+'" name="sale_price_org[]"><input type="hidden" class="form-control" id="igst_'+nx+'" name="igst[]"></td><td><a href="javascript:;" onclick="remove_data('+ nx +')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="dw dw-delete-3 pd-15"></i>Delete</a></td></tr>');
                    
                 // var newRow = $('#app tbody').append('<tr id='+nx+'><input type="hidden" class="form-control" value="'+document.getElementById('bar_code_'+n).value+'" name="bar_code[]" id="bar_code1_'+nx+'"><td><input   value="'+msp+'" class="form-control" required></td><td><input type="number"  onkeyup="calculate_price1(this.value,'+nx+')" onchange="calculate_price1(this.value,'+nx+')"  value="'+document.getElementById('quantity_'+n).value+'" step="1" class="form-control" onkeyup="calculate_price1(this.value,"'+nx+'") name="quantity[]" required></td><td><input type="number"  class="form-control" value="'+document.getElementById('sale_price_'+n).value+'" onkeyup="get_quantity(this.value,"'+nx+'") name="sale_price[]" id="giabang_'+nx+'" step="1000" required><input type="hidden" class="form-control" id="sale_price_org_'+nx+'" name="sale_price_org[]"><input type="hidden" class="form-control" id="igst_'+nx+'" name="igst[]"></td><td><a href="javascript:;" onclick="remove_data('+ nx +')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="dw dw-delete-3 pd-15"></i>Delete</a></td></tr>');
                    nx ++;
                }

                else if(barCode.length>0){
                    
                    for(key=0; key < barCode.length ; key++)  {
                        if(barCode[key].value == document.getElementById('bar_code_'+n).value ){
                            alert("Sản phẩm đã được thêm vào!");
                            return false;
                        }					
                    }				
                    var newRow = $('#app tbody').append('<tr id='+nx+'><input type="hidden" class="form-control" value="'+document.getElementById('bar_code_'+n).value+'" name="bar_code[]" id="bar_code1_'+nx+'"><td><input id="ten_sp_'+nx+'"  value="'+msp+'" class="form-control" required></td><td><input type="number" id="soluong_'+nx+'" onkeyup="calculate_price1(this.value,'+nx+')" onchange="calculate_price1(this.value,'+nx+')"  value="'+document.getElementById('quantity_'+n).value+'" step="1" class="form-control" onkeyup="calculate_price1(this.value,"'+nx+'") name="quantity[]" required></td><td><input type="number"  class="form-control" value="'+document.getElementById('sale_price_'+n).value+'" onkeyup="get_quantity(this.value,"'+nx+'") name="sale_price[]" id="giabang_'+nx+'" step="1000" required><input type="hidden" class="form-control" id="sale_price_org_'+nx+'" name="sale_price_org[]"><input type="hidden" class="form-control" id="igst_'+nx+'" name="igst[]"></td><td><a href="javascript:;" onclick="remove_data('+ nx +')" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row" data-toggle="tooltip" data-original-title="Remove"><i class="dw dw-delete-3 pd-15"></i>Delete</a></td></tr>');
                    nx ++;
                }
                //console.log(nx);
                            
                
                var newA = [];
                var salePrice = document.querySelectorAll("#ac  input[name='sale_price[]']");
                for(key=0; key < salePrice.length ; key++)  {
                    if(salePrice[key].value != ''){
                        newA.push(parseFloat(salePrice[key].value));
                        totalgia += parseFloat(salePrice[key].value);
                    }
                }
                
                //  console.log(newA);
                 var aac = newA.reduce(getSum);
                document.getElementById('getTotal').value = Math.round(parseFloat(aac));
                return true;    

        } ;
        function calculate_price(q,b){
            var sale_price_org = document.getElementById('sale_price_org_'+b).value;
            var gt = document.getElementById('sale_price_'+b).value = (giasp * q);
            
        }
        function calculate_price1(q,b){
            var a = document.getElementById('bar_code1_'+b).value;
            console.log(a);
            //var sp = document.getElementById('giabang_'+b).value;
            $.ajax({
                type: 'POST',
                url: 'ajax_price.php',
                datatype: "json",
                // async: false,
                data:{name:a,soluong:q},
                success: function (data) {
                    var data = $.parseJSON(data);
                    if(data.type == 'Success'){
                        
                        var gt = document.getElementById('giabang_'+b).value=data.gia_ban;
                        var newA = [];
                        var salePrice = document.querySelectorAll("#ac  input[name='sale_price[]']");
                            for(key=0; key < salePrice.length ; key++)  {
                                if(salePrice[key].value != ''){
                                    newA.push(parseFloat(salePrice[key].value));
                                
                                }
                            }
                            console.log(newA);
                            
                            var aac = newA.reduce(getSum);
                            var tongtien =Math.round(parseFloat(aac));
                            document.getElementById('getTotal').value = tongtien ;
                        
                        
                    }else{
                        alert("Prduct Not Found!");
                    }
                },
                error: function (data) {
                    //  alert(data.status + ' ' + data.statusText);
                }
            });

        }
        function getSum(total, num) {
          return parseFloat(total + num);
        }
        function remove_data(r){
            $('#'+r).remove();
            //Get Value For Total
            var salePrice = document.querySelectorAll("#ac input[name='sale_price[]']");
            var newA = [];
            for(key=0; key < salePrice.length; key++)  {
                if(salePrice[key].value != ''){
                    newA.push(parseFloat(salePrice[key].value));
                }
            }
            var aac = newA.reduce(getSum);
            document.getElementById('getTotal').value = Math.round(parseFloat(aac));
            
        }
    </script>

</body>
<script>
    
var saveBtn = document.getElementById("add-btn");
var printBtn = document.getElementById("print-btn");
var hdmBtn = document.getElementById("hdm-btn");
    $(document).ready(function(){


        $('#print-btn').click(function(){
        
        saveBtn.style.display = "block";

        printBtn.style.display = "none";

        hdmBtn.style.display = "none";
        
        // console.log(product);
            $.ajax({
                url: 'ajax_print.php',
                type: 'POST',
                data: {
                    action: 'print' },
                success: function(data){
                    // console.log(data);
                    var newWindow = window.open();
                    newWindow.document.write(data);
                    newWindow.print();
					location.reload();
                }
            });
        });
    });

    $(document).ready(function(){


        $('#add-btn').click(function(){
            printBtn.style.display = "block";
  
            saveBtn.style.display = "none";


            hdmBtn.style.display = "block";
        var product = [];
        $('tr').each(function(i) {
            var id = $(this).attr('id');
        // Lấy thông tin sản phẩm từ thẻ tr hiện tại
            product[i] = {
                barCode: $(this).find('#bar_code1_'+id).val(),
                name: $(this).find('#ten_sp_'+id).val(),
                quantity: $(this).find('#soluong_'+id).val(),
                salePrice: $(this).find('#giabang_'+id).val(),
            };
        });
       var tongtien= document.getElementById('getTotal').value;
       var id_nv= document.getElementById('id_nv').value;
        
        // console.log(product);
            $.ajax({
                url: 'ajax_print.php',
                type: 'POST',
                data: {
                    product: product,
                    tongtien:tongtien,
                    id_nv:id_nv,
                    action: 'add' },
                success: function(data){
                    console.log(data);
                    // var newWindow = window.open();
                    // newWindow.document.write(response);
                    // newWindow.print();
                }
            });
        });
    });
</script>
