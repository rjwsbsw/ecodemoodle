const links = document.getElementsByClassName('aclass');
for (let i = 0; i < links.length; i++) {
    var obj = links[i];
    var idd = obj.getAttribute('id');
    var allinfo = atob(idd);
    var allinfolist = JSON.parse(allinfo);
    var orderid = allinfolist['orderid'];
    var bookid = allinfolist['id'];
    var email = allinfolist['email'];
    var name_ = allinfolist['name'];
    var ordersource_ = allinfolist['ordersource'];
    var host_ = allinfolist['host'];
    sharedsecret_ = allinfolist['sharedsecret']
    sharedsecret_ = sharedsecret_.replace('+','___')
    obj.addEventListener('click', event => {
        callmagiclink(bookid,orderid,email,name_,ordersource_,sharedsecret_,host_);
        });    
  }

  function isValidURL(string) {
    var res = string.match(/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
    return (res !== null)
  };
function callmagiclink(bookid,booktitle,email,name_,ordersource_,sharedsecret_,host_)
{
    var theUrl = "magiclink/getlink.php?resid="+bookid+"&orderid="+booktitle+"&email="+email+"&name="+name_+"&ordersource="+ordersource_+"&sharedsecret="+sharedsecret_+"&host="+host_;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", theUrl, false ); // false for synchronous request
    xmlHttp.send();
    if (xmlHttp.readyState === xmlHttp.DONE) {
        if (xmlHttp.status === 200) {
            if (isValidURL(xmlHttp.response))
            {
                window.location.href=xmlHttp.response;
            }
            else
            {
                alert('Error(3): Es ist ein Fehler aufgetreten, bitte überprüfen Sie Ihren Code!')
            }
           
        }
        else
            {
                alert('Error(2): Es ist ein Fehler aufgetreten, bitte überprüfen Sie Ihren Code!')
            }
    }
    else
    {
        alert('Error(1): Es ist ein Fehler aufgetreten, bitte überprüfen Sie Ihren Code!')
    }
   

}