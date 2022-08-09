var delets = document.getElementsByName('delete')
var multyple = 0
var selected = []
delets.forEach(element => {
   element.onmousedown=(e)=>{
     if(e.button===1)
     {
        if(selected.includes(element.id)){
            var index = selected.indexOf(element.id);
            if (index !== -1) {
                selected.splice(index, 1);
            }
            multyple--
            element.style.background="white"
            element.innerHTML = ""
        }
        else{
            multyple++
            selected.push(element.id)
            element.style.background="cyan"
            element.innerHTML = "&#10004"
        }
     }
     else if(e.button===0)
     {
        if(confirm("Do you really want to delete this?"))
        {
            document.getElementById('delete:'+element.id).submit()
        }
     }
   }
});
document.onmousedown=(e)=>{
    if(multyple!=0)
    {
        if(e.button===2)
        {
            if(confirm("Do you really want to delete this?"))
            {
                document.getElementById('delete:list').action="http://127.0.0.1:8000/delete/"+selected+"/-1"
                document.getElementById('delete:list').submit()
            }
        }
    }
}