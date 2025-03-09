// Abrir el modal y llenar los campos con los datos del producto seleccionado
function openEditModal(id, nombre, precio, cantidad) {
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-nombre').value = nombre;
    document.getElementById('edit-precio').value = precio;
    document.getElementById('edit-cantidad').value = cantidad;

    document.getElementById('editModal').style.display = 'block';
}

// Cerrar el modal
function closeEditModal() {
    document.getElementById('editModal').style.display = 'none';
}
