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
        font-family:  Calibri , sans-serif;
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
                <img src="{{asset('/img/original.png')}}" width="50px" alt="Logo"> 
                <span style="font-size: 20; font-weight: bold;"> PT GOSYEN SOLUSINDO CEMERLANG</span>
                <br>
           </div>
           <div class="col-print-12">
            <pre class="fnt-14 leap">
                <b>DELIVERY NOTE</b>
           </pre>
           </div>

           <div class="col-print-6 fnt-12">
            <b>PT. GOSYEN SOLUSINDO CEMERLANG</b> <br>
            <div style="width: 200px">
                Jl. Pahlawan Revolusi No.7a, RT.1/RW.4, Pd. Bambu, Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13430
            </div>
            
            
           </div>
           <div class="col-print-6 fnt-12">
            <div class="row">
                <div class="col-print-6">
                    Delivery Note <br>
                    Date <br>
                    PO No. <br>			
                </div>
                <div class="col-print-6">
                    : {{$paket->dn_no}} <br>
                    : @php
                        echo date('d M Y');
                    @endphp <br>
                    : <br>
                </div>
            </div>
           </div>

           <div class="col-print-8 fnt-12">
            <b>{{$expedisi->nama_expedisi}}</b> <br>
            <div style="width: 200px">
                {{$expedisi->alamat_expedisi}} <br><br>
            </div>
            
           </div>
           <div class="col-print-4 fnt-12"></div>

           <div class="col-print-12 fnt-12">
               <hr>
               <div class="row">
                <div class="col-print-1">
                    No.
                   </div>
                   <div class="col-print-9">
                    Description
                   </div>
    
                   <div class="col-print-2">
                    QTY/EA
                   </div>
               </div>
               <hr>
           </div>
           @php
                $no = 0;
                $serial = app('App\Http\Controllers\transaksiController');
                $det = app('App\Http\Controllers\transaksiController');
            @endphp
           @foreach($pouser as $data)
           <div class="col-print-12 fnt-12">
            @foreach ($det->det_pouser($data->userReq_id) as $item)
                <div class="row">
                    <div class="col-print-1">
                        {{$no +=1}}.
                    </div>
                    <div class="col-print-9">
                        {{$item->nama_barang}}
                    </div>
                    <div class="col-print-2">
                        {{$item->quantity}} UNIT
                    </div>
                    <div class="col-print-1">
                        
                    </div>
                    <div class="col-print-9 fnt-12 serial">
                        <div id="toolbar"></div>
                    <div id="editor{{$no}}" class="fnt-12">
                            {{$serial->panggil_serial($item->userReq_det_id)}}
                        </div>
                    </div>
                    <div class="col-print-2">
                        
                    </div>
                </div>
            @endforeach
           </div>
           @endforeach

           <input type="hidden" id="row" value="{{$no}}">

           <div class="col-print-8">

           </div>
           <div class="col-print-4 fnt-12">
               <br><br><br>
                Received By: <br>
                <b>{{$expedisi->nama_expedisi}}</b>
                <br><br><br><br><br>
                Name:______________ <br>
                                    
                Date:______________ <br>
                (Please sign & stamp)

           </div>
        </div>
    </div>
</div>
</body>
<script>
  var row =  document.getElementById('row').value;
  for (let i = 0; i <= row; i++) {
    var editor = new Quill(document.getElementById('editor'+i));  
  }

</script>
</head>
</html>