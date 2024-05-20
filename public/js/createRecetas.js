$(document).ready(function () {
    var numOfIngredient = 0;

    $("#createForm").submit(function (e) {
        e.preventDefault(e);
        let images = $("#images")[0].files;
        console.log(images);
        let formData = new FormData();
        // return;
        $("#saveReceta").prop('disabled', true);


        //obtiene los valores de los inputs
        let title = $("#title").val();
        let calories = $("#calories").val();
        let body = $("#body").val();
        let ingredients_array = [];

        let ingredients = $("#ingredientsContainer").children();

        //HORA DE GUARDAR TODOS LOS INGREDIENTES
        for (let index = 0; index < ingredients.length; index++) {
            const element = ingredients[index];

            let new_ingredient = {
                ingredient: "",
                quantity: "",
                measurement: "",
            };

            //Obtiene los datos de los inputs
            new_ingredient.ingredient = element.children[0].value;
            new_ingredient.quantity = element.children[1].value;
            new_ingredient.measurement = element.children[2].value;

            if (
                !new_ingredient.ingredient ||
                !new_ingredient.quantity ||
                !new_ingredient.measurement
            ) {
                showErrorMessage('Todos los ingredientes deben de estar completo');

                return;
            }

            ingredients_array.push(new_ingredient);
        }

        let data = {
            title,
            calories,
            body,
            ingredients_array,
        };

        let new_images = [];
        if(images) {
            for (let i = 0; i < images.length; i++) 
                formData.append('images[]', images[i]);
        }

        formData.append('title', title);
        formData.append('calories', calories);
        formData.append('body', body);
        ingredients_array.forEach(function (ingredient) {
            formData.append('ingredients_array[]', JSON.stringify(ingredient));
        })
        if(new_images.length > 0)
            formData.append('images[]', new_images)

        //manda la peticion al servidor

        console.log(formData.getAll('image'));

        // return;

        $.ajax({
            url: '/ajax/saveReceta',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            succes: showSuccesMessageWithRedirect("Receta creada!", '/recetas'),
            error: function(data) {
                showErrorMessage(data.responseJSON.msg);
                $("#saveReceta").removeAttr('disabled');
            }
        })
    });

    $("#addIngredient").on("click", function () {
        $("#ingredientsContainer").append(`
            <div id="${numOfIngredient}_container">
                <input type="text" id="${numOfIngredient}_ingredient">
                <input type="number" id="${numOfIngredient}_quantity">
                <select id="${numOfIngredient}_measurment">
                    <option value="pieza(s)">pieza(s)</option>
                    <option value="ml">ml</option>
                    <option value="L">L</option>
                    <option value="g">g</option>
                    <option value="kg">kg</option>
                </select>
                <button type="button" id="${numOfIngredient}_eliminarIngrediente" onclick="$('#${numOfIngredient}_container').remove()">Eliminar</button>
                <bu>
            </div>
        `);

        numOfIngredient++;
    });
});