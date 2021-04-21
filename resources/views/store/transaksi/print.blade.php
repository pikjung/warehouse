<html>
<head>
<title>Layout</title>
<link href="{{asset('template/vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
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

    p {
        margin: 0;
        padding: 0;
    }

    input {
    border: none;
    background: transparent;
    }


    @page {
    size: A4;
    margin: 0;
    }
    /* Kode CSS Untuk PAGE ini dibuat oleh http://jsfiddle.net/2wk6Q/1/ */
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font-family:  consolas , sans-serif;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }

    .fnt-14{
        font-size: 14px;
    }

    .fnt-12{
    }

    .page {
        width: 210mm;
        padding: 5mm;
        margin: 5mm auto;
        border: 1px  solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
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
        border-top: 2px solid black; margin-top:5px;width:110%;margin-left:-15px;
    }


        
    @page {
        size: A4;
        margin: 0;
    }

    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
        /* ... the rest of the rules ... */
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
        border-top: 2px solid black; margin-top:5px;width:110%;margin-left:-15px;
         }
    }

    @media print {
        .page .subpage {
        margin-bottom: 60px;
         }
    }

    @media print {
        pre {
            border: none;
        }
    }
</style>
<body>
<div class="page">
    <div class="subpage">
        <div class="row">
            <div class="col-print-12">
                <img src="{{asset('/img/data_toko/'.$toko->logo)}}" width="50px" alt="Logo"> 
                <span style="font-size: 20; font-weight: bold;"> {{$toko->nama_toko}}</span>
                <br>
           </div>
           <div class="col-print-12">
            <div class="row">
                <div class="col-print-4"></div>
                <div class="col-print-4 leap">
                    <br>
                    <b>INVOICE</b>
                    <br>
                    <br>
                </div>
                <div class="col-print-4"></div>
            </div>
           </div>

           <div class="col-print-6 fnt-12">
            <b>{{$toko->nama_toko}}</b> <br>
            <div style="width: 350px">
                {{$toko->alamat}}
            </div>
            
            
           </div>
           <div class="col-print-1"></div>
           <div class="col-print-5 fnt-12">
            <div class="row">
                <div class="col-print-4">
                    Invoice No <br>
                    Date <br>
                    Due Date <br>
                    Payment Terms <br>		
                </div>
                <div class="col-print-8">
                    : {{$data->no_transaksi}} <br>
                    : @php
                        echo date('d M Y');
                    @endphp <br>
                    : - <br>
                    : <br>
                </div>
            </div>
           </div>

           <div class="col-print-8 fnt-12">
            <b>{{$data->customer}}</b> <br>
            <div style="width: 350px">
                {{$data->alamat}} <br>
                <b><div id="edit_attn"></div></b> 
            </div>
            
           </div>
           <div class="col-print-4 fnt-12"></div>

           <div class="col-print-12 fnt-12">
               <hr>
               <div class="row">
                    <div class="col-print-1">
                    <b>No.</b>
                   </div>
                   <div class="col-print-3">
                    <b>MODEL & DESCR. <br>
                        Nama Barang Kena Pajak</b>
                   </div>
    
                   <div class="col-print-2">
                    <b>QTY</b>
                   </div>

                   <div class="col-print-3">
                    <b>UNIT PRICE (IDR)</b>
                   </div>

                   <div class="col-print-3">
                    <b>TOTAL PRICE (IDR)</b>
                    </div>
               </div>
               <hr>
           </div>
           <div class="col-print-12">
               <br>
           </div>
           @php
               $no = 0;
               $total = 0;
               $serial = app('App\Http\Controllers\transaksiController');
           @endphp
           <div class="col-print-12 fnt-12">
            @foreach ($det as $item)
                <div class="row">
                    <div class="col-print-1">
                        {{$no +=1}} .
                    </div>
                    <div class="col-print-3">
                        <div style="width: 150px">
                            {{$item->nama_barang}}
                        </div>
                    </div>
                    <div class="col-print-2">
                        {{$item->qty}} UNIT
                    </div>
                    <div class="col-print-3">
                        <div class="row">
                            <div class="col-print-2">IDR</div>
                            <div class="col-print-10">{{$serial->rupiah($item->harga_jual)}}</div>
                        </div>
                    </div>
                    <div class="col-print-3">
                        <div class="col-print-2">IDR</div>
                        <div class="col-print-10"><input id="data" type="text" value="{{$serial->rupiah($item->harga_jual * $item->qty)}}"></div>
                    </div>
                    @php
                        $total += $item->harga_jual * $item->qty;
                    @endphp

                </div>
            @endforeach
           </div>

           <div class="col-print-12">
               <br>
               <hr>
           </div>

           <div class="col-print-12">
               <div class="row">
                   <div class="col-print-6"></div>
                   <div class="col-print-6">
                       <div class="row">
                           <div class="col-print-6">
                            Harga Jual <br>
                            Diskon/Potongan Harga <br><br>
                            TOTAL (IDR) 
                           </div>
                           <div class="col-print-6">
                            IDR {{$serial->rupiah($total)}} <br>
                            <input type="" value=""><br>
                            <hr>
                            <input type="" value="IDR {{$serial->rupiah($total)}}">
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <div class="col-print-12">
               <br>
               <b>{{$serial->terbilang($total)}} RUPIAH</b>
               <hr>
           </div>

           <div class="col-print-12">
               <div class="row">
                   <div class="col-print-8">

                   </div>
                   <div class="col-print-4" style="text-align: center">
                    Jakarta, {{date('d M Y')}}
                    <br><br><br><br><br>
                    <u>{{$toko->nama_toko}}</u><br>
                   </div>
               </div>
           </div>
           <div class="col-print-12">
               <br>
               <p>
                Seluruh pembayaran harus dilakukan sesuai dengan mata uang yang tertera di dokumen penagihan ini
                (total invoice). Pembayaran adalah sah/lunas setelah clearing diterima dengan baik pada bank
                kami: <br> <br>
                <b>
                    Bank Central Asia (BCA) A/C No. (IDR): 7830-4133-88 <br>
                </b>
               <br> <br>
                Setiap dan semua pelanggan/pembeli yang melanggar ketentuan ini wajib bertanggung jawab
                sepenuhnya dan karenanya harus mengganti seluruh kekurangan dan kerugian yang timbul atau akan
                timbul dari pelanggaran sebagaimana dimaksud tanpa ada yang dikecualikan.
               </p>
           </div>

           <div class="col-print-12">
            <div class="col-print-6"><input type="text" name="" value=""></div>
            <div class="col-print-6" style="text-align: right">White: Customer, Blue/Red: Admin Sales</div>
           </div>
        </div>
    </div>
</div>
</body>
<script>
  //var editor2 = new Quill(document.getElementById('edit_attn'));
</script>

<script>
    //window.print()
    //var grand_total = prompt("Input Grand Total");
    //var jum = grand_total / 1.1
    //function numberWithCommas(x) {
    //return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    //}
    //document.getElementById('sub_total').innerHTML = "IDR " + numberWithCommas(Math.round(jum))
    //document.getElementById('sub_total2').innerHTML = "IDR " + numberWithCommas(Math.round(jum))
    //document.getElementById('vat').innerHTML = "IDR " + numberWithCommas(Math.round(jum * 10/100))
    //document.getElementById('grand_total').innerHTML = "IDR " + numberWithCommas(grand_total)
</script>
</head>
</html>