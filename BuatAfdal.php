<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="packing">
        <select name="packings_id[]" data-live-search="true"><option value="1">Carton (24 x 1Ltr)</option><option value="2">Pail (18 Ltr)</option><option value="3">Carton (12 x 1Ltr)</option><option value="7">Carton (36 x 170ML)</option><option value="8">Carton (24 x 300ML)</option><option value="9">Carton (12 x 900ML)</option><option value="10">Carton (1 x 20Ltr)</option><option value="11">Carton (1 x 200Ltr)</option></select>
        <button type="button" onclick="addformfield()">Add More
        </button>
    </div>
    <div id="product_field"></div>
    <script>
        $('select').attr('data-live-search', 'true');
        $('select').attr('data-style', 'form-control');
        $('select').selectpicker();
        var counter = 1;
            function addformfield() {
                counter += 1;
                var packing = $('#packing');
                var clone = packing.clone();
                clone.appendTo('#product_field');
                clone.attr('id', 'packing_' + counter);
                clone.find('.bootstrap-select').remove();
                clone.find('select').selectpicker();
            }
    </script>
</body>
</html>