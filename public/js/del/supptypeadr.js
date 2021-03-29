const typeAdhrents = document.getElementById('typeAdhrents');

if (typeAdhrents) {
    typeAdhrents.addEventListener('click', e => {
        if (e.target.className === 'btn-sm btn btn-danger delete-tadhrent') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/typeadr/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}