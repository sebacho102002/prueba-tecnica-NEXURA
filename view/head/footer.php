</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery Validate -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/additional-methods.min.js"></script>

<script>
$(document).ready(function() {

    $("form").validate({
        rules: {
            nombre: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                email: true
            },
            sexo: {
                required: true
            },
            area_id: {
                required: true
            },
            descripcion: {
                required: true,
                minlength: 10
            },
            roles: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "Por favor, ingresa el nombre completo",
                minlength: "El nombre debe tener al menos 3 caracteres"
            },
            email: {
                required: "Por favor, ingresa un correo electrónico",
                email: "Por favor, ingresa una dirección de correo válida"
            },
            sexo: {
                required: "Por favor, selecciona el sexo"
            },
            area_id: {
                required: "Por favor, selecciona un área"
            },
            descripcion: {
                required: "Por favor, ingresa una descripción",
                minlength: "La descripción debe tener al menos 10 caracteres"
            },
            roles: {
                required: "Por favor, selecciona al menos un rol"
            }
        },
        errorElement: "div",
        errorPlacement: function(error, element) {
            error.addClass("invalid-feedback");
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element) {
            $(element).addClass("is-invalid");
        },
        unhighlight: function(element) {
            $(element).removeClass("is-invalid");
        }
    });
});
</script>

</body>
</html>

