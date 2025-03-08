let h1 = document.querySelector("h1");
h1.append(nUsuario);

const bAddTarea = document.getElementById("bAddTarea");
const nuevaTareaDiv = document.getElementById("nuevaTarea");
const bAñadirTarea = document.getElementById("bAñadirTarea");
const tablaTareas = document.querySelector("#tablaTareas tbody");

verTareas();

bAddTarea.addEventListener("click", () => {
  nuevaTareaDiv.hidden = false;
});

bAñadirTarea.addEventListener("click", agregarTarea);

async function verTareas() {
  tablaTareas.innerHTML =
    "<tr><th>Tarea</th>" +
    "<th>Descripción</th>" +
    "<th>Fecha Inicio</th>" +
    "<th>Fecha Fin</th></tr>";
  try {
    let response = await fetch("../controller/verTareas.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(nUsuario),
    });
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    } else {
      let resultado = await response.json();
      if (resultado.length > 0) {
        resultado.forEach((tarea) => {
          let tr = document.createElement("tr");
          let bEditar = document.createElement("input");
          bEditar.type = "button";
          bEditar.value = "Editar";
          bEditar.classList.add("bEditar");
          bEditar.classList.add("botonAmarillo");
          bEditar.addEventListener("click", editarTarea);
          let bEliminar = document.createElement("input");
          bEliminar.type = "button";
          bEliminar.value = "Eliminar";
          bEliminar.classList.add("bEliminar");
          bEliminar.classList.add("botonRojo");
          bEliminar.addEventListener("click", eliminarTarea);
          let tdBotones = document.createElement("td");
          tdBotones.classList.add("tdBotones");
          tdBotones.append(bEditar, bEliminar);

          tr.innerHTML =
            `<td class="tituloTarea">${tarea.Titulo}</td>` +
            `<td class="descripcionTarea">${tarea.Descripcion}</td>` +
            `<td>${tarea.FechaInicio}</td>` +
            `<td class="fechaFinTarea">${tarea.FechaFin}</td>` +
            `<td hidden class="idTarea">${tarea.IdTarea}</td>`;
          tr.append(tdBotones);
          tablaTareas.append(tr);
        });
      }
    }
  } catch (error) {
    console.error("Error al visualizar las tareas:", error);
  }
}

async function agregarTarea() {
  let tituloTarea = document.getElementById("tituloTarea").value;
  let descripcionTarea = document.getElementById("descripcionTarea").value;
  let fechaLimite = document.getElementById("fechaFinTarea").value;

  let tareaNueva = {
    titulo: tituloTarea,
    descripcion: descripcionTarea,
    fechaLimite: fechaLimite,
    nUsuario: nUsuario,
  };

  try {
    let response = await fetch("../controller/añadirTareas.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(tareaNueva),
    });

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    // Después de añadir la tarea, ocultar el formulario y limpiar los campos
    nuevaTareaDiv.hidden = true;
    document.getElementById("tituloTarea").value = "";
    document.getElementById("descripcionTarea").value = "";
    document.getElementById("fechaFinTarea").value = "";

    verTareas(); // Refrescar la lista de tareas
  } catch (error) {
    console.error("Error al añadir la tarea:", error);
  }
}

async function eliminarTarea(event) {
  let fila = event.target.closest("tr");
  let idTarea = fila.querySelector(".idTarea").textContent.trim();

  try {
    let response = await fetch("../controller/eliminarTarea.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(idTarea),
    });
    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }
  } catch (error) {
    console.error("Error al eliminar la tarea:", error);
  }
  verTareas();
}

function editarTarea(event) {
  let fila = event.target.closest("tr");

  let tituloTarea = fila.querySelector(".tituloTarea");
  let inputTituloTarea = document.createElement("input");
  inputTituloTarea.type = "text";
  inputTituloTarea.value = tituloTarea.textContent;
  tituloTarea.textContent = "";
  tituloTarea.append(inputTituloTarea);

  let descripcionTarea = fila.querySelector(".descripcionTarea");
  let inputDescripcionTarea = document.createElement("textarea");
  inputDescripcionTarea.value = descripcionTarea.textContent;
  descripcionTarea.textContent = "";
  descripcionTarea.append(inputDescripcionTarea);

  let fechaFin = fila.querySelector(".fechaFinTarea");
  let inputFechaFinTarea = document.createElement("input");
  inputFechaFinTarea.type = "date";
  let hoy = new Date().toISOString().split("T")[0];
  inputFechaFinTarea.setAttribute("min", hoy);
  inputFechaFinTarea.value = fechaFin.textContent;
  fechaFin.textContent = "";
  fechaFin.append(inputFechaFinTarea);

  fila.querySelector(".bEditar").remove();
  fila.querySelector(".bEliminar").remove();

  let bAñadirTarea = document.createElement("input");
  bAñadirTarea.type = "button";
  bAñadirTarea.value = "Guardar Tarea";
  bAñadirTarea.addEventListener("click", async (e) => {
    let edicionTarea = {
      titulo: inputTituloTarea.value,
      descripcion: inputDescripcionTarea.value,
      fechaLimite: inputFechaFinTarea.value,
      idTarea: fila.querySelector(".idTarea").textContent,
    };

    try {
      let response = await fetch("../controller/editarTareas.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(edicionTarea),
      });
      verTareas();
    } catch (error) {
      console.error("Error al editar la tarea:", error);
    }
  });
  let tdBotones = fila.querySelector(".tdBotones");
  tdBotones.append(bAñadirTarea);
}
