<html>
<head>
<title>Layout</title>
<link href="{{asset('template/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
<script src="{{asset('template/vendors/jquery/dist/jquery.min.js')}}"></script>

<!-- Main Quill library -->
<script src="//cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="//cdn.quilljs.com/1.3.6/quill.min.js"></script>

<!-- Theme included stylesheets -->
<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

<!-- Core build with no theme, formatting, non-essential modules -->
<link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
<script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script>
<style>
    .mid {
        text-align: center;
        vertical-align: top;
    }

    .leap {
        text-align: center;
        vertical-align: center;
    }


    .laep {
        text-align: left;
        vertical-align: top;
    }

    .lep {
        text-align: right;
        vertical-align: bottom;
    }

    input {
    border: none;
    background: transparent;
    }


    @page {
    size: letter;
    margin: 0;
    }
    /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt;
        font-family:  Calibri , sans-serif;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .fnt-14{
        font-size: 16px;
    }

    .fnt-12{
        font-size: 14px;
    }

    p {
        margin: 0;
        padding: 0;
    }

    .page {
        width: 215.9mm;
        height: 279.4mm;  
        padding: 5mm;
        margin: 5mm auto;
        border: 1px  solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        height: 257mm;
        outline: 2cm white solid;
    }

    .left {
    width: 60%;
    }

    .right {
    width: 40%;
    }

    .center {
    width: 50%;
    }

    .full {
        width: 100%;
    }

    .flt-right {
        float: right;
    }

    .col-print-1 {width:8%;  float:left;}
    .col-print-2 {width:16%; float:left;}
    .col-print-3 {width:25%; float:left;}
    .col-print-4 {width:33%; float:left;}
    .col-print-5 {width:42%; float:left;}
    .col-print-6 {width:50%; float:left;}
    .col-print-7 {width:58%; float:left;}
    .col-print-8 {width:66%; float:left;}
    .col-print-9 {width:75%; float:left;}
    .col-print-10{width:83%; float:left;}
    .col-print-11{width:92%; float:left;}
    .col-print-12{width:100%; float:left;}

    #customers {
    font-family: Arial, Verdana, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    #customers td, #customers th {
    border: 1px solid #ddd;
    padding: 8px;
    }


    #customers th {
    padding-top: 12px;
    padding-bottom: 12px;
    font-size: 12px;
    text-align: left;
    background-color: black;
    color: white;
    }

    #table_total #kiri {
        background-color: #404040;color:white;text-align:right;
    }

    hr {
        border-top: 5px solid black; margin-top:5px;width:110%;margin-left:-15px;
    }


        
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }

    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
        /* ... the rest of the rules ... */
        }

    @media print {
    tr.vendor {
        background-color: black !important;
        -webkit-print-color-adjust: exact; 
        }
    }

    @media print {
        .vendor th {
            color: white !important;
        }
    }

    @media print {
    td#kiri {
        background-color: #404040 !important;
        -webkit-print-color-adjust: exact; 
        }
    }

    @media print {
        hr {
        border-top: 5px solid black; margin-top:5px;width:110%;margin-left:-15px;
         }
    }
