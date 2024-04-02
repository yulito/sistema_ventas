export function docPDF(element,docSale,msg){

    const today = new Date();
    var doc = new jsPDF();

    doc.setFontSize(18);
    doc.setTextColor(5, 105, 5);
    doc.text(20,10,'SISTEMA DE VENTAS -- Fecha: '+today.toLocaleDateString()); 

    doc.setFontSize(16);
    doc.setTextColor(0,0,0);
    doc.text(20, (18),'Tipo de documento: '+docSale+' -- Nro documento: '+msg.nro);
    doc.setFontSize(14);
    doc.setTextColor(0,0,0);
    doc.text(20, (23),'***********************************************************************************************');
    doc.text(20, (28),'Subtotal: $'+element.totalSale.subtotal+' \| '+
                        'Descuento total de la compra: '+element.totalSale.descxtotal+'% \| '+
                        'TOTAL COMPRA: $'+element.totalSale.total);
    doc.setFontSize(12);
    let i = 30
    if(docSale == 'factura'){
        //datos factura    
        doc.text(20,(i+5), 'Razón social: '+element.totalSale.nameCompany)
        doc.text(20,(i+10), 'Rut: '+element.totalSale.rutCompany)
        doc.text(20,(i+15), 'Dirección: '+element.totalSale.addressCompany)                  
        if(msg.location){            
            doc.text(20,(i+20), 'Comuna: '+msg.location.comuna_) 
        }else{ doc.text(20,(i+20), 'Comuna: --') }         
    }    
    doc.text(20, (i+=26),'********************************************************************************************');
   
    element.details.forEach(data => {            
        data.product, data.qn, data.val, data.valueu, data.total
        doc.text(20,(i+=5), 'Producto: '+data.product) 
        doc.text(20,(i+=5), 'Cantidad: '+data.qn+'  \|  Val/uni: '+data.val+'  \|  Desc/prod: '+data.valueu+'%  \|  Total: '+data.total)
        doc.text(20,(i+=5), '_____________________________________________________________________________')
    })
    doc.save(docSale+'_'+today.toLocaleDateString()+'_'+msg.nro+'_'+'venta.pdf');
}