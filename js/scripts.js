// Previsualización de imagen
document.addEventListener('DOMContentLoaded', function() {
    const imageInput = document.getElementById('imagen');
    const imagePreview = document.querySelector('.imagen-preview');
    
    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Confirmación para eliminar alojamiento
    const eliminarForms = document.querySelectorAll('.eliminar-form');
    eliminarForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            if (!confirm('¿Estás seguro de que deseas eliminar este alojamiento de tu selección?')) {
                e.preventDefault();
            }
        });
    });

    // Mostrar/ocultar loader durante el envío de formularios
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const loader = this.querySelector('.loader');
            if (loader) {
                loader.style.display = 'block';
            }
        });
    });

    // Validación de formularios
    const authForms = document.querySelectorAll('.auth-form');
    authForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const password = this.querySelector('input[type="password"]');
            if (password && password.value.length < 6) {
                e.preventDefault();
                alert('La contraseña debe tener al menos 6 caracteres');
            }
        });
    });
});

// Función para mostrar mensajes temporales
function showMessage(message, type = 'success') {
    const messageDiv = document.createElement('div');
    messageDiv.className = type === 'success' ? 'success-message' : 'error-message';
    messageDiv.textContent = message;
    
    document.body.insertBefore(messageDiv, document.body.firstChild);
    
    setTimeout(() => {
        messageDiv.remove();
    }, 3000);
}

// Función para filtrar alojamientos (para implementación futura)
function filtrarAlojamientos(criterio) {
    const alojamientos = document.querySelectorAll('.alojamiento-card');
    alojamientos.forEach(alojamiento => {
        const precio = parseFloat(alojamiento.querySelector('.precio').textContent.replace('€', ''));
        const ubicacion = alojamiento.querySelector('.ubicacion').textContent.toLowerCase();
        
        let mostrar = true;
        if (criterio.precio && precio > criterio.precio) {
            mostrar = false;
        }
        if (criterio.ubicacion && !ubicacion.includes(criterio.ubicacion.toLowerCase())) {
            mostrar = false;
        }
        
        alojamiento.style.display = mostrar ? 'block' : 'none';
    });
}