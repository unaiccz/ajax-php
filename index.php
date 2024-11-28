<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <form id="notaForm" class="mb-4">
        <div class="form-group">
            <label for="alumno">Nombre del alumno</label>
            <input type="text" id="alumno" name="alumno" class="form-control" placeholder="Nombre del alumno" required>
        </div>
        <div class="form-group">
            <label for="nota">Nota</label>
            <input type="number" id="nota" name="nota" class="form-control" placeholder="Nota" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Nota</button>
    </form>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Notas</th>
            </tr>
        </thead>
        <tbody id="notas"></tbody>
    </table>
    <script>
        const xhr = new XMLHttpRequest();

        function getNotas() {
            xhr.open("GET", 'http://localhost:4141/server.php', true);
            xhr.send();

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    const resp = JSON.parse(xhr.responseText) ?? [];
                    
                    const notasElement = document.getElementById('notas');
                    notasElement.innerHTML = ''; // Limpiar la tabla antes de agregar nuevas filas

                    for(let i = 0; i < resp.length; i++){
                        let row = document.createElement('tr');
                        let cell = document.createElement('td');
                        let cell2 = document.createElement('td');
                        cell.textContent = resp[i].alumno;
                        cell2.textContent = resp[i].nota;
                        row.appendChild(cell);
                        row.appendChild(cell2);
                        notasElement.appendChild(row);
                    }
                }
            }
        }

        document.getElementById('notaForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const alumno = document.getElementById('alumno').value;
            const nota = document.getElementById('nota').value;

            const xhrPost = new XMLHttpRequest();
            xhrPost.open("POST", 'http://localhost:4141/server.php', true);
            xhrPost.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhrPost.send(`alumno=${alumno}&nota=${nota}`);

            xhrPost.onreadystatechange = function () {
                if (xhrPost.readyState == 4 && xhrPost.status == 200) {
                    getNotas(); // Actualizar la tabla con las nuevas notas
                }
            }
        });

        getNotas();
    </script>
    <!-- Incluir Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>