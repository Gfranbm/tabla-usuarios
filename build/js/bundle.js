function advertencia(e){if(confirm("¿Estás seguro de eliminar este registro?"))return!0;e.preventDefault()}function mostrarAlerta(){document.querySelectorAll(".confirmacion").forEach(e=>{e.addEventListener("click",advertencia)})}document.addEventListener("DOMContentLoaded",(function(){mostrarAlerta()}));
//# sourceMappingURL=bundle.js.map
