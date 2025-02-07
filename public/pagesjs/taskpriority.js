/**
 * App Kanban
 */

"use strict";

(async function () {
    let boards;
    const kanbanSidebar = document.querySelector(".kanban-update-item-sidebar"),
        kanbanWrapper = document.querySelector(".kanban-wrapper"),
        commentEditor = document.querySelector(".comment-editor"),
        kanbanAddNewBoard = document.querySelector(".kanban-add-new-board"),
        kanbanAddNewInput = [].slice.call(document.querySelectorAll(".kanban-add-board-input")),
        kanbanAddBoardBtn = document.querySelector(".kanban-add-board-btn"),
        select2 = $(".select2"), // ! Using jquery vars due to select2 jQuery dependency
        assetsPath = document.querySelector("html").getAttribute("data-base-url");

    // Init kanban Offcanvas
    const kanbanOffcanvas = new bootstrap.Offcanvas(kanbanSidebar);

    // Obtiene la data de la bases de datos de kanban
    const kanbanResponse = await fetch(assetsPath + '/tareas-por-prioridad/json');
    if (!kanbanResponse.ok) {
        console.error("error", kanbanResponse);
    }
    boards = await kanbanResponse.json();

    // Carga el header de la tarjeta de tarea
    function renderHeader(color, text, facturable) {
        if (facturable == 'Si') {
            facturable = "<span class='badge bg-success'>$ Facturable</span>";
        } else {
            facturable = "";
        }
        return (
            "<div class='d-flex justify-content-between flex-wrap align-items-center mb-2'>" +
                "<div class='item-badges d-flex'> " + facturable + '</div>' +
                "<div class='badge bg-" + color +"'> " + text + '</div>'
            + '</div>'
          );
    }

    // Init kanban
    const kanban = new jKanban({
        element: ".kanban-wrapper",
        gutter: "5px",
        widthBoard: "250px",
        dragItems: true,
        boards: boards,
        dragBoards: true,
        // addItemButton: true,
        // buttonContent: "+ Add Item",
        // itemAddOptions: {
        //     position: "top",
        //     enabled: true, // añadir un botón al tablero para facilitar la creación de artículos
        //     content: "+ Nueva Tarea", // texto o contenido html del botón del tablón
        //     class: "kanban-title-button btn btn-default btn-md shadow-none text-capitalize fw-normal text-heading", // default class of the button
        //     footer: false, // posicionar el botón en el pie de página
        // },
        click: async function (el) {
            try {
                const element = el;
                const taskId = element.getAttribute("data-eid");

                if (!taskId) {
                    console.error("No se encontró el ID de la tarea.");
                    return;
                }

                // Realizar solicitud GET para obtener los datos de la tarea
                const response = await fetch(`/kamban/${taskId}/show-item`);
                if (!response.ok) {
                    console.error("Error al obtener los datos de la tarea:", response.statusText);
                    return;
                }

                const taskData = await response.json();
                // Verificar si los datos de la tarea están disponibles
                if (!taskData) {
                    console.error("No se recibieron datos de la tarea.");
                    return;
                }
                console.log(taskData);

                // Asignar valores obtenidos a los campos del modal
                document.querySelector("#update_board_id").value = taskData.task.id || "";
                document.querySelector("#title_update").value = taskData.task.title || "";
                document.querySelector("#description_update").value = taskData.task.description || "";
                document.querySelector("#start_date_update").value = taskData.task.start_date || "";
                document.querySelector("#due_date_update").value = taskData.task.due_date || "";
                $('#label_update').val(taskData.task.priority).trigger('change');
                $('#event_calendar_update').val(taskData.task.event_calendar).trigger('change');
                document.querySelector("#start_time_update").value = taskData.task.start_time || "";
                document.querySelector("#due_time_update").value = taskData.task.due_time || "";
                $('#billable_task_update').val(taskData.task.billable_task).trigger('change');
                document.querySelector("#time_billable_task_update").value = taskData.task.time_billable_task || "";

                // listar los archivos subidos
                const attachments = taskData.files || [];
                const attachmentsHtml = attachments
                    .map(function (attachment) {
                        console.log(attachment.file);
                        return "<li><i class='ri-arrow-drop-right-fill'></i> <a href='" + assetsPath + "" + attachment.file + "' target='_blank'>" + attachment.filename + "</a></li>";
                    })
                    .join("");
                document.querySelector("#archivos_subidos").innerHTML = attachmentsHtml;

                // Mostrar el modal
                const viewTaskModal = new bootstrap.Modal(document.querySelector("#ViewTaskModal"));
                viewTaskModal.show();
            } catch (error) {
                console.error("Error en la función click:", error);
            }
        },
        buttonClick: function (el, boardId) {
            console.log(boardId);
            console.log(el);

            // abrir modal de crear tarea
            document.querySelector("#modal_board_id").value = boardId;
            modalCreateTask.show();
        },

    });

    // Kanban Wrapper scrollbar
    if (kanbanWrapper) {
        new PerfectScrollbar(kanbanWrapper);
    }

    const kanbanContainer = document.querySelector(".kanban-container"),
        kanbanTitleBoard = [].slice.call(
            document.querySelectorAll(".kanban-title-board")
        ),
        kanbanItem = [].slice.call(document.querySelectorAll(".kanban-item"));

    // Render custom items
    if (kanbanItem) {
        kanbanItem.forEach(function (el) {
            const element = "<span class='kanban-text'><strong>" + el.textContent + "</strong></span>";
            const title = "<span class='kanban-text'>" + el.getAttribute("data-title-secondary") + "</span>";
            el.textContent = "";

            if (el.getAttribute("data-badge") !== undefined && el.getAttribute("data-badge-text") !== undefined)
            {
                el.insertAdjacentHTML("afterbegin",
                renderHeader(el.getAttribute("data-badge"),
                            el.getAttribute("data-badge-text"),
                            el.getAttribute("data-facturable")) + element + title);
            }
        });
    }

    // To initialize tooltips for rendered items
    const tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // prevent sidebar to open onclick dropdown buttons of tasks
    const tasksItemDropdown = [].slice.call(
        document.querySelectorAll(".kanban-tasks-item-dropdown")
    );
    if (tasksItemDropdown) {
        tasksItemDropdown.forEach(function (e) {
            e.addEventListener("click", function (el) {
                el.stopPropagation();
            });
        });
    }

    // crear tarea con boton del tablero
    // const addNewTask = [].slice.call(
    //     document.querySelectorAll(".add-new-task")
    // );
    // if (addNewTask) {
    //     addNewTask.forEach(function (elem) {
    //         elem.addEventListener("click", function () {
    //             const boardId = this.closest(".kanban-board").getAttribute("data-id");
    //             // abrir modal de crear tarea
    //             document.querySelector("#modal_board_id").value = boardId;
    //             modalCreateTask.show();
    //         });
    //     });
    // }
    // // Eliminar tarea de tablero
    // const deleteTask = [].slice.call(document.querySelectorAll(".delete-task"));
    // if (deleteTask) {
    //     deleteTask.forEach(function (e) {
    //         e.addEventListener("click", function () {
    //             const id = this.closest(".kanban-item").getAttribute("data-eid");
    //             console.log(id)
    //             Swal.fire({
    //                 title: '¿Está seguro de eliminar esta Tarea?',
    //                 text: "No podra recuperar la información!",
    //                 icon: 'warning',
    //                 showCancelButton: true,
    //                 confirmButtonText: 'Si, eliminar!',
    //                 cancelButtonText: 'Cancelar',
    //                 customClass: {
    //                     confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
    //                     cancelButton: 'btn btn-outline-danger waves-effect'
    //                 },
    //                 buttonsStyling: false
    //             }).then((result) => {
    //                 if (result.isConfirmed) {
    //                     window.location.href =
    //                         "/kamban/"+workspace_id+"/"+id+"/delete-item";
    //                 }
    //             });
    //         });
    //     });
    // }

    // Eliminar tablero
    // const deleteBoards = [].slice.call(
    //     document.querySelectorAll(".delete-board")
    // );
    // if (deleteBoards) {
    //     deleteBoards.forEach(function (elem) {
    //         elem.addEventListener("click", function () {
    //             const id = this.closest(".kanban-board").getAttribute("data-id");
    //             Swal.fire({
    //                 title: '¿Está seguro de eliminar este Tablero?',
    //                 text: "Las tareas del tablero no podran ser recuperadas!",
    //                 icon: 'warning',
    //                 showCancelButton: true,
    //                 confirmButtonText: 'Si, eliminar!',
    //                 cancelButtonText: 'Cancelar',
    //                 customClass: {
    //                     confirmButton: 'btn btn-primary me-3 waves-effect waves-light',
    //                     cancelButton: 'btn btn-outline-danger waves-effect'
    //                 },
    //                 buttonsStyling: false
    //             }).then((result) => {
    //                 if (result.isConfirmed) {
    //                     document.querySelector("#boardcolumn").value = id;
    //                     document.querySelector("#form_delete_board").submit();
    //                 }
    //             });
    //         });
    //     });
    // }


    // Clear comment editor on close
    kanbanSidebar.addEventListener("hidden.bs.offcanvas", function () {
        kanbanSidebar.querySelector(".ql-editor").firstElementChild.innerHTML =
            "";
    });

    // Re-init tooltip when offcanvas opens(Bootstrap bug)
    if (kanbanSidebar) {
        kanbanSidebar.addEventListener("shown.bs.offcanvas", function () {
            const tooltipTriggerList = [].slice.call(
                kanbanSidebar.querySelectorAll('[data-bs-toggle="tooltip"]')
            );
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    }
})();
