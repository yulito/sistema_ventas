export function docPDF(element, docSale, msg) {

    //formato moneda
    const formatoCLP = new Intl.NumberFormat('es-CL', {
        style: 'currency',
        currency: 'CLP',
        minimumFractionDigits: 0
    });

    const today = new Date();
    const doc = new jsPDF();
    const pageHeight = doc.internal.pageSize.height;
    let i = 15;

    const saltoLinea = (texto, fontSize = 12, color = [0, 0, 0]) => {
        doc.setFontSize(fontSize);
        doc.setTextColor(...color);
        if (i + 15 > pageHeight) {
            doc.addPage();
            i = 15;
        }
        doc.text(20, i, texto);
        i += 5;
    };

    // Encabezado
    saltoLinea('Ferreteria Donde el Pelao -- Fecha: ' + today.toLocaleDateString(), 18, [5, 105, 5]);
    saltoLinea('Tipo de documento: ' + docSale + ' -- Nro documento: ' + msg.nro, 16);
    saltoLinea('***********************************************************************************************', 14);
    saltoLinea('Subtotal: $' + element.totalSale.subtotal + ' | Descuento total de la compra: ' + element.totalSale.descxtotal + '%', 14);

    // Datos factura
    if (docSale === 'factura') {
        saltoLinea('Razón social: ' + element.totalSale.nameCompany);
        saltoLinea('Rut: ' + element.totalSale.rutCompany);
        saltoLinea('Dirección: ' + element.totalSale.addressCompany);
        saltoLinea('Comuna: ' + (msg.location ? msg.location.comuna_ : '--'));
    }

    saltoLinea('********************************************************************************************');

    // Detalles
    let index = 1;
    element.details.forEach(data => {
        saltoLinea(index+') Producto: ' + data.product);
        saltoLinea('Cantidad: ' + data.qn + ' | Val/uni: ' + formatoCLP.format(data.val) + ' | Desc/prod: ' + data.valueu + '% | Total: ' + formatoCLP.format(data.total));
        saltoLinea(' ');
        index = index + 1;
    });

    // Total
    saltoLinea('TOTAL COMPRA: ' + formatoCLP.format(element.totalSale.total), 18);

    doc.save(docSale + '_' + today.toLocaleDateString() + '_' + msg.nro + '_venta.pdf');
}
