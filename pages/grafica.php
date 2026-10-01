<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gráfico de Pastel con Chart.js</title>
    //<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<canvas id="miGrafico" width="400" height="400"></canvas>

<script>
    async function obtenerDatos() {
        try {
            const response = await fetch('grafica_data.php'); // Cambia 'grafica_data.php' según la ruta real
            const datos = await response.json();
            return datos;
        } catch (error) {
            console.error("Error al obtener los datos:", error);
            return { labels: [], data: [] }; // Devuelve valores vacíos en caso de error
        }
    }

    async function crearGrafico() {
        const datos = await obtenerDatos();

        const ctx = document.getElementById('miGrafico').getContext('2d');
        const miGrafico = new Chart(ctx, {
            type: 'pie', // Tipo de gráfico cambiado a 'pie'
            data: {
                labels: datos.labels, // Etiquetas de las categorías
                datasets: [{
                    label: 'Rentas por ciudad',
                    data: datos.data, // Datos correspondientes a las etiquetas
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ], // Colores para cada segmento del pastel
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ], // Bordes de los colores
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true, // Ajuste automático al tamaño del contenedor
                plugins: {
                    legend: {
                        position: 'top', // Posición de la leyenda
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                let label = tooltipItem.label || '';
                                const value = tooltipItem.raw || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }
            }
        });
    }

    crearGrafico();
</script>

</body>
</html>
