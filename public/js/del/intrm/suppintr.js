const intrs = document.getElementById('intrs');

if (intrs) {
    intrs.addEventListener('click', e => {
        if (e.target.className === 'delete-intrm') {
            if (confirm('Êtes-vous sûr de le supprimer?')) {
                const id = e.target.getAttribute('data-id');
                fetch(`/intermidiares/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}
