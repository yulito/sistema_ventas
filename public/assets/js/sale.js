//Datos de localstorage
const vTotal = JSON.parse(localStorage.getItem("totalSale"));
const detailList = JSON.parse(localStorage.getItem("productRow"));

//redireccionar en caso de no haber datos en localstorage
window.addEventListener('load',(e)=>{
    e.preventDefault
        
    if(!vTotal){
        location.href = "/"
    }
})

//******************************************************************* */
function infoDoc(dt){
    /* 
        totalSale contendra solo el total de la venta (en caso de ser boleta) 
        o contendra el total + los datos del comprador (en caso de ser factura)
    */
    return{
            totalSale:dt,
            details:detailList
    }
}
//tipo de documento (boleta o factura)
const docSale = document.getElementById('document-sale').textContent
const formDoc = document.getElementById('formBill')
const saveBtn = document.querySelector('.btn-save-doc')
const descxtotal = document.getElementById('descxtotal')
const btnPDF = document.getElementById('pdf-generator')
//elemento  de valor total
const vT = document.getElementById('tValue')
vT.innerHTML = vTotal

//evento para descuento del total final
descxtotal.addEventListener('keyup',(e)=>{
    e.preventDefault
    vT.innerHTML = vTotal - (vTotal * descxtotal.value /100)    
})

//evento para guardar cambios y efectuar venta
saveBtn.addEventListener('click',(e)=>{
    e.preventDefault
    
    //mostrar mensaje de "procesando datos"
    document.getElementById('msg-wait').hidden = false;
    document.getElementById('msg-wait').style.color = 'blue';
    document.getElementById('msg-wait').innerHTML = '<i>PROCESANDO LOS DATOS...</i>';

    const data = new FormData(formDoc)

    //agregamos el total a los datos del formulario
    data.append('total',Number(vT.innerHTML))
    data.append('subtotal',Number(vTotal)) 
    
    //clonamos lo de localstorage y form para usar en PDF
    const dtSale = {...infoDoc(Object.fromEntries(data))}    

    //---- BOLETA
    if(docSale === 'boleta'){ 
        sendPOST("1")
    }

    //---- FACTURA
    if(docSale === 'factura'){
        sendPOST("2")
    }

    //----
    //Enviando el POST
    function sendPOST(id){
        fetch('/documento/'+id,{
            method:'post',
            body:JSON.stringify(infoDoc(Object.fromEntries(data))),
            headers: {
                "Content-Type": "application/json"
            }
        }).then( response => response.json() )
        .then( msg =>{           
            //una vez confirma con un msg positivo, activamos el hidden del mensaje de espera y habilitamos el btn PDF.
            document.getElementById('msg-wait').style.color = 'green';
            document.getElementById('msg-wait').innerHTML = '<i>'+msg+'</i>';
            btnPDF.hidden = false  
            saveBtn.disabled = true                
            //eliminamos localstorage, operamos btn pdf con un evento listener, creamos pdf y redireccionamos a ventas
            localStorage.clear()
            console.log('datos de localstorage eliminados \n estos datos para el pdf son del clon: ')
            console.log(dtSale)

        })
        .catch( err => console.log(err) )
    }

})


