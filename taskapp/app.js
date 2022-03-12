$(function () {

    let edit = false;
    console.log("jQuery is Working"); 
    $('#task-result').hide();
    getTasks();
    
    $('#search').keyup(function(e) { //capturamos la escritura del usuario en campo de búsqueda
        
        if($('#search').val()) {
            let search = $('#search').val(); //capturamos el valor
            $.ajax({
                url: 'task-search.php',
                type: 'POST',
                data: {search},
                success: function(response){
                    
                    let tasks = JSON.parse(response); //CONVIERTE STRING EN JSON
                    console.log(tasks);
                    
                    let template = '';
                    
                    tasks.forEach(task => {
                        template += `<li>${task.name}</li>` //Estas tildes permiten introducir elementos HTML
                    });

                    $('#container').html(template)
                    $('#task-result').show();
                    
                }
            });
        }

    });

    $('#task-form').submit(function (e) { 
        const postData = {
            id: $('#taskId').val(),
            name: $('#name').val(),
            description: $('#description').val()
        };
        //console.log(postData);

        let url = edit === false ? 'task-add.php' : 'task-edit.php';
        console.log(url);

        $.post(url, postData, function (response, status) {
                //console.log(status);
                //console.log(response);
                getTasks();
                $('#task-form').trigger('reset'); //Resetear formulario
        });
        e.preventDefault();

    });

    function getTasks(){

        $.ajax({
            type: "GET",
            url: "task-list.php",
            success: function (response) {
                //console.log(response);
                let template = '';
                let tasks = JSON.parse(response);
                tasks.forEach(task => {
                    template += `
                        <tr taskId="${task.id}">
                            <td>${task.id}</td>
                            <td>
                                <a href="#" class="task-item">${task.name}</a>
                            </td>
                            <td>${task.description}</td>
                            <td>
                                <button class="task-delete btn btn-danger">Delete</button>
                            </td>
                        </tr>
                    `
                });
                $('#tasks').html(template);
            }
        });

    }

    $('.task-delete').click(function (e) { 
        //console.log('clicked');
        if(confirm('¿Are you sure you want to delete it?')){
                    
            let element = $(this)[0].parentElement.parentElement;
            let taskId = $(element).attr('taskId');
            //console.log(taskId);

            $.post("task-delete.php", {taskId},
                function (response, status) {
                    //console.log(response);
                    getTasks();
                }
            );

        }
        
    });

    $('.task-item').click(function (e) { 
        //console.log('Editing');

        let element = $(this)[0].parentElement.parentElement;
        let taskId = $(element).attr('taskId');
        console.log(taskId);

        $.post("task-single.php", {taskId},
            function (response, status) {
                //console.log(status);
                //console.log(response);
                const task = JSON.parse(response);
                $('#taskId').val(task.id); //guardo el ID en un input oculto ya que lo necesito en el formulario cuando trato de actualizar una tarea
                $('#name').val(task.name);
                $('#description').val(task.description);
                edit = true;
            }
        );
        

    });

    
});



    


