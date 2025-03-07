let h1 = document.querySelector("h1");
h1.append(nUsuario);

const bAddTarea = document.getElementById("bAddTarea");
const nuevaTareaDiv = document.getElementById("nuevaTarea");
const bAñadirTarea = document.getElementById("bAñadirTarea");
const tablaTareas = document.querySelector("#tablaTareas tbody");

bAddTarea.addEventListener("click", () => {
  nuevaTareaDiv.hidden = false;
});

bAñadirTarea.addEventListener("click", await agregarTarea);


async function agregarTarea(){
  let tituloTarea = document.getElementById("tituloTareaNueva").value;
  let descripcionTarea = document.getElementById("descripcionTareaNueva").value;
  let fechaLimite = document.getElementById("fechaLimiteTareaNueva").value;

  let tareaNueva = {
    titulo: tituloTarea,
    descripcion: descripcionTarea,
    fechaLimite: fechaLimite,
    nUsuario: nUsuario,
  };

  try {
    let response = await fetch("../controller/controlTareas.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(tareaNueva),
    });
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    let responseText = await response.json();
    console.log(responseText);
    
  } catch (error) {
    console.error("Error al añadir la tarea:", error);
  }
}
