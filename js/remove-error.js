document.addEventListener("DOMContentLoaded",()=>{

      setInterval(() => {
          removeErrors()
      }, 2000);
      
  })
  function removeErrors(){
      let errors=document.querySelectorAll('.msg')
      errors.forEach(e=>{
          e.remove()
      })
  }