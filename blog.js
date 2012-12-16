function showRSS(source, num)
{
    xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("rssOutput").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "getblog.php?s=" + source + "&n=" + num, true);
    xmlhttp.send();
}