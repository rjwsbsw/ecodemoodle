var selectbooksid = document.getElementById('selectbooksid');
if (selectbooksid)
{
    try
    {
        document.getElementById('namelable').value = selectbooksid.options[selectbooksid.selectedIndex].text;
        var getvalue = selectbooksid.options[selectbooksid.selectedIndex].value;
        if (getvalue)
        {
            getvalues = getvalue.split('###');
            document.getElementById('bookidlable').value = getvalues[0].trim();
            document.getElementById('host').value = getvalues[1].trim();
            document.getElementById('ordersourcelable').value = getvalues[2].trim();
            document.getElementById('sharedsecretlable').value = getvalues[3].trim();
        }
    }
    catch (error) 
    {
        console.log(error);
    }
}
else
{
    console.log('can not find Element with id: selectbooksid!');
}