</style>
<body>
<div class="page">
   <div class="subpage">
    <div class="row">
        <div class="col-print-6 fnt-12 h-5">
            <h3><b>Purchase Order</b></h3>
            <br>
            <div style="line-height: 3px;">
                <div style="margin-top:-5px;"><b>Date:</b> @php
                    $date = \Carbon\Carbon::now();
                    echo $date->format('F')." ". $date->format('d'). ", " . $date->format('Y') ; 
                @endphp  <br></div>
                <hr style="border-top: 1px dotted black; margin-top:7px;"><br>
                <div style="margin-top:-5px;"><b>PO. No:</b> {{$pogsc->no_po_gsc}} <br></div>
                <hr style="border-top: 1px dotted black; margin-top:7px;"><br>
                <div style="margin-top:-5px;"><b>Payment Terms:</b> {{$pogsc->payment_terms}}</div>
            </div>
           </div>
           <div class="col-print-6 fnt-12 flt-rigth">
           <div class="float-right text-right">
            <img src="{{asset('/img/original.png')}}" width="50px" alt="Logo"><br>
            <i>PT. Gosyen Solusindo Cemerlang</i><br>
            <i>Email: gosyensc@gosyen.id</i><br>
            <i>http://www.gosyen.co.id</i>
           </div>
           </div>
       </div>
       <div class="col-print-12">
           <br>
        <hr style="border-top: 5px solid black; margin-top:5px;width:110%;margin-left:-15px;">
       </div>

       <div class="col-print-12">
        <table id="customers" >
            <tr class="vendor">
              <th>Vendor</th>
              <th>Ship To</th>
              <th>Other Information</th>
            </tr>
            <tr>
              <td class="fnt-12 laep" width="30%">
                  <b>{{$pogsc->nama_disti}}</b> <br> <br>
                    Bp. {{$pogsc->name}}<br>
                  {{$pogsc->alamat}} <br>
                  <br>
                  <b>
                    Fax: {{$pogsc->fax}} <br>
                    No. Telp: {{$pogsc->no_telp}}
                  </b>
              </td>
              <td width="30%" class="fnt-12 laep" id="edit_ship">
                  <b>PT. Gosyen Solusindo Cemerlang</b> <br>  <br>
                  Ibu Faradila<br>
                  <br>
                  Jl. Pahlawan Revolusi No.7a, RT.1/RW.4, Pd. Bambu, Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13430 
                  <br>
                  <br>
                  <b>
                      Fax : <br>
                      Telp : <br>
                  </b>
              </td>
              <td width="40%" class="fnt-12 leap">
                {{$pogsc->noted}}
              </td>
            </tr>
          </table>
       </div>

       <div class="col-print-12" style="height: 300px">
           <br>
        <table id="customers" class="fnt-12">
            <tr class="vendor">
              <th>Item #</th>
              <th>Product Name /Description</th>
              <th class="mid">Qty</th>
              <th class="mid">Unit Price</th>
              <th class="mid">Total</th>
            </tr>
            @php
                $no = 1;
                $rupiah = app('App\Http\Controllers\gscController');
                $jum = 0;
            @endphp
            @foreach ($det as $item)
                <tr>
                <td width="10%">{{$no}}</td>
                <td width="50%">{{$item->nama_barang}} <br> {{$item->spek}}</td>
                <td class="mid" width="10%">{{$item->quantity}}</td>
                <td class="mid" width="15%">Rp. {{$rupiah->rupiah($item->harga_beli_satuan)}}</td>
                <td class="mid" width="15%"><input type="text" value="Rp. {{$rupiah->rupiah($item->harga_beli_satuan * $item->quantity)}}"></td>
                </tr>
                @php
                    $jum = $jum + $item->harga_beli_satuan * $item->quantity;
                @endphp
            @endforeach
          </table>
       </div>

       <div class="col-print-6">
           <div><br></div>
       </div>
       <div class="col-print-6" style="height: 100px">
           <table class="fnt-12" class="table table-stripped" id="table_total">
               <tr>
                   <td id="kiri" style="background-color: #404040;color:white;text-align:right;" width="60%">Sub Total:</td>
                    <td width="30%"><p id="sub_total2"></p></td>
               </tr>
               <tr>
                   <td id="kiri" style="background-color: #404040;color:white;text-align:right;">VAT:</td>
                    <td><p id="vat"></p></td>
               </tr>
               <tr>
                   <td id="kiri" style="background-color: #404040;color:white;text-align:right;">Grand Total:</td>
                   <td><p id="grand_total"></p></td>
               </tr>
           </table>
           <br>
           <br>
           <br><br>
       </div>

       <div class="col-print-12">
           <br><br>
       </div>

       <div class="col-print-6">
           Date <br>
           <hr style="border-top: 1px dotted black; margin-top:7px; width:300px;">
           @php
                $date = \Carbon\Carbon::now();
                echo $date->format('F')." ". $date->format('d'). ", " . $date->format('Y') ; 
            @endphp 
       </div>

       <div class="col-print-6">
           Authorized Signature
           <hr style="border-top: 1px dotted black; margin-top:7px;">
           <br>
       </div>

       <div class="col-print-12 fnt-12">
           <br>
           <br>
        <div class="mid">
            If you have any questions, concerns or queries regarding this PO, please feel free to contact with Fara at 0812-1810-4411
        </div>
       </div>

       <div class="col-print-12">
        <div class="lep">
            Powered By: <b>Gosyensc</b>
        </div>
       </div>
   </div>
</div>
</body>
<script>
    //window.print()
    var grand_total = prompt("Input Grand Total");
    var jum = grand_total / 1.1
    function numberWithCommas(x) {
    return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }
    document.getElementById('sub_total2').innerHTML = "Rp." + numberWithCommas(Math.round(jum))
    document.getElementById('vat').innerHTML = "Rp." + numberWithCommas(Math.round(jum * 10/100))
    document.getElementById('grand_total').innerHTML = "Rp." + numberWithCommas(grand_total)
</script>

<script>
    var editor2 = new Quill(document.getElementById('edit_ship'));
  </script>
</head>
</html>