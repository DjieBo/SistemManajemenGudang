function cekBarang(idbarang)
{   $.ajax({
        url: 'config/deskrip.php',
        data : 'idbarang='+idbarang,
        type: "post", 
        dataType: "html",
        timeout: 10000,
        success: function(response){
            $('#deskrip').html(response);
        }
    });
}

function SelectProv(prov)
{   $.ajax({
        url: 'config/location.php',
        data : 'prov='+prov,
        type: "post", 
        dataType: "html",
        timeout: 10000,
        success: function(response){
            $('#kota').html(response);
        }
    });
}

function SelectProvOut(provout)
{   $.ajax({
        url: 'config/location.php',
        data : 'provout='+provout,
        type: "post", 
        dataType: "html",
        timeout: 10000,
        success: function(response){
            $('#cityout').html(response);
        }
    });
}

function SelectProvStock(provstock)
{   $.ajax({
        url: 'config/ware.php',
        data : 'provstock='+provstock,
        type: "post", 
        dataType: "html",
        timeout: 10000,
        success: function(response){
            $('#stockgetcity').html(response);
        }
    });
}

function SelectIslandOut(pulauout)
{   $.ajax({
        url: 'config/ware.php',
        data : 'pulauout='+pulauout,
        type: "post", 
        dataType: "html",
        timeout: 10000,
        success: function(response){
            $('#provselect').html(response);
        }
    });
}