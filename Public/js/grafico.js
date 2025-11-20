function mostrarGraficoEmpresas() {
    
    // 1. URL de tu API
    const API_URL = '/portalDeEmpleo2/API/ApiEmpresasEstado.php'; // Cambia esto por la URL real de tu API

    // 2. Consumir la API
    fetch('/portalDeEmpleo2/API/ApiGrafico.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la respuesta de la red: ' + response.statusText);
            }
            return response.json();
        })
        .then(data => {
            // El JSON esperado es: {"activas": 4, "noActivas": 10}

            // 3. Preparar los datos para Chart.js
            const datos = {
                // Las etiquetas de las porciones del gráfico
                labels: [
                    'Empresas Activas',
                    'Empresas No Activas'
                ],
                // Los valores numéricos (4 y 10 en el ejemplo)
                datasets: [{
                    data: [data.activas, data.noActivas],
                    // Colores para cada porción
                    backgroundColor: [
                        'rgb(75, 192, 192)', // Un color verde/azul para activas
                        'rgb(255, 99, 132)'  // Un color rojo/rosa para no activas
                    ],
                    // Hover effect (opcional)
                    hoverOffset: 4
                }]
            };

            // 4. Configurar el gráfico
            const configuracion = {
                type: 'pie', // Especificamos el tipo de gráfico: 'pie' (tarta)
                data: datos,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top', // Posición de la leyenda (Activas/No Activas)
                        },
                        title: {
                            display: true,
                            text: 'Distribución de Empresas por Estado',
                            font: {
                                size: 16
                            }
                        }
                    }
                }
            };

            // 5. Renderizar el gráfico en el <canvas>
            const ctx = document.getElementById('graficoEmpresas').getContext('2d');
            new Chart(ctx, configuracion);
            
        })
        .catch(error => {
            console.error('Error al obtener o procesar los datos del gráfico:', error);
            // Puedes mostrar un mensaje de error en el canvas si lo deseas
            document.getElementById('graficoEmpresas').textContent = "No se pudieron cargar los datos del gráfico.";
        });
}

// Llama a la función para ejecutar la carga y el gráfico al cargar la página
// O cuando sea apropiado en tu código.
document.addEventListener('DOMContentLoaded', mostrarGraficoEmpresas);