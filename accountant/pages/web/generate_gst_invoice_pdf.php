<html>
<style>
    table,
    tr,
    td {
        padding: 4px;
        border: 1px solid black;
        border-collapse: collapse;
    }

    table {
        width: 100%;
    }

    .right {
        float: right;
    }

    .right-text {
        text-align: right;
    }

    .left-text {
        text-align: left;
    }

    h2 {
        text-align: center;
        margin-top: 10%;
    }
   
</style>
<body>
    <div id="html" style="width: 560px; font-family:Arial;margin:0 auto;"></div>
    <div style="width: 560px; font-family:Arial;margin:0 auto;margin-top:3%;text-align:center;">
        <button onclick="generatePDF()">Print</button>
        <button onclick="window.history.back()">Go back</button>
    </div>
<?php require_once("./layout/footer_links.php"); ?>
<script src="/new/oba/accountant/js/generate_gst_pdf.js"></script>
<script type="text/javascript">
    //getInvoiceData('2024/Bhaguwala/1');
    var invoice_number = localStorage.getItem('invoice_number');
    getInvoiceData(invoice_number);
   
</script>

</body>
</html>