var QR_Altasib =
{
        openQr: function()
        {

        var divQr = BX(this.id+'_big');
        if (!divQr)
              return;

        divQr.style.display = "block";

        var QrImgBig = BX(this.id+'_bigimg');
        var QrImg = BX(this.id+'_mini');
        leftQr = Math.round(-(QrImgBig.width  - QrImg.width)/2)+"px";
        topQr = Math.round(-(QrImgBig.height  - QrImg.height)/2)+"px";
        divQr.style.marginLeft = leftQr;
        divQr.style.marginTop = topQr;

        return false;
        },
        closeQr: function ()
        {
        divQr = this;
        if (!divQr)
          return;
           divQr.style.display = "none";
        }
}
