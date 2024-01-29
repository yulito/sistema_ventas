import {docPDF} from './generatorPDF.js'
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
            if(msg.fail){
                document.getElementById('msg-wait').style.color = 'red';
                document.getElementById('msg-wait').innerHTML = '<i>'+msg.fail+'</i>';                
                saveBtn.disabled = true
            }
            if(msg.success){
                document.getElementById('msg-wait').style.color = 'green';
                document.getElementById('msg-wait').innerHTML = '<i>'+msg.success+'</i>';
                btnPDF.hidden = false  
                saveBtn.disabled = true                
                //eliminamos localstorage
                localStorage.clear()
                //btn pdf con un evento listener,
                btnPDF.addEventListener('click',(e)=>{
                    e.preventDefault
                    btnPDF.disabled = true
                    //deberiamos agregar los parametros que faltan para datos del pdf                      
                    docPDF(dtSale,docSale,msg) //dtSale es el clon del arreglo rescatado del localstorage que enviamos al backend
                    location.href = "/"
                })
            }            

        })
        .catch( err => console.log(err) )
    }

})


