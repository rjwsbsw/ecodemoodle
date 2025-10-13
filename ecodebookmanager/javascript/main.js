// to add javascript code
function saveCustomerVariable()
{
    var host = $('#host').val();
    var sc = $('#sc').val();
    var shs = $('#shs').val();
    var ok = true;
    
    if (!host.trim().length)
    {
        $('#host').attr('style','border:1px solid red');
        ok = false;
    }
    if (!sc.trim().length)
    {
        $('#sc').attr('style','border:1px solid red');
        ok = false;
    }
    if (!shs.trim().length)
    {
        $('#shs').attr('style','border:1px solid red');
        ok = false;
    }
    if (ok)
    {
        saveData(host,sc,shs);
    }
    else
    {

        $('#required').show();
        $('#yes').hide();
        $('#no').hide();
    }
}
function saveData(host,sc,shs)
{
    shs = shs.replace('+','___')
    var theUrl = encodeURI("savedata/savedata.php?host="+host+"&sc="+sc+"&shs="+shs);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send();
    if (xmlHttp.readyState === xmlHttp.DONE) {
        if (xmlHttp.status === 200) {
            $('#yes').show();  
            $('#required').hide();
            $('#no').hide();         
        }
        else
            {
                alert('Error(2), Bad Response: Es ist ein Fehler aufgetreten!')
                $('#no').show();
                $('#required').hide();
                 $('#yes').hide();   
            }
    }
    else
    {
        alert('Error(1), Bad Request: Es ist ein Fehler aufgetreten!')
        $('#no').show();
        $('#required').hide();
        $('#yes').hide();
    }

}